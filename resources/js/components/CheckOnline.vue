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
        window.addEventListener('online', ()=>{this.isOnLine=true});
        window.addEventListener('offline', ()=>{this.isOnLine=false});
    },
}
</script>

<style scoped>

</style>
