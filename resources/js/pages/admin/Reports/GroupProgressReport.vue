<template>
    <div class="app-main">
        <sidebar :user="user"></sidebar>
        <div class="app-main__outer bg-white">
            <div class="app-main__inner">
                <div class="app-page-title bg-primary text-light">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <div>Group Progress</div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2 mb-2">
                    <div class="col-md-3">
                        <select class="form-control" v-model="details.sec_id" @change="ChangeSections">
                            <option value="">Select Course Code</option>
                            <option v-for="s in sections" :key="s.sec_id" :value="s.sec_id">{{ s.sec_code }}</option>
                        </select>
                    </div>
                    <div class="col-md-3">

                        <button class="btn-wide mb-2 mr-2 btn btn-primary btn-lg" @click="print">
                            <i class="fas fa-print"></i> Print
                        </button>
                    </div>
                </div>
                <div class="content" id="printMe">
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
                                    <div class="col-md-12">
                                        <div class="table-responsive" style="overflow:hidden;">
                                            <h4 class="title text-center">List of Group Progress</h4>
                                            <p class="text-center" style="font-size:12px;">SY {{ details.sec.sec_yrs }}
                                                - {{ details.sec.sec_yre }}</p>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p>Course Code: {{ details.sec.sec_code }}</p>
                                                    <p>Subject Teacher: {{ details.sec.name }}</p>
                                                    <p>Time: {{ details.sec.sec_time }}</p>
                                                    <p># of Groups: {{ details.groups.length }}</p>
                                                </div>
                                                <div class="col-md-12">
                                                    <table class="table table-hover text-center">
                                                        <thead>
                                                            <tr>
                                                                <td><strong>Group Name</strong></td>
                                                                <td><strong>Group Percent</strong></td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="g in details.groups" :key="g.grp_id">
                                                                <td>{{ g.grp_title }}%</td>
                                                                <td>{{ g.grp_percent }}%</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
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
                sections: {},
                details: {
                    sec_id: '',
                    sec: {},
                    groups: {},
                }
            }
        },
        methods: {
            GetSectionList() {
                axios.get('../api/getsectionlist').then(res => {
                    this.sections = res.data.sections
                })
            },
            ChangeSections() {
                if (this.details.sec_id == '') {

                } else {
                    this.details.sec = this.sections.find(data => data.sec_id == this.details.sec_id)
                    axios.get('../api/getsectiongrouprogress/' + this.details.sec_id).then(res => {
                        this.details.groups = res.data.groups
                    })
                }
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
            this.GetSectionList()
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
