<template>
    <div>

        <div :id="'reply-'+id" class="panel panel-default">
            <div class="panel-heading">
                <div class="level">
                    <h5 class="flex">
                        <a :href="'/profile/'+reply.owner.name" v-text="reply.owner.name"></a>
                        <p style="display: inline" v-text="'said'+reply.created_at"></p>

                    </h5>
                    <div v-if="signedIn"><favorite :reply="reply" ></favorite></div>

                </div>

            </div>
            <div  class="panel-body">
                <div v-if="editing">
                    <textarea class="form-control" v-model="attributes.body"></textarea>
                    <button class=" btn btn-primary btn-xs" @click="update" style="margin-right: 1px">
                        Update
                    </button>
                    <button @click="editing = false" class=" btn btn-link btn-xs" style="margin-right: 1px">
                        Cancel
                    </button>
                </div>
                <div v-else v-text="attributes.body" >

                </div>
            </div>


            <div v-if="canUpdate" class="panel-footer" style="display: flex; align-items: center ">
                <button @click="editing = true" class=" btn btn-info btn-xs" style="margin-right: 1px">
                    Edit
                </button>
                <button @click="destroy" class=" btn btn-danger btn-xs" style="margin-right: 1px">
                    Delete
                </button>

            </div>


        </div>
    </div>
</template>
<script>
    import Favorite from "./Favorite";
    export default {
        props: ['attributes'],
        components: { Favorite },
        data() {
          return{
            editing: false,
            reply: this.attributes,
            id: this.attributes.id,


          }
        },
        computed: {
            signedIn(){
                return window.App.signedIn;
            },
            canUpdate(){
                if(window.App.user != null)
                return this.reply.owner.id== window.App.user.id ;
            }
        },
        methods: {
            update(){
                axios.patch('/reply/' + this.attributes.id,{
                    body: this.attributes.body
                })
                this.editing = false;

                flash('Updated!');
            },
            destroy(){
                axios.delete('/reply/'+ this.attributes.id +'/' + this.attributes.thread_id);
                this.$emit('deleted', this.reply.id); // this /** $emit **/ function is used for creating custom element
                                                      // this custom element is used for the parent component
                                                      // to listen for the associated event in the child component

            },


        }
    }
</script>

<style scoped>

</style>
