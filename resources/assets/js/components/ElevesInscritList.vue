<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Elèves inscrits</h5>
                    </div>
                    <table class="table table-responsive" v-if="READY_FOR_SHOW">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Elève</th>
                                <th>Age</th>
                                <th>Redoublant</th>
                                <th>Inscrit le</th>
                                <th>Parents & contact</th>
                                <th>Paiements</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="ins in inscriptions" v-bind:key="ins.id">
                                <td>{{ ins.id }}</td>
                                <td>{{ ins.eleve.prenoms }} {{ ins.eleve.nom }}</td>
                                <td>{{ getAge(ins.eleve.date_naissance) }}</td>
                                <td>{{ ins.eleve.redoublant == 1 ? 'Oui' : 'Non' }}</td>
                                <td>{{ ins.date_inscription }}</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="panel-body" v-else>
                        <p v-if="isFetching">Chargement en cours ...</p>
                        <div v-else>
                        <h5>Vide !</h5>
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
                isFetching: false,
                inscriptions: [],
                error: '',
            }
        },
        mounted() {
            this.fetch();
        },
        methods: {
            fetch() {
                this.isFetching = true;

                axios.get(Routes.inscription.forClasse.concat(this.classe))
                .then(response => {
                    this.inscriptions = response.data;
                })
                .catch(error => {
                    this.error = error.message;
                    console.log(error);
                })
                .finally(() => {
                    this.isFetching = false;
                });
            },

            getAge($birthday) {

            }
        },
        computed: {
            READY_FOR_SHOW () { return (this.inscriptions.length > 0 && this.FETCHED) ? true : false;  },
            isErrored () { return this.error === "" ? false : true; },
            FETCHED () { return this.isFetching ? false : true },
        }
    }
</script>
