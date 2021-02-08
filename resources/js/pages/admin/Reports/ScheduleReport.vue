<template>
    <div class="app-main">
        <sidebar :user="user"></sidebar>
        <div class="app-main__outer bg-white">
            <div class="app-main__inner">
                <div class="app-page-title bg-primary text-light">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <div>Schedule Report </div>
                        </div>
                    </div>
                </div>
        
                <div class="row mt-2 mb-2">
                    <div class="col-md-3">
                        <select class="form-control">
                            <option value="">Select Start Date</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select  class="form-control">
                            <option value="">Select End Date</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-control">
                            <option value="">Select Schedule Type</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-info btn-round btn-block">Print</button>
                    </div>
                </div>
      
            <div class="content">
                <div class="card">
                    <div class="card-body">
                        <div class="row ph">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <img src="/assets/img/um.jpg" alt="umbanner">
                                    </div>
                                    <div class="col-md-6">
                                        <p class="font-weight-bold" style="text-align:right">College of Computing
                                            Education</p>
                                        <p class="font-italic" style="text-align:right">
                                        3rd Floor, DPT Building <br>
                                        Matina Campus, Davao City <br>
                                        Telefax: (082) <br>
                                        Phone No: (082)300-5456/300-0645 to 48 Local 116
                                    </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 font-weight-bold">
                                16500 - {{ getYear() }} - {{ getDate() }}/rev 0
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <h4 class="title text-center">List of Schedule Report</h4>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <td><strong>Date</strong></td>
                                                <td><strong>Time</strong></td>
                                                <td><strong>Group</strong></td>
                                                <td><strong>Adivser</strong></td>
                                                <td><strong>Panels</strong></td>
                                                <td><strong>Status</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>

                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="container row">
                                        <div class="col-md-6">
                                            <p>Prepared By</p>
                                            <p class="text-center">{{ user.name }}</p>
                                            <p class="border-top text-center">Research Coordinator</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>Noted By</p>
                                            <p class="text-center">Ramciz N. Vilchez, DIT</p>
                                            <p class="text-center border-top">Dean</p>
                                        </div>
                                    </div>
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
    import AdminSidebar from '../AdminSidebar'
    import moment from 'moment'
    import {
        mapGetters,
        mapActions
    } from 'vuex'
    export default {
        props: ['user'],
        components: {
            'sidebar': AdminSidebar,
        },
        methods: {
            getDate() {
                var date = moment(Date.now()).format('MMDD')
                return date
            },
            getYear() {
                var year = moment(Date.now()).format('YYYY')
                return year
            },
            ...mapActions(["fetchadminDashboard", "fetchDependencies"])
        },
        computed: mapGetters(['getadminDashboard']),
        created() {
            this.fetchadminDashboard();
            this.fetchDependencies();
        }
    }

</script>
<style scoped>
    .ph {
        border-bottom-style: solid;
    }
</style>
