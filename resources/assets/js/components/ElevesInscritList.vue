<template>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h5>
                         Elèves inscrits <span class="badge" v-if="READY_FOR_SHOW">  Total inscrits : {{ inscriptions.length }}</span>
                    </h5>
                </div>
                <table class="table table-responsive" v-if="READY_FOR_SHOW">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Elève</th>
                            <th>Age</th>
                            <th>Sexe</th>
                            <th>Redoublant</th>
                            <th>Inscrit le</th>
                            <th>Contact du parent</th>
                            <th>Paiement restant</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(ins, index) in inscriptions" v-bind:key="ins.inscription">
                            <td>{{ index + 1 }}</td>
                            <td>{{ ins.datas.prenoms }} {{ ins.datas.nom }}</td>
                            <td>{{ getAge(ins.datas.date_naissance) }} ans</td>
                            <td>{{ ins.datas.sexe }}</td>
                            <td>{{ ins.datas.redoublant == 1 ? 'Oui' : 'Non' }}</td>
                            <td>{{ ins.datas.date_inscription }}</td>
                            <td>{{ ins.datas.par_tel }} / {{ ins.datas.par_email }}</td>
                            <td>{{ ins.paiement.reste }} FCFA </td>
                        </tr>
                    </tbody>
                </table>
                <div class="panel-body" v-else>
                    <p v-if="isFetching">Chargement en cours ...</p>
                    <div v-else>
                        <h5>Aucun élève trouvé !</h5>
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

                axios.get(Routes.inscription.basicsForClasse.concat(this.classe))
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

            getAge(birthday) {
                return new Date().getFullYear() - new Date(Date.parse(birthday)).getFullYear();
            }
        },
        computed: {
            READY_FOR_SHOW () { return (this.inscriptions.length > 0 && this.FETCHED) ? true : false;  },
            isErrored () { return this.error === "" ? false : true; },
            FETCHED () { return this.isFetching ? false : true },
        }
    }
</script>
