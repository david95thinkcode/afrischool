<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h5>{{ courses.classe.cla_intitule}}</h5>
        </div>

            <table class="table table-striped">
                <tbody>
                    <tr v-for="e in courses.enseigner" v-bind:key='e.created_at'>
                        <!-- <td><button class="btn btn-sm btn-primary">Marquer</button></td> -->
                        <td><input type="checkbox" @click="selectCourse(e.id)"></td>
                        <td>{{ e.matiere.intitule }}</td>
                        <td>{{ e.professeur.prof_prenoms }} {{ e.professeur.prof_nom }}</td>
                    </tr>
                </tbody>
            </table>
        <div class="panel-footer">
            <button class="btn btn-sm btn-info">Tout cocher</button>
            <button class="btn btn-sm btn-success">Enregistrer</button>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        courses: '',
    },
    data () {
        return {
            selected: [],
            saved: [],
            issending: false,
        }
    },
    methods: {

        selectCourse (id) {
            console.log(id)
            this.selected.push(id);
            console.table(this.selected)
        },

    },
    computed: {

    },
    mounted () {

    }
}
</script>
