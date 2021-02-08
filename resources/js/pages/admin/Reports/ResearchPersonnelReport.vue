<template>
    <div class="app-main">
        <sidebar :user="user"></sidebar>
        <div class="app-main__outer bg-white">
            <div class="app-main__inner">
                <div class="app-page-title bg-primary text-light">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <div>Research Personnel</div>
                        </div>
                    </div>
                </div>
                 <div class="row">
                    <div class="col-md-6 float-left">
                       
                        <button class="btn-wide mb-2 mr-2 btn btn-primary btn-lg" @click="print">
                            <i class="fas fa-print"></i> Print
                            </button>
                    </div>
                </div>
                <div class="content" id="printMe">
                    <div class="card p-3"  style="overflow:hidden;">
                        <div class="card-body" >
                            <div class="row ph" >
                                <div class="col-md-12" >
                                    <div class="row" >
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
                            <div class="row" >
                                <div class="col-md-12 font-weight-bold">
                                    16500 - {{ getYear() }} - {{ getDate() }}/rev 0
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive" style="overflow:hidden;">
                                        <h4 class="title text-center">List of Research Personnel Report</h4>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p style="font-size:15px;" class="font-weight-bold">Panel</p>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <td><strong>Name</strong></td>
                                                                <td><strong>Specialization</strong></td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="p in rp.panel" :key="p.id">
                                                                <td>{{ p.name }}</td>
                                                                <td>{{ p.specialty }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <p style="font-size:15px;" class="font-weight-bold">Adviser</p>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <td><strong>Name</strong></td>
                                                                <td><strong>Specialization</strong></td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="a in rp.adviser" :key="a.id">
                                                                <td>{{ a.name }}</td>
                                                                <td>{{ a.specialty }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container row">
                                            <div class="col-md-6">
                                                <p><strong>Prepared By</strong></p>
                                                <p class="text-center">{{ user.name }}</p>
                                                <p class="border-top text-center">Research Coordinator</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><strong>Noted By</strong></p>
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
        data() {
            return {
                rp: {
                    adviser: {},
                    panel: {}
                }
            }
        },
        methods: {
            GetReport() {
                axios.get('../api/getresearchperson').then(res => {
                    this.rp.adviser = res.data.adviser
                    this.rp.panel = res.data.panel
                })
            },
            print() {
                this.$htmlToPaper('printMe');
            },
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
            this.GetReport()
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
