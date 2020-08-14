<script>
    import Favorite from "./Favorite";
    export default {
        props: ['attributes'],
        components: { Favorite },
        data() {
          return{
            editing: false,


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
                axios.delete('/reply/'+ this.attributes.id +'/' + this.attributes.thread_id)
                $(this.$el).fadeOut(300, () => {
                    flash('your reply deleted successfully!');
                });
            },

        }
    }
</script>

<style scoped>

</style>
