<template>
    <div class="app-main"> 
        <sidebar :user="user"></sidebar>
        <div class="app-main__outer bg-white">
            <div class="app-main__inner">
                <div class="app-page-title bg-primary text-light">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            
                              
                            <div v-if="isSelect == false">Capstone 2</div>
                    
                        <a v-else @click="Unselect" class="navbar-brand" href="#">
                            <h5><i class="fas fa-arrow-left"></i> Back</h5>
                        </a>   
                        </div>

                    </div>
                </div>
                  <div class="content">
                <div v-if="isSelect == false">
                   
                     <div class="flex flex-col">
                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                        <table class="min-w-full divide-y divide-gray-150">
                                            <thead class="bg-gray-50">

                                                <tr>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">

                                                        Group
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Title
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Course
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Code
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Defense Standing
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Progress
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Action
                                                    </th>

                                                </tr>
                                            </thead>



                                            <tbody class="bg-white divide-y divide-gray-200">
                                                <tr v-for="(cap1, index) in getadminDashboard.c2" :key="cap1.grp_id">
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    {{ cap1.grp_title }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                     
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900">{{ cap1.grp_researchtitle }}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        {{ cap1.crs_title }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ cap1.grp_code }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ cap1.styp_title }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ cap1.grp_percent }} <strong>%</strong>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <button @click="Select(index)"
                                                            class="btn btn-info btn-sm btn-round">Manage</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- This example requires Tailwind CSS v2.0+ -->
                                    <!-- <div
                                        class="px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                                        <ul class="pagination">
                                            <pagination :data="getstudentdata" @pagination-change-page="Paginate"
                                                :limit=5>
                                            </pagination>
                                        </ul>
                                    </div> -->

                                </div>
                            </div>
                            <div class="mt-3" align="center">
                                <moon-loader :loading="loading" color="#1256b5" size="70px">
                                </moon-loader>
                                <p> {{ message }}</p>
                            </div>
                        </div>
                </div>
                <div v-if="isSelect == true" class="row">
                    <div class="col-md-12">
                        <div class="card card-subcategories">
                            <div class="card-body">
                                <div class="alert alert-warning text-center" v-if="capstone.caps2 == 4">
                                    <span>
                                        Waiting for your approval. <br>
                                        This Group Accomplish the Thesis/Capstone 2.<br>
                                        Check the Turnitin Categories, and Check if all panels already validate the
                                        group. <br>
                                        Click the <strong>Approve</strong> button to proceed the groups to Sending all
                                        the Resources. <br>
                                        <button @click="ShowConfirmation"
                                            class="btn btn-info btn-round">Approve</button>
                                    </span>
                                </div>
                                <div class="card-header">
                                    <ul class="nav nav-pills nav-pills-info nav-pills-icons justify-content-center"
                                        role="tablist">
                                        <li class="nav-item">
                                            <a href="#info" data-toggle="tab" role="tablist" class="nav-link active">
                                                <i class="fas fa-info"></i>
                                                Information
                                            </a>
                                        </li>
                                        <!-- <li class="nav-item">
                                            <a href="#caps1" data-toggle="tab" role="tablist" class="nav-link">
                                                <i class="fas fa-file"></i>
                                                Resources
                                            </a>
                                        </li> -->
                                        <li class="nav-item">
                                            <a href="#system" data-toggle="tab" role="tablist" class="nav-link">
                                                <i class="fas fa-cog"></i>
                                                System
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#adviser" data-toggle="tab" role="tablist" class="nav-link">
                                                <i class="fas fa-user"></i>
                                                Adviser
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#panel" data-toggle="tab" role="tablist" class="nav-link">
                                                <i class="fas fa-user"></i>
                                                Panel
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#turnitin" data-toggle="tab" role="tablist" class="nav-link">
                                                <i class="fas fa-file"></i>
                                                Turnitin
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#resources" data-toggle="tab" role="tablist" class="nav-link">
                                                <i class="fas fa-file"></i>
                                                Resources
                                            </a>
                                        </li>
                                        <!-- <li class="nav-item">
                                            <a href="#message" data-toggle="tab" role="tablist" class="nav-link">
                                                <i class="fas fa-comment-dots"></i>
                                                Message
                                            </a>
                                        </li> -->
                                    </ul>
                                </div>
                                <div class="tab-content tab-space tab-subcategories">
                                    <div class="tab-pane active" id="info">
                                        <form-wizard v-if="groupinfo.info && groupinfo.grp_standing == 2" color="#f44336" :start-index="groupinfo.caps2" ref="wizzard">
                                            <h2 slot="title">Group Milestone</h2>
                                            <tab-content title="Certificates" icon="fas fa-file"></tab-content>
                                            <tab-content title="Chapter 1 to 6" icon="fas fa-file"></tab-content>
                                            <tab-content title="Evaluation" icon="fas fa-file"></tab-content>
                                            <tab-content title="Grammarly and Plagiarism" icon="fas fa-file"></tab-content>
                                            <tab-content title="Validation" icon="fas fa-file"></tab-content>
                                            <template slot="footer">
                                                <div class="wizard-footer-right">

                                                </div>
                                            </template>
                                        </form-wizard>
                                        <h4 class="title text-center">Group Information</h4>
                                        <hr>
                                        <div v-if="isAssignAdviser == false && isAssignPanel == false" class="row">
                                            <div class="col-md-4">
                                                <p style="font-size:15px;" class="category text-center">Group Members:
                                                </p>
                                                <h6 class="text-center" v-for="mem in groupinfo.members" :key="mem.id">
                                                    {{ mem.name }}</h6>
                                            </div>
                                            <div class="col-md-4">
                                                <p style="font-size:15px;" class="category text-center">Group Adviser:
                                                </p>
                                                <h6 class="text-center" v-if="groupinfo.adviser">
                                                    <p v-if="groupinfo.adviser.id != 2">{{ groupinfo.adviser.name }}</p>
                                                    <p v-if="groupinfo.adviser.id == 2 && groupinfo.adviser.us_id != 1">
                                                        No Adviser Yet</p>
                                                    <p style="font-size:10px;"
                                                        v-if="groupinfo.adviser.id != 2 && groupinfo.adviser.us_id != 1">
                                                        {{ groupinfo.adviser.us_title }}</p>
                                                    <p style="color:red;">{{ groupinfo.adviser.adv_reason }}</p>
                                                    <button @click="AssignAdviser"
                                                        class="btn btn-info btn-round btn-block">Assign</button>
                                                </h6>
                                            </div>
                                            <div class="col-md-4">
                                                <p style="font-size:15px;" class="category text-center">Group Panels:
                                                </p>
                                                <h6 class="text-center" v-for="pans in groupinfo.panels" :key="pans.id">
                                                    <p>{{ pans.name }} -- {{ pans.us_title }}</p>
                                                </h6>
                                                <button @click="AssignPanels"
                                                    class="btn btn-info btn-round btn-block">Assign</button>
                                            </div>
                                            <div class="col-md-4">
                                                <p style="font-size:15px;" class="category text-center">Group Status:
                                                </p>
                                                <h6 class="text-center">{{ capstone.styp_title }}</h6>
                                            </div>
                                            <div class="col-md-4">
                                                <p style="font-size:15px;" class="category text-center">Group Code:</p>
                                                <h6 class="text-center">{{ capstone.grp_code }}</h6>
                                            </div>
                                            <div class="col-md-4">
                                                <p style="font-size:15px;" class="category text-center">Group Course:
                                                </p>
                                                <h6 class="text-center">{{ capstone.crs_title }}</h6>
                                            </div>
                                        </div>
                                        <div v-if="isAssignAdviser == true" class="row">
                                            <div class="col-md-8 mr-auto ml-auto">
                                                <h6 class="text-center">Assign Adviser</h6>
                                                <div class="table-responsive">
                                                    <table class="table table-hovered">
                                                        <thead class="text-info">
                                                            <tr>
                                                                <td><strong>Name</strong></td>
                                                                <td><strong>Specialty</strong></td>
                                                                <td><strong>User Type</strong></td>
                                                                <td><strong>Action</strong></td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="list in getadviserList" :key="list.id">
                                                                <td>{{ list.name }}</td>
                                                                <td>{{ list.specialty }}</td>
                                                                <td>{{ list.typ_title }}</td>
                                                                <td>
                                                                    <button @click="SelectAdviser(list.id)"
                                                                        class="btn btn-sm btn-round btn-info">Assign</button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <button @click="CancelAssignAdviser"
                                                    class="btn btn-round btn-info btn-block">Cancel</button>
                                            </div>
                                        </div>
                                        <div v-if="isAssignPanel == true" class="row text-center">
                                            <h6 class="col-md-12 text-center">Assign Panel</h6>
                                            <div class="col-md-4 mr-auto ml-auto"
                                                v-for="(panel,index) in groupinfo.panels" :key="panel.id">
                                                <label>Panel {{index+1}}</label>
                                                <div class="alert alert-info">
                                                    <button aria-hidden="true" class="close">
                                                        <i @click="SelectUpdatePanel(panel.id, panel.name)"
                                                            class="fas fa-user-edit"></i>
                                                    </button>
                                                    <span>{{ panel.name }} -- {{ panel.us_title }}</span>
                                                    <span>{{ panel.pan_reason }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-8 mr-auto ml-auto mt-2">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h6 class="card-title text-center">Panel List</h6>
                                                    </div>
                                                    <div class="card-body">
                                                        <h6 v-if="isUpdatePanel == true" class="text-center">Update
                                                            Panel {{ PanelNametoUpdate }}</h6>
                                                        <div class="table-responsive">
                                                            <table class="table table-hovered">
                                                                <thead class="text-info">
                                                                    <tr>
                                                                        <td><strong>Name</strong></td>
                                                                        <td><strong>Specialty</strong></td>
                                                                        <td><strong>User Type</strong></td>
                                                                        <td><strong>Action</strong></td>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr v-for="panel in getpanelList" :key="panel.id">
                                                                        <td>{{ panel.name }}</td>
                                                                        <td>{{ panel.specialty }}</td>
                                                                        <td>{{ panel.typ_title }}</td>
                                                                        <td>
                                                                            <button v-if="isUpdatePanel == false"
                                                                                @click="SelectPanel(panel.id)"
                                                                                class="btn btn-info btn-sm btn-round">Select</button>
                                                                            <button v-if="isUpdatePanel == true"
                                                                                @click="UpdatePanel(panel.id)"
                                                                                class="btn btn-info btn-sm btn-round">Update</button>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mr-auto ml-auto">
                                                <button @click="CancelAssignAdviser"
                                                    class="btn btn-round btn-info btn-block">Cancel</button>
                                            </div>
                                        </div>
                                        <hr>
                                        <h4 class="title text-center">Group Progress</h4>
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
                                    <!-- <div class="tab-pane" id="caps1">
                                        <Capstone1History :getcaps1evalution="getcaps1evalution" :getcaps1validation="getcaps1validation"/>
                                    </div> -->
                                    <div class="tab-pane" id="system">
                                        <Systemchecking :grp="capstone" :path="path" :system="systemchecking" />
                                    </div>
                                    <div class="tab-pane" id="adviser">
                                        <Adviser :user="user" />
                                    </div>
                                    <div class="tab-pane" id="panel">
                                        <Evaluation :getcaps1evalution="getcaps1evalution" />
                                        <Validation :getcaps1validation="getcaps1validation" />
                                    </div>
                                    <div class="tab-pane" id="turnitin">
                                        <Turnitin :getcaps1evalution="getcaps1evalution"
                                            :getcaps1validation="getcaps1validation" :grp="capstone" :user="user" />
                                    </div>
                                    <div class="tab-pane" id="resources">
                                        <Resources :capstone="capstone" :getcaps1evalution="getcaps1evalution" :getcaps1validation="getcaps1validation" />
                                    </div>
                                    <div class="tab-pane" id="message">

                                    </div>
                                    <div class="tab-pane" id="submission">

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
    import Capstone1History from './Capstone2/Capstone1History'
    import Systemchecking from './Capstone2/Sytemchecking'
    import Adviser from './Capstone2/Adviser'
    import Evaluation from './Capstone2/Evaluation'
    import Turnitin from './Capstone2/Turnitin'
    import Validation from './Capstone2/Validator'
    import Resources from './Capstone2/Resources'
    import datetime from 'vuejs-datetimepicker'

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
            'sidebar': AdminSidebar,
            'Capstone1History': Capstone1History,
            'Systemchecking': Systemchecking,
            'Adviser': Adviser,
            'Evaluation': Evaluation,
            'Turnitin': Turnitin,
            'Validation': Validation,
            'Resources': Resources,
            datetime,

            'rc-progress': RCProgress,
            'adviser-progress': AdviserProgress,
            'panel-progress': PanelProgress,
        },
        data() {
            return {
                message: '',
                loading : true,
                isSelect: false,
                isAssignAdviser: false,
                isAssignPanel: false,
                isUpdatePanel: false,

                PanelIDtoUpdate: '',
                PanelNametoUpdate: '',

                capstone: {},
                members: {},
                adviser: {},
                panels: {},
                date: moment(Date.now()).format('MM/DD/YYYY'),

                path: {
                    acceptpath: '',
                    deploypath: '',
                },
                systemchecking: {},
            }
        },
        methods: {
            Select(index) {
                this.isAssignAdviser = false
                this.isAssignPanel = false
                this.isSelect = true
                this.capstone = this.getadminDashboard.c2[index]
                this.getGroupInfo(this.capstone.grp_id)

                let req = {
                    grp_id: this.capstone.grp_id,
                    id: ''
                }
                let req1 = {
                    grp: this.capstone.grp_id,
                    id: ''
                }
                this.getCapstone1checkDocs(req)
                this.getCapstone1checkSys(this.capstone.grp_id)
                this.getCapstone1Evaluation(req1)
                this.getCapstone1Validation(req1)
                this.getCapston1Grammarly(this.capstone.grp_id)
                this.GetCertificate();
            },
            GetCapstoneDetails() {
                axios.get('../api/selectCap1/' + this.capstone.grp_id).then(res => {
                    this.members = res.data.members
                    this.adviser = res.data.adviser
                    this.panels = res.data.panels
                })
            },
            Unselect() {
                this.isSelect = false
                this.capstone = {}
            },
            AssignAdviser() {
                this.isAssignAdviser = true
            },
            AssignPanels() {
                this.isAssignPanel = true
            },
            SelectAdviser(id) {
                axios.post('../api/selectadviser', {
                    'id': id,
                    'grp_id': this.capstone.grp_id
                }).then(res => {
                    if (res.data.message == 'success') {
                        this.Alert('success', 'Successfully Assign')
                        this.getGroupInfo(this.capstone.grp_id)
                        this.isAssignAdviser = false
                    } else {
                        this.Alert('info', res.data.message)
                    }
                })
            },
            SelectPanel(id) {
                axios.post('../api/selectpanel', {
                    'id': id,
                    'grp_id': this.capstone.grp_id,
                }).then(res => {
                    if (res.data.message == 'success') {
                        this.Alert('success', 'Successfully Assign')
                        this.getGroupInfo(this.capstone.grp_id)
                    } else {
                        this.Alert('warning', res.data.message)
                    }
                })
            },
            SelectUpdatePanel(id, name) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to change the Panel!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Update'
                }).then((result) => {
                    if (result.value) {
                        this.PanelIDtoUpdate = id
                        this.PanelNametoUpdate = name
                        this.isUpdatePanel = true
                    }
                })
            },
            UpdatePanel(id) {
                // alert('to replace'+this.PanelIDtoUpdate+' replace with' + id)
                axios.post('../api/changegrouppanel', {
                    old_id: this.PanelIDtoUpdate,
                    new_id: id,
                    grp_id: this.capstone.grp_id
                }).then(res => {
                    if (res.data.message == 'success') {
                        this.Alert('success', 'Successfully Update')
                        this.getGroupInfo(this.capstone.grp_id)
                        this.CancelAssignAdviser()
                    } else {
                        this.Alert('warning', res.data.message)
                    }
                })
            },
            CancelAssignAdviser() {
                this.isAssignAdviser = false
                this.isAssignPanel = false
                this.PanelIDtoUpdate = ''
                this.PanelNametoUpdate = ''
                this.isUpdatePanel = false
            },
            ShowConfirmation() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to Approve!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Approve'
                }).then((result) => {
                    if (result.value) {
                        this.Capstone2Approval()
                    }
                })
            },
            Capstone2Approval() {
                axios.post('../api/capstoneapproval', this.capstone).then(res => {
                    if (res.data.message == 'success') {
                        this.Alert('success', 'Group Standing Updated')
                        this.capstone.grp_standing = 3
                        this.Unselect()
                        this.fetchadminDashboard()
                    } else {
                        this.Alert('info', res.data.message)
                    }
                })
            },
            GetCertificate() {
                axios.get('../api/getsystemcertificate/' + this.capstone.grp_id).then(res => {
                    if (res.data.length > 0) {
                        this.systemchecking = res.data[0]
                        this.path.acceptpath = '../app/myfiles/Submittedfiles/Capstone2/' + res.data[0]
                            .sys_acceptfile
                        this.path.deploypath = '../app/myfiles/Submittedfiles/Capstone2/' + res.data[0]
                            .sys_deployfile
                    }
                })
            },
            Alert(icon, title) {
                toast.fire({
                    icon: icon,
                    title: title,
                })
            },
            ...mapActions(["fetchadminDashboard", "fetchallAdviserlist", "fetchallPanellist", "getGroupInfo",
                "getCapstone1checkDocs", "getCapstone1checkSys", "getCapstone1Evaluation", "getCapston1Grammarly",
                "getCapstone1Validation"
            ])
        },
        computed: mapGetters(['getadminDashboard', 'getadviserList', 'getpanelList', 'groupinfo', 'getcaps1checkdocs',
            'getcaps1evalution', 'getcaps1validation'
        ]),
        watch: {
            getadminDashboard() {
               
                if(this.getadminDashboard.c2 != ''){
                    this.loading = false
                } else {
                     setTimeout(() => {
                    this.loading = false
                    this.message = 'No data found.'
                },2000)
                }
            }
        },
        created() {
            this.fetchadminDashboard();
            this.fetchallAdviserlist();
            this.fetchallPanellist();
        }
    }

</script>
