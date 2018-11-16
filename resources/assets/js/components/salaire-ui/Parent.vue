<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h4 class="panel-title">1 - Période</h4>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Mois</label>
                            <select class='form-control' v-model='selectedMonth'>
                                <option v-for="(m,key) in months" v-bind:key='m' v-bind:value='key+1'>{{ m }}
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Annee</label>
                            <select class='form-control' v-model='selectedYear'>
                                <option v-for="y in years" v-bind:key='y' v-bind:value='y'>{{ y }}
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success">Charger</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4 class="panel-title">2 - Les professeurs</h4>
                    </div>
                    <div class="list-group" v-if="profFetched">
                        <a href="#" class="list-group-item" v-for="p in profs" v-bind:key='p.id' v-bind:value='p.id'
                            @click="fetchSalaireDetails(p.id)">
                            {{ buildFullName(p) }}
                            <!-- <p class="list-group-item-text">...</p> -->
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">3 - Paiement salaire</h4>
                    </div>

                    <div class="panel-body">
                        <div v-if="isSearchingSalaire">
                            <h4 class="text-center">Chargement en cours...</h4>
                        </div>
                        <div v-if="salaireDetailsIsReady">
                            {{ salaireDetailsObj }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Routes } from "../../routes.js";

export default {
  mounted() {
    // Preselect some data for the first time
    // the component load
    let today = new Date();
    this.selectedMonth = today.getMonth() + 1;
    this.selectedYear = today.getFullYear();

    this.start();
  },
  data() {
    return {
      years: [],
      profs: [],
      months: [],
      classes: [],
      enseignerByClasse: [],

      selectedMonth: "",
      selectedProf: "",
      selectedYear: "",
      salaireDetailsObj: "",
      isLoadingDetails: false
    };
  },
  computed: {
    profFetched() {
      return this.profs.length > 0 ? true : false;
    },
    activePeriodeButton() {
      return this.selectedMonth != "" && this.selectedYear != "" ? true : false;
    },
    isSearchingSalaire() {
      return this.selectedProf != "" && this.isLoadingDetails == true
        ? true
        : false;
    },
    salaireDetailsIsReady() {
      return this.salaireDetailsObj != "" ||
        this.salaireDetailsObj != null ||
        this.salaireDetailsObj != undefined
        ? true
        : false;
    }
  },
  methods: {
    start() {
      this.getPrimitivesDatas();
    },

    getPrimitivesDatas() {
      this.populateYears();
      this.populateMonths();
      this.fetchProfesseurs();
    },

    fetchSalaireDetails(professeurKey) {
      this.isLoadingDetails = true;
      this.salaireDetailsObj = "";
      this.selectedProf = professeurKey;

      let req = {
        year: this.selectedYear,
        month: this.selectedMonth,
        prof: this.selectedProf
      };

      axios
        .post(Routes.salaire.post.fetchDetails, req)
        .then(response => {
          this.salaireDetailsObj = response.data;
          console.log(response.data);
        })
        .catch(error => {
          console.log(req);
          console.log("Error failing salaire details..");
        })
        .finally(() => {
          this.isLoadingDetails = false;
        });
    },

    populateYears() {
      this.years = [];
      let actualYear = new Date().getFullYear();

      for (let index = 2017; index <= actualYear; index++) {
        console.log(index);
        this.years.push(index);
      }
    },

    populateMonths() {
      this.months = [
        "Janvier",
        "Février",
        "Mars",
        "Avril",
        "Mai",
        "Juin",
        "Juillet",
        "Août",
        "Septembre",
        "Octobre",
        " Novembre",
        "Décembre"
      ];
    },

    fetchProfesseurs() {
      axios
        .get(Routes.professeur.fetch)
        .then(response => {
          this.profs = response.data;
        })
        .catch(error => {
          this.errorActions(error, "Error on getting professeurs");
        });
    },

    buildFullName(professeur) {
      if (professeur == null) return null;

      return professeur.prof_nom + " " + professeur.prof_prenoms;
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
    }
  }
};
</script>
