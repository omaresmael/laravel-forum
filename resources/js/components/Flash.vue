<template>
    <div class="alert alert-success alert-flash" v-if="show" role="alert">
        <p> {{body}}</p> <!-- you may wonder now thy i didn't use message directly, we don't do that don't ask why! !-->
    </div>
</template>

<script>
    export default {
        props: ['message'],
       data(){
           return {
               body: '',
               show: false,
           }
       },
        created() {
            if (this.message){
                this.flash(this.message);

            }
            window.events.$on('flash',message => {
                this.flash(message);
            })
        },
        methods: {
            flash(message){
                this.body = message;
                this.show = true;
                this.hide()
            },
            hide(){
                setTimeout(() => {
                    this.show = false;
                },10000)
            }
        }

    }
</script>

<style>
    .alert-flash{
        position: fixed;
        right: 25px;
        bottom: 25px;
    }


</style>
