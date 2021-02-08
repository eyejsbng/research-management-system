<template>

    <div class="app-main">

        <sidebar :user="user" />
        <transition name="show">
            <div class="app-main__outer bg-white">
                <div class="app-main__inner">
                    <div class="app-page-title bg-primary text-light">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <i class="metismenu-icon fas fa-layer-group fa-2x"></i>
                                <div class="ml-2">Dashboard</div>

                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-xl-3">
                            <div
                                class="card mb-3 widget-chart widget-chart2 text-left card-btm-border card-shadow-success border-success">
                                <div class="widget-chat-wrapper-outer">
                                    <div class="widget-chart-content pt-3 pl-3 pb-1">
                                        <div class="widget-chart-flex">
                                            <div class="widget-numbers">
                                                <div class="widget-chart-flex">
                                                    <div class="fsize-4">
                                                        <i class="fas fa-graduation-cap"></i>
                                                        <span>{{ getadminDashboard.student }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h6 class="widget-subheading mb-0 opacity-5">number of students</h6>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3">
                            <div
                                class="card mb-3 widget-chart widget-chart2 text-left card-btm-border card-shadow-primary border-primary">
                                <div class="widget-chat-wrapper-outer">
                                    <div class="widget-chart-content pt-3 pl-3 pb-1">
                                        <div class="widget-chart-flex">
                                            <div class="widget-numbers">
                                                <div class="widget-chart-flex">
                                                    <div class="fsize-4">
                                                        <i class="fas fa-user-tie"></i>
                                                        <span>{{ getadminDashboard.adviser }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h6 class="widget-subheading mb-0 opacity-5">number of adviser</h6>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3">
                            <div
                                class="card mb-3 widget-chart widget-chart2 text-left card-btm-border card-shadow-warning border-warning">
                                <div class="widget-chat-wrapper-outer">
                                    <div class="widget-chart-content pt-3 pl-3 pb-1">
                                        <div class="widget-chart-flex">
                                            <div class="widget-numbers">
                                                <div class="widget-chart-flex">
                                                    <div class="fsize-4">
                                                        <i class="fas fa-chalkboard-teacher"></i>
                                                        <span>{{ getadminDashboard.st }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h6 class="widget-subheading mb-0 opacity-5">number of subject teacher</h6>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3">
                            <div
                                class="card mb-3 widget-chart widget-chart2 text-left card-btm-border card-shadow-danger border-danger">
                                <div class="widget-chat-wrapper-outer">
                                    <div class="widget-chart-content pt-3 pl-3 pb-1">
                                        <div class="widget-chart-flex">
                                            <div class="widget-numbers">
                                                <div class="widget-chart-flex">
                                                    <div class="fsize-4">
                                                        <i class="fas fa-user-tie"></i>
                                                        <span>{{ getadminDashboard.panel }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h6 class="widget-subheading mb-0 opacity-5">number of panel</h6>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3">
                            <div
                                class="card mb-3 widget-chart widget-chart2 text-left card-btm-border card-shadow-danger border-danger">
                                <div class="widget-chat-wrapper-outer">
                                    <div class="widget-chart-content pt-3 pl-3 pb-1">
                                        <div class="widget-chart-flex">
                                            <div class="widget-numbers">
                                                <div class="widget-chart-flex">
                                                    <div class="fsize-4">
                                                        <i class="fas fa-users"></i>
                                                        <span>{{ getadminDashboard.group }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h6 class="widget-subheading mb-0 opacity-5">number of group</h6>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3">
                            <div
                                class="card mb-3 widget-chart widget-chart2 text-left card-btm-border card-shadow-success border-success">
                                <div class="widget-chat-wrapper-outer">
                                    <div class="widget-chart-content pt-3 pl-3 pb-1">
                                        <div class="widget-chart-flex">
                                            <div class="widget-numbers">
                                                <div class="widget-chart-flex">
                                                    <div class="fsize-4">
                                                        <i class="fas fa-book-open"></i>
                                                        <span>{{ getadminDashboard.archived }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h6 class="widget-subheading mb-0 opacity-5">reseaches in archive</h6>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3">
                            <div
                                class="card mb-3 widget-chart widget-chart2 text-left card-btm-border card-shadow-primary border-primary">
                                <div class="widget-chat-wrapper-outer">
                                    <div class="widget-chart-content pt-3 pl-3 pb-1">
                                        <div class="widget-chart-flex">
                                            <div class="widget-numbers">
                                                <div class="widget-chart-flex">
                                                    <div class="fsize-4">
                                                        <i class="fas fa-calendar-day"></i>
                                                        <span>{{ getadminDashboard.sched }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h6 class="widget-subheading mb-0 opacity-5">scheduled for today</h6>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"> Capstone 1 Progress</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <caps1 v-if="getadminDashboard.c1" :getadminDashboard="getadminDashboard.c1">
                                    </caps1>
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"> Capstone 2 Progress</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <caps2 v-if="getadminDashboard.c2" :getadminDashboard="getadminDashboard.c2">
                                    </caps2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3 card" style="height:400px">
                                <div class="card-header-tab card-header">
                                  
                                        <i class="metismenu-icon fas fa-book-reader fa-2x"></i>
                                        <div class="ml-2">Capstone 1 Group Progress</div>
                                   

                                </div>
                                <div class="p-0 card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="p-3 bg-transparent list-group-item">
                                            <div class="widget-content p-0">
                                                <div class="widget-content-outer">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left">
                                                            <div class="widget-heading">Group Name</div>
                                                        </div>
                                                        <p class="text-center" v-if="getadminDashboard.c1 == ''">No data
                                                            to
                                                            present.</p>
                                                    </div>
                                                    <div class="scroll-area-md">
                                                        <div class="scrollbar-container">
                                                            <div class="widget-progress-wrapper pl-4 pr-4"
                                                                v-for="cap1 in getadminDashboard.c1" :key="cap1.id">

                                                                <div class="widget-content-left">

                                                                    <div class="widget-subheading">
                                                                        <strong>{{ cap1.grp_title}}</strong></div>
                                                                </div>
                                                                <div
                                                                    class="progress-bar-sm progress-bar-animated-alt progress">
                                                                    <div class="progress-bar bg-primary"
                                                                        role="progressbar" aria-valuenow="100"
                                                                        aria-valuemin="0" aria-valuemax="100"
                                                                        v-bind:style="{ width: cap1.grp_percent + '%'}">
                                                                    </div>
                                                                </div>
                                                                <div class="progress-sub-label">

                                                                    <div class="sub-label-right">{{ cap1.grp_percent }}%
                                                                    </div>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 card" style="height:400px">
                                <div class="card-header-tab card-header">
                                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                        <i class="metismenu-icon fas fa-book-reader fa-2x"></i>
                                        <div class="ml-2"> Capstone 2 Group Progress</div>
                                    </div>

                                </div>
                                <div class="p-0 card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="p-3 bg-transparent list-group-item">
                                            <div class="widget-content p-0">
                                                <div class="widget-content-outer">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left">
                                                            <div class="widget-heading">Group Name</div>
                                                        </div>

                                                    </div>
                                                    <p class="text-center" v-if="getadminDashboard.c2 == ''">No data to
                                                        present.</p>
                                                    <div class="widget-progress-wrapper"
                                                        v-for="cap2 in getadminDashboard.c2" :key="cap2.id">

                                                        <div class="widget-content-left">

                                                            <div class="widget-subheading">
                                                                <strong>{{ cap2.grp_title}}</strong></div>
                                                        </div>
                                                        <div class="progress-bar-sm progress-bar-animated-alt progress">
                                                            <div class="progress-bar bg-primary" role="progressbar"
                                                                aria-valuenow="100" aria-valuemin="0"
                                                                aria-valuemax="100"
                                                                v-bind:style="{ width: cap2.grp_percent + '%'}">
                                                            </div>
                                                        </div>
                                                        <div class="progress-sub-label">

                                                            <div class="sub-label-right">{{ cap2.grp_percent }}%</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </transition>

    </div>



</template>
<style>
    .show-enter-active,
    .show-leave-enter {
        transform: translateX(0);
        transition: all .3s linear;
    }

    .show-enter,
    .show-leave-to {
        transform: translateX(100%);
    }

    .ps {
        height: 100px;
    }

</style>
<script>
    import AdminSidebar from './AdminSidebar'

    import {
        mapGetters,
        mapActions
    } from 'vuex'
    import Capstone1 from './Graph/Capstone1'
    import Capstone2 from './Graph/Capstone2'
    import Navbar from '../../components/Navbar.vue'
    export default {
        props: ['user'],
        components: {
            'sidebar': AdminSidebar,
            'caps1': Capstone1,
            'caps2': Capstone2,
            Navbar,

        },
        data() {
            return {
                capstone1: {},
            }
        },

        methods: {
            ...mapActions(["fetchadminDashboard", "fetchDependencies"]),
            getCapstone1() {
                axios.get('../api/adminDashboard').then(data => {
                    console.log(data);
                    this.capstone1 = data
                });
            }
        },
        computed: mapGetters(['getadminDashboard']),
        created() {
            this.fetchadminDashboard();
            this.fetchDependencies();
            this.getCapstone1();
        }
    }

</script>
