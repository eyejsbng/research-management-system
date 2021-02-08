<template>
    <div v-if="groupinfo.info">
         <div class="app-main">

        <sidebar :user="user" />

        <div class="app-main__outer">
            <div class="app-main__inner">
                <div class="app-page-title">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <i class="metismenu-icon fas fa-layer-group fa-2x"></i>
                            <div class="ml-2">Group Information</div>

                        </div>

                    </div>
                </div>
            <div class="content">
                <div class="header text-center" v-if="groupinfo.info">
                    <p class="h2">{{ groupinfo.info.grp_title }}</p>
                    <p class="h3">{{ groupinfo.info.grp_researchtitle }}</p>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title title text-center">Group Progress</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="title text-center">RC Progress</h4>
                                            </div>
                                            <div class="card-body">
                                                <rc-progress v-if="this.groupinfo.info" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="title text-center">Adviser Progress</h4>
                                            </div>
                                            <div class="card-body">
                                                <adviser-progress v-if="this.groupinfo.info" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="title text-center">Panel Progress</h4>
                                            </div>
                                            <div class="card-body">
                                                <panel-progress v-if="this.groupinfo.info" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                      <div class="card col-md-8">
                    <dl class="row ml-auto mr-auto">
                   
                    <dt class="col-sm-3 h5">Research Title</dt>
                    <dd class="col-sm-9 h5"><i>{{ groupinfo.info.grp_researchtitle }}</i></dd>
                    <dt class="col-sm-3 h5">Group Name</dt>
                    <dd class="col-sm-9 h5">{{ groupinfo.info.grp_title }}</dd>
                    <dt class="col-sm-3 h5">Members</dt>
                    <dd class="col-sm-9 h5"><h6 v-for="mem in groupinfo.members" :key="mem.id">{{mem.name}}</h6></dd>
                    <dt class="col-sm-3 h5">Adviser</dt>
                    <dd class="col-sm-9 h5">
                        <h6 v-if="groupinfo.adviser.id != 2">{{groupinfo.adviser.name}}</h6>
                                       <h6 v-if="groupinfo.adviser.id == 2">No Adviser Yet</h6>
                    </dd>
                    <dt class="col-sm-3 h5">Access Code</dt>
                    <dd class="col-sm-9 h5">{{ groupinfo.info.grp_code }}</dd>
                    <dt class="col-sm-3 h5">Defense Status</dt>
                    <dd class="col-sm-9 h5">{{  groupinfo.info.styp_title }}</dd>
                    <dt class="col-sm-3 h5">Group Standing</dt>
                    <dd class="col-sm-9 h5"><h6 v-if="groupinfo.info.grp_standing == 1">Capstone 1</h6>
                                       <h6 v-if="groupinfo.info.grp_standing == 2">Capstone 2</h6>
                                       <h6 v-if="groupinfo.info.grp_standing == 3">Done</h6></dd>
                    
                </dl>
                </div>
                <div class="card col-md-4">
                    <div class="card-header">Panels</div>
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item" v-for="pan in groupinfo.panels" :key="pan.id">
                        {{pan.name}}

                    </li>
                    </ul>
                </div>
                </div>
              
                <div class="row">
                   <div class="col-md-12">
                       <div class="card">
                           <div class="card-header">
                               <h4 class="card-title title text-center">Group Details</h4>
                           </div>
                           <div class="card-body">
                               <div class="row">
                                   <div class="col-md-4 text-center">
                                       <h5>Members</h5>
                                       <hr>
                                       <h6 v-for="mem in groupinfo.members" :key="mem.id">{{mem.name}}</h6>
                                   </div>
                                   <div class="col-md-4 text-center" v-if="groupinfo.adviser">
                                       <h5>Adviser</h5>
                                       <hr>
                                       <h6 v-if="groupinfo.adviser.id != 2">{{groupinfo.adviser.name}}</h6>
                                       <h6 v-if="groupinfo.adviser.id == 2">No Adviser Yet</h6>
                                   </div>
                                   <div class="col-md-4 text-center">
                                       <h5>Panels</h5>
                                       <hr>
                                       <h6 v-for="pan in groupinfo.panels" :key="pan.id">{{pan.name}}</h6>
                                   </div>
                               </div>
                               <hr>
                               <div class="row text-center" v-if="groupinfo.info">
                                   <div class="col-md-4">
                                       <h5>Code</h5>
                                       <hr>
                                       <h6>{{ groupinfo.info.grp_code }}</h6>
                                   </div>
                                   <div class="col-md-4">
                                       <h5>Defense Status</h5>
                                       <hr>
                                       <h6>{{  groupinfo.info.styp_title }}</h6>
                                   </div>
                                   <div class="col-md-4">
                                       <h5>Group Standing</h5>
                                       <hr>
                                       <h6 v-if="groupinfo.info.grp_standing == 1">Capstone 1</h6>
                                       <h6 v-if="groupinfo.info.grp_standing == 2">Capstone 2</h6>
                                       <h6 v-if="groupinfo.info.grp_standing == 3">Done</h6>
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
          <val1 :sections="sections" :grp="groupinfo.info" v-if="groupinfo.info.sec_id == null && groupinfo.info.grp_standing == 0" />
        <val2 :sections="sections" :grp="groupinfo.info" v-if="groupinfo.info.sec_id2 == null && groupinfo.info.grp_standing == 2" />
    </div>
</template>
<script>
    import ValidateSection1 from './ValidateSection1'
    import ValidateSection2 from './ValidateSection2'
    import StudentSidebar from './StudentSidebar'
    import RCProgress from '../../components/Progress/RCProgress'
    import AdviserProgress from '../../components/Progress/AdviserProgress'
    import PanelProgress from '../../components/Progress/PanelProgress'
    import {
        mapGetters,
        mapActions
    } from 'vuex'
    export default {
        props: ['user'],
        components: {
            'val1' : ValidateSection1,
            'val2' : ValidateSection2,
            'sidebar': StudentSidebar,
            'rc-progress' : RCProgress,
            'adviser-progress' : AdviserProgress,
            'panel-progress' : PanelProgress,
        },
        data() {
            return {
                GroupInfo: {},
                members: {},
                adviser: {},
                panels: {},

                isUpload: false,

                sections:{},
            }
        },
        methods: {
            CheckSection(){
                axios.get('../../api/getsectionlist/'+ this.user.grp_id).then(res => {
                    this.sections = res.data.sections
                })
            },
            GetGroupInfo() {
                axios.get('../../api/selectCap1/' + this.user.grp_id).then(res => {
                    this.GroupInfo = res.data.info[0]
                    this.members = res.data.members
                    this.adviser = res.data.adviser[0]
                    this.panels = res.data.panels
                })
            },
            SelectLogo(){
                this.isUpload = true
            },
            ...mapActions(["fetchadminDashboard","fetchDependencies","getGroupInfo"])
        },
        computed: {
            ...mapGetters(['getadminDashboard','groupinfo']),
        },
        created() {
            this.CheckSection()
            // this.fetchadminDashboard();
            // this.fetchDependencies();
            this.getGroupInfo(this.user.grp_id);
        }
    }

</script>
<style scoped>
</style>
