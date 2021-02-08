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
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title"> Group Progress</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <group v-if="groups != ''" :getadminDashboard="groups"></group>
                                    </div>
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
    import PanelSidebar from './PanelSidebar'
    import {
        mapGetters,
        mapActions
    } from 'vuex'
    import Capstone1 from '../admin/Graph/Capstone1'
    export default {
        props: ['user'],
        components: {
            'sidebar': PanelSidebar,
            'group': Capstone1,
        },
        data() {
            return {
                count: {
                    active: 0,
                    done: 0,
                },
                groups: '',
            }
        },
        methods: {
            GetPanelGroups() {
                axios.get('../api/getpanelgroups/' + this.user.id).then(res => {
                    this.groups = res.data.groups
                    this.count.active = res.data.active
                    this.count.done = res.data.done
                })
            },
        },
        created() {
            this.GetPanelGroups();
        }
    }

</script>
