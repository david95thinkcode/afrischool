<template>
    <div class="row">
        <div class="col-sm-12">
            <div class="row">

              <div class="col-sm-offset-3 col-sm-6">
                <!-- <h3>Date : {{ today }}</h3> -->
                  <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                      <h4 class="panel-title text-center">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"  aria-controls="collapseOne">
                          <span class="glyphicon glyphicon-search" aria-hidden="true"></span> 
                          Chercher pour une autre date
                        </a>
                      </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                      <div class="panel-body">
                        <div class="form-group">
                          <div class="row">
                            <div class="col-sm-6">
                              <input type="date" class='form-control' v-model="date">
                            </div>
                            <div class="col-sm-6">
                              <button class="btn btn-success" @click="start()" v-bind:disabled="date == ''" >Charger le cahier de présence</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
                
              </div>
            </div>
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
      date: '',
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
      alreadyCheckedInDB: [], // contient les presences deja enregistrés pour cette date dans la base de donnees
      fetched: false,
      today: '',
    };
  },
  props: {},
  computed: {},
  mounted() {
    this.today = new Date();
    this.start();
  },
  methods: {
    
    /**
     * Vidons les donnees prealables
     */
    resetData() {
      this.horaires = [];
      this.distinctsClasses = [];
      this.distinctEnseigner = [];
      this.alreadyCheckedInDB = [];
      this.enseignerObjectsDetails = [];
      this.classesWithCorrespondingEnseigner = [];
    },

    /**
     * Lance le code d'execution de la page
     * Si la date est non vide,
     * lancer le processus, sinon ne rien faire
     */
    start() {
      if (this.date != '') this.today = new Date(this.date);
      this.resetData();
      this.fetchExistingMarkedPresencesInDB();
      this.fetchTodaysCourses();

      console.log('Loading cahier de presence for date ' + this.date)
    },

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
      
      let requestBody = {
        day: this.getFormattedDate()
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
     * Récupère les presences déja marquées 
     * dans la base de données afin de les pour des 
     * traitements dans d'autre methoes
     */
    async fetchExistingMarkedPresencesInDB() {
      let request = await axios.post(Routes.presenceProfesseur.existing, {
        day: this.getFormattedDate()
      });

      this.alreadyCheckedInDB = request.data;

      return new Promise(resolve => {
        resolve();
      });
    },

    /**
     * Recupere les details d'un model Enseigner
     * dont l'ID est recu en parametre
     * et l'ajoute au tableau enseignerObjectsDetails
     */
    async fetchEnseignerDetails(enseignerID) {
      let response = await axios.get(
        Routes.enseigner.get.details + enseignerID
      );

      let concernedHoraire = this.horaires.find(function(element) {
        return element.enseigner.id == enseignerID && element.enseigner.professeur_id;
      });

      // On verifie que pour tel element, si la presence
      // d'un prof a auparavant été marquée dans la DB
      // si c'est le cas, 
      // la propriete disableInput se mettra a true
      // la propriete cocher aussi sera a true

      let control = this.alreadyCheckedInDB.find(function(element) {
        return element.real_professeur_id == response.data.professeur_id && element.horaire_id == concernedHoraire.id;
      });

      this.enseignerObjectsDetails.push({
        id: enseignerID,
        horaire: concernedHoraire,
        details: response.data,
        cocher: control === undefined ? false : true, // tres important
        disableInput: control === undefined ? false : true, 
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
};
</script>
