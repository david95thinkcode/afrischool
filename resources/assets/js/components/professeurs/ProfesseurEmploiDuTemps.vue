<template>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default mx-auto">
                <div class="panel-heading"><h5>Emploi du temps du professeur </h5></div>
                <table class="table table-responsive" v-if="READY_FOR_SHOW">
                    <thead>
                        <tr>
                            <th>Jour</th>
                            <th>Horaire</th>
                            <th>Matiere</th>
                            <th>Classe</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(e, index) in emploiDuTemps" v-bind:key='index'>
                            <th>{{ e['label'] }}</th>
                            <td>
                                <tr v-for="(i, idex) in e['datas']" v-bind:key='idex'>
                                    <td>{{ i.debut }} à {{ i.fin }}</td>
                                </tr>
                            </td>
                            <td>
                                <tr v-for="(i, idex) in e['datas']" v-bind:key='idex'>
                                    <td><strong>{{ i.intitule }}</strong></td>
                                </tr>
                            </td>
                            <td>
                                <tr v-for="(i, idex) in e['datas']" v-bind:key='idex'>
                                    <td><strong>{{ i.cla_intitule }}</strong></td>
                                </tr>
                            </td>
                        </tr>
                    </tbody>

                </table>
                <div class="panel-body" v-else>
                    <p v-if="isFetching">Chargement en cours ...</p>
                    <div v-else>
                    <h5>Cette section ne contient rien à afficher !</h5>
                    <button @click="fetch()" class="btn btn-primary">Rééssayez ici</button>
                    </div>
                </div>
                <div class="panel-footer" v-if="isErrored">
                    <div class="alert alert-warning">
                        <p>Une erreur s'est produite</p>
                        <p><strong>{{error}}</strong></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="col-sm-4">
            <div class="panel panel-default mx-auto">
                <div class="panel-heading"><h5>A propos</h5></div>
                <div class="panel-body">
                    <li>Matières enseignées : </li>
                    <li>Classes encadrées : </li>
                    <li>Plage horaire par semaine :</li>
                </div>
            </div>
        </div> -->
    </div>
</template>

<script>
import { Routes } from "../../routes.js";

export default {
  props: {
    prof: {
      type: Number,
      required: true,
      default: 0
    }
  },
  data() {
    return {
      isFetching: false,
      emploiDuTemps: {},
      error: '',
    };
  },
  mounted() {
      this.fetch();
  },
  methods: {
    fetch() {
        this.isFetching = true;

        axios.get(Routes.emploiDuTemps.get.prof.concat(this.prof))
        .then(response => {
          this.emploiDuTemps = response.data;
        })
        .catch(error => {
            this.error = error.message;
          console.log(error);
        })
        .finally(() => {
            this.isFetching = false;
        });
    }
  },
  computed: {
    READY_FOR_SHOW () { return (Object.keys(this.emploiDuTemps).length> 0 && this.FETCHED) ? true : false;  },
    isErrored () { return this.error === "" ? false : true; },
    FETCHED () { return this.isFetching ? false : true },
  }
};
</script>
