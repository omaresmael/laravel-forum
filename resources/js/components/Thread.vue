
<script>
    import Replies from "./Replies";

    export default {
        components: {Replies},
        props: ['initialRepliesCount'],

        data(){
            return {
                repliesCount: this.initialRepliesCount,
            }
        },
        methods: {
          minusReply(){
              this.repliesCount --;
          },
            incrementReply(){
                this.repliesCount ++;
            }
        }
    }
</script>

