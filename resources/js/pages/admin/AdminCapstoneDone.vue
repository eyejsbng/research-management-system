<template>
     <div class="app-main">
        <sidebar :user="user"></sidebar>
         <div class="app-main__outer">
            <div class="app-main__inner">
                <div class="app-page-title bg-primary text-light">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            
                              
                            <div v-if="select == false">Capstone Done </div>
                    
                        <a v-else @click="Unselect" class="navbar-brand" href="#">
                            <h5><i class="fas fa-arrow-left"></i> Back</h5>
                        </a>   
                        </div>

                    </div>
                </div>
                 <div class="content">
                <div class="row">
                    <div class="col-md-12" v-if="select == false">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    Group List
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hovered">
                                        <thead class="text-info">
                                            <tr>
                                                <td><strong>Group Name</strong></td>
                                                <td><strong>Group Title</strong></td>
                                                <td><strong>Group Course</strong></td>
                                                <td><strong>Group Code</strong></td>
                                                <td><strong>Action</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(c3, index) in getadminDashboard.c3" :key="c3.grp_id">
                                                <td>{{ c3.grp_title }}</td>
                                                <td>{{ c3.grp_researchtitle }}</td>
                                                <td>{{ c3.crs_title }}</td>
                                                <td>{{ c3.grp_code }}</td>
                                                <td>
                                                    <button class="btn btn-info btn-round btn-sm"
                                                        @click="Manage(index)">Manage</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12" v-if="select == true">
                        <div class="card card-subcategories">
                            <div class="card-body">
                                <ul class="nav nav-pills nav-pills-info nav-pills-icon justify-content-center" role="tablist">
                                    <li class="nav-item">
                                        <a href="#info" data-toggle="tab" role="tablist" class="nav-link">
                                            <i class="fas fa-info"></i>
                                            Information
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#checklist" data-toggle="tab" role="tablist" class="nav-link">
                                            <i class="fas fa-file"></i>
                                            Checklist
                                        </a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a href="#resources" data-toggle="tab" role="tablist" class="nav-link">
                                            <i class="fas fa-file"></i>
                                            Resources
                                        </a>
                                    </li> -->
                                </ul>
                                <div class="tab-content tab-space tab-subcategories">
                                    <div class="tab-pane active" id="info">
                                        <information :grp="groupinfo" />
                                    </div>
                                    <div class="tab-pane" id="checklist">
                                        <checklist :grp="grp" />
                                    </div>
                                    <!-- <div class="tab-pane" id="resources">

                                    </div> -->
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
import { mapGetters,mapActions} from 'vuex'
import AdminSidebar from './AdminSidebar'
import GroupInformation from './Donegroups/Information'
import GroupChecklist from './Donegroups/Checklist'
export default {
        props: ['user'],
        components: {
            'sidebar': AdminSidebar,
            'information' : GroupInformation,
            'checklist' : GroupChecklist
        },
        data() {
            return {
                select: false,

                grp: {},
            }
        },
        methods: {
            Manage(index) {
                this.select = true
                this.grp = this.getadminDashboard.c3[index]

                this.getGroupInfo(this.grp.grp_id)
                this.getFinalChecklist(this.grp.grp_id)
            },
            Cancel() {
                this.grp = {}
                this.select = false
            },
            ...mapActions(['fetchadminDashboard', 'getGroupInfo','getFinalChecklist'])
        },
        created() {
            this.fetchadminDashboard()
        },
        computed: mapGetters(['getadminDashboard','groupinfo','getfinalchecklist'])

    }

</script>
