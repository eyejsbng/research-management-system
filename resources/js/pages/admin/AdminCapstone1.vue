<template>
    <div class="app-main">
        <sidebar :user="user"></sidebar>
        <div class="app-main__outer bg-white">
            <div class="app-main__inner" >
                <div class="app-page-title bg-primary text-light">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">


                            <div v-if="isSelect == false">Capstone 1</div>

                            <a v-else  class="navbar-brand" href="#">
                                <h5 @click="Unselect" class="text-light"><i class="fas fa-arrow-left"></i> Back</h5>
                                <div class="row mt-3" v-if="isSelect == true">
                                    <div class="nav">
                                        <a data-toggle="tab" href="#info"
                                            class="ml-1 btn-pill btn-wide btn-hover-shine btn btn-outline-light active">Information
                                        </a>
                                        <a data-toggle="tab" href="#adviser"
                                            class="ml-1 btn-pill btn-wide btn-hover-shine btn-transition btn btn-outline-light">Adviser
                                        </a>
                                        <a data-toggle="tab" href="#panel"
                                            class="ml-1 btn-pill btn-wide btn-hover-shine btn-transition btn btn-outline-light">Panel
                                        </a>
                                        <a data-toggle="tab" href="#turnitin"
                                            class="ml-1 btn-pill btn-wide btn-hover-shine btn-transition btn btn-outline-light">Turnitin
                                        </a>
                                        <a data-toggle="tab" href="#minutes"
                                            class="ml-1 btn-pill btn-wide btn-hover-shine btn-transition btn btn-outline-light">Minutes
                                        </a>
                                    </div>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>

                <div class="content col-md-12">
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
                                                <tr v-for="(cap1, index) in getadminDashboard.c1" :key="cap1.grp_id">
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
                                                        <div class="text-sm text-gray-900">{{ cap1.grp_researchtitle }}
                                                        </div>
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
                                                            class="btn btn-primary btn-sm btn-round">Manage</button>
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
                            </div>
                        </div>
                    </div>
                    <div v-if="isSelect == true" class="row">
                        <div class="col-md-12">

                            <div class="alert alert-warning text-center" v-if="capstone.grp_percent == 50">
                                <span>
                                    Waiting for your approval. <br>
                                    This Group Accomplish the Thesis/Capstone 1.<br>
                                    Check the Turnitin Categories, and Check if all panels already validate the
                                    group. <br>
                                    Click the <strong>Approve</strong> button to proceed the groups to
                                    Thesis/Capstone 2 milestone. <br>
                                    <button @click="ShowConfirmation" class="btn btn-info btn-round">Approve</button>
                                </span>
                            </div>


                            <div class="tab-content tab-space tab-subcategories">

                                <div class="tab-pane active" id="info">

                                    <form-wizard
                                        v-if="groupinfo.info && (groupinfo.info.grp_standing == 1 || groupinfo.info.grp_standing == 0)"
                                        color="#1e9df7" :start-index="groupinfo.info.caps1" ref="wizzard">
                                        <h4 slot="title" class="title">Group Milestone</h4>
                                        <tab-content title="Chapter 1 to 3" icon="fas fa-file"></tab-content>
                                        <tab-content title="Capstone 1 System" icon="fas fa-cogs"></tab-content>
                                        <tab-content title="Evaluation" icon="fas fa-file"></tab-content>
                                        <tab-content title="Grammarly and Plagiarism" icon="fas fa-file">
                                        </tab-content>
                                        <tab-content title="Validator" icon="fas fa-file"></tab-content>
                                        <template slot="footer">
                                            <div class="wizard-footer-right">

                                            </div>
                                        </template>
                                    </form-wizard>

                                    <div v-if="isAssignAdviser == false && isAssignPanel == false" class="row">
                                        <div class="card col-md-7 ml-3 mb-2">
                                            <div class="card-header mb-2">
                                                <div
                                                    class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                                    Group Information
                                                </div>
                                            </div>
                                            <table>
                                                <th>Members</th>
                                                <th>Course</th>
                                                <th>Adviser <button data-toggle="tooltip" title="Assign Adviser" 
                                                @click="AssignAdviser" class="btn-icon btn-icon-only btn-pill btn btn-link">
                                                <i class="fas fa-cogs"> </i></button></th>
                                                <th>Code</th>
                                                <th>Status</th>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <p v-for="mem in groupinfo.members" :key="mem.id">
                                                                {{ mem.name }}</p>
                                                        </td>
                                                        <td>
                                                            {{ capstone.crs_title }}

                                                        </td>
                                                        <td>
                                                            <h6 v-if="groupinfo.adviser">
                                                                <p v-if="groupinfo.adviser.id != 2">
                                                                    {{ groupinfo.adviser.name }}
                                                                </p>
                                                                <p
                                                                    v-if="groupinfo.adviser.id == 2 && groupinfo.adviser.us_id != 1">
                                                                    No Adviser Yet</p>
                                                                <p style="font-size:10px;"
                                                                    v-if="groupinfo.adviser.id != 2 && groupinfo.adviser.us_id != 1">
                                                                    {{ groupinfo.adviser.us_title }}</p>
                                                                <p style="color:red;">{{ groupinfo.adviser.adv_reason }}
                                                                </p>
                                                                <!-- <button @click="AssignAdviser"
                                                                    class="mt-3 btn btn-success btn-round">Assign</button> -->
                                                                    
                                                            </h6>

                                                        </td>
                                                        <td>
                                                            <strong>{{ capstone.grp_code }}</strong>
                                                        </td>
                                                        <td>
                                                            {{ capstone.styp_title }}
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>


                                        </div>
                                        <!-- <div class="card col-md-3 ml-3 mb-2">

                                            <div class="card-header mb-2">
                                                 <div
                                                    class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                                    Advisers
                                                </div>
                                            </div>
                                            <h6 class="text-gray-700 text-md font-bold mb-2" v-if="groupinfo.adviser">
                                                <p v-if="groupinfo.adviser.id != 2">{{ groupinfo.adviser.name }}
                                                </p>
                                                <p v-if="groupinfo.adviser.id == 2 && groupinfo.adviser.us_id != 1">
                                                    No Adviser Yet</p>
                                                <p style="font-size:10px;"
                                                    v-if="groupinfo.adviser.id != 2 && groupinfo.adviser.us_id != 1">
                                                    {{ groupinfo.adviser.us_title }}</p>
                                                <p style="color:red;">{{ groupinfo.adviser.adv_reason }}</p>
                                               
                                                    <button @click="AssignAdviser"
                                                        class="mt-3 btn btn-success btn-round btn-block">Assign</button>
                                            

                                            </h6>

                                        </div> -->

                                        <div class=" card col-md-3 ml-3 mb-2">
                                            <div class="card-header mb-2">
                                                <div
                                                    class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                                    Panels
                                                </div>
                                            </div>

                                            <table>
                                                <th>Name</th>
                                                <th>Status</th>
                                                <tbody>
                                                    <tr v-for="pans in groupinfo.panels" :key="pans.id">
                                                        <td>
                                                            <p>{{ pans.name }}</p>
                                                        </td>
                                                        <td>
                                                            <div class="badge badge-pill "
                                                                :class="pans.us_title == 'Approved' ? 'badge-success' : 'badge-info'">
                                                                {{ pans.us_title }}</div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <button @click="AssignPanels"
                                                class="mb-2 mr-2 btn-pill btn-hover-shine btn btn-primary btn-lg">Choose</button>

                                        </div>

                                    </div>

                                    <div v-if="isAssignAdviser == true" class="row">
                                        <div class="col-md-8 mr-auto ml-auto">
                                            <h6 class="text-center">Assign Adviser</h6>
                                            <div class="table-responsive">
                                                <table class="mb-0 table table-hover">
                                                    <thead>
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
                                        <div class="col-md-4 mr-auto ml-auto" v-for="(panel,index) in groupinfo.panels"
                                            :key="panel.id">
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
                                                        <table class="mb-0 table table-hover">
                                                            <thead>
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

                                    <div class="row mt-5">
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
                                <div class="tab-pane" id="adviser">
                                    <AdviserSubmission :user="user" />
                                </div>
                                <div class="tab-pane" id="panel">
                                    <Evaluation :getcaps1evalution="getcaps1evalution" />
                                    <Validation :getcaps1validation="getcaps1validation" />
                                </div>
                                <div class="tab-pane" id="minutes">
                                    <Minutes :capstone="capstone" />
                                </div>
                                <!-- <div class="tab-pane" id="message">
                                        <h4 class="title text-center">Group Schedule</h4>
                                    </div> -->
                                <div class="tab-pane" id="submission">
                                    <Turnitin :getcaps1evalution="getcaps1evalution"
                                        :getcaps1validation="getcaps1validation" :grp="capstone" :user="user" />
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
    import AdviserSubmission from './Capstone1/AdviserSubmission'
    import Turnitin from './Capstone1/Turnitin'
    import Evaluation from './Capstone1/Evaluation'
    import Validation from './Capstone1/Validator'
    import Minutes from './Capstone1/Minutes'
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
            datetime,
            'AdviserSubmission': AdviserSubmission,
            'Turnitin': Turnitin,
            'Evaluation': Evaluation,
            'Validation': Validation,
            'Minutes': Minutes,

            'rc-progress': RCProgress,
            'adviser-progress': AdviserProgress,
            'panel-progress': PanelProgress,
        },
        data() {
            return {
                loading: true,
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
                date: moment(Date.now()).format('MM/DD/YYYY')
            }
        },
        methods: {
            Select(index) {
                this.isAssignAdviser = false
                this.isAssignPanel = false
                this.isSelect = true
                this.capstone = this.getadminDashboard.c1[index]
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
                        this.capstone.grp_standing = 2
                        this.Unselect()
                        this.fetchadminDashboard();

                    } else {
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
            ...mapActions(["fetchadminDashboard", "fetchallAdviserlist", "fetchallPanellist", "getGroupInfo",
                "getCapstone1checkDocs", "getCapstone1checkSys", "getCapstone1Evaluation", "getCapston1Grammarly",
                "getCapstone1Validation",
            ])
        },
        computed: mapGetters(['getadminDashboard', 'getadviserList', 'getpanelList', 'groupinfo', 'getcaps1checkdocs',
            'getcaps1evalution', 'getcaps1validation'
        ]),
        watch: {
            getadminDashboard() {
                if (this.getadminDashboard.c1 != '') {
                    this.loading = false
                }
            }
        },
        created() {
            $('[data-toggle="tooltip"]').tooltip()
            this.fetchadminDashboard();
            this.fetchallAdviserlist();
            this.fetchallPanellist();
        }
    }

</script>
