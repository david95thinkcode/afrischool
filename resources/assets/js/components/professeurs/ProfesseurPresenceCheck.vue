<template>
    <div class="panel panel-primary" v-if="isReady">
        <div class="panel-heading">
            <h4 class="panel-title">
              {{ courses.classe.cla_intitule}} / date: {{ formattedDate }}
            </h4>
            <div v-if="inProgress">Traitement en cours...</div>
        </div>

            <table class="table table-striped">
                <tbody>
                    <tr v-for="(e,index) in courses.enseigner" v-bind:key='e.created_at' v-bind:class="e.disableInput ? 'success' : ''">
                        <td><input type="checkbox" v-model="e.cocher" @click="saveOnePresence(index)" v-bind:disabled="e.disableInput"></td>
                        <td>{{ e.details.matiere.intitule }}</td>
                        <td>{{ e.details.professeur.prof_prenoms }} {{ e.details.professeur.prof_nom }}</td>
                    </tr>
                </tbody>
            </table>
    </div>
    <div v-else>
        Chargement en cours..
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
      inProgress: false
    };
  },
  methods: {

    saveOnePresence(indexInFormatedCourses) {
      let concernedItem = this.formatedCourses.enseigner[indexInFormatedCourses];
      let msg = "Confirmez-vous que le professeur " + concernedItem.details.professeur.prof_nom + ' ' + concernedItem.details.professeur.prof_prenoms + " a effectué le cours < " + concernedItem.details.matiere.intitule + " > aujourd'hui ? Attention car cette action est irréversible."

      // Afficher l'alerte seulement si coché
      if (concernedItem.cocher == false) {
        if (confirm(msg)) {
          this.inProgress = true;
          let requestBody = {
            prof: concernedItem.details.professeur_id,
            horaire: concernedItem.horaire.id,
            date: this.getFormattedDate()
          };
          axios.post(Routes.presenceProfesseur.store, requestBody)
          .then((response) => {
            concernedItem.cocher = true;
            concernedItem.disableInput = true;
          })
          .catch((error) => {
            console.log("Nous n'avons pas pu enregistrer cette présence :");
            console.log(requestBody)
            console.log(error);
          })
          .finally(() => {
            this.inProgress = false;
          })
        }
      }

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
    },
    formattedDate() {
      return this.date.getDate() + "-" + (this.date.getMonth() + 1) + "-" + this.date.getFullYear();
    }
  },
  mounted() {
    this.cloneCourseProp();
    this.getAlreadySaved();
  }
};
</script>
