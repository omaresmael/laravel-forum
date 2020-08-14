<template>
    <button   :class="classes" style="margin-right: 1px" @click="toggle">
        <span class="glyphicon glyphicon-heart"></span>
        <span v-text="favoritesCount"></span>
    </button>
</template>

<script>
    export default {
        props: ['reply'],

        data(){
            return{
                favoritesCount : this.reply.favorites_count,
                isFavorited : this.reply.isFavorited,

            }
        },
        computed: {
            classes(){
                return  ['btn btn-xs', this.isFavorited?' btn-primary': ' btn-default' ]
            }
        },
        methods: {
            toggle(){
                if(this.isFavorited){
                    axios.delete('/replies/' + this.reply.id + '/favorites');
                    this.isFavorited = 0;
                    this.favoritesCount--;
                }
                else {
                    axios.post('/replies/' + this.reply.id + '/favorites');
                    this.favoritesCount++;
                    this.isFavorited = 1;
                }
            }

        }

    }
</script>

<style scoped>

</style>
