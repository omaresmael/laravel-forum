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
                if(! page){
                    let query = location.search.match(/page=(\d+)/);
                    page = query ? query[1] : 1;
                }
                return '/threads/'+ this.threadId +'/replies?page='+page
            },

            fetchReplies(page){
              axios.get(this.repliesUrl(page))
                  .then(this.refresh)
            },
            refresh({data}){
               this.dataSet = data;
               this.items = data.data;
               window.scrollTo(0,0); // after the page loads, it scroll up to the top of it


            },

        }
    }


</script>

<style scoped>

</style>
