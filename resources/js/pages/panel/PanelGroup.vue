<template>
 <div class="app-main">

        <sidebar :user="user" />

        <div class="app-main__outer">
            <div class="app-main__inner">
                <div class="app-page-title">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <i class="metismenu-icon fas fa-users fa-2x"></i>
                            <div class="ml-2">Dashboard</div>

                        </div>

                    </div>
                </div>
            <div class="content">
                
                        <a v-if="select == false" class="navbar-brand" href="#">Groups</a>
                        <a @click="Unselect" v-if="select == true" class="navbar-brand" href="#">Back</a>
                         <div v-if="select == true" class="header text-center">
                    <h2 class="title">{{ grp.grp_title }}</h2>
                    <p class="category">{{ grp.grp_researchtitle }}</p>
                </div>
                <div class="row">
                    <div v-if="select == false" class="col-md-12">
                        <div class="card">
                            <div class="card-header text-center">
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
                                            <tr v-for="(group, index) in groups" :key="group.id">
                                                <td>{{ group.grp_title }}</td>
                                                <td>{{ group.grp_researchtitle }}</td>
                                                <td>{{ group.crs_title }}</td>
                                                <td>
                                                    <button @click="SelectGroup(index)"
                                                        class="btn btn-info btn-round btn-sm">Manage</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="select == true" class="col-md-12">
                      
                           
                                <ul class="nav nav-pills nav-pills-info nav-pills-icons justify-content-center"
                                    role="tablist">
                                    <li class="nav-item">
                                        <a href="#info" data-toggle="tab" role="tablist" class="nav-link active">
                                            <i class="fas fa-info"></i>
                                            Information
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#evaluation" data-toggle="tab" role="tablist" class="nav-link">
                                            <i class="fas fa-file"></i>
                                            Evaluation
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#validator" data-toggle="tab" role="tablist" class="nav-link">
                                            <i class="fas fa-file"></i>
                                            Validation
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#resources" data-toggle="tab" role="tablist" class="nav-link">
                                            <i class="fas fa-file"></i>
                                            Resources
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#schedule" data-toggle="tab" role="tablist" class="nav-link">
                                            <i class="fas fa-calendar"></i>
                                            Schedule
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
                                    <div class="tab-pane" id="evaluation">
                                        <evaluation  v-if="grp.grp_standing == 1" :rating="rating" :user="user" :grp="grp" />
                                        <evaluation2 v-if="grp.grp_standing == 2" :rating="rating" :user="user" :grp="grp" />
                                    </div>
                                    <div class="tab-pane" id="validator">
                                        <validator v-if="grp.grp_standing == 1" :grp="grp" :user="user"  />
                                        <validator2 v-if="grp.grp_standing == 2" :grp="grp" :user="user"  />
                                    </div>
                                    <div class="tab-pane" id="resources">
                                        <resources :grp="grp" :user="user"  />
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
    import GroupInformation from './Groups/GroupInformation'
    import Capstone1Evaluation from './Groups/Capstone1Evaluation'
    import Capstone1Validator from './Groups/Capstone1Validor'
    import Resources from './Groups/Resources'
    import Minutes from '../admin/Capstone1/Minutes'

    import Capstone2Evaluation from './Groups/Capstone2Evaluation'
    import Capstone2Validator from './Groups/Capstone2Validator'
    import {
        mapGetters,
        mapActions
    } from 'vuex'
    export default {
        props: ['user'],
        components: {
            'sidebar': PanelSidebar,
            'information' : GroupInformation,
            'evaluation' : Capstone1Evaluation,
            'validator' : Capstone1Validator,
            'resources' : Resources,

            'evaluation2' : Capstone2Evaluation,
            'validator2' : Capstone2Validator,
        },
        data() {
            return {
                select: false,
                groups: {},
                rating:{},

                grp: {},
            }
        },
        methods: {
            GetPanelGroups() {
                axios.get('../api/getpanelgroups/' + this.user.id).then(res => {
                    this.groups = res.data.groups
                })
            },
            GetRating(){
                axios.get('../api/getratingscale').then(res => {
                    this.rating = res.data.rating
                })
            },
            SelectGroup(index) {
                this.select = true
                this.grp = this.groups[index]
                var req = {
                    grp : this.grp.grp_id,
                    id : this.user.id
                }
                this.getGroupInfo(this.grp.grp_id)
                this.getCapstone1Evaluation(req)
                this.getCapstone1Validation(req)
            },
            Unselect() {
                this.select = false
                this.grp = {}
            },
            ...mapActions(["getCapstone1Evaluation", 'getCapstone1Validation',"getGroupInfo"])
        },
        created() {
            this.GetPanelGroups()
            this.GetRating()
        },
        computed: mapGetters(['groupinfo'])
    }

</script>
