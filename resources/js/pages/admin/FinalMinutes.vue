<template>
   <div class="app-main">
        <sidebar :user="user"></sidebar>
        <div class="app-main__outer bg-white">
            <div class="app-main__inner">
                <div class="app-page-title bg-primary text-light">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <div>Final</div>
                        </div>
                    </div>
                </div>
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-primary text-light">
                              
                                  Minutes of the Final Defense
                            
                            </div>
                            <div class="card-body">
                                 <div class="row">
                                        <div class="col-md-12">
                                            <div class="alert alert-info">
                                            <strong>Note:</strong> Choose first in the dropdown below to make the minutes of the group.
                                        </div>
                                        </div>
                                        
                                    </div>
                                <div class="row text-center">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Group</label>
                                            <select class="form-control" v-model="grp" @change="ChangeGroup">
                                                <option value="" selected disabled hidden>Choose group</option>
                                                <option v-if="getadminDashboard.c2 == ''" value="" disabled>No data found.</option>
                                                <option v-for="c in getadminDashboard.c2" :key="c.grp_id" :value="c.grp_id">{{ c.grp_title }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Defense Type</label>
                                            <input type="text" value="Final Defense" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Date</label>
                                            <input type="text" class="form-control" v-model="Tdate" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Defense Status</label>
                                            <input type="text" class="form-control" v-model="Tstatus" disabled>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row text-center">
                                    <div class="col-md-12">
                                        <h5 class="font-italic" v-if="groupinfo.info">{{ groupinfo.info.grp_researchtitle }}</h5>
                                        <h6>Title of the Study</h6>
                                        <hr>
                                        <div class="row">
                                            <h6 class="col-md-3 border-right">Proponents</h6>
                                            <div class="col-md-3" v-for="m in groupinfo.members" :key="m.id">
                                                <p>{{ m.name }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <h6 class="col-md-3 border-right">Panel Memner/s:</h6>
                                            <div class="col-md-3" v-for="m in groupinfo.panels" :key="m.id">
                                                <p>{{ m.name }}</p>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                                <div class="row text-center" v-if="isOkay">
                                    <h5 class="col-md-12">Comments and Suggestions</h5>
                                    <hr>
                                    <div class="col-md-12 mt-1">
                                        <h6 class="col-md-3 float-left mt-3">Document Format</h6>
                                        <div class="col-md-9 float-right">
                                            <textarea class="form-control" v-model="getminutes.sched[0].min_DocumentFormat"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-1">
                                        <h6 class="col-md-3 float-left mt-3">Chapter 1</h6>
                                        <div class="col-md-9 float-right">
                                            <textarea class="form-control" v-model="getminutes.sched[0].min2_chapter1"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-1">
                                        <h6 class="col-md-3 float-left mt-3">Chapter 2</h6>
                                        <div class="col-md-9 float-right">
                                            <textarea class="form-control" v-model="getminutes.sched[0].min2_chapter2"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-1">
                                        <h6 class="col-md-3 float-left mt-3">Chapter 3</h6>
                                        <div class="col-md-9 float-right">
                                            <textarea class="form-control" v-model="getminutes.sched[0].min2_chapter3"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-1">
                                        <h6 class="col-md-3 float-left mt-3">Methodology</h6>
                                        <div class="col-md-9 float-right">
                                            <textarea class="form-control" v-model="getminutes.sched[0].min2_methodology"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-1">
                                        <h6 class="col-md-3 float-left mt-3">Results and <br> Discussion</h6>
                                        <div class="col-md-9 float-right">
                                            <textarea class="form-control" v-model="getminutes.sched[0].min2_RD"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-1">
                                        <h6 class="col-md-3 float-left mt-3">Conclusion</h6>
                                        <div class="col-md-9 float-right">
                                            <textarea class="form-control" v-model="getminutes.sched[0].min2_conclussion"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-1">
                                        <h6 class="col-md-3 float-left mt-3">Recommendation</h6>
                                        <div class="col-md-9 float-right">
                                            <textarea class="form-control" v-model="getminutes.sched[0].min2_recommendation"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-1">
                                        <h6 class="col-md-3 float-left mt-3">References</h6>
                                        <div class="col-md-9 float-right">
                                            <textarea class="form-control" v-model="getminutes.sched[0].min_references"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-1">
                                        <h6 class="col-md-3 float-left mt-3">Application/ <br> System</h6>
                                        <div class="col-md-9 float-right">
                                            <textarea class="form-control" v-model="getminutes.sched[0].min2_AS"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-1">
                                        <h6 class="col-md-3 float-left mt-3">Others</h6>
                                        <div class="col-md-9 float-right">
                                            <textarea class="form-control" v-model="getminutes.sched[0].min_others"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3" v-if="isOkay">
                                    <div class="col-md-6 mr-auto ml-auto">
                                        <button :disabled="loading == true" class="btn btn-info btn-round btn-block" @click="CreateMinutes">Save Minutes</button>
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
    import AdminSidebar from './AdminSidebar'
    import {
        mapGetters,
        mapActions
    } from 'vuex'
    import moment from 'moment';
    export default {
        props: ['user'],
        components: {
            'sidebar': AdminSidebar
        },
        data(){
            return{
                grp: '',

                loading: ''
            }
        },
        methods:{
            ChangeGroup(){
                this.getGroupInfo(this.grp)
                 var req = {
                    grp : this.grp,
                    type: '',
                    isCaps1: 2,
                }
                this.fetchminutes(req)
            },
            CreateMinutes(){
                this.loading = true
                axios.post('../api/createfinalminutes', this.getminutes.sched[0]).then(res => {
                    if (res.data.message == 'success') {
                        this.loading = false
                        this.Alert('success', 'Successfully Created')
                    }
                    else{
                        this.loading = false
                        this.Alert('info', res.data.message)
                    }

                })
            },
            Alert(icon, title) {
                toast.fire({
                    icon: icon,
                    title: title,
                })
            },
             ...mapActions(["fetchadminDashboard","getGroupInfo", 'fetchminutes'])
        },
        computed:{
            Tdate(){
                if (this.getminutes.message == '') {
                    return this.date = this.getminutes.sched[0].min_date
                }
                else{
                    return this.date = ''
                }
            },
            Tstatus(){
                if (this.getminutes.message == '') {
                    return this.status = this.getminutes.sched[0].ds_title
                }
                else{
                    return this.status = ''
                }
            },
            isOkay(){
                if (this.getminutes.message == '') {
                    return true
                }
                else{
                    return false
                }
            },
            ...mapGetters(['getadminDashboard','groupinfo', 'getminutes'])
        },
        created(){
            this.fetchadminDashboard()
        }
    }

</script>
