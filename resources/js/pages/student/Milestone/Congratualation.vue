<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <h1 class="title text-center">C O N G R A T U A L A T I O N S</h1>
                <p class="text-center">Your Group Accomplish Thesis/Capstone.</p>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    methods:{
        Congrats(){
            this.$confetti.start();
            setTimeout(() => {
                this.$confetti.stop();
            }, 5000)
        }
    },
    mounted(){
        this.Congrats()
    }
}
</script>
