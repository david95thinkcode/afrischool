<template>
    <div class="row">
        <div class="col-sm-12">
            <div class="row" v-if="fetched">
                <div class="col-sm-4">
                    <div class="panel panel-default" v-for="(c, cindex) in classesWithCorrespondingEnseigner"
                        v-bind:key="cindex">
                        <div class="panel-heading">
                            <h5>{{ c.classe.cla_intitule}}</h5>
                        </div>
                        <div class="panel-body">
                            <form v-on:submit.prevent accept-charset="UTF-8">
                                <div class="form-group" v-for="e in c.enseigner" v-bind:key='e.created_at'>
                                    <input type="checkbox" :id="'el'.concat(e.created_at)" class="">
                                    <label :for="'el'.concat(e.created_at)">{{ e.matiere.intitule }}</label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Routes } from "../routes.js";

export default {
  data() {
    return {
      horaires: [],
      readableCourses: [],

      distinctsClasses: [],

      /* Contient des classes sans doublon
        * Chaque item contient :
        * - la classe
        * - les enseigner concernant la classe
       */
      classesWithCorrespondingEnseigner: [],

      distinctEnseigner: [],
      enseignerObjectsDetails: [], // Contient les oject enseigner de distinctsEnseigner

      fetched: false
    };
  },
  props: {},
  mounted() {
    this.fetchTodaysCourses();
  },
  methods: {
    populateClassesWithEnseigner() {
      // On prends chaque item de $chassesdistintes
      // puis on recherche dans $distinctEnseigner l'element
      // correspondant a la classe en question
      // Une fois trouvé, on peuple cree un object
      // dans lequel se trouve les details de la classe
      // mais aussi un les enseigner correspondants

      this.distinctsClasses.forEach(classeID => {
        this.enseignerObjectsDetails.forEach(ens => {
          if (ens.details.classe_id == classeID) {
            let d = {
              classe: ens.details.classe,
              enseigner: []
            };
            d.enseigner.push(ens.details);
            this.classesWithCorrespondingEnseigner.push(d);
          }
        });
      });
    },

    /**
     * Recupere les cours enseignes aujourdh"hui
     */
    async fetchTodaysCourses() {
      let today = new Date();
      let formattedToday = today
        .getDate()
        .toString()
        .concat(
          "-",
          (today.getMonth() + 1).toString(),
          "-",
          today.getFullYear()
        );
      let requestBody = {
        day: formattedToday
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
     */
    async fetchEnseignerDetails(enseignerID) {
      let response = await axios.get(
        Routes.enseigner.get.details.concat(enseignerID)
      );

      this.enseignerObjectsDetails.push({
        id: enseignerID,
        details: response.data
      });

      return new Promise(resolve => {
        resolve();
      });
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
    },

    fetchMatieres() {
      axios
        .post(Routes.enseigner.post.classNdate, this.absence)
        .then(response => {
          this.matieres = response.data;
        })
        .catch(error => {
          this.errorActions(error, "Error on getting matieres");
        });
    },

    fetchInscrits() {
      axios
        .get(Routes.inscription.forClasse.concat(this.absence.classe))
        .then(response => {
          this.inscrits = response.data;
        })
        .catch(error => {
          this.errorActions(error, "Error on getting inscrits");
        });
    },

    gotoMatStep() {
      this.resetInput();
      this.fetchMatieres();
      this.fetchInscrits();
    },

    toggleEleveCheckbox(inscriptionID) {
      if (this.choosedEleve.length == 0) {
        this.choosedEleve.push(inscriptionID);
      } else {
        // Toggling code
        let i = this.choosedEleve.indexOf(inscriptionID);
        i == -1
          ? this.choosedEleve.push(inscriptionID)
          : this.choosedEleve.splice(i, 1);
      }
    },

    /**
     * @param
     */
    removeInscritItem(itemvalue) {},

    store() {
      this.isSaving = true;
      axios
        .post(Routes.absenses.post.store, {
          eleves: this.choosedEleve,
          enseigner: this.pickedMat,
          date: this.absence.date
        })
        .then(response => {
          console.log(response.data);
          this.successActions("Absences enregistré");
        })
        .catch(error => {
          this.errorActions(error, "Problème");
        })
        .finally(() => {
          this.isSaving = false;
        });
    },

    resetInput() {
      this.matieres = [];
      this.inscrits = [];
      this.choosedEleve = [];
      this.pickedMat = "";
    },

    successActions(successMessage) {
      this.resetInput();
      this.isSaved = true;
      this.error = "";
      // this.$emit('refresh');
      console.log(successMessage);
      alert(successMessage);
    },

    errorActions(error, message) {
      console.log(message);
      console.log(error);
      this.error = error;
      this.isSaved = false;
    }
  },
  computed: {
    // CLASSES_ARE_FILLED() {
    //   return this.classes.length > 0 ? true : false;
    // },
    INSCRITS_ARE_FILLED() {
      return this.inscrits.length > 0 ? true : false;
    },
    MATIERES_ARE_FILLED() {
      return this.matieres.length > 0 ? true : false;
    },
    READY_FOR_MATIERE_STEP() {
      return this.absence.date != "" && this.absence.classe != ""
        ? true
        : false;
    },
    READY_FOR_SUBMIT() {
      return this.choosedEleve.length > 0 && this.pickedMat != ""
        ? true
        : false;
    },
    isErrored() {
      return this.error === "" ? false : true;
    }
  }
};
</script>

<style>
/* .btn-primary:active,
.btn-primary.active,
.btn-primary.active.focus,
.open > .btn-primary.dropdown-toggle {
  background-color: #1abb9c; */
/* } */
</style>

