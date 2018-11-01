<template>
    <div class="panel panel-default" v-if="isReady">
        <div class="panel-heading">
            <h5>{{ courses.classe.cla_intitule}}</h5>
        </div>

            <table class="table table-striped">
                <tbody>
                    <tr v-for="(e,index) in courses.enseigner" v-bind:key='e.created_at'>
                        <!-- <td><button class="btn btn-sm btn-primary">Marquer</button></td> -->
                        <td><input type="checkbox" v-model="e.cocher" @click="saveOnePresence(index)"></td>
                        <td>{{ e.details.matiere.intitule }}</td>
                        <td>{{ e.details.professeur.prof_prenoms }} {{ e.details.professeur.prof_nom }}</td>
                    </tr>
                </tbody>
            </table>
        <div class="panel-footer">
            <button class="btn btn-sm btn-info">Tout cocher</button>
            <button class="btn btn-sm btn-success">Enregistrer</button>
        </div>
    </div>
    <div v-else>
        Loading...
    </div>
</template>

<script>
import { Routes } from "../../routes.js";
export default {
  props: {
    courses: "",
    date: "",
  },
  data() {
    return {
      formatedCourses: "",
      selected: [],
      saved: [],
      issending: false
    };
  },
  methods: {

    saveOnePresence(indexInFormatedCourses) {
      let concernedItem = this.formatedCourses.enseigner[indexInFormatedCourses];
      let msg = "Confirmez-vous que le professeur " + concernedItem.details.professeur.prof_nom + ' ' + concernedItem.details.professeur.prof_prenoms + " a effectué le cours < " + concernedItem.details.matiere.intitule + " > aujourd'hui ? Attention car cette action est irréversible."

      // console.log(concernedItem);
      let defaultHoraire = 4; // TODO: change it with the real horaire 

      // Afficher l'alerte seulement si coché
      if (concernedItem.cocher == false) {
        if (confirm(msg)) {
          console.log("C'est parti !")
          let requestBody = {
            prof: concernedItem.details.professeur_id,
            horaire: defaultHoraire,
            date: this.getFormattedDate()
          };
          axios.post(Routes.presenceProfesseur.store, requestBody)
          .then((response) => {
            console.log(response);
          })
          .catch((error) => {
            console.log(error);
          })
        } else {
          // decocher le checkbox
          // this.formatedCourses.enseigner[indexInFormatedCourses].cocher = false
          console.log("Il vaudrait mieux pour vous ...")
        }
      }

    },

    savePresences() {

    },

    async cloneCourseProp() {
      this.formatedCourses = await { ...this.courses };
    },

    getFormattedDate() {
      let d = this.date.getDate() + "-" + (this.date.getMonth() + 1) + "-" + this.date.getFullYear();
      return d;
    },

    /**
     * Recupere tous les models representant des elements deja
     * coches pour la date d'aujourd'hui
     */
    async getAlreadySaved() {}
  },
  computed: {
    isReady() {
      return typeof this.formatedCourses == "object" ? true : false;
    }
  },
  mounted() {
    this.cloneCourseProp();
    this.getAlreadySaved();
  }
};
</script>
