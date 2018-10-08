<template>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Matieres enseignées</h5>
                    </div>
                    <div class="panel-body">
                        I'm an example component!
                    </div>
                </div>
</template>

<script>
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
                matieres: [],
                isFetching: false,
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {

        },
        computed: {
            
        }
    }
</script>
