<template>
 <div>
     <div v-for="(reply,index) in items">
         <reply :attributes="reply" @deleted="remove(index)"></reply>
     </div>
     <new-reply  :thread="threadId" @created="addReply"></new-reply>
 </div>
</template>

<script>
    import Reply from "./Reply";
    import NewReply from "./NewReply";

    export default {

        props : ['data','thread'],
        components: { Reply,NewReply },

        data(){
            return {
                items: this.data,
                threadId: this.thread
            }
        },
        computed: {

        },
        methods: {
            remove(index){
                this.items.splice(index,1);
                this.$emit('erase');
            },
            addReply(reply){
                this.items.push(reply);
                this.$emit('increase')
            },

        }
    }


</script>

<style scoped>

</style>
