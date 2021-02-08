<template>
    <div class="app-main">

        <sidebar :user="user" />
        <div class="app-main__outer bg-white">
            <div class="app-main__inner">
                <div class="app-page-title bg-primary text-light">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <div v-if="create == false">Manage Research Personnel</div>
                            <div v-if="create == true">Manage Research Personnel</div>
                        </div>

                    </div>
                </div>
                <button v-if="create == false" class="btn btn-primary btn-lg mb-2"
                    @click="create = true"><i class="fas fa-plus"></i>
                    Create New</button>
                <button v-if="create == true" class="float right btn btn-gradient-success mb-2"
                    @click="create = false"><i class="fas fa-chevron-left"></i>
                    Back</button>
                <div class="row">
                    <div v-if="create == true" class="col-md-6">
                        <div class="card">
                            <div class="card-header" id="update">
                                <h4 v-if="isUpdate == false" class="card-title">Create New Research Personnel</h4>
                                <h4 v-if="isUpdate == true" class="card-title">Update Research Personnel</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Full Name</label>
                                        <div class="form-group">
                                            <input type="text" v-model="rp.name" class="form-control"
                                                placeholder="Input Research Personnel Fullname">
                                        </div>
                                        <p style="font-size:12px;color:red;">{{ errors.name }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Email</label>
                                        <div class="form-group">
                                            <input type="email" v-model="rp.email" class="form-control"
                                                placeholder="Input Research Personnel Email">
                                        </div>
                                        <p style="font-size:12px;color:red;">{{ errors.email }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Password</label>
                                        <div class="form-group">
                                            <input type="password" v-model="rp.password" class="form-control"
                                                placeholder="Input Research Personnel Password">
                                        </div>
                                        <p style="font-size:12px;color:red;">{{ errors.password }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Specialization</label>
                                        <div class="form-group">
                                            <input type="text" v-model="rp.specialty" class="form-control"
                                                placeholder="Input Research Personnel Specialty">
                                        </div>
                                        <p style="font-size:12px;color:red;">{{ errors.specialty }}</p>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Type</label>
                                        <div class="form-group">
                                            <select class="form-control" v-model="rp.typ_id">
                                                <option v-for="type in getdependencies.userTypes" :key="type.typ_id"
                                                    :value="type.typ_id">{{ type.typ_title }}</option>
                                            </select>
                                        </div>
                                        <p style="font-size:12px;color:red;">{{ errors.typ_id }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button v-if="isUpdate == false" @click="CreateRP" :disabled="isloading == true"
                                            class="btn btn-primary">
                                            <i v-if="isloading == false" class="fas fa-users-cog"></i>
                                            <span v-if="isloading == true" class="spinner-grow spinner-grow-sm"
                                                role="status" aria-hidden="true"></span>
                                            Create Research Personnel
                                        </button>
                                        <button v-if="isUpdate == true" @click="UpdateRP" :disabled="isloading == true"
                                            class="btn btn-primary">
                                            <i v-if="isloading == false" class="fas fa-users-cog"></i>
                                            <span v-if="isloading == true" class="spinner-grow spinner-grow-sm"
                                                role="status" aria-hidden="true"></span>
                                            Update Research Personnel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="create == false" class="col-md-12">




                        <div class="modal fade" id="mdlAcceptRP">


                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="country" class="block text-sm font-medium text-gray-700">Sort by
                                        Status</label>
                                    <select id="country" v-model="searching.status"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        <option v-for="status in getdependencies.userStatus" :key="status.us_id"
                                            :value="status.us_id">{{ status.us_title }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="country" class="block text-sm font-medium text-gray-700">Search</label>
                                    <input type="text" class="form-control form-control" @keyup="Search"
                                        v-model="searching.search" placeholder="Enter Research Personnel...">
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                        <table class="min-w-full divide-y divide-gray-150">
                                            <thead class="bg-gray-50">

                                                <tr>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">

                                                        Name
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Email
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Specialization
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Type
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Status
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Action
                                                    </th>

                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                <tr v-for="(rp, index) in getrpdata.data" :key="rp.id">
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    {{ rp.name }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900">{{ rp.email }}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        {{ rp.specialty }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ rp.typ_title }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ rp.us_title  }}
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <button @click="Decission(index, 1)"
                                                            v-if="rp.us_id == 3 || rp.us_id == 2"
                                                            class="btn btn-outline-success btn-sm">
                                                            <i class="fas fa-plus-circle"></i>
                                                            Approve
                                                        </button>
                                                        <button @click="Decission(index, 2)"
                                                            v-if="rp.us_id == 1 || rp.us_id == 3"
                                                            class="btn btn-secondary btn-sm  mt-1">
                                                            <i v-if="isloading == false"
                                                                class="fas fa-minus-circle"></i>
                                                            <span v-if="isloading == true"
                                                                class="spinner-grow spinner-grow-sm" role="status"
                                                                aria-hidden="true"></span>
                                                            Disapprove
                                                        </button>
                                                        <a href="#update" v-if="rp.us_id == 1"
                                                            @click="showUpdate(index)"
                                                            class="btn btn-outline-alternate btn-sm mt-1"><i
                                                                class="fas fa-user-edit"></i>
                                                            Edit
                                                        </a>

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- This example requires Tailwind CSS v2.0+ -->
                                    <div
                                        class="px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                                        <ul class="pagination">
                                            <pagination :data="getrpdata" @pagination-change-page="Paginate" :limit=5>
                                            </pagination>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <div class="mt-3" align="center">
                                <moon-loader :loading="loading" color="#1256b5" size="70px">
                                </moon-loader>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <modal name="approverp" :adaptive="true" height="auto">
            <div class="card-header">Personnel Type</div>
            <div class="card-body">
                 <div class="row">
                <div class="col-md-10 mr-auto ml-auto">
                    <div class="form-group">
                        <label>Personnel Type</label>
                        <select class="form-control" v-model="rp.typ_id">
                            <option v-for="type in getdependencies.userTypes" :key="type.typ_id" :value="type.typ_id">
                                {{ type.typ_title }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-8 mr-auto ml-auto">
                    <button @click="AcceptRP" class="btn btn-info btn-round btn-block"
                        :disabled="isloading == true"><span v-if="isloading == true"
                            class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>Accept</button>
                </div>
            </div>
            </div>  
        </modal>
        <modal name="updaterp" :adaptive="true" height="auto">
            <div class="card-header">Edit Information</div>
            <div class="card-body">
                 <div class="row">
                <div class="col-md-6">
                    <label>Full Name</label>
                    <div class="form-group">
                        <input type="text" v-model="rp.name" class="form-control"
                            placeholder="Input Research Personnel Fullname">
                    </div>
                    <p style="font-size:12px;color:red;">{{ errors.name }}</p>
                </div>
                <div class="col-md-6">
                    <label>Email</label>
                    <div class="form-group">
                        <input type="email" v-model="rp.email" class="form-control"
                            placeholder="Input Research Personnel Email">
                    </div>
                    <p style="font-size:12px;color:red;">{{ errors.email }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label>Password</label>
                    <div class="form-group">
                        <input type="password" v-model="rp.password" class="form-control"
                            placeholder="Input Research Personnel Password">
                    </div>
                    <p style="font-size:12px;color:red;">{{ errors.password }}</p>
                </div>
                <div class="col-md-6">
                    <label>Specialization</label>
                    <div class="form-group">
                        <input type="text" v-model="rp.specialty" class="form-control"
                            placeholder="Input Research Personnel Specialty">
                    </div>
                    <p style="font-size:12px;color:red;">{{ errors.specialty }}</p>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <label>Type</label>
                    <div class="form-group">
                        <select class="form-control" v-model="rp.typ_id">
                            <option v-for="type in getdependencies.userTypes" :key="type.typ_id" :value="type.typ_id">
                                {{ type.typ_title }}</option>
                        </select>
                    </div>
                    <p style="font-size:12px;color:red;">{{ errors.typ_id }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <button v-if="isUpdate == true" @click="UpdateRP" :disabled="isloading == true"
                        class="btn btn-primary">
                        <i v-if="isloading == false" class="fas fa-users-cog"></i>
                        <span v-if="isloading == true" class="spinner-grow spinner-grow-sm" role="status"
                            aria-hidden="true"></span>
                        Update Research Personnel
                    </button>
                </div>
            </div>
            </div>
           
        </modal>
    </div>
</template>
<script>
    import AdminSidebar from './AdminSidebar'
    import TextHighlight from 'vue-text-highlight';
    import {
        mapGetters,
        mapActions
    } from 'vuex'
    export default {
        props: ['user'],
        components: {
            'sidebar': AdminSidebar,
            'text-highlight': TextHighlight
        },
        data() {
            return {
                loading: true,
                create: false,
                rp: {
                    id: '',
                    name: '',
                    email: '',
                    password: '',
                    specialty: '',
                    typ_id: 2,
                    us_id: '',
                    type: '',
                },

                searching: {
                    search: '',
                    status: 1
                },

                errors: {},
                isloading: false,
                isUpdate: false,

                personnel: {},
            }
        },
        methods: {
            SendEmail(to, subject, message) {
                Email.send({
                    SecureToken: "21691b39-e134-40cd-86dd-da6081f54e65",
                    To: to,
                    From: "umccerms@gmail.com",
                    Subject: subject,
                    Body: message
                }).then()
            },
            Search: _.debounce(function () {
                if (this.searching.search == '') {
                    this.fetchrpdata()
                } else {
                    this.searchRP(this.searching);
                }
            }, 3000),
            Paginate(page = 1) {
                this.paginaterp(page)
            },
            CreateRP() {
                const subject = "Account Created"
                const body =
                    "Your Email is created by the RC. Login in wwww.ccerms.online and use this Credentials: <br>" +
                    "Email: " + this.rp.email + " <br> Password: " + this.rp.password
                this.isloading = true
                axios.post('../api/createRP', this.rp).then(res => {
                    if (res.data.message == 'success') {
                        this.isloading = false
                        this.SendEmail(this.rp.email, subject, body)
                        this.Clear()
                        this.Alert('success', 'Successfully Created')
                    } else {
                        this.isloading = false
                        this.Alert('info', res.data.message)
                    }
                }).catch(err => {
                    this.isloading = false
                    if (err.response.status == 422) {
                        this.errors = err.response.data.errors
                    }
                })
            },
            Decission(index, us_id) {
                const subject = "Account Status"
                const body = "Your account is Disapproved by the RC. Contact the RC for more information."
                this.personnel = this.getrpdata.data[index];
                this.rp = {
                    id: this.personnel.id,
                    name: this.personnel.name,
                    email: this.personnel.email,
                    typ_id: this.personnel.typ_id,
                    type: 'approval',
                    us_id: us_id
                }
                if (us_id == 1) {

                    this.$modal.show('approverp')
                } else {
                    this.isloading = true
                    axios.post('../api/updateRP', this.rp).then(res => {
                        if (res.data.message == 'success') {
                            this.isloading = false
                            this.Alert('success', 'Successfully Disapproved')
                            this.SendEmail(this.rp.email, subject, body)
                            this.Clear()
                        } else {
                            this.isloading = true
                            this.Alert('info', res.data.message)
                        }
                    })
                }
            },
            AcceptRP() {
                this.isloading = true
                const subject = "Account Status"
                const body = "Your account is Approved by the RC. Contact the RC for more information."
                axios.post('../api/updateRP', this.rp).then(res => {
                    if (res.data.message == 'success') {
                        $('#mdlAcceptRP').modal('hide')
                        this.isloading = false
                        this.Alert('success', 'Successfully Approved')
                        this.SendEmail(this.rp.email, subject, body)
                        this.Clear()
                    } else {
                        this.isloading = true
                        this.Alert('info', res.data.message)
                    }
                })
            },
            showUpdate(index) {
                this.isUpdate = true
                this.$modal.show('updaterp')
                this.errors.password = 'Leave Blank if you will not change the password'
                this.personnel = this.getrpdata.data[index];
                this.rp = {
                    id: this.personnel.id,
                    name: this.personnel.name,
                    email: this.personnel.email,
                    specialty: this.personnel.specialty,
                    typ_id: this.personnel.typ_id,
                    type: 'update'
                }
            },
            UpdateRP() {
                const subject = "Account Updated"
                const body = "Your account is updated by the RC. Contact the RC for more information."
                this.isloading = true
                axios.post('../api/updateRP', this.rp).then(res => {
                    if (res.data.message == 'success') {
                        this.isloading = false
                        this.isUpdate = false
                        this.$modal.hide('updaterp')
                        this.SendEmail(this.rp.email, subject, body)
                        this.Clear()
                        this.Alert('success', 'Successfully Created')
                        this.fetchrpdata()
                        this.errors = {}
                    } else {
                        this.Alert('info', res.data.message)
                        this.isloading = false
                    }
                }).catch(err => {
                    this.isloading = false
                    if (err.response.status == 422) {
                        this.errors = err.response.data.errors
                        this.errors.password = 'Leave Blank if you will not change the password'
                    }
                })
            },
            Clear() {
                this.personnel = {}
                this.rp = {
                    id: '',
                    name: '',
                    email: '',
                    password: '',
                    specialty: '',
                    typ_id: 2,
                    us_id: '',
                    type: '',
                }
                this.fetchrpdata()
            },
            Alert(icon, title) {
                toast.fire({
                    icon: icon,
                    title: title,
                })
            },
            ...mapActions(["fetchDependencies", "fetchrpdata", "searchRP", "paginaterp"])
        },
        watch: {
            getrpdata() {
                if (this.getrpdata != '') {
                    this.loading = false
                }
            }
        },
        computed: mapGetters(['getdependencies', 'getrpdata']),
        created() {
            this.fetchDependencies()
            this.fetchrpdata()
        },
    }

</script>
