export default {
    data(){
      return {
          items: []
      }
    },
    computed: {
        signedIn(){
            return window.App.signedIn;
        }
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
