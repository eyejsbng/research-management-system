<template>
    <div class="app-main">
        <sidebar :user="user"></sidebar>
        <div class="app-main__outer bg-white">
            <div class="app-main__inner">
                <div class="app-page-title bg-primary text-light" >
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <div>Title-Outline Defense</div>
                        </div>
                    </div>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light">
                               

                                        Minutes of the Defense
                              
                                    <hr>
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
                                                <select class="form-control" v-model="grp" @change="ChangeGroups">
                                                    <option value="" selected disabled hidden>Choose here</option>
                                                    <option v-for="c in getadminDashboard.c1" :key="c.grp_id"
                                                        :value="c.grp_id">{{ c.grp_title }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Defense Type</label>
                                                <select class="form-control" v-model="type" @change="ChangeType">
                                                    <option value="2">Title Defense</option>
                                                    <option value="3">Outline Defense</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Date</label>
                                                <input type="text" class="form-control" disabled :value="Tdate">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Defense Status</label>
                                                <input type="text" class="form-control" disabled :value="Tstatus">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row text-center">
                                        <div class="col-md-12">
                                             <h6><strong>Research Title</strong></h6>
                                            <h5 class="font-italic" v-if="groupinfo.info">
                                                {{ groupinfo.info.grp_researchtitle }}</h5>
                                           
                                            <hr>
                                            <div class="row">
                                                <h6 class="col-md-3 ">Proponents</h6>
                                                <div class="col-md-3" v-for="m in groupinfo.members" :key="m.id">
                                                    <p>{{ m.name }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <h6 class="col-md-3 ">Panel Memner/s:</h6>
                                                <div class="col-md-3" v-for="p in groupinfo.panels" :key="p.id">
                                                    <p>{{ p.name }}</p>
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
                                                <textarea class="form-control"
                                                    v-model="getminutes.sched[0].min_DocumentFormat"></textarea>
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-12 mt-1">
                                            <h6 class="col-md-3 float-left mt-3">Title</h6>
                                            <div class="col-md-9 float-right">
                                                <textarea class="form-control"
                                                    v-model="getminutes.sched[0].min1_title"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-1">
                                            <h6 class="col-md-3 float-left mt-3">Introduction/ <br> Project Context</h6>
                                            <div class="col-md-9 float-right">
                                                <textarea class="form-control"
                                                    v-model="getminutes.sched[0].min1_IP"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-1">
                                            <h6 class="col-md-3 float-left mt-3">Purpose and <br> Description</h6>
                                            <div class="col-md-9 float-right">
                                                <textarea class="form-control"
                                                    v-model="getminutes.sched[0].min1_PD"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-1">
                                            <h6 class="col-md-3 float-left mt-3">Objectives <br> General</h6>
                                            <div class="col-md-9 float-right">
                                                <textarea class="form-control"
                                                    v-model="getminutes.sched[0].min1_OG"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-1">
                                            <h6 class="col-md-3 float-left mt-3">Specific</h6>
                                            <div class="col-md-9 float-right">
                                                <textarea class="form-control"
                                                    v-model="getminutes.sched[0].min1_specific"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-1">
                                            <h6 class="col-md-3 float-left mt-3">RRL/S</h6>
                                            <div class="col-md-9 float-right">
                                                <textarea class="form-control"
                                                    v-model="getminutes.sched[0].min1_rrl"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-1">
                                            <h6 class="col-md-3 float-left mt-3">Technical <br> Background</h6>
                                            <div class="col-md-9 float-right">
                                                <textarea class="form-control"
                                                    v-model="getminutes.sched[0].min1_tb"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-1">
                                            <h6 class="col-md-3 float-left mt-3">References</h6>
                                            <div class="col-md-9 float-right">
                                                <textarea class="form-control"
                                                    v-model="getminutes.sched[0].min_references"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-1">
                                            <h6 class="col-md-3 float-left mt-3">Others</h6>
                                            <div class="col-md-9 float-right">
                                                <textarea class="form-control"
                                                    v-model="getminutes.sched[0].min_others"></textarea>
                                            </div>
                                        </div>
                                    </div>
                            
                                </div>
                                <div class="d-block text-right card-footer">

                                    <button class="btn btn-success btn-lg" @click="CreateMinutes">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <modal name="example" adaptive="true" height="auto">

                adasdasd

        </modal>
        </div>
    </div>
</template>
<style scoped>
textarea {

    background-color: #fafafa

}   
</style>
<script>
    import AdminSidebar from './AdminSidebar'
    import {
        mapGetters,
        mapActions
    } from 'vuex'
    import moment from 'moment';
    export default {
        props: ['user'],
        data() {
            return {
                grp: '',
                type: '',

                date: '',
                status: '',

                loading: '',
            }
        },
        components: {
            'sidebar': AdminSidebar
        },
        methods: {
            showModal() {
                this.$modal.show('example');
            },
            ChangeGroups() {
                this.getGroupInfo(this.grp)
                this.type = ''
            },
            ChangeType() {
                if (this.grp == '') {
                    this.Alert('info', 'Please Select A Group')
                    this.type = ''
                }
                var req = {
                    grp: this.grp,
                    type: this.type,
                    isCaps1: 1,
                }
                this.fetchminutes(req)
            },
            CreateMinutes() {
                this.loading = true
                axios.post('../api/createtitleoutlineminutes', this.getminutes.sched[0]).then(res => {
                    if (res.data.message == 'success') {
                        this.loading = false
                        this.Alert('success', 'Successfully Created')
                    } else {
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
            ...mapActions(["fetchadminDashboard", "getGroupInfo", 'fetchminutes'])
        },
        computed: {
            Tdate() {
                if (this.getminutes.message == '') {
                    return this.date = this.getminutes.sched[0].min_date
                } else {
                    return this.date = ''
                }
            },
            Tstatus() {
                if (this.getminutes.message == '') {
                    return this.status = this.getminutes.sched[0].ds_title
                } else {
                    return this.status = ''
                }
            },
            isOkay() {
                if (this.getminutes.message == '') {
                    return true
                } else {
                    return false
                }
            },
            ...mapGetters(['getadminDashboard', 'groupinfo', 'getminutes'])
        },
        created() {
            this.fetchadminDashboard();
        }
    }

</script>
