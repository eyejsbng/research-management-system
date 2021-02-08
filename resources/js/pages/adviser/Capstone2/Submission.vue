<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <h4 class="title text-center">Adviser Submission</h4>
            </div>
            <div class="col-md-12">
                <h5 class="title text-center">Chapter History</h5>
                <div class="table-responsive">
                    <table class="table table-hovered">
                        <thead>
                            <tr class="text-info">
                                <td><strong>Revision #</strong></td>
                                <td><strong>Documents</strong></td>
                                <td><strong>Date Submitted</strong></td>
                                <td><strong>Date Check</strong></td>
                                <td><strong>Submitted By</strong></td>
                                <td><strong>Status</strong></td>
                                <td><strong>Action</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(docs, index) in getcaps1checkdocs.document2" :key="docs.dcs_id">
                                <td>{{ docs.dcs_revID }}</td>
                                <td><a :href="'../app/myfiles/Submittedfiles/Capstone2/'+docs.dcs_file">{{ docs.dcs_document }}</a></td>
                                <td>{{ docs.dcs_date }}</td>
                                <td v-if="docs.adv_date == null">Not yet check</td>
                                <td v-if="docs.adv_date != null">{{docs.adv_date}}</td>
                                <td>{{ docs.submitby }}</td>
                                <td>{{ docs.ss_title }}</td>
                                <td>
                                    <button v-if="docs.dcs_status == 1" @click="Check(index)"
                                        class="btn btn-info btn-round btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <p v-if="docs.dcs_status != 1" class="text-info">Already checked</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-8 mr-auto ml-auto" v-if="isCheck == true && docs.ss_title != 'Approved'">
                <div class="card">
                    <div class="card-header">
                        <h4 v-if="UpdateCheck == false" class="card-title text-center">
                            Check Documents Rev. # {{ docs.dcs_revID }} <br>
                            <a class="btn btn-info btn-round" :href="path">Download file</a>
                        </h4>
                        <h4 v-if="UpdateCheck == true" class="card-title text-center">
                            Update Documents Rev. # {{ docs.dcs_revID }} <br>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-warning">
                            <span v-if="UpdateCheck == false">
                                Download thier file. <br>
                                Make Decission, Accept or Revise. <br>
                                If revise add comment to thier file and upload it. <br>
                                Submit only MS Word.
                            </span>
                            <span v-if="UpdateCheck == true">
                                Update your decission, Accept or Revise. <br>
                                If revise add comment to thier file and upload it. <br>
                                Submit only MS Word.
                            </span>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>File</label>
                                    <input v-model="filename" type="text" class="form-control inputFileVisible"
                                        placeholder="Choose your file...">
                                    <input @change="updatefiles" type="file" class="inputFileHidden">
                                </div>
                                <p class="text-primary" style="font-size:12px;">
                                    {{ error.file }}</p>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Additional Comment</label>
                                    <textarea v-model="comment" class="form-control" id="validationTextarea"
                                        placeholder="Add your Additional Comment."></textarea>
                                </div>
                                <p class="text-primary" style="font-size:12px;">
                                    {{ error.comment }}</p>
                            </div>
                            <div class="col-md-6 mt-2">
                                <button @click="Sendfile('revise')" :disabled="loading == true"
                                    class="btn btn-primary btn-round btn-block">Revise</button>
                            </div>
                            <div class="col-md-6 mt-2">
                                <button @click="Sendfile('accept')" :disabled="loading == true"
                                    class="btn btn-info btn-round btn-block">
                                    <span v-if="loading == true" class="spinner-grow spinner-grow-sm" role="status"
                                        aria-hidden="true"></span>
                                    Accept
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <h5 class="title text-center">Grammarly Report</h5>
                <div class="row" v-if="getcaps1grammarly.grammar">
                    <div class="col-md-8 mr-auto ml-auto"
                        v-if="grp.caps2 == 3 && getcaps1grammarly.grammar2.length == 0">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="alert alert-primary">
                                    <span>
                                        Download the Approved File. <br>
                                        Grammarly the file. <br>
                                        And Upload the file with the Percentage. <br>
                                        <a :href="path" @click="FileDL" class="btn btn-info btn-round btn-sm">Download
                                            File</a>
                                    </span>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>File</label>
                                            <input v-model="filename" type="text" class="form-control inputFileVisible"
                                                placeholder="Choose your file...">
                                            <input @change="updatefiles" type="file" class="inputFileHidden">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Percentage</label>
                                            <input v-model="percentage" type="number" min="1" max="100"
                                                placeholder="Enter Grammarly Percentage" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mr-auto ml-auto">
                                        <button @click="UploadGrammarly"
                                            class="btn btn-info btn-round btn-block">Upload</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-hovered">
                                <thead class="text-info text-center">
                                    <tr>
                                        <td><strong>Document</strong></td>
                                        <td><strong>Date Check</strong></td>
                                        <td><strong>Percentage</strong></td>
                                        <td><strong>Download</strong></td>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr v-for="g in getcaps1grammarly.grammar2" :key="g.gra_id">
                                        <td>{{ g.gra_document }}</td>
                                        <td>{{ g.gra_date }}</td>
                                        <td>{{ g.gra_percent }}%</td>
                                        <td><a @click="GrammarlyDL(g.gra_file)" :href="path">download</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import {
        mapGetters,
        mapActions
    } from 'vuex'
    export default {
        props: ['user', 'grp'],
        data() {
            return {
                path: '',
                isCheck: false,
                UpdateCheck: false,
                loading: false,

                docs: {},
                error: {},
                file: '',
                filename: '',
                comment: '',
                percentage: '',

                finaldocs: '',
            }
        },
        methods: {
            GetDocument() {
                let req = {
                    grp_id: this.grp.grp_id,
                    id: this.user.id
                }
                this.getCapstone1checkDocs(req)
                axios.get('../api/finaldocuments/' + this.grp.grp_id).then(res => {
                    this.finaldocs = res.data.final[0]
                })
            },
            FileDL() {
                this.path = '../app/myfiles/Submittedfiles/Capstone2/' + this.finaldocs.fin_file
            },
            GrammarlyDL(str) {
                this.path = '../app/myfiles/Adviserfiles/Grammarly/' + str
            },
            Check(index) {
                this.isCheck = true
                this.docs = this.getcaps1checkdocs.document2[index]
                this.path = '../app/myfiles/Submittedfiles/Capstone2/' + this.docs.dcs_file

                if (index > 0) {
                    this.isCheck = false
                } else if (this.docs.dcs_status != 1) {
                    this.UpdateCheck = true
                    this.comment = this.docs.adv_comment
                } else {
                    this.UpdateCheck = false
                }

            },
            updatefiles(e) {
                let file = e.target.files[0];
                let reader = new FileReader();
                if (file['size'] < 10111775) {
                    // console.log(file)
                    if (file['type'] ==
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
            Sendfile(type) {
                this.loading = true
                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
                let formdata = new FormData()
                let date = moment(Date.now()).format('YYYY-MM-DD hh:mm')
                formdata.append('dcs_id', this.docs.dcs_id)
                formdata.append('adv_date', date)
                formdata.append('file', this.file)
                formdata.append('comment', this.comment)
                formdata.append('name', this.user.name)
                formdata.append('group', this.grp.grp_title)
                formdata.append('grp_id', this.grp.grp_id)
                formdata.append('filename', this.docs.dcs_file)
                formdata.append('standing', 2)
                if (type == 'accept') {
                    formdata.append('dcs_status', 4)
                    axios.post('../api/advisercheckcaps1docs', formdata, config).then(res => {
                        if (res.data.message == 'success') {
                            this.Alert('success', 'Successfully Checked')
                            this.ClearAdiverCheck()
                            this.grp.caps1 = 1
                        } else {
                            this.loading = false
                            this.Alert('info', res.data.message)
                        }
                    })
                } else {
                    formdata.append('dcs_status', 3)
                    axios.post('../api/advisercheckcaps1docs', formdata, config).then(res => {
                        if (res.data.message == 'success') {
                            this.Alert('success', 'Successfully Checked')
                            this.ClearAdiverCheck()
                        } else {
                            this.loading = false
                            this.Alert('info', res.data.message)
                        }
                    }).catch(err => {
                        this.loading = false
                        if (err.response.status == 422) {
                            this.error = err.response.data.errors
                        }
                    })
                }
            },
            ClearAdiverCheck() {
                this.loading = false
                this.isCheck = false
                this.UpdateCheck = false
                this.error = {}
                this.file = ''
                this.filename = ''
                this.comment = ''
                let req = {
                    grp_id: this.grp.grp_id,
                    id: this.user.id
                }
                this.getCapstone1checkDocs(req)
            },
            UploadGrammarly() {
                this.loading = true
                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
                let formdata = new FormData()
                let date = moment(Date.now()).format('YYYY-MM-DD hh:mm')
                formdata.append('grp_id', this.grp.grp_id)
                formdata.append('grp_title', this.grp.grp_title)
                formdata.append('date', date)
                formdata.append('id', this.user.id)
                formdata.append('document', 'Grammarly 2')
                formdata.append('percentage', this.percentage)
                formdata.append('file', this.file)
                formdata.append('standing', 2)
                axios.post('../api/uploadgrammarly', formdata, config).then(res => {
                    if (res.data.message == 'success') {
                        this.ClearGrammarly()
                    } else {
                        this.loading = false
                        this.Alert('info', res.data.message)
                    }
                })
            },
            ClearGrammarly() {
                this.loading = false
                this.Alert('success', 'Successfully Uploaded')
                this.file = ''
                this.filename = ''
                this.percentage = ''
                this.getCapston1Grammarly(this.grp.grp_id)
            },
            Alert(icon, title) {
                toast.fire({
                    icon: icon,
                    title: title,
                })
            },
            ...mapActions(["getCapstone1checkDocs", "getCapston1Grammarly"])
        },
        created() {
            this.GetDocument()
        },
        computed: mapGetters(['getcaps1checkdocs', 'getcaps1checksys', 'getcaps1grammarly']),
    }

</script>
