<template>
    <div>
        <div v-if="signedIn">
            <div>
                <div class="form-group">
                    <textarea name="body" id="body" required class="form-control" placeholder="Hava somethin to say?" rows="5" v-model="body"></textarea>
                </div>
                <input type="submit" class="btn btn-default" @click="newReply" value="Submit">
            </div>

        </div>
        <div v-else>
            <a href="/login">Please sign in to participate</a>
        </div>
    </div>



</template>

<script>
    import collection from '../mixins/collection'
    export default {

        props: ['thread'],
        mixins: [collection],
        data(){
            return{
                threadId: this.thread,
                body: '',


            }
        },
        computed: {
          // signedIn(){
          //     return window.App.signedIn;
          // }
        },
        methods:{
            newReply(){
                axios.post('/threads/'+this.threadId+'/replies',{
                    body: this.body
                }).then(({data}) =>{ // data = the response after the post request.
                                     // you determine the response in the store function of replies controller
                                     // in this case as json, it returns the new reply
                                     // then the data is the new reply
                    this.body = '';
                    flash('your reply is being added');

                    this.$emit('created',data)
                });

            }
        }

    }
</script>

<style scoped>

</style>
