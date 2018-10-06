<template>
<div class="row">
    <div class="col-sm-4">
        <div class="panel panel-default mx-auto">
            <div class="panel-heading">Etape 1</div>
            <div class="panel-body">
                <form v-on:submit.prevent accept-charset="UTF-8">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="classe">Classe</label>
                                <select class='form-control' v-model='absence.classe' name="classe" id="classe">    
                                    <option value=""></option>                            
                                    <option v-if='CLASSES_ARE_FILLED' v-for="c in classes" v-bind:key='c.id'>{{c.cla_intitule}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="prenom">Date</label>
                                <input class="form-control" v-model="absence.date" type="date">
                            </div>
                        </div>
                    </div>                
                    <div class='form-group'>
                        <button v-if='READY_FOR_MATIERE_STEP' @click='gotoMatStep()' class="btn btn-success">Suivant</button>
                    </div>
                </form>
            </div>
            <!-- <div class="panel-footer">
                <p class="alert alert-light" v-if="isSaving">Enregistrement en cours ...</p>
                <p class="alert alert-success" v-if="!isSaving && isSaved"> <i class="fas fa-check"></i> Enregistré</p>
                <div class="alert alert-warning alert-dismissible fade show" v-if="!isSaving && isErrored" role='alert'>
                    <strong> <i class="fas fa-error"></i> Echec d'enregistrement </strong>
                    <p class="text-sm">{{ error.message }}</p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div> -->
        </div>
    </div>
    <div class="col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading">Etape 2 - Le cours</div>
            <div class="panel-body">
                <form v-if="MATIERES_ARE_FILLED">
                    <div class="form-group" v-for="m in matieres" v-bind:key='m.id'>
                        <div class="checkbox">
                            <label for="">{{m.intitule}}</label>
                            <input type="radio" name="" id="" class="form-control">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="panel panel-default mx-auto">
            <div class="panel-heading">Etape 3 - Cochez les absents</div>
            <div class="panel-body">
                <form v-if="INSCRITS_ARE_FILLED">
                    <div class="form-group" v-for="i in inscrits" v-bind:key='i.id'>
                        <div class="checkbox">
                            <label for="">{{i.eleve.nom}} {{i.eleve.prenoms}}</label>
                            <input type="checkbox" name="" id="" class="form-control" v-model="choosedEleve">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import { Routes } from "../../routes.js";
export default {
    data () {
        return {
            classes: [],
            matieres: [],
            inscrits: [],
            absence: {
                date: '',
                classe: '',
                anneeScolaire: ''
            },
            choosedMatiere: '',
            choosedEleve: [],

            isSaving: false,
            isSaved: false,
        }
    },
    props: {
        agent_id: {},
        agentobject: {},
    },
    mounted () {
        this.fetchClasses();
        
    },
    methods: {       

        fetchClasses() {
            axios.get(Routes.classes.get.fetch)
            .then((response) => {
                this.classes = response.data;
            })
            .catch((error) => {
                this.errorActions(error, "Error on getting classes")
            })
        },

        fetchMatieres () {
            axios.get(Routes.enseigner.get.forClasse.concat(this.absence.classe))
            .then((response) => {
                this.matieres = response.data;
            })
            .catch((error) => {
                this.errorActions(error, "Error on getting matieres")
            })
        },

        fetchInscrits () {
            axios.get(Routes.inscription.forClasse.concat(this.absence.classe))
            .then((response) => {
                this.inscrits = response.data;
            })
            .catch((error) => {
                this.errorActions(error, "Error on getting inscrits")
            })
        },

        gotoMatStep () {
            this.fetchMatieres();
            this.fetchInscrits();
        },

        

        save() {
            let route = this.rootURI.concat('dashboard/agents');
            this.isSaving = true;

            axios.post(route, this.agent)
            .then((response) => {
                this.successActions("Agent enregistré")                
            })
            .catch((error) => {
                this.errorActions(error, "Problème enregistrement de l'agent")
            })
            .finally(() => {
                this.isSaving = false;
            })
        },


        /**
         * Met à jour le agent dans la base de données
         * @return {[type]} [description]
         */
        updateagent () {
            let UpdateRoute = this.rootURI.concat('dashboard/agents/').concat(this.agent.id);
            
            axios.put(UpdateRoute, this.agent)
            .then((response) => {
                this.isEdition = false;
                this.successActions("Mise à jour effectuée !");
            })
            .catch((error) => {
                this.errorActions(error, "Error on update")
            })
            .finally(() => {
                this.isSaving = false;
            });
        },

        successActions (successMessage) {
            this.resetInput();
            this.isSaved = true;
            this.error = '';
            this.$emit('refresh');
            console.log(successMessage)
        },

        errorActions (error, message) {
            console.log(message)
            console.log(error)
            this.error = error;
            this.isSaved = false;
        },

    },
    computed: {
        CLASSES_ARE_FILLED () { return this.classes.length > 0 ? true : false; },
        INSCRITS_ARE_FILLED () { return this.inscrits.length > 0 ? true : false; },
        MATIERES_ARE_FILLED () { return this.matieres.length > 0 ? true : false; },
        READY_FOR_MATIERE_STEP () {
            return true;
            // return (this.absence.date != '' && this.absence.classe != null) ? true : false;
        },
        isErrored () {
            return this.error === '' ? false : true;
        },
    },
}
</script>
