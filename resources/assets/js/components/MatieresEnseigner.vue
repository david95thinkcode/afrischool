<template>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Matieres enseignées</h5>
                    </div>
                    <table class="table table-responsive" v-if="READY_FOR_SHOW">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Matière</td>
                                <td>Coefficient</td>
                                <td>Enseignée par</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for='m in matieres' v-bind:key='m.id'>
                                <td>{{ m.id }}</td>
                                <td>{{ m.intitule }}</td>
                                <td>{{ m.coefficient }}</td>
                                <td>{{ m.prof_prenoms }} {{ m.prof_nom }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="panel-body" v-else>
                        <p v-if="isFetching">Chargement en cours ...</p>
                        <div v-else>
                        <h5>Aucune matière trouvée !</h5>
                        </div>
                    </div>
                    <div class="panel-footer" v-if="isErrored">
                        <div class="alert alert-warning">
                            <p>Une erreur s'est produite</p>
                            <button @click="fetch()" class="btn btn-primary">Rééssayez ici</button>
                            <p><strong>{{error}}</strong></p>
                        </div>
                    </div>
                </div>
</template>

<script>
import { Routes } from "../routes.js";

    export default {
        props: {
            classe : {
                type: Number,
                required: true,
            }
        },
        data () {
            return {
                matieres: [],
                isFetching: false,
                error: '',
            }
        },
        mounted() {
            this.fetch();
        },
        methods: {

            fetch () {
                this.isFetching = true;

                axios.get(Routes.enseigner.get.forClasse.concat(this.classe))
                .then(response => {
                    this.matieres = response.data;
                })
                .catch(error => {
                    this.error = error;
                })
                .finally(() => {
                    this.isFetching = false;
                })
            }
        },
        computed: {
            READY_FOR_SHOW () { return (this.matieres.length > 0 && this.FETCHED) ? true : false;  },
            isErrored () { return this.error === "" ? false : true; },
            FETCHED () { return this.isFetching ? false : true },
        }
    }
</script>
