<template>
<div class="row">
    <div class="col-sm-12">
        <div class="row" v-if="fetched">
            <div class="col-sm-4">
                <div class="panel panel-default" v-for="c in distinctsClasses" v-bind:key="c">
                    <div class="panel-heading">
                        <h5>{{c}}</h5>
                    </div>
                    <div class="panel-body">
                        
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
      distinctsClassesDetails: [],

      distincEnseigner: [],
      enseignerObjectsDetails: [], // Contient les onject enseignes de distinctsEnseigner
      
      fetched: false
    };
  },
  props: {},
  mounted() {
    this.fetchTodaysCourses();
  },
  methods: {
    /**
     * Recupere les cours enseignes aujourdh"hui
     */
    fetchTodaysCourses() {
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
      axios
        .post(Routes.emploiDuTemps.post.date, requestBody)
        .then(response => {
          this.horaires = response.data;

          // Fetching enseigner details
          this.horaires.forEach(h => {
            let found = this.distincEnseigner.find(function(element) {
              return element == h.enseigner.id;
            });

            if (this.distincEnseigner.length == 0 || found == undefined) {
              this.distincEnseigner.push(h.enseigner.id);
              this.fetchEnseignerDetails(h.enseigner.id);
            }
            // Getting distincs classe
            let foundClass = this.distinctsClasses.find(function(element) {
                return element == h.enseigner.classe_id;
            });

            if ((this.distinctsClasses.length == 0) || (foundClass == undefined)) {
                this.distinctsClasses.push(h.enseigner.classe_id);
                // Getting classe details directly from enseignerDetails
            }
            // End gettings distinct clasees
          });
          this.fetched = true;
          // End fetching enseigner details
          

        })
        .catch(error => {
          alert("Un probleme est survenu");
        });
    },

    fetchEnseignerDetails(enseignerID) {
      axios.get(Routes.enseigner.get.details.concat(enseignerID)).then(res => {
        this.enseignerObjectsDetails.push({
          id: enseignerID,
          details: res.data
        });
      });
    },

    fetchClasses() {
      axios
        .get(Routes.classes.get.fetch)
        .then(response => {
          this.classes = response.data;
        })
        .catch(error => {
          this.errorActions(error, "Error on getting classes");
        });
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
    CLASSES_ARE_FILLED() {
      return this.classes.length > 0 ? true : false;
    },
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
.btn-primary:active,
.btn-primary.active,
.btn-primary.active.focus,
.open > .btn-primary.dropdown-toggle {
  background-color: #1abb9c;
}
</style>

