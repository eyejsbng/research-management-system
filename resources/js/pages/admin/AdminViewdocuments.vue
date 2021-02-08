<template>
    <div class="app-main">
        <sidebar :user="user"></sidebar>
        <div class="app-main__outer bg-white">
            <div class="app-main__inner">
                <div class="app-page-title bg-primary text-light">
                    <div class="page-title-wrapper">
                        <div v-if="create == false" class="page-title-heading">
                            <i class="fas fa-book fa-2x"></i>
                            <div class="ml-2">Research Archive</div>

                        </div>
                          <a href="#" v-if="create == true"
                        
                            @click="create = false"><i class="fas fa-chevron-left mr-2 fa-2x text-light"></i>
                            </a> <h4>Back</h4>
                      
                    </div>
                </div>
                <div class="content">
                    <div class="row">
                      
                        <div v-if="create == true" class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h2 v-if="update == false" class="title text-center">Create New Researchs</h2>
                                    <h2 v-if="update == true" class="title text-center">Update Research</h2>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Research Title</label>
                                                <input v-model="research.title" type="text" class="form-control"
                                                    placeholder="Input research Title">
                                            </div>
                                            <p class="archived-error" v-if="errors.title">Please Provide Research Title
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Group Name</label>
                                                <select v-if="update == false" class="form-control"
                                                    v-model="research.group" @change="ChangeGroup">
                                                    <option v-for="group in groupList" :key="group.grp_id"
                                                        :value="group.grp_id">{{ group.grp_title }}</option>
                                                    <option value="others">Others</option>
                                                </select>
                                                <input v-if="update == true" type="text" class="form-control" disabled
                                                    v-model="research.groupname">
                                            </div>
                                            <p class="archived-error" v-if="errors.groupname">Please Provide Research
                                                Title</p>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Author 1</label>
                                                <input v-model="research.autor1" type="text" class="form-control"
                                                    placeholder="Input Author name">
                                            </div>
                                            <p class="archived-error" v-if="errors.author1">Please Provide Author</p>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Author 2</label>
                                                <input v-model="research.autor2" type="text" class="form-control"
                                                    placeholder="Input Author name">
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Author 3</label>
                                                <input v-model="research.autor3" type="text" class="form-control"
                                                    placeholder="Input Author name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Author 4</label>
                                                <input v-model="research.autor4" type="text" class="form-control"
                                                    placeholder="Input Author name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Adviser Name</label>
                                                <input v-model="research.adviser" type="text" class="form-control"
                                                    placeholder="Input Advisesr name">
                                            </div>
                                            <p class="archived-error" v-if="errors.adviser">Input N/A if no Adviser</p>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Year Published</label>
                                                <select class="form-control" id="dob" v-model="research.year">
                                                    <option v-for="year in years" :value="year" :key="year.index">
                                                        {{ year }}</option>
                                                </select>
                                            </div>
                                            <p class="archived-error" v-if="errors.year">Please provide year published
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Course</label>
                                                <select class="form-control" id="dob" v-model="research.course">
                                                    <option v-for="course in  getdependencies.studCourse"
                                                        :key="course.crs_id" :value="course.crs_id">
                                                        {{ course.crs_title }}</option>
                                                </select>
                                            </div>
                                            <p class="archived-error" v-if="errors.course">Please Provide group course
                                            </p>
                                        </div>
                                        <div class="col-md-8 mr-auto ml-auto">
                                            <div class="form-group">
                                                <label>File</label>
                                                <input v-model="filename" type="text"
                                                    class="form-control inputFileVisible"
                                                    placeholder="Choose your file...">
                                                <input @change="updatefiles" type="file" class="inputFileHidden">
                                            </div>
                                            <p class="archived-error" v-if="errors.file">Please Provide PDF file</p>
                                        </div>
                                        <div class="col-md-6 mr-auto ml-auto" v-if="update == false">
                                            <button class="btn btn-info btn-round btn-block" :disabled="loading == true"
                                                @click="CreateNew">Upload</button>
                                        </div>
                                        <div class="col-md-6 mr-auto ml-auto" v-if="update == true">
                                            <button class="btn btn-info btn-round btn-block" :disabled="loading == true"
                                                @click="Update">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="create == false" id="researchlist">
                    <div class="row mb-1">
                        <div class="col-md-4">
                            <div class="col-span-6 sm:col-span-3">
                                <label class="block text-sm font-medium text-gray-700">Search</label>
                                <input v-model="search" @keyup="SearchResearch(search)" type="text"
                                    placeholder="Research title..." class="form-control">
                            </div>
                        </div>

                        <div class="ml-auto mt-5 mr-3">
                              <button v-if="create == false" class="float right btn btn-gradient-primary mb-2"
                            @click="create = true"><i class="fas fa-plus"></i>
                            Add New</button>
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

                                                    Research Title
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Year Publish
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Course
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <tr v-for="(research, index) in files.data" :key="research.res_id">
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center">
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">
                                                                <text-highlight :queries="search">
                                                                    {{ research.res_title }}
                                                                </text-highlight>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>


                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ research.res_ysdate }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ research.crs_title }}
                                                </td>

                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                   
                                                        <a href="#" @click="view(index)" type="button" rel="tooltip"
                                                            class="btn btn-primary btn-link btn-sm">
                                                            <i class="fas fa-search"></i>
                                                        </a>
                                                
                                               
                                                        <a @click="SelectUpdate(index)" type="button" rel="tooltip"
                                                            class="btn btn-outline-alternate btn-sm">
                                                            <i class="fas fa-file-signature"></i>
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
                                        <pagination :data="files" @pagination-change-page="Paginate" :limit=5>
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
        <modal name="example" resizable="true" adaptive="true" height="auto" shiftY="0.9">

            <perfect-scrollbar>
                <pdf :src="path"></pdf>
            </perfect-scrollbar>


        </modal>
    </div>

</template>

<script>
    import AdminSidebar from './AdminSidebar'
    import {
        mapGetters,
        mapActions,
    } from 'vuex'
    import pdf from 'vue-pdf'
    import _ from 'lodash';
    import TextHighlight from 'vue-text-highlight';
    export default {
        props: ['user'],
        components: {
            'text-highlight': TextHighlight,
            pdf,
            'sidebar': AdminSidebar,
        },
        data() {
            return {
                create: false,
                search: '',
                files: {},
                Count: {
                    percent: '',
                    research: ''
                },
                showPercent: false,
                showresearch: false,

                file: {},
                path: '',

                research: {
                    id: '',
                    title: '',
                    group: '',
                    groupname: '',
                    autor1: '',
                    autor2: '',
                    autor3: '',
                    autor4: '',
                    adviser: '',
                    year: '',
                    course: '',
                    filename: '',
                    pdf: '',
                },
                groups: {},
                groupList: {},
                filename: '',
                ifmanual: false,
                loading: false,
                update: false,
                errors: {},
            }
        },
        methods: {
            showModal() {
                this.$modal.show('example');
            },
            updatefiles(e) {
                let file = e.target.files[0];
                let reader = new FileReader();
                if (file['size'] < 10111775) {
                    // console.log(file)
                    if (file['type'] ==
                        'application/pdf') {
                        this.research.pdf = file
                        this.filename = file.name
                        reader.readAsDataURL(file);
                    } else {
                        this.filename = ''
                        this.research.pdf = ''
                        this.Alert('error', 'Invalid File')
                    }
                } else {
                    this.filename = ''
                    this.research.pdf = ''
                    this.Alert('error', 'You are uploading a Large File!!');
                }
            },
            GetGroupList() {
                axios.get('../api/getc3list').then(res => {
                    this.groupList = res.data
                })
            },
            ChangeGroup() {
                if (this.research.group == 'others') {
                    this.Alert('success', 'Fill up all the inputs')
                    this.research = {
                        title: '',
                        group: 'others',
                        groupname: 'others',
                        autor1: '',
                        autor2: 'NA',
                        autor3: 'NA',
                        autor4: 'NA',
                        adviser: '',
                        year: '',
                        course: '',
                        pdf: '',
                    }
                } else {
                    axios.get('../api/selectCap1/' + this.research.group).then(res => {
                        this.groups = res.data
                        this.research.adviser = this.groups.adviser.name
                        this.research.title = this.groups.info.grp_researchtitle
                        this.research.groupname = this.groups.info.grp_title
                        this.research.course = this.groups.info.crs_id
                        for (let index = 0; index < this.groups.members.length; index++) {
                            if (this.groups.members.length == 1) {
                                this.research.autor1 = this.groups.members[0].name
                            } else if (this.groups.members.length == 2) {
                                this.research.autor1 = this.groups.members[0].name
                                this.research.autor2 = this.groups.members[1].name
                            } else if (this.groups.members.length == 2) {
                                this.research.autor1 = this.groups.members[0].name
                                this.research.autor2 = this.groups.members[1].name
                                this.research.autor3 = this.groups.members[2].name
                            }
                        }
                    })
                }
            },
            SelectUpdate(index) {
                this.update = true
                this.showresearch = false
                this.research.id = this.files.data[index].res_id
                this.research.title = this.files.data[index].res_title
                this.research.groupname = this.files.data[index].rfg_groupName
                this.research.autor1 = this.files.data[index].rfg_author1
                this.research.autor2 = this.files.data[index].rfg_author2
                this.research.autor3 = this.files.data[index].rfg_autor3
                this.research.autor4 = this.files.data[index].rfg_autor4
                this.research.adviser = this.files.data[index].rfg_adviser
                this.research.course = this.files.data[index].crs_id
                this.research.filename = this.files.data[index].res_file
            },
            CreateNew() {
                this.loading = true
                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
                let formdata = new FormData()
                formdata.append('title', this.research.title)
                formdata.append('grp_id', this.research.group)
                formdata.append('groupname', this.research.groupname)
                formdata.append('author1', this.research.autor1)
                formdata.append('author2', this.research.autor2)
                formdata.append('author3', this.research.autor3)
                formdata.append('author4', this.research.autor4)
                formdata.append('adviser', this.research.adviser)
                formdata.append('year', this.research.year)
                formdata.append('course', this.research.course)
                formdata.append('file', this.research.pdf)
                axios.post('../api/createarchiveresearch', formdata, config).then(res => {
                    if (res.data.message == 'success') {
                        this.loading = false
                        this.GetGroupList()
                        this.showFiles()
                        this.Alert('success', 'Successfully Uploaded')
                        this.filename = ''
                        this.errors = {}
                        this.research = {
                            title: '',
                            group: '',
                            groupname: '',
                            autor1: '',
                            autor2: '',
                            autor3: '',
                            autor4: '',
                            adviser: '',
                            year: '',
                            course: '',
                            pdf: '',
                        }
                    } else {
                        this.loading = false
                        this.Alert('info', res.data.message)
                    }
                }).catch(err => {
                    this.loading = false
                    if (err.response.status == 422) {
                        this.errors = err.response.data.errors
                    }
                })
            },
            Update() {
                this.loading = true
                this.update = false
                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
                let formdata = new FormData()
                formdata.append('id', this.research.id)
                formdata.append('title', this.research.title)
                formdata.append('grp_id', this.research.group)
                formdata.append('groupname', this.research.groupname)
                formdata.append('author1', this.research.autor1)
                formdata.append('author2', this.research.autor2)
                formdata.append('author3', this.research.autor3)
                formdata.append('author4', this.research.autor4)
                formdata.append('adviser', this.research.adviser)
                formdata.append('year', this.research.year)
                formdata.append('course', this.research.course)
                formdata.append('filename', this.research.filename)
                formdata.append('file', this.research.pdf)
                axios.post('../api/updatearchiveresearch', formdata, config).then(res => {
                    if (res.data.message == 'success') {
                        this.loading = false
                        this.update = false
                        this.GetGroupList()
                        this.showFiles()
                        this.Alert('success', 'Successfully Uploaded')
                        this.filename = ''
                        this.errors = {}
                        this.research = {
                            id: '',
                            title: '',
                            group: '',
                            groupname: '',
                            autor1: '',
                            autor2: '',
                            autor3: '',
                            autor4: '',
                            adviser: '',
                            year: '',
                            course: '',
                            filename: '',
                            pdf: '',
                        }
                    } else {
                        this.loading = false
                        this.Alert('info', res.data.message)
                    }
                }).catch(err => {
                    this.loading = false
                    if (err.response.status == 422) {
                        this.errors = err.response.data.errors
                    }
                })
            },
            view(index) {
                this.showresearch = true
                this.file = this.files.data[index]
                this.showModal();
                this.path = '../app/myfiles/Files/Doneresearch/' + this.file.res_file;
            },
            showFiles() {
                axios.get('/api/archiveresearch').then(res => {
                    this.files = res.data
                });
            },
            SearchResearch: _.debounce(function (search) {
                if (search == '') {
                    this.showPercent = false
                    axios.get('../api/archiveresearch').then(({
                        data
                    }) => (this.files = data))
                } else {
                    axios.get('../api/searcharchived?q=' + search).then(res => {
                            this.files = res.data.files
                            this.Count.percent = res.data.countSearch
                            this.Count.research = res.data.countResearch
                            this.showPercent = true
                        })
                        .catch()
                }
            }, 1000),
            Paginate(page = 1) {
                if (this.search == '') {
                    axios.get('../api/archiveresearch/' + '?page=' + page)
                        .then(response => {
                            this.files = response.data;
                        });
                } else {
                    axios.get('../api/searcharchived?q=' + this.search + "&" + 'page=' + page)
                        .then(response => {
                            this.files = response.data.files;
                        });
                }
            },
            Alert(icon, title) {
                toast.fire({
                    icon: icon,
                    title: title,
                })
            },
            ...mapActions(["fetchDependencies"])
        },
        created() {
            this.showFiles()
            this.GetGroupList()
            this.fetchDependencies()
        },
        computed: {
            years() {
                const year = new Date().getFullYear()
                return Array.from({
                    length: year - 2013
                }, (value, index) => 2020 - index)
            },
            ...mapGetters(['getdependencies']),
        },


    }

</script>
<style scoped>
    .archived-error {
        font-size: 12px;
        color: red;
    }

</style>
