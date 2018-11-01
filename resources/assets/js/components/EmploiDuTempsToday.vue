<template>
    <div class="row">
        <div class="col-sm-12">
            <div class="row" v-if="fetched">
                <div class="col-sm-4" 
                  v-for="(c, cindex) in classesWithCorrespondingEnseigner"
                  v-bind:key="cindex">
                  <prof-presence-check v-bind:courses='c' v-bind:date='today'></prof-presence-check>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Routes } from "../routes.js";
import ProfesseurPresenceCheck from "./professeurs/ProfesseurPresenceCheck.vue";

export default {
  components: {
    "prof-presence-check": ProfesseurPresenceCheck
  },
  data() {
    return {
      horaires: [],
      distinctsClasses: [],

      /* Contient des classes sans doublon
        * Chaque item contient :
        * - la classe
        * - les enseigner concernant la classe
       */
      classesWithCorrespondingEnseigner: [],
      distinctEnseigner: [],
      enseignerObjectsDetails: [], // Contient les oject enseigner de distinctsEnseigner

      fetched: false,
      today: '',
      formattedToday: "",
    };
  },
  props: {},
  mounted() {
    this.today = new Date();
    this.formattedToday = this.getFormattedDate();
    this.fetchTodaysCourses();
  },
  methods: {
    populateClassesWithEnseigner() {
      // On prends chaque item de $chassesdistintes
      // puis on recherche dans $enseignerObjectsDetails les elements
      // correspondant a la classe en question
      // Une fois trouvé, on crée un object
      // dans lequel se trouve les details de la classe
      // mais aussi les enseigner correspondants

      this.distinctsClasses.forEach(classeID => {
        let enseignerForThisClasse = this.enseignerObjectsDetails.filter(
          function(eodElement) {
            return eodElement.details.classe.id === classeID;
          }
        );
        if (enseignerForThisClasse.length > 0) {
          let d = {
            classe: { ...enseignerForThisClasse[0].details.classe },
            enseigner: [...enseignerForThisClasse]
          };
          this.classesWithCorrespondingEnseigner.push(d);
        }
      });
    },

    /**
     * Recupere les cours enseignes aujourdh"hui
     */
    async fetchTodaysCourses() {
      
      // for test only
      // this.formattedToday = '31-10-2018';

      let requestBody = {
        day: this.formattedToday
      };

      let post = await axios.post(Routes.emploiDuTemps.post.date, requestBody);

      this.horaires = post.data;

      // Let's fetch enseigner data for each horaire
      for (let h of this.horaires) {
        this.pushToDistinctEnseigner(h.enseigner.id);
        await this.fetchEnseignerDetails(h.enseigner.id);
        this.pushToDistinctsClasses(h.enseigner.classe_id);
      }
      this.fetched = true;

      this.populateClassesWithEnseigner();
    },

    /**
     * Recupere les details d'un model Enseigner
     * dont l'ID est recu en parametre
     * et l'ajoute au tableau enseignerObjectsDetails
     */
    async fetchEnseignerDetails(enseignerID) {
      let response = await axios.get(
        Routes.enseigner.get.details.concat(enseignerID)
      );

      this.enseignerObjectsDetails.push({
        id: enseignerID,
        details: response.data,
        cocher: false // tres important
      });

      return new Promise(resolve => {
        resolve();
      });
    },

    getFormattedDate() {
      let d = this.today.getDate() + "-" + (this.today.getMonth() + 1) + "-" + this.today.getFullYear();
      return d;
    },

    /**
     * Push to the array and prevent agains duplication
     */
    pushToDistinctEnseigner(enseignerID) {
      let found = this.distinctEnseigner.find(function(element) {
        return element == enseignerID;
      });

      if (this.distinctEnseigner.length == 0 || found == undefined) {
        this.distinctEnseigner.push(enseignerID);
      }
    },

    pushToDistinctsClasses(classeID) {
      let foundClass = this.distinctsClasses.find(function(element) {
        return element == classeID;
      });

      if (this.distinctsClasses.length == 0 || foundClass == undefined) {
        this.distinctsClasses.push(classeID);
        // Getting classe details directly from enseignerDetails
      }
    }
  },
  computed: {}
};
</script>
