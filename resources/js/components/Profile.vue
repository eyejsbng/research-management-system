<template>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-testimonial">
                    <div class="card-header card-header-avatar">
                        <a href="#">
                            <img src="/nowasset/assets/img/james.jpg" class="img img-raised">
                            <span class="fas fa-camera"></span>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mr-auto ml-auto" >
                                <h2 class="title text-center" style="line-height:1px;">{{ user.name }}</h2>
                                <p v-if="user.typ_id == 1" class="text-info">Research Coordinator</p>
                                <p v-if="user.typ_id == 2" class="text-info">Adviser</p>
                                <p v-if="user.typ_id == 3" class="text-info">Student</p>
                                <p v-if="user.typ_id == 4" class="text-info">Subject Teacher</p>
                                <p v-if="user.typ_id == 5" class="text-info">Panel</p>
                                <p v-if="user.typ_id == 6" class="text-info">Adviser / Panel</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mr-auto ml-auto">
                                <h6 class="title text-center" style="line-height:1px;">{{ user.email }}</h6>
                                <p class="text-info">Email</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mr-auto ml-auto">
                                <h6 class="title text-center" style="line-height:1px;">{{ user.specialty }}</h6>
                                <p class="text-info">Specialty</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>
<script>
    export default {
        props:['user'],
        methods: {
            SelectPhoto(){

            }
        }
    }

</script>
