<template>
 <div>
     <div v-for="(reply,index) in items">
         <reply :attributes="reply" @deleted="remove(index)"></reply>
     </div>
     <new-reply  :thread="threadId" @created="addReply"></new-reply>
     <paginator :dataSet="dataSet" @updated="fetchReplies"> </paginator>
 </div>
</template>

<script>
    import Reply from "./Reply";
    import NewReply from "./NewReply";
    import collection from '../mixins/collection'

    export default {

        props : ['thread'],
        components: { Reply,NewReply },
        mixins: [collection],
        data(){
            return {

                dataSet: [],
                threadId: this.thread,

            }
        },

        created(){

          this.fetchReplies();
        },
        methods: {

            repliesUrl(page){
                return '/threads/'+ this.threadId +'/replies?page='+page
            },

            fetchReplies(page = 1){
              axios.get(this.repliesUrl(page))
                  .then(this.refresh)
            },
            refresh({data}){
               this.dataSet = data;
               this.items = data.data;

            },

        }
    }


</script>

<style scoped>

</style>
