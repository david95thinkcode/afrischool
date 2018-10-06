<template>
<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-4">
                <div class="panel panel-default mx-auto">
                    <div class="panel-heading"><h5>Etape 1 - Date et Classe</h5></div>
                    <div class="panel-body">
                        <form v-on:submit.prevent accept-charset="UTF-8">
                            <fieldset v-bind:disabled='isSaving'>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="classe">Classe</label>
                                            <select class='form-control' v-model='absence.classe' name="classe" id="classe">
                                                <option value=""></option>
                                                <option v-if='CLASSES_ARE_FILLED' v-for="c in classes" v-bind:key='c.id'
                                                    v-bind:value='c.id'>{{c.cla_intitule}}
                                                </option>
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
                            </fieldset>
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
                    <div class="panel-heading"><h5>Etape 2 - Sélectionnez le cours manqué</h5></div>
                    <div class="panel-body">
                        <form v-if="MATIERES_ARE_FILLED">
                            <fieldset v-bind:disabled='isSaving'>
                                <!-- <input type="radio" v-model="pick" v-bind:value="a"> -->
                                <!-- <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-primary mb-1" v-for="m in matieres" v-bind:key='m.matiere_id'>
                                    <input type="radio" v-model="rebe" v-bind:value="m.id"> {{m.intitule}}
                                </label>
                            </div> -->
                                <div class="form-group" v-for="m in matieres" v-bind:key='m.id'>
                                    <input type="radio" :id="'mat'.concat(m.id)" v-bind:value="m.id" v-model="pickedMat">
                                    <label :for="'mat'.concat(m.id)">{{m.matiere.intitule}}</label>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="panel panel-default mx-auto">
                    <div class="panel-heading"><h5>Etape 3 - Cochez les absents</h5></div>
                    <div class="panel-body">
                        <form v-if="INSCRITS_ARE_FILLED" v-on:submit.prevent accept-charset="UTF-8">
                            <fieldset v-bind:disabled='isSaving'>
                                <div class="form-group" v-for="i in inscrits" v-bind:key='i.id'>
                                    <input type="checkbox" @click="toggleEleveCheckbox(i.id)" :id="'el'.concat(i.eleve_id)"
                                        class="">
                                    <label :for="'el'.concat(i.eleve_id)">{{i.eleve.nom}} {{i.eleve.prenoms}}</label>
                                </div>
                                <div v-if='READY_FOR_SUBMIT' class="form-group text-center mt-1">
                                    <button class="btn btn-success btn-block" @click="store()">Enregistrer les absents</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" v-if="isSaved">
            <div class="col-sm-12">
                <div class="alert alert-success">
                    <h4 class="text-center">Les absents ont bien été enregistrés.</h4>
                </div>
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
            pickedMat: '',
            choosedEleve: [],

            isSaving: false,
            isSaved: false,
        }
    },
    props: { },
    mounted () {
        this.fetchClasses();
        this.absence.date = '2018-10-03';
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
            axios.post(Routes.enseigner.post.classNdate, this.absence)
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
            this.resetInput();
            this.fetchMatieres();
            this.fetchInscrits();
        },

        toggleEleveCheckbox (inscriptionID) {
            if (this.choosedEleve.length == 0) {
                this.choosedEleve.push(inscriptionID)
            }
            else {
                // Toggling code 
                let i = this.choosedEleve.indexOf(inscriptionID);
                (i == -1) ? this.choosedEleve.push(inscriptionID) : this.choosedEleve.splice(i, 1);
            }           

        },

        /**
         * @param 
         */
        removeInscritItem (itemvalue) {
            
        },

        store () {
            this.isSaving = true;
            axios.post(Routes.absenses.post.store, {
                eleves: this.choosedEleve,
                enseigner: this.pickedMat,
                date: this.absence.date,
            })
            .then((response) => {
                console.log(response.data)
                this.successActions("Absences enregistré")
            })
            .catch((error) => {
                this.errorActions(error, "Problème")
            })
            .finally(() => {
                this.isSaving = false;
            })
        },

        resetInput () {
            this.matieres = [];
            this.inscrits = [];
            this.choosedEleve = [];
            this.pickedMat = '';
        },

        successActions (successMessage) {
            this.resetInput();
            this.isSaved = true;
            this.error = '';
            // this.$emit('refresh');
            console.log(successMessage)
            alert(successMessage);
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
        READY_FOR_MATIERE_STEP () { return (this.absence.date != '' && this.absence.classe != '') ? true : false; },
        READY_FOR_SUBMIT () { return (this.choosedEleve.length > 0 && this.pickedMat != '') ? true : false; },
        isErrored () { return this.error === '' ? false : true; },
    },
}
</script>

<style>
    .btn-primary:active, 
    .btn-primary.active,
    .btn-primary.active.focus,
    .open > .btn-primary.dropdown-toggle {
        background-color: #1abb9c;
    }
</style>

