<template>
   <div class="app-main">

        <sidebar :user="user" />

        <div class="app-main__outer">
            <div class="app-main__inner">
                <div class="app-page-title">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <i class="metismenu-icon fas fa-mail-bulk fa-2x"></i>
                            <div class="ml-2">Group Request</div>

                        </div>

                    </div>
                </div>
            <div class="content">
                <div class="row">
                    <div v-if="isManage == false" class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Group Request List</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hovered">
                                        <thead class="text-info">
                                            <tr>
                                                <td><strong>Name</strong></td>
                                                <td><strong>Research Title</strong></td>
                                                <td><strong>Course</strong></td>
                                                <td><strong>Action</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(group,index) in groups" :key="group.id">
                                                <td>{{ group.grp_title }}</td>
                                                <td>{{ group.grp_researchtitle }}</td>
                                                <td>{{ group.crs_title }}</td>
                                                <td>
                                                    <button @click="Manage(index)" class="btn btn-info btn-round btn-sm">Manage</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="isManage == true" class="col-md-8 mr-auto ml-auto">
                        <div class="card">
                            <div class="card-header bg-info">
                                <h4 class="card-title text-center">Manage Request of {{ grp.grp_title }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Reason</label>
                                            <input v-model="reason" type="text" class="form-control"
                                                placeholder="Please state your reason to decline">
                                        </div>
                                        <p style="font-size:12px;color:red;">{{ error.reason }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <button @click="Decission(1)"
                                            class="btn btn-info btn-round btn-block">Accept</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button @click="Decission(2)"
                                            class="btn btn-primary btn-round btn-block">Decline</button>
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
    import PanelSidebar from './PanelSidebar'
    import {
        mapGetters,
        mapActions
    } from 'vuex'
    export default {
        props: ['user'],
        components: {
            'sidebar': PanelSidebar,
        },
        data() {
            return {
                groups: {},
                grp:{},

                reason:'',
                isManage: false,
                error:{},
            }
        },
        methods: {
            GetGroupRequest() {
                axios.get('../api/getpanelgrouprequest/' + this.user.id).then(res => {
                    this.groups = res.data.groups
                })
            },
            Manage(index){
                this.isManage = true
                this.grp = this.groups[index]
            },
            Unmanage(){
                this.grp = {}
                this.isManage = false
                this.error  = {}
            },
            Decission(us_id){
                axios.post('../api/updatepanelgroups',{
                    grp_id : this.grp.grp_id,
                    id : this.user.id,
                    us_id: us_id,
                    reason: this.reason
                }).then(res =>{
                    if(res.data.message == 'success'){
                        this.Alert('success', 'Successfully Accepted')
                        this.isManage = false
                        this.GetGroupRequest()
                    }
                    else{
                        this.Alert('info', res.data.message)
                    }
                }).catch(err => {
                    if(err.response.status == 422){
                        this.error = err.response.data.errors
                    }
                })
            },
            Alert(icon, title) {
                toast.fire({
                    icon: icon,
                    title: title,
                })
            },
            ...mapActions(["fetchadminDashboard", "fetchDependencies"])
        },
        computed: mapGetters(['getadminDashboard']),
        created() {
            this.fetchadminDashboard();
            this.fetchDependencies();
            this.GetGroupRequest()
        }
    }

</script>
