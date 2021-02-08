<template>
    <div class="app-main">

        <sidebar :user="user" />
        <div class="app-main__outer bg-white">
            <div class="app-main__inner">
                <div class="app-page-title bg-primary text-light">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <div v-if="create == false">Manage Subject Teacher</div>
                            <div v-else>
                                <a href="#" v-if="create == true" @click="create = false"><i
                                    class="fas fa-chevron-left text-light mr-2"></i>
                                
                            </a>
                            Create New Subject Teacher
                            </div>
                            
                        </div>

                    </div>
                </div>
                <button v-if="create == false" class="btn btn-primary btn-lg mb-2" @click="create = true; Clear();"><i
                        class="fas fa-plus"></i>
                    Create New</button>

                <div class="row">
                    <div v-if="create == true" class="col-md-6">
                        <div class="card" id="update">
                            <div class="card-header">
                                <h4 v-if="isUpdate == false" class="card-title">Create New Subject Teacher</h4>
                                <h4 v-if="isUpdate == true" class="card-title">Update Subject Teacher</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Full Name</label>
                                        <div class="form-group">
                                            <input type="text" v-model="st.name" class="form-control"
                                                placeholder="Teacher Fullname">
                                                <p style="font-size:12px;color:red;">{{ errors.name }}</p>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-6">
                                        <label>Email</label>
                                        <div class="form-group">
                                            <input type="email" v-model="st.email" class="form-control"
                                                placeholder="Email">
                                                <p style="font-size:12px;color:red;">{{ errors.email }}</p>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Password</label>
                                        <div class="form-group">
                                            <input type="password" v-model="st.password" class="form-control"
                                                placeholder="Password">
                                                <p style="font-size:12px;color:red;">{{ errors.password }}</p>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-6">
                                        <label>Specialty</label>
                                        <div class="form-group">
                                            <input type="text" v-model="st.specialty" class="form-control"
                                                placeholder="Field of Expertise">
                                                 <p style="font-size:12px;color:red;">{{ errors.specialty }}</p>
                                        </div>
                                       
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button v-if="isUpdate == false" @click="CreateST" :disabled="isloading == true"
                                            class="btn btn-primary btn-lg">
                                            <i v-if="isloading == false" class="fas fa-users-cog"></i>
                                            <span v-if="isloading == true" class="spinner-grow spinner-grow-sm"
                                                role="status" aria-hidden="true"></span>
                                            Create
                                        </button>

                                        <button v-if="isUpdate == true" @click="UpdateST" :disabled="isloading == true"
                                            class="btn btn-primary">
                                            <i v-if="isloading == false" class="fas fa-users-cog"></i>
                                            <span v-if="isloading == true" class="spinner-grow spinner-grow-sm"
                                                role="status" aria-hidden="true"></span>
                                            Update Subject Teacher
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="create == false" class="col-md-12">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="country" class="block text-sm font-medium text-gray-700">Sort by
                                        Sort by Status</label>
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
                                    <input type="text" @keyup="Search" v-model="searching.search"
                                        class="form-control form-control" placeholder="Search...">
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
                                                        Status
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Action
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody class="bg-white divide-y divide-gray-200">
                                                <tr v-for="(st,index) in getstdata.data" :key="st.id">
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    {{ st.name }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900">{{ st.email }}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">

                                                        {{ st.specialty }}

                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ st.us_title }}
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <button @click="Decission(index, 1)"
                                                            :disabled="isloading == true"
                                                            v-if="st.us_id == 3 || st.us_id == 2"
                                                            class="btn btn-outline-success btn-sm">
                                                            <i v-if="isloading == false" class="fas fa-plus-circle"></i>
                                                            <span v-if="isloading == true"
                                                                class="spinner-grow spinner-grow-sm" role="status"
                                                                aria-hidden="true"></span>
                                                            Approve
                                                        </button>
                                                        <button @click="Decission(index, 2)"
                                                            :disabled="isloading == true"
                                                            v-if="st.us_id == 1 || st.us_id == 3"
                                                            class="btn btn-secondary btn-sm mt-1">
                                                            <i v-if="isloading == false"
                                                                class="fas fa-minus-circle"></i>
                                                            <span v-if="isloading == true"
                                                                class="spinner-grow spinner-grow-sm" role="status"
                                                                aria-hidden="true"></span>
                                                            Disapprove
                                                        </button>
                                                        <a href="#update" v-if="st.us_id == 1"
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
                                            <pagination :data="getstdata" @pagination-change-page="Paginate" :limit=5>
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
        <modal name="update" :clickToClose="false" :adaptive="true" height="auto">
            <div class="col-lg-12">
                <div>
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal">

                            Edit Student Information
                        </div>

                    </div>
                    <div class="scroll-area-lg">
                        <div class="scrollbar-container ps ps--active-y">

                            <div class="row p-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Full Name</label>
                                            <div class="form-group">
                                                <input type="text" v-model="st.name" class="form-control"
                                                    placeholder="Input Subject Teacher Fullname">
                                            </div>
                                            <p style="font-size:12px;color:red;">{{ errors.name }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Email</label>
                                            <div class="form-group">
                                                <input type="email" v-model="st.email" class="form-control"
                                                    placeholder="Input Subject Teacher Email">
                                            </div>
                                            <p style="font-size:12px;color:red;">{{ errors.email }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Password</label>
                                            <div class="form-group">
                                                <input type="password" v-model="st.password" class="form-control"
                                                    placeholder="Input Subject Teacher Password">
                                            </div>
                                            <p style="font-size:12px;color:red;">{{ errors.password }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Specialty</label>
                                            <div class="form-group">
                                                <input type="text" v-model="st.specialty" class="form-control"
                                                    placeholder="Input Subject Teacher Specialty">
                                            </div>
                                            <p style="font-size:12px;color:red;">{{ errors.specialty }}</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="float-right">
                        <button @click="$modal.hide('update')" class="mb-2 mr-2 btn btn-danger">Cancel</button>
                        <button @click="UpdateST" class="mb-2 mr-2 btn btn-success">Update</button>
                    </div>
                </div>
            </div>
        </modal>
    </div>
</template>
<script>
    import AdminSidebar from './AdminSidebar'
    import {
        mapGetters,
        mapActions
    } from 'vuex'
    import TextHighlight from 'vue-text-highlight';
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
                st: {
                    id: '',
                    name: '',
                    email: '',
                    password: '',
                    specialty: '',
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

                subteacher: {},
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
            CreateST() {
                const subject = "Account Created"
                const body =
                    "Your Email is Created by the RC. Login to wwww.ccerms.online and use this credentials: <br>" +
                    "Email: " + this.st.email + " <br> Password: " + this.st.password
                this.isloading = true
                axios.post('../api/createST', this.st).then(res => {
                    if (res.data.message == 'success') {
                        this.isloading = false
                        this.Alert('success', 'Successfully Created');
                        this.SendEmail(this.st.email, subject, body)
                        this.Clear()

                    } else {
                        this.isloading = false
                        this.Alert('infro', res.data.message)
                    }
                }).catch(err => {
                    this.isloading = false
                    if (err.response.status == 422) {
                        this.errors = err.response.data.errors
                        console.log(this.erros)
                    }
                })
            },
            showUpdate(index) {
                this.isUpdate = true
                this.subteacher = this.getstdata.data[index]
                this.st = {
                    id: this.subteacher.id,
                    name: this.subteacher.name,
                    email: this.subteacher.email,
                    password: '',
                    specialty: this.subteacher.specialty,
                    type: 'update',

                }
                this.$modal.show('update')
                this.errors.password = 'Leave Blank if you will not change the password'
            },
            UpdateST() {
                const subject = "Account Updated"
                const body = "Your Account is Updated by the RC. Contact the RC for more Information"
                this.isloading = true
                axios.post('../api/updateST', this.st).then(res => {
                    if (res.data.message == 'success') {
                        this.isloading = false
                        this.isUpdate = false
                        this.Alert('success', 'Successfully Updated')
                        this.SendEmail(this.st.email, subject, body)
                        this.Clear()
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
                const body = "Please Contact the RC for more information for youre account."
                this.isloading = true
                this.subteacher = this.getstdata.data[index]
                this.st = {
                    id: this.subteacher.id,
                    name: this.subteacher.name,
                    email: this.subteacher.email,
                    type: 'approval',
                    us_id: us_id
                }
                axios.post('../api/updateST', this.st).then(res => {
                    if (res.data.message == 'success') {
                        this.isloading = false
                        this.Alert('success', 'Successfully Updated')
                        this.SendEmail(this.st.email, subject, body)
                        this.Clear()
                    } else {
                        this.isloading = false
                        this.Alert('info', res.data.message)
                    }
                })
            },
            Search: _.debounce(function () {
                if (this.searching.search == '') {
                    this.fetchstdata()
                } else {
                    this.searchST(this.searching);
                }
            }, 3000),
            Paginate(page = 1) {
                this.paginatest(page)
            },
            Clear() {
                this.errors = {}
                this.st = {
                    name: '',
                    email: '',
                    password: '',
                    specialty: ''
                }
                this.fetchstdata()
            },
            Alert(icon, title) {
                toast.fire({
                    icon: icon,
                    title: title,
                })
            },
            ...mapActions(["fetchDependencies", "fetchstdata", "searchST", "paginatest"])
        },
        watch: {
            getstdata() {
                if (this.getstdata != '') {
                    this.loading = false
                }
            }
        },
        computed: mapGetters(['getdependencies', 'getstdata']),
        created() {
            this.fetchDependencies()
            this.fetchstdata()
        }
    }

</script>
