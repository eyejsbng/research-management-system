<template>
    <div>
        <sidebar :user="user"></sidebar>
        <div class="main-panel" id="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-transparent  navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-toggle">
                            <button type="button" class="navbar-toggler">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </button>
                        </div>

                        <a v-if="isManage == false" class="navbar-brand" href="#">Group Request</a>
                        <a @click="Cancel" v-if="isManage == true" class="navbar-brand" href="#">Back</a>
                    </div>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                        aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                    </button>

                    <!-- <div class="collapse navbar-collapse justify-content-end" id="navigation">


                        <form>
                            <div class="input-group no-border">
                                <input type="text" value="" class="form-control" placeholder="Search...">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <i class="now-ui-icons ui-1_zoom-bold"></i>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#pablo">
                                    <i class="now-ui-icons media-2_sound-wave"></i>
                                    <p>
                                        <span class="d-lg-none d-md-block">Stats</span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="now-ui-icons location_world"></i>
                                    <p>
                                        <span class="d-lg-none d-md-block">Some Actions</span>
                                    </p>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#pablo">
                                    <i class="now-ui-icons users_single-02"></i>
                                    <p>
                                        <span class="d-lg-none d-md-block">Account</span>
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </div> -->
                </div>
            </nav>
            <div class="panel-header panel-header-sm" style="background:#bd821c;">
            </div>
            <div class="content">
                <div class="row">
                    <div v-if="isManage == false" class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Group Request</h4>
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
                                            <tr v-for="(groups, index) in group" :key="groups.ag_id">
                                                <td>{{ groups.grp_title }}</td>
                                                <td>{{ groups.grp_researchtitle }}</td>
                                                <td>{{ groups.crs_title }}</td>
                                                <td>
                                                    <button @click="Manage(index)" class="btn btn-info btn-round btn-sm"><i class="fas fa-cogs"></i>Manage</button>
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
                                            <input v-model="reason" type="text" class="form-control" placeholder="Please state your reason to decline">
                                        </div>
                                        <p style="font-size:12px;color:red;">{{ error.reason }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <button @click="Decission(1)" class="btn btn-info btn-round btn-block">Accept</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button @click="Decission(2)" class="btn btn-primary btn-round btn-block">Decline</button>
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
    import AdviserSidebar from './AdviserSidebar'
    import {
        mapGetters,
        mapActions
    } from 'vuex'
    export default {
        props: ['user'],
        components: {
            'sidebar': AdviserSidebar,
        },
        data(){
            return{
                reason: null,
                error:{},

                group:{},
                grp:{},

                isManage:false,
                isDecline:false,
            }
        },
        methods: {
            GetGroupRequest(){
                axios.get('../api/getadvisergrouprequest/'+this.user.id).then(res => {
                    this.group = res.data.group
                })
            },
            Manage(index){
                this.isManage = true
                this.grp = this.group[index]
            },
            Cancel(){
                this.isManage = false
                this.grp = {}
            },
            Decission(us_id){
               axios.post('../api/updateadvisergroups', {
                    grp_id : this.grp.grp_id,
                    id : this.user.id,
                    us_id: us_id,
                    reason: this.reason
                }).then(res => {
                    if(res.data.message == 'success'){
                        if(us_id == 1){
                            this.Alert('success', 'Successfully Accepted')
                            this.Clear()
                        }
                        else{
                            this.Alert('success', 'Successfully Declined')
                            this.Clear()
                        }
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
            Clear(){
                this.GetGroupRequest()
                this.grp = {}
                this.isDecline = false
                this.isManage = false
                this.reason = null
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
            this.GetGroupRequest();
        }
    }

</script>
