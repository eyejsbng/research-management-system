<template>
    <div class="app-main">

        <sidebar :user="user" />
        <div class="app-main__outer bg-white">
            <div class="app-main__inner">
                <div class="app-page-title bg-primary text-light">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <div v-if="create == false">Manage Student</div>
                            <div v-if="create == true"><a href="#" v-if="create == true"
                    @click="create = false"><i class="fas fa-chevron-left text-light mr-2"></i>
                    </a>Create New Student</div>
                        </div>

                    </div>
                </div>
                <button v-if="create == false" class="btn btn-primary btn-lg mb-2"
                    @click="create = true; Clear()"><i class="fas fa-plus"></i>
                    Create New</button>
                
                <div class="row">
                    <div v-if="create == true" class="col-md-6">
                        <div class="card" id="create">
                            <div class="card-header">
                                <h4 v-if="isUdate == false" class="card-title">Create New Student</h4>
                                <h4 v-if="isUdate == true" class="card-title">Update Student</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Full Name</label>
                                        <div class="form-group">
                                            <input v-model="name" type="text" class="form-control"
                                                placeholder="Input Student Fullname">
                                        </div>
                                        <p style="font-size:12px;color:red;">{{error.name}}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Email</label>
                                        <div class="form-group">
                                            <input v-model="email" type="email" class="form-control"
                                                placeholder="Input Student Email">
                                        </div>
                                        <p style="font-size:12px;color:red;">{{error.email}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Password</label>
                                        <div class="form-group">
                                            <input v-model="password" type="password" class="form-control"
                                                placeholder="Input Student Password">
                                        </div>
                                        <p style="font-size:12px;color:red;">{{error.password}}</p>
                                        <p v-if="isUdate == true" style="font-size:12px;color:red;">Leave blank the
                                            password if you will not update</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Course</label>
                                        <div class="form-group">
                                            <select class="form-control" v-model="course">
                                                <option v-for="course in getdependencies.studCourse"
                                                    :key="course.crs_id" :value="course.crs_id">{{ course.crs_title }}
                                                </option>
                                            </select>
                                        </div>
                                        <p style="font-size:12px;color:red;">{{error.course}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button v-if="isUdate == false" class="btn btn-primary" @click="CreateStudent"
                                            :disabled="isCreating == true">
                                            <i v-if="isCreating == false" class="fas fa-users-cog"></i>
                                            <span v-if="isCreating == true" class="spinner-grow spinner-grow-sm"
                                                role="status" aria-hidden="true"></span>
                                            Create Student
                                        </button>
                                        <button v-if="isUdate == true" class="btn btn-info btn-block btn-round"
                                            @click="UpdateStudent" :disabled="isUpdating == true">
                                            <i v-if="isUpdating == false" class="fas fa-users-cog"></i>
                                            <span v-if="isUpdating == true" class="spinner-grow spinner-grow-sm"
                                                role="status" aria-hidden="true"></span>
                                            Update Student
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
                                        Course</label>
                                    <select id="country" v-model="searching.course"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        <option v-for="course in getdependencies.studCourse" :key="course.crs_id"
                                            :value="course.crs_id">{{ course.crs_title }}</option>
                                    </select>
                                </div>
                            </div>
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
                                    <input type="text" class="form-control form-control" @keyup="SearchStudent"
                                        v-model="searching.search" placeholder="Search student...">
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
                                                        Course
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Group
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
                                                <tr v-for="(student,index) in getstudentdata.data" :key="student.id">
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    {{ student.name }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900">{{ student.email }}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        {{ student.crs_title }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ student.grp_title }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ student.us_title }}
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <button v-if="student.us_id == 3 || student.us_id == 2"
                                                            @click="Decission(1,student.id,student.name,student.email)"
                                                            :disabled="isloading == true"
                                                            class="btn btn-success btn-round btn-sm">
                                                            <i v-if="isloading == false" class="fas fa-plus-circle"></i>
                                                            <span v-if="isloading == true"
                                                                class="spinner-grow spinner-grow-sm" role="status"
                                                                aria-hidden="true"></span>
                                                            Approve
                                                        </button>
                                                        <button v-if="student.us_id == 1 || student.us_id == 3"
                                                            @click="Decission(2,student.id,student.name,student.email)"
                                                            :disabled="isloading == true"
                                                            class="mb-2 mr-2 btn-sm btn-transition btn btn-secondary">
                                                            <i v-if="isloading == false"
                                                                class="fas fa-minus-circle"></i>
                                                            <span v-if="isloading == true"
                                                                class="spinner-grow spinner-grow-sm" role="status"
                                                                aria-hidden="true"></span>
                                                            Disapprove
                                                        </button>

                                                        <a v-if="student.us_id == 1" href="#create"
                                                            @click="getToUpdate(index)"
                                                            class="mb-2 mr-2 btn-sm btn-transition btn btn-outline-alternate"><i
                                                                class="fas fa-user-edit"></i> Edit</a>

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- This example requires Tailwind CSS v2.0+ -->
                                    <div
                                        class="px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                                        <ul class="pagination">
                                            <pagination :data="getstudentdata" @pagination-change-page="Paginate"
                                                :limit=5>
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
                                <div class="col-md-6">
                                    <label>Full Name</label>
                                    <div class="form-group">
                                        <input v-model="name" type="text" class="form-control"
                                            placeholder="Input Student Fullname">
                                    </div>
                                    <p style="font-size:12px;color:red;">{{error.name}}</p>
                                </div>
                                <div class="col-md-6">
                                    <label>Email</label>
                                    <div class="form-group">
                                        <input v-model="email" type="email" class="form-control"
                                            placeholder="Input Student Email">
                                    </div>
                                    <p style="font-size:12px;color:red;">{{error.email}}</p>
                                </div>
                            </div>
                            <div class="row p-3">
                                <div class="col-md-6">
                                    <label>Password</label>
                                    <div class="form-group">
                                        <input v-model="password" type="password" class="form-control"
                                            placeholder="Input Student Password">
                                    </div>
                                    <p style="font-size:12px;color:red;">{{error.password}}</p>
                                    <p v-if="isUdate == true" style="font-size:12px;color:red;">Leave blank the
                                        password if you will not update</p>
                                </div>
                                <div class="col-md-6">
                                    <label>Course</label>
                                    <div class="form-group">
                                        <select class="form-control" v-model="course">
                                            <option v-for="course in getdependencies.studCourse" :key="course.crs_id"
                                                :value="course.crs_id">{{ course.crs_title }}
                                            </option>
                                        </select>
                                    </div>
                                    <p style="font-size:12px;color:red;">{{error.course}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="float-right">
                        <button @click="cancelUpdate" class="mb-2 mr-2 btn btn-danger">Cancel</button>
                        <button @click="UpdateStudent" class="mb-2 mr-2 btn btn-success">Update</button>
                    </div>
                </div>
            </div>
        </modal>
    </div>
</template>
<script>
    import AdminSidebar from './AdminSidebar'
    import TextHighlight from 'vue-text-highlight';
    import _ from 'lodash';
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
                name: '',
                email: '',
                password: '',
                course: '',

                isCreating: false,
                isloading: false,
                isUpdating: false,
                isUdate: false,

                error: {
                    name: '',
                    email: '',
                    password: '',
                    course: ''
                },

                searching: {
                    course: 1,
                    status: 1,
                    search: '',
                },

                student: {}
            }
        },
        methods: {
            cancelUpdate() {
                this.$modal.hide('update')
            },
            SendEmail(to, subject, message) {
                Email.send({
                    SecureToken: "21691b39-e134-40cd-86dd-da6081f54e65",
                    To: to,
                    From: "umccerms@gmail.com",
                    Subject: subject,
                    Body: message
                }).then()
            },
            SearchStudent: _.debounce(function () {
                if (this.searching.search == '') {
                    this.fetchstudentdata()
                } else {
                    this.searchStudent(this.searching);
                }
            }, 3000),
            Paginate(page = 1) {
                this.paginatestudent(page)
            },
            CreateStudent() {
                var subject = "New Account"
                var body = "Your Account Has been created by the RC. Please use this credentials: <br> Email: " +
                    this.email + " <br> Password: " + this.password
                if (this.name == '') {

                    this.error.name = 'Please Provide a fullname'
                    if (this.email != '') {
                        this.error.email = ''
                    }
                    if (this.password != '') {
                        this.error.password = ''
                    }
                    if (this.course != '') {
                        this.error.course = ''
                    }
                } else if (this.email == '') {
                    this.error.email = 'Please Provide a valid email'
                    if (this.name != '') {
                        this.error.name = ''
                    }
                    if (this.password != '') {
                        this.error.password = ''
                    }
                    if (this.course != '') {
                        this.error.course = ''
                    }
                } else if (this.password == '') {
                    this.error.password = 'Please Provide a password'
                    if (this.email != '') {
                        this.error.email = ''
                    }
                    if (this.name != '') {
                        this.error.name = ''
                    }
                    if (this.course != '') {
                        this.error.course = ''
                    }
                } else if (this.course == '') {
                    this.error.course = 'Please Select a Course'
                    if (this.email != '') {
                        this.error.email = ''
                    }
                    if (this.password != '') {
                        this.error.password = ''
                    }
                    if (this.name != '') {
                        this.error.name = ''
                    }
                } else {
                    this.isCreating = true
                    this.SendEmail(this.email, subject, body)
                    axios.post('../api/CreateStudent', {
                        name: this.name,
                        email: this.email,
                        password: this.password,
                        crs_id: this.course
                    }).then(res => {
                        if (res.data.message == 'success') {
                            this.Clear()
                            this.isCreating = false
                            this.Alert('success', 'Successfully Created')
                        } else {
                            this.isCreating = false
                            this.Alert('info', res.data.message)
                        }

                    })
                }
            },
            getToUpdate(index) {
                this.error = {
                    name: '',
                    email: '',
                    password: '',
                    course: '',
                }
                this.isUdate = true
                this.student = this.getstudentdata.data[index]
                this.name = this.student.name
                this.email = this.student.email
                this.course = this.student.crs_id
                this.$modal.show('update')
            },
            UpdateStudent() {
                var datas = {}
                const subject = 'Account Updated'
                const body = 'Your Account has been updated. Contact the RC for more Information.'
                if (this.password == '') {
                    datas = {
                        id: this.student.id,
                        type: 'update',
                        name: this.name,
                        email: this.email,
                        password: '',
                        crs_id: this.course
                    }
                } else {
                    datas = {
                        id: this.student.id,
                        name: this.name,
                        type: 'update',
                        email: this.email,
                        password: this.password,
                        crs_id: this.course
                    }
                }
                this.isUpdating = true
                this.SendEmail(this.email, subject, body)
                axios.post('../api/updatestudent', datas).then(res => {
                    if (res.data.message == 'success') {
                        this.isUdate = false
                        this.isUpdating = false
                        this.Alert('success', 'Successfully Updated')
                        this.Clear()
                    } else {
                        this.isUpdating = false
                        this.Alert('info', res.data.message)
                    }
                })
            },
            Decission(str, id, name, email) {
                this.isloading = true
                const subject = 'Student Status'

                if (str == 1) {
                    const body = 'Your Account is being Approved by the RC'
                    const data = {
                        type: 'approval',
                        id: id,
                        email: email,
                        name: name,
                        us_id: 1
                    }
                    this.SendEmail(email, subject, body)
                    axios.post('../api/updatestudent', data).then(res => {
                        if (res.data.message == 'success') {
                            this.isloading = false
                            this.Clear()
                            this.Alert('info', 'Successfully Approve')
                        } else {
                            this.isloading = false
                            this.Alert('info', res.data.message)
                        }
                    })
                } else {
                    const body = 'Your Account is being Disapproved by the RC'
                    const data = {
                        type: 'approval',
                        email: email,
                        name: name,
                        id: id,
                        us_id: 2
                    }
                    this.SendEmail(email, subject, body)
                    axios.post('../api/updatestudent', data).then(res => {
                        if (res.data.message == 'success') {
                            this.isloading = false
                            this.Clear()
                            this.Alert('info', 'Successfully Disapprove')
                        } else {
                            this.isloading = false
                            this.Alert('info', res.data.message)
                        }
                    })
                }
            },
            Alert(icon, title) {
                toast.fire({
                    icon: icon,
                    title: title,
                })
            },
            Clear() {
                this.name = '',
                    this.email = '',
                    this.password = '',
                    this.course = '',

                    this.error = {
                        name: '',
                        email: '',
                        password: '',
                        course: '',
                    }
                this.student = {}
                this.fetchstudentdata();
            },
            ...mapActions(["fetchDependencies", "fetchstudentdata", "searchStudent", "paginatestudent"])
        },
        watch: {
            getstudentdata() {
                if (this.getstudentdata != '') {
                    this.loading = false
                }
            }
        },
        created() {
            this.fetchDependencies();
            this.fetchstudentdata();
        },
        computed: mapGetters(['getdependencies', 'getstudentdata']),
    }

</script>
