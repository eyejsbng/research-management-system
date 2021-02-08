<template>
    <div class="app-main">
        <sidebar :user="user"></sidebar>
        <div class="app-main__outer bg-white">
            <div class="app-main__inner">
                <div class="app-page-title bg-primary text-light">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <div>Evaluation Report</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <select name="" id="" class="form-control">
                            <option value="">SY Start</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="" id="" class="form-control">
                            <option value="">SY End</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="" id="" class="form-control">
                            <option value="">Type</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="" id="" class="form-control">
                            <option value="">Research Person</option>
                        </select>
                    </div>

                    <div class="row ml-3 mt-2 mb-2">
                        <button class="btn-wide btn btn-primary btn-lg">
                            <i class="fas fa-print"></i> Print
                        </button>
                    </div>
                </div>
                <div class="content">
                    <div class="card p-3">
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
                                        <h4 class="title text-center">Research Personnel Evaluation</h4>
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <td><strong>Name of Faculty</strong></td>
                                                    <td><strong>Advisees</strong></td>
                                                    <td><strong>Course Code</strong></td>
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
