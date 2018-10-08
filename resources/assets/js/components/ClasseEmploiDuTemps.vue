<template>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Emploi du temps</h5>
                    </div>

                    <div class="panel-body">
                        
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
                isFetching: false,
                emploiDuTemps: [],
                error: '',
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
