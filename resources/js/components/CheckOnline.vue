<template>
    <div>
        <div class="alert-danger alert" v-if="!isOnLine">لطفا اتصال خود را به اینترنت چک کنید</div>
    </div>
</template>

<script>
export default {
    name: "CheckOnline",
    data () {

        return{
            isOnLine:navigator.onLine,
        }
        },
    mounted() {
        console.log('CheckOnline Mounted');
        this.test();
        window.addEventListener('online', ()=>{this.isOnLine=true});
        window.addEventListener('offline', ()=>{this.isOnLine=false});
    },
    methods:{
        test(){

            axios.get('http://shoorak.ir/wp-json/wp/v2/posts')
            .then(response => {
                console.log(response.getResponseHeader('x-wp-total'))
            });


        }
    }
}
</script>

<style scoped>

</style>
