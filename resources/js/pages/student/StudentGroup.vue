<template>

    <div class="col-md-12 mr-auto ml-auto mt-3">
        <div>
            <div class="text-center mt-5 mb-3">
                <img class="mx-auto" src="/img/logo.png" width="200" height="70">
                <h2 slot="title">You are almost there!</h2>
                <p slot="title">Just a little more information. Join or create a group.</p>

            </div>
            <div v-if="showGroup == true">
                <div v-if="showJoin == false">
                    <div
                        class="max-w-md border border-gray-200 shadow-xs mx-auto rounded-lg p-10 bg-white space-y-6 flex-grow">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Group Name</label>
                                <div class="form-group">
                                    <input type="text" v-model="groupName"
                                        class="outline-none px-2 py-2 border text-black placeholder-gray-500 rounded"
                                        placeholder="Ex. CCERMS">
                                    <p class="text-danger" style="font-size:12px;">{{ error.grpName }}</p>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <label>Group Course</label>
                                <div class="form-group">
                                    <select class="form-control" v-model="crs_id">
                                        <option value="" selected disabled hidden>Choose here</option>
                                        <option v-for="crs in course" :key="crs.crs_id" :value="crs.crs_id">
                                            {{ crs.crs_title }}</option>
                                    </select>
                                    <p class="text-danger" style="font-size:12px;">{{ error.grpCourse }}</p>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <label>Group Research Title</label>
                                <div class="form-group">
                                    <input type="text" v-model="groupResearchTitle"
                                        class="outline-none px-2 py-2 border text-black placeholder-gray-500 rounded"
                                        placeholder="Ex. CCERMS: A Multiplatform Research Management">
                                    <p class="text-danger" style="font-size:12px;">{{ error.grpresearchtitle }}</p>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mr-auto ml-auto">
                                <button @click="CreateGroup" class="btn btn-info btn-round btn-block"
                                    :disabled="loading == true"><i class="fas fa-arrow-right"></i> Create Group</button>
                            </div>
                        </div>
                    </div>


                </div>
                <p v-if="showJoin == false" class="text-center">Or Just <a @click="clickshowJoin('join')"
                        href="#">Join</a> your Group!</p>
                <div v-if="showJoin == true" class="col-md-7 mx-auto">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-150">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                               Group Name</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><strong>Group Title</strong></th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><strong>Group Course</strong></th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><strong>Action</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(group,index) in groups" :key="group.grp_id">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ group.grp_title }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ group.grp_researchtitle }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ group.crs_title }}</td>
                                            <td>
                                                <button class="btn btn-primary"
                                                    @click="showModalJoin(index)">Join</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal fade" id="mdlJoinGroup">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header justify-content-center bg-info">
                                        <h4 class="title title-up">Join Group <p>{{ grp.grp_title }}</p>
                                        </h4>

                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-10 mr-auto ml-auto">
                                                <div class="form-group">
                                                    <input type="text" v-model="groupCode"
                                                        class="form-control text-center"
                                                        placeholder="Enter Your Group Code...">
                                                </div>
                                                <p class="text-primary" style="font-size:12px;">{{ error.groupCode }}
                                                </p>
                                            </div>
                                            <div class="col-md-8 mr-auto ml-auto">
                                                <button @click="JoinGroup" class="btn btn-info btn-round btn-block"
                                                    :disabled="isloading == true"><span v-if="isloading == true"
                                                        class="spinner-grow spinner-grow-sm" role="status"
                                                        aria-hidden="true"></span>Join</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <p v-if="showJoin == true" class="text-center">or just <a @click="clickshowJoin('create')"
                        href="#">Create</a> your Group!</p>
            </div>
        </div>
      
    </div>

</template>

<script>
    export default {
        data() {
            return {
                groupName: '',
                groupResearchTitle: '',
                crs_id: '',
                loading: false,

                groupCode: '',

                sec_code: '',

                start: 0,
                showJoin: true,
                showGroup: true,
                isloading: false,
                error: {
                    grpName: '',
                    grpCourse: '',
                    grpresearchtitle: '',
                    sec_code: '',
                    groupCode: '',

                },
                course: [],
                groups: [],
                grp: {},
            }
        },
        props: ['user'],
        methods: {
            getCourse() {
                axios.get('../api/Dependencies').then(res => {
                    this.course = res.data.studCourse
                })
                axios.get('../api/Capstone1Info').then(res => {
                    this.groups = res.data.cap1
                })
            },
            Alert(icon, title) {
                toast.fire({
                    icon: icon,
                    title: title,
                })
            },
            clickshowJoin(str) {
                if (str == 'join') {
                    this.showJoin = true
                } else {
                    this.showJoin = false
                }
            },
            CreateGroup() {
                if (this.groupName == '') {
                    this.error.grpName = 'Input group field is required.'
                    if (this.crs_id != '') {
                        this.error.grpCourse = ''
                    }
                    if (this.groupResearchTitle != '') {
                        this.error.grpresearchtitle = ''
                    }

                }
                if (this.crs_id == '') {
                    this.error.grpCourse = 'Select course'
                    if (this.groupName != '') {
                        this.error.grpName = ''
                    }
                    if (this.groupResearchTitle != '') {
                        this.error.grpresearchtitle = ''
                    }

                }
                if (this.groupResearchTitle == '') {
                    this.error.grpresearchtitle = 'Input research title is required.'
                    if (this.groupName != '') {
                        this.error.grpName = ''
                    }
                    if (this.crs_id != '') {
                        this.error.grpCourse = ''
                    }
                } else {
                    this.loading = true
                    axios.post('../api/createGroup', {
                        'groupName': this.groupName,
                        'groupResearchTitle': this.groupResearchTitle,
                        'crs_id': this.crs_id,
                        'id': this.user.id
                    }).then(res => {
                        if (res.data.message == 'Success') {
                            this.loading = false
                            this.Alert('success', 'Successfully Created!')
                            this.$router.push('/student/dashboard')
                            location.reload()
                            this.error = {
                                grpName: '',
                                grpCourse: '',
                                grpresearchtitle: ''
                            }
                            this.groupName = ''
                            this.crs_id = ''
                            this.groupResearchTitle = ''
                            this.showGroup = false
                        } else {
                            this.loading = false
                            this.Alert('info', 'Somethings went wrong')
                            this.error.grpName = res.data.message
                        }
                    })

                }
            },
            showModalJoin(index) {
                this.grp = this.groups[index]
                $('#mdlJoinGroup').modal('show')
            },
            JoinGroup() {
                this.isloading = true
                if (this.groupCode == '') {
                    this.isloading = false
                    this.error.groupCode = 'Please provide group Code!'
                } else {
                    this.loading = true
                    axios.post('../api/JoinGroup', {
                        'id': this.user.id,
                        'grp_id': this.grp.grp_id,
                        'grp_code': this.groupCode
                    }).then(res => {
                        if (res.data.message == 'Success') {
                            this.loading = false
                            this.Alert('success', 'Successfully Joined!')
                            this.$router.push('/student/dashboard')
                            location.reload()
                            // this.isloading = false
                            // this.showGroup = false
                            // this.error.groupCode = ''
                            // this.groupCode = ''
                            // $('#mdlJoinGroup').modal('hide')

                        } else {
                            this.isloading = false
                            this.error.groupCode = res.data.message
                        }
                    })
                }
            },
            JoinSection() {
                if (this.sec_code == '') {
                    this.error.sec_code = 'Enter Your Subject Code'
                } else {
                    axios.post('../api/JoinSection', {
                        'sec_code': this.sec_code,
                        'id': this.user.id
                    }).then(res => {
                        if (res.data.message == 'Success') {
                            this.Alert('success', 'Successfully Join to Section')
                            this.error.sec_code = ''


                        } else {
                            this.Alert('info', 'Somethings went wrong')
                            this.error.sec_code = res.data.message
                        }
                    });
                }
            }
        },
        created() {
            $('.app_header').remove();
            this.getCourse()
            if (this.user.us_id == 3) {
                this.$router.push('/account/conflictAccount')
                location.reload()
            }
            if (this.user.grp_id == 1) {
                this.start = 0
                console.log('0')
            } else {
                this.showGroup = false
                this.start = 1
            }
        }
    }

</script>
