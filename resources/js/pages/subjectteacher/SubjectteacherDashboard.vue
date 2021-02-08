<template>
   <div class="app-main">
        <sidebar :user="user"></sidebar>
        <div class="app-main__outer">
            <div class="app-main__inner">
                <div class="app-page-title">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                              <i class="metismenu-icon fas fa-layer-group fa-2x"></i>
                          <h5 class="ml-3">Dashboard</h5>
                        </div>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-6">
                        <div class="card card-stat bg-warning">
                            <div class="card-body">
                                <div class="statistics statistics-horizontal">
                                    <div class="info info-horizontal">
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="icon icon-primary icon-circle">
                                                    <i class="now-ui-icons users_single-02"></i>
                                                </div>
                                            </div>
                                            <div class="col-9 text-right">
                                                <h3 class="info-title">{{ count.student  }}
                                                </h3>
                                                <h6 class="stats-title">Number of Student</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="card card-stat bg-warning">
                            <div class="card-body">
                                <div class="statistics statistics-horizontal">
                                    <div class="info info-horizontal">
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="icon icon-primary icon-circle">
                                                    <i class="now-ui-icons users_single-02"></i>
                                                </div>
                                            </div>
                                            <div class="col-9 text-right">
                                                <h3 class="info-title">{{ count.section  }}
                                                </h3>
                                                <h6 class="stats-title">Number of Sections</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="card card-stat bg-warning">
                            <div class="card-body">
                                <div class="statistics statistics-horizontal">
                                    <div class="info info-horizontal">
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="icon icon-primary icon-circle">
                                                    <i class="now-ui-icons users_single-02"></i>
                                                </div>
                                            </div>
                                            <div class="col-9 text-right">
                                                <h3 class="info-title">{{ count.group }}</h3>
                                                <h6 class="stats-title">Number of Groups</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>    
</template>
<script>
    import SubjectteacherSidebar from './SubjectteacherSidebar'
    import {
        mapGetters,
        mapActions
    } from 'vuex'
    export default {
        props: ['user'],
        data() {
            return {
                activeClass: 'mm-active'
            }
        },
        computed: {
            currentPage() {
                $("#app").removeClass('sidebar-mobile-open')
                return this.$route.path;
            }
        },
        components: {
            'sidebar': SubjectteacherSidebar,
        },
        data() {
            return {
                count: {
                    student: 0,
                    group: 0,
                    section: 0,
                }
            }
        },
        methods: {
            GetSTDashbaord(){
                axios.get('../api/getstdashboard/'+this.user.id).then(res => {
                    this.count = {
                        student : res.data.student,
                        section : res.data.section,
                        group : res.data.groups
                    }
                })
            }
        },
        created() {
            this.GetSTDashbaord()
        }
    }

</script>
