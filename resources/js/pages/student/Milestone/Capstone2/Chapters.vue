<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <h4 class="title text-center">Chapters 1 to 6</h4>
            </div>
            <div class="col-md-8 mr-auto ml-auto" v-if="groupinfo.info.caps2 == 1">
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-warning text-center">
                            <span v-if="isUpdate == false">Submit Chapter 4 to 6 to your Adviser. <br> Submit only Docs
                                file.</span>
                            <span v-if="isUpdate == true">Choose file to upload. <br> Refresh the page to cancel.</span>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <div class="form-group form-file-upload form-file-simple">
                                        <label>Submit File</label>
                                        <input v-model="filename" type="text" class="form-control inputFileVisible"
                                            placeholder="Choose your file...">
                                        <input @change="updatefiles" type="file" class="inputFileHidden">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" v-if="groupinfo">
                                <div class="col-md-8 mr-auto ml-auto" v-if="groupinfo.adviser.id != 2">
                                    <button v-if="isUpdate == false" @click="SubmitDocs"
                                        class="btn btn-info btn-round btn-block" :disabled="loading == true">
                                        <span v-if="loading == true" class="spinner-grow spinner-grow-sm" role="status"
                                            aria-hidden="true"></span>
                                        Send
                                    </button>
                                    <button v-if="isUpdate == true" @click="Update"
                                        class="btn btn-info btn-round btn-block" :disabled="loading == true">
                                        <span v-if="loading == true" class="spinner-grow spinner-grow-sm" role="status"
                                            aria-hidden="true"></span>
                                        Update
                                    </button>
                                </div>
                                <div class="col-md-8 mr-auto ml-auto" v-if="groupinfo.adviser.id == 2">
                                    <p style="color:red;font-size:12px;" class="text-center"> No Adviser Yet </p>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">Submission History</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hovered">
                                <thead class="text-info">
                                    <tr>
                                        <td><strong>Rev. #</strong></td>
                                        <td><strong>Chapter</strong></td>
                                        <td><strong>Date Submitted</strong></td>
                                        <td><strong>Submitted by</strong></td>
                                        <td><strong>Submitted to</strong></td>
                                        <td><strong>Status</strong></td>
                                        <td><strong>Action</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(docs,index) in getcaps1submitteddocs.documents2" :key="docs.dcs_id">
                                        <td>{{ docs.dcs_revID }}</td>
                                        <td>{{ docs.dcs_document }}</td>
                                        <td>{{ docs.dcs_date }}</td>
                                        <td>{{ docs.submitby }}</td>
                                        <td>{{ docs.submitto }}</td>
                                        <td>{{ docs.ss_title }}</td>
                                        <td>
                                            <button @click="ShowDetails(index)" class="btn btn-info btn-round btn-sm">
                                                <i class="fas fa-search"></i>
                                                Show
                                            </button>
                                            <button v-if="docs.ss_id == 1" @click="SelectUpdate(docs.dcs_id)" class="btn btn-info btn-round btn-sm">
                                                <i class="fas fa-edit"></i>
                                                Update
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal fade" id="mdlShowDetails">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header justify-content-center">
                                        <h5 class="modal-title text-center">Submission Details <br> <a v-if="docs.ss_id != 1 && docs.adv_file != null" :href="path">Download File</a></h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="alert alert-warning">
                                            <span v-if="docs.ss_id != 1 && docs.ss_id != 4">
                                                Download the file if the Adviser check your submission. <br>
                                                See the comment in the MS Word. <br>
                                                Submit again if you comply the revision.
                                            </span>
                                            <span v-if="docs.ss_id == 1">
                                                Adviser not yet check your Submission.
                                            </span>
                                            <span v-if="docs.ss_id == 4">
                                                Adviser Approved your documents.
                                            </span>
                                        </div>
                                        <div class="container text-center" v-if="docs.ss_id != 1">
                                            <h5 class="title">Adviser Comment</h5>
                                            <p>{{ docs.adv_comment }}</p>
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
import {mapGetters,mapActions} from 'vuex'
    export default {
        props: ['user'],
        data() {
            return {
                isUpdate: false,
                loading: false,

                docs:{},
                path:'',

                idtoUpdate: '',

                file: '',
                filename: '',
            }
        },
        methods: {
            updatefiles(e) {
                let file = e.target.files[0];
                let reader = new FileReader();
                if (file['size'] < 10111775) {
                    // console.log(file)
                    if (file['type'] == 'application/pdf' || file['type'] ==
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
                        this.file = file
                        this.filename = file.name
                        reader.readAsDataURL(file);
                    } else {
                        this.filename = ''
                        this.file = ''
                        this.Alert('error', 'Invalid File')
                    }
                } else {
                    this.filename = ''
                    this.file = ''
                    this.Alert('error', 'You are uploading a Large File!!');
                }
            },
            SubmitDocs() {
                this.loading = true
                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
                let formdata = new FormData()
                let date = moment(Date.now()).format('YYYY-MM-DD hh:mm')
                let chapter = 'Chapter1to6'
                formdata.append('submitby', this.user.id)
                formdata.append('submitto', this.groupinfo.adviser.id)
                formdata.append('grp_title', this.groupinfo.info.grp_title)
                formdata.append('grp_id', this.user.grp_id)
                formdata.append('file', this.file)
                formdata.append('chapter', chapter)
                formdata.append('date', date)
                formdata.append('standing', 2)
                axios.post('../api/SubmitDocs', formdata, config).then(res => {
                    if (res.data.message == 'success') {
                        this.Alert('success', 'Successfully Submitted')
                        this.file = ''
                        this.filename = ''
                        this.loading = false
                        this.getCapstone1SubmittedDocs(this.user.grp_id)
                    } else {
                        this.loading = false
                        this.file = ''
                        this.filename = ''
                        this.Alert('info', res.data.message)
                    }
                })
            },
            SelectUpdate(id){
                this.isUpdate = true
                this.idtoUpdate = id
            },
            Update(){
                this.loading = true
                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
                let formdata = new FormData()
                let date = moment(Date.now()).format('YYYY-MM-DD hh:mm')
                let chapter = 'Chapter1to6'
                formdata.append('submitby', this.user.id)
                formdata.append('grp_title', this.groupinfo.info.grp_title)
                formdata.append('grp_id', this.user.grp_id)
                formdata.append('file', this.file)
                formdata.append('chapter', chapter)
                formdata.append('date', date)
                formdata.append('dcs_id', this.idtoUpdate)
                formdata.append('standing', 2)
                axios.post('../api/UpdateDocs', formdata, config).then(res => {
                    if (res.data.message == 'success') {
                        this.Alert('success', 'Successfully Submitted')
                        this.file = ''
                        this.filename = ''
                        this.loading = false
                        this.isUpdate = false
                        this.getCapstone1SubmittedDocs(this.user.grp_id)
                    } else {
                        this.loading = false
                        this.file = ''
                        this.filename = ''
                        this.Alert('info', res.data.message)
                    }
                })
            },
            ShowDetails(index){
                $('#mdlShowDetails').modal('show')
                this.docs = this.getcaps1submitteddocs.documents2[index]
                this.path = '../app/myfiles/Adviserfiles/Capstone2/'+this.docs.adv_file
            },
            Alert(icon, title) {
                toast.fire({
                    icon: icon,
                    title: title,
                })
            },
            ...mapActions(["getCapstone1SubmittedDocs"])
        },
        computed: mapGetters(['getadminDashboard', 'groupinfo', 'getcaps1submitteddocs']),
    }

</script>
