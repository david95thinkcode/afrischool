<template>
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default mx-auto">
                <div class="panel-heading">
                    <h3>Selection de la classe</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="classe">Classe</label>
                        <select class='form-control' id="classe" name="classe" v-model="classe.id" @change="dataEmpty">
                            <option value=""></option>
                            <option v-for="c in classes" v-bind:key='c.id'
                                    v-bind:value='c.id'>{{c.cla_intitule}}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="panel-footer" v-if="is_classe">
                    <div class="row">
                        <button class="btn btn-success col-md-5 col-md-offset-3" @click="showParent">
                            Suivant
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4" v-if="is_parent">
            <div class="panel panel-default mx-auto">
                <div class="panel-heading">
                    <h3>Selection du parent</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="classe">liste des parents d'élèves</label>
                        <ul class="list-unstyled" >
                            <li v-for="e in inscrits">
                                <div class="form-check">
                                    <input type="checkbox" v-bind:value="e.eleve.id" v-bind:key="e.eleve.id"
                                           v-model="parent_selected" class="form-check-input">
                                    <label class="form-check-label ml-1" v-bind:for="e.eleve.id">{{e.eleve.person_a_contacter_nom}}</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4" v-if="is_message">
            <div class="panel panel-default mx-auto">
                <div class="panel-heading">
                    <h3>Selection du parent</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="classe">Votre message</label>
                        <textarea v-model="message" id="" class="col-md-12"></textarea>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <button class="btn btn-success col-md-5 col-md-offset-4" @click="sendMessage">
                            Envoyer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.fetchClasses()
        },
        data() {
            return {
                classes:[],
                inscrits:[],
                classe:{
                    id: ''
                },
                parent_selected: [],
                message:{type: String},
            }
        },
        methods: {
            fetchClasses() {
                axios.get('/api/liste-classe')
                    .then((res) => {
                        this.classes = res.data
                    })
                    .catch((err) => {
                        console.log(err)
                    })
            },
            showParent() {
                axios.get('/api/list-parent/'+this.classe.id)
                    .then((res) => {
                        this.inscrits = res.data
                    })
                    .catch((err) => {
                        console.log(err)
                    })
            },
            dataEmpty() {
                this.inscrits = [], this.parent_selected = [], this.message = ''
            },
            sendMessage() {
                axios.post('/api/send-message-parent', {
                    messager: this.message,
                    contact: this.parent_selected
                })
                    .then((res) => {
                        this.dataEmpty(),
                            this.flash('Data loaded', 'success');
                    })
                    .catch((err) => {
                        console.log(err)
                    })
            }

        },
        computed: {
            is_classe() { return this.classe.id !== '' ? true : false; },
            is_parent() { return this.inscrits.length > 0 ? true : false; },
            is_message() { return this.parent_selected.length > 0 ? true : false; },
        }
    }
</script>