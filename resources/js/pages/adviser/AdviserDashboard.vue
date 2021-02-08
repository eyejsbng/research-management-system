<template>
   
    <div class="app-main">

        <sidebar :user="user" />
     
        <div class="app-main__outer">
            <div class="app-main__inner">
                <div class="app-page-title">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                             <i class="metismenu-icon fas fa-layer-group fa-2x"></i>
                            <div class="ml-2">Dashboard</div>

                        </div>

                    </div>
                </div>
            <div class="content">
                <div class="row">
                   
                     <div class="col-md-6 col-xl-3">
                        <div
                            class="card mb-3 widget-chart widget-chart2 text-left card-btm-border card-shadow-primary border-primary">
                            <div class="widget-chat-wrapper-outer">
                                <div class="widget-chart-content pt-3 pl-3 pb-1">
                                    <div class="widget-chart-flex">
                                        <div class="widget-numbers">
                                            <div class="widget-chart-flex">
                                                <div class="fsize-4">
                                                    <i class="fas fa-users"></i>
                                                    <span>{{ count.active }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h6 class="widget-subheading mb-0 opacity-5">Active Groups</h6>
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
                                                    <i class="fas fa-users"></i>
                                                    <span>{{ count.done }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h6 class="widget-subheading mb-0 opacity-5">Done Groups</h6>
                                </div>

                            </div>
                        </div>
                    </div>
                 
                </div>
                <div class="row">
                   
                    <div class="col-sm-12 col-lg-6">
                        <div class="mb-3 card h-75 d-inline-block">
                            <div class="card-header-tab card-header">
                                <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                    <i class="metismenu-icon fas fa-book-reader fa-2x"></i>
                                    Capstone 1 Group Progress
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
                                                    <p class="text-center" v-if="groups.c1 == ''">No data to
                                                        present.</p>
                                                </div>

                                                <div class="widget-progress-wrapper"
                                                    v-for="cap1 in groups.c1" :key="cap1.id">
                                                    <div class="widget-content-left">

                                                        <div class="widget-subheading">
                                                            <strong>{{ cap1.grp_title}}</strong></div>
                                                    </div>
                                                    <div class="progress-bar-sm progress-bar-animated-alt progress">
                                                        <div class="progress-bar bg-primary" role="progressbar"
                                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"
                                                            v-bind:style="{ width: cap1.grp_percent + '%'}">
                                                        </div>
                                                    </div>
                                                    <div class="progress-sub-label">

                                                        <div class="sub-label-right">{{ cap1.grp_percent }}%</div>
                                                    </div>
                                                    <hr>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                     <div class="col-sm-12 col-lg-6">
                        <div class="mb-3 card h-75 d-inline-block">
                            <div class="card-header-tab card-header">
                                <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                    <i class="metismenu-icon fas fa-book-reader fa-2x"></i>
                                    Capstone 2 Group Progress
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
                                                    <p class="text-center" v-if="groups.c2 == ''">No data to
                                                        present.</p>
                                                </div>

                                                <div class="widget-progress-wrapper"
                                                    v-for="cap2 in groups.c2" :key="cap2.id">
                                                    <div class="widget-content-left">

                                                        <div class="widget-subheading">
                                                            <strong>{{ cap2.grp_title}}</strong></div>
                                                    </div>
                                                    <div class="progress-bar-sm progress-bar-animated-alt progress">
                                                        <div class="progress-bar bg-primary" role="progressbar"
                                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"
                                                            v-bind:style="{ width: cap2.grp_percent + '%'}">
                                                        </div>
                                                    </div>
                                                    <div class="progress-sub-label">

                                                        <div class="sub-label-right">{{ cap2.grp_percent }}%</div>
                                                    </div>
                                                    <hr>
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
        </div>
    </div>
</template>
<script>
    import AdviserSidebar from './AdviserSidebar'
    import Capstone1 from '../admin/Graph/Capstone1'
    import Capstone2 from '../admin/Graph/Capstone2'
    export default {
        props: ['user'],
        components: {
            'sidebar': AdviserSidebar,
            'caps1': Capstone1,
            'caps2' : Capstone2
        },
        data(){
            return{
                groups:{
                    c1:'',
                    c2:'',
                },
                count:{
                    active:0,
                    done:0
                }
            }
        },
        methods: {
            GetAdviserGroups(){
                axios.get('../api/getadvisercapstone1/' + this.user.id).then(res => {
                    this.groups.c1 = res.data.c1
                    this.groups.c2 = res.data.c2
                    this.count.active = res.data.active
                    this.count.done = res.data.done
                })
            }
        },
        created() {
            this.GetAdviserGroups()
        }
    }
</script>
