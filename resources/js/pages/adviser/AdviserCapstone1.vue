<template>
    <div class="app-main">
        <sidebar :user="user"></sidebar>
        <div class="app-main__outer">
            <div class="app-main__inner">
                <div class="app-page-title">
                    <div class="page-title-wrapper">
                        <div v-if="isSelect == false" class="page-title-heading">
                            <i class="metismenu-icon fas fa-users fa-2x"></i> 
                          <h5 class="ml-3">Capstone 1</h5>
                        </div>
                        <div v-if="isSelect == true" class="page-title-heading">
                            <a @click="Cancel" v-if="isSelect == true" href="#"><i class="metismenu-icon fas fa-chevron-left fa-2x"></i>  Back</a>
                        </div>
                    </div>
                </div>
           
            <div class="content">
        
                        
                <div class="row">
                    <div v-if="isSelect == false" class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Group List</h4>
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
                                            <tr v-for="(groups, index) in c1" :key="groups.ag_id">
                                                <td>{{ groups.grp_title }}</td>
                                                <td>{{ groups.grp_researchtitle }}</td>
                                                <td>{{ groups.crs_title }}</td>
                                                <td>
                                                    <button @click="Manage(index)"
                                                        class="btn btn-info btn-round btn-sm"><i
                                                            class="fas fa-cogs"></i>Manage</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="isSelect == true" class="col-md-12">
                         <div v-if="isSelect == true" class="header text-center">
                    <h2 class="title">{{ grp.grp_title }}</h2>
                    <p class="category">{{ grp.grp_researchtitle }}</p>
                </div>
                        <div class="card card-subcategories">
                            <div class="card-body">
                                <div class="alert alert-warning text-center" v-if="grp.grp_percent == 50">
                                    <span>
                                        Group are waiting Panel to Validate. <br>
                                        Or Waiting for RC to Approve the Group Standing to Thesis/Capstone 2.
                                    </span>
                                </div>
                                <ul class="nav nav-pills nav-pills-info nav-pills-icons justify-content-center"
                                    role="tablist">
                                    <li class="nav-item">
                                        <a href="#info" data-toggle="tab" role="tablist" class="nav-link active">
                                            <i class="fas fa-info"></i>
                                            Information
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#adviser" data-toggle="tab" role="tablist" class="nav-link">
                                            <i class="fas fa-file"></i>
                                            Submission
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#system" data-toggle="tab" role="tablist" class="nav-link">
                                            <i class="fas fa-cogs"></i>
                                            System
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#panel" data-toggle="tab" role="tablist" class="nav-link">
                                            <i class="fas fa-user"></i>
                                            Panel
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#minutes" data-toggle="tab" role="tablist" class="nav-link">
                                            <i class="fas fa-calendar"></i>
                                            Minutes
                                        </a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a href="#message" data-toggle="tab" role="tablist" class="nav-link">
                                            <i class="fas fa-comment-dots"></i>
                                            Message
                                        </a>
                                    </li> -->
                                </ul>
                                <div class="tab-content tab-space tab-subcategories">
                                    <div class="tab-pane active" id="info">
                                        <information :grp="grp" />
                                    </div>
                                    <div class="tab-pane" id="adviser">
                                        <submission :grp="grp" :user="user" />
                                    </div>
                                    <div class="tab-pane" id="system">
                                        <system :grp="grp" :user="user" />
                                    </div>
                                    <div class="tab-pane" id="panel">
                                        <evaluation :getcaps1evalution="getcaps1evalution" />
                                        <Validation :getcaps1validation="getcaps1validation" />
                                    </div>
                                    <div class="tab-pane" id="minutes">
                                        <minutes :capstone="grp" />
                                    </div>
                                    <div class="tab-pane" id="message">
                                        <h4 class="title text-center">Group Schedule</h4>
                                    </div>
                                    <div class="tab-pane" id="submission">
                                        <h4 class="title text-center">Group Submission</h4>
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
    import AdviserSidebar from './AdviserSidebar'
    import Information from './Capstone1/Information'
    import Submission from './Capstone1/Submission'
    import Evaluation from '../admin/Capstone1/Evaluation'
    import Validation from '../admin/Capstone1/Validator'
    import System from './Capstone1/System'
    import Minutes from '../admin/Capstone1/Minutes'
    // import VueDocPreview from 'vue-doc-preview'
    import pdf from 'vue-pdf'
    import {
        mapGetters,
        mapActions
    } from 'vuex'
    export default {
        props: ['user'],
        components: {
            'sidebar': AdviserSidebar,
            'information' : Information,
            'system' : System,
            'submission' : Submission,
            'evaluation' : Evaluation,
            'Validation' : Validation,
            'minutes' : Minutes,

            // VueDocPreview,
            pdf
        },
        data() {
            return {
                reason: null,
                error: {},

                members: {},
                panels: {},
                c1: {},
                grp: {},
                // for system checking

                isSelect: false,

            }
        },
        methods: {
            GetAdviserCapstone1() {
                axios.get('../api/getadvisercapstone1/' + this.user.id).then(res => {
                    this.c1 = res.data.c1
                })
            },
            Manage(index) {
                this.isSelect = true
                this.grp = this.c1[index]
                // this.GetCapstoneDetails()
                //get Capstone 1 checking system
                var req = {
                    grp: this.grp.grp_id,
                    id: ''
                }
                this.getGroupInfo(this.grp.grp_id)
                this.getCapstone1checkSys(this.grp.grp_id)
                this.getCapstone1Evaluation(req)
                this.getCapstone1Validation(req)
                this.getCapston1Grammarly(this.grp.grp_id)

            },
            // GetCapstoneDetails() {
            //     axios.get('../api/selectCap1/' + this.grp.grp_id).then(res => {
            //         this.members = res.data.members
            //         this.panels = res.data.panels
            //     })
            // },
            Cancel(index) {
                this.isSelect = false
                this.docs = {}
                this.path = ''
                this.isCheck = false
                this.grp = {}
            },

            // Grammarly Function
            GrammarlyUpload() {

            },
            ...mapActions(["getGroupInfo","fetchadminDashboard", "fetchDependencies", "getCapstone1checkDocs", "getCapstone1checkSys","getCapstone1Evaluation","getCapston1Grammarly","getCapstone1Validation"])
        },
        computed: mapGetters(['groupinfo','getadminDashboard', 'getcaps1checkdocs', 'getcaps1checksys','getcaps1evalution','getcaps1validation']),
        created() {
            this.GetAdviserCapstone1();
        }
    }

</script>
<style scoped>
    .doc {
        width: 100%;
        height: 500px;
    }

</style>
