<template>
    <ul class="pagination" v-if="shouldPaginate">
        <li class="page-item">
            <a class="page-link" href="#" aria-label="Previous" v-show="prevUrl" @click.prevent="page--">
                <span aria-hidden="true"> Previus &laquo;</span>
            </a>
        </li>

        <li class="page-item">
            <a class="page-link" href="#" aria-label="Next" v-show="nextUrl" @click.prevent="page++">
                <span aria-hidden="true"> Next &raquo;</span>
            </a>
        </li>
    </ul>
</template>

<script>
    import collection from "../mixins/collection";
    export default {
        name: "Paginator",
        mixins: [collection],
        props: ['dataSet'],

        data(){
            return{
             page: 1,
             prevUrl: false,
             nextUrl: false,
            }
        },

        watch:{
            // you may wonder why dealing with this prop -dataSet- differently
            // it's because the prop is initially empty, as it comes from replies
            // and it's filled by an axios get request after the components are created
            // so "watch" is keeping an eye on any change that occurred to the original value
            // and updates these local variables upon the changes

            // it also can work ecsactly as the traditional way ex: repliesCount in thread
            // "page()" can be handeled exsactly as repliesCount >>> you've tried it
            dataSet(){
                this.page = this.dataSet.current_page;
                this.prevUrl = this.dataSet.prev_page_url;
                this.nextUrl = this.dataSet.next_page_url;
            },
            page(){
                this.broadcast();
            }


        },
        computed: {
            shouldPaginate(){
                return !! this.prevUrl || !! this.nextUrl;
            }

        },
        methods: {
            broadcast(){
                this.$emit('updated',this.page)
            }
        },


    }

</script>

<style scoped>

</style>
