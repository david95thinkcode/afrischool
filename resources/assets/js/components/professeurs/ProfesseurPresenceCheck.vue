<template>
    <div class="panel panel-default" v-if="isReady">
        <div class="panel-heading">
            <h5>{{ courses.classe.cla_intitule}}</h5>
        </div>

            <table class="table table-striped">
                <tbody>
                    <tr v-for="e in courses.enseigner" v-bind:key='e.created_at'>
                        <!-- <td><button class="btn btn-sm btn-primary">Marquer</button></td> -->
                        <td><input type="checkbox" v-model="e.cocher"></td>
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
export default {
  props: {
    courses: ""
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
    async cloneCourseProp() {
      this.formatedCourses = await { ...this.courses };
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
