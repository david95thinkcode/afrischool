<template>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Emploi du temps</h5>
                    </div>
                    <table class="table table-striped table-responsive" v-if="READY_FOR_SHOW">
                        <thead>
                            <tr>
                                <th>Jour</th>
                                <th>Horaire</th>
                                <th>Matière</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="edt in emploiDuTemps" v-bind:key='edt.matiere'>
                                <th>{{ edt.day }}</th>
                                <td>
                                    <tr v-for="data in edt.datas" v-bind:key='data.id'>
                                        <td>{{ data.debut }} à {{ data.fin }}</td>
                                    </tr>
                                </td>
                                <td>
                                    <tr v-for="data in edt.datas" v-bind:key='data.id'>
                                        <td><strong>{{ data.intitule }}</strong></td>
                                    </tr>
                                </td>
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
                default: '',
            }
        },
        data () {
            return {
                isFetching: false,
                emploiDuTemps: [],
                error: '',
            }
        },
        mounted() {
            this.fetch();
        },
        methods: {

            fetch() {
                this.isFetching = true;

                axios.get(Routes.emploiDuTemps.get.classe.concat(this.classe))
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
            },
        },
        computed: {
            READY_FOR_SHOW () { return (Object.keys(this.emploiDuTemps).length > 0 && this.FETCHED) ? true : false;  },
            isErrored () { return this.error === "" ? false : true; },
            FETCHED () { return this.isFetching ? false : true },
        }
    }
</script>
