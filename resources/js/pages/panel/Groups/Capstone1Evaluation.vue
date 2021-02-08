<template>
    <div v-if="getcaps1evalution.eval1 && getcaps1revisefile.revise1">
        <div class="row" v-if="getcaps1evalution.eval1[0].dt_status != 4 && grp.caps1 != 0">
            <div class="col-md-12">
                <h4 class="title text-center">Chapter 1 to 3 Document Checking</h4>
                <p class="text-center">Thesis/Capstone 1</p>
                <div class="row">
                    <div class="col-md-6 mr-auto ml-auto">
                        <div class="alert alert-warning text-center">
                            <span>
                                Download approved documents by their Adivser. <br>
                                Decide if the documents are approved or revised to you. <br>
                                If revised, add a comments to their file and upload. <br>
                                Wait for the Student to Revise the file. <br>
                            </span>
                            <span v-if="getcaps1revisefile.revise1.length == 0">
                                <a :href="path" @click="FileDL" class="btn btn-info btn-round">Download File</a>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-12 mr-auto ml-auto">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title text-center">Panel List Decission</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4" v-for="pan in panellist" :key="pan.dt_id">
                                        <p class="text-center">{{pan.ss_title}}</p>
                                        <h6 class="text-center">{{ pan.name }}</h6>
                                    </div>
                                    <div class="col-md-12" v-if="getcaps1revisefile.revise1.length > 0">
                                        <h5 class="text-center">Submission History</h5>
                                        <div class="table-responsive">
                                            <table class="table table-hovered">
                                                <thead class="text-info">
                                                    <tr>
                                                        <td><strong>rev. #</strong></td>
                                                        <td><strong>Document</strong></td>
                                                        <td><strong>Name</strong></td>
                                                        <td><strong>Date Submitted</strong></td>
                                                        <td><strong>file</strong></td>
                                                        <td><strong>Status</strong></td>
                                                        <td><strong>Action</strong></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(revise,index) in getcaps1revisefile.revise1" :key="revise.rev_id">
                                                        <td>{{ revise.rev_revID }}</td>
                                                        <td>{{ revise.rev_document }}</td>
                                                        <td>{{ revise.name }}</td>
                                                        <td>{{ revise.rev_date }}</td>
                                                        <td><a :href="path" @click="GetPath(revise.rev_panfile)">{{ revise.rev_panfile }}</a></td>
                                                        <td>{{ revise.ss_title }}</td>
                                                        <td>
                                                            <button v-if="revise.rev_grpfile == null && revise.rev_status == 1 && revise.rev_panID == user.id" @click="UpdateModal(index)" class="btn btn-info btn-sm btn-round">Update</button>
                                                            <button v-if="revise.rev_grpfile != null && revise.rev_status == 1" @click="Show(index)" class="btn btn-info btn-sm btn-round">Show</button>
                                                            <button class="btn btn-link btn-info btn-sm" disabled v-if="revise.rev_status != 1">Already Checked</button>
                                                            <button class="btn btn-link btn-info btn-sm" disabled v-if="revise.rev_panID != user.id && revise.rev_grpfile == null">N/A</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row" v-if="showrevise == true">
                                    <div class="col-md-12">
                                        <h5 class="text-center">Group Revised File</h5>
                                        <div class="row text-center">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <a :href="path" @click="ReviseDL">{{ revise.rev_grpfile }}</a> <br>
                                                    <label>File</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <a>{{ revise.rev_grpdate }}</a> <br>
                                                    <label>Date Submitted</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <a>{{ revise.rev_grpcomment }}</a> <br>
                                                    <label>Comment</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" v-if="getcaps1evalution.eval1[0].dt_status == 1 || showrevise == true && revise.rev_panID == user.id" >
                                    <div class="col-md-12">
                                        <h5 class="text-center">Your Decission</h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button @click="Decission(3)"
                                                    class="btn btn-primary btn-round btn-block">Revise</button>
                                            </div>
                                            <div class="col-md-6">
                                                <button @click="Decission(4)"
                                                    class="btn btn-info btn-round btn-block">Approve</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" data-backdrop="static" data-keyboard="false" id="mdlRevise">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header justify-content-center">
                                <button type="button" class="close" @click="CloseModal">&times;</button>
                                <h5 class="title" v-if="update == false">Submit Revise File</h5>
                                <h5 class="title" v-if="update == true">Update Revise File</h5>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-warning text-center" v-if="update == true">
                                            <span>
                                                Since the Group are not already Submit their revise Docs, you can Update your file. <br>
                                                You can Download your file in the table. <br>
                                                Select another file if you want to update file. <br>
                                            </span>
                                        </div>
                                        <div class="form-group form-file-upload form-file-simple">
                                            <label>Submit File</label>
                                            <input v-model="filename" type="text" class="form-control inputFileVisible"
                                                placeholder="Choose your file...">
                                            <input @change="updatefiles" type="file" class="inputFileHidden">
                                        </div>
                                        <p style="font-size:12px;color:red">{{ error.file }}</p>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Comment</label>
                                            <textarea v-model="comment" class="form-control"
                                                placeholder="Add Comment to the group"></textarea>
                                        </div>
                                        <p style="font-size:12px;color:red">{{ error.comment }}</p>
                                    </div>
                                    <div class="col-md-6 mr-auto ml-auto">
                                        <button v-if="update == false" class="btn btn-info btn-round btn-block" :disabled="loading == true"
                                            @click="Sendfile">Send</button>
                                        <button v-if="update == true" class="btn btn-info btn-round btn-block" :disabled="loading == true"
                                            @click="UpdateFile">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" v-if="getcaps1evalution.eval1[0].dt_status == 4">
            <div class="col-md-12">
                <h4 class="title text-center">Title/Outline Defense Evaluation Form</h4>
                <p class="text-center">Thesis/Capstone 1</p>
                <div class="card">
                    <div class="card-header">
                        <button class="btn btn-link btn-block text-center mb-0" data-toggle="collapse"
                            data-target="#instruction">
                            Instructions
                        </button>
                    </div>
                    <div id="instruction" class="collapse show">
                        <div class="card-body text-center">
                            <div class="alert alert-warning">
                                Enclosed are the criteria-indicators and rating scale to help you evaluate the
                                various <br>
                                components of this thesis work. Please read the criteria carefully and place the
                                <br>
                                corresponding score of each item on the blank provided for. Multiply the score with
                                its <br>
                                corresponding weight and enter it on last column. Add the points in the last column
                                to <br>
                                compute the final grade. Space is provided for your comments at the bottom of the
                                page. <br>
                                Thank you.
                            </div>
                            <div class="alert alert-primary">
                                <span>
                                    Don't forget to click the <strong>Evaluate</strong> button to save your evaluation.
                                </span>
                            </div>
                            <h6 class="text-center">Rating Scale</h6>
                            <div class="table-responsive">
                                <table class="table table-hovered">
                                    <thead class="text-center">
                                        <tr>
                                            <td><strong>Score</strong></td>
                                            <td><strong>Equivalent</strong></td>
                                            <td><strong>Narative Description</strong></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="rate in rating" :key="rate.rs_id">
                                            <td>{{ rate.rs_score }}</td>
                                            <td>{{ rate.rs_equivalent }}</td>
                                            <td>{{ rate.rs_narrative }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="text-center text-info">
                            <tr>
                                <td><strong>Criterion</strong></td>
                                <td><strong>Score</strong></td>
                                <td><strong>Weight</strong></td>
                                <td><strong>Points</strong></td>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr>
                                <td>
                                    <strong>Introduction</strong> <br>
                                    An Exposition on the Project Context, Purpose and <br>
                                    Description of the study are given. The objectives are <br>
                                    specific, measurable, achievable, realistic and time-bound. <br>
                                    The scope and deliminations of the study are clearly <br>
                                    explained.
                                </td>
                                <td>
                                    <input @keyup="SetScore(1)" v-model="getcaps1evalution.eval1[0].dt_sintro" type="number"
                                        class="form-control text-center" placeholder="1-100">
                                </td>
                                <td>
                                    25%
                                </td>
                                <td>
                                    {{ getcaps1evalution.eval1[0].dt_pintro }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Related Literature</strong> <br>
                                    There is evidence that the writer made a scholarly attempt<br>
                                    to find his precursors in the field. The review provides <br>
                                    relevant discussion on the theories, concepts, facts, and/or <br>
                                    ideas related to the subject. The materials are current,<br>
                                    adequate and carefully selected. A Synthesis is provided at <br>
                                    the end of the section describing the review's significance.
                                </td>
                                <td>
                                    <input @keyup="SetScore(2)" v-model="getcaps1evalution.eval1[0].dt_srelated" type="number"
                                        class="form-control text-center" placeholder="1-100">
                                </td>
                                <td>
                                    20%
                                </td>
                                <td>
                                    {{ getcaps1evalution.eval1[0].dt_prelated }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Technical Background</strong> <br>
                                    Include in-depth discussion on relevant technical <br>
                                    aspects of the project.
                                </td>
                                <td>
                                    <input @keyup="SetScore(3)" v-model="getcaps1evalution.eval1[0].dt_stechnical"
                                        type="number" class="form-control text-center" placeholder="1-100">
                                </td>
                                <td>
                                    15%
                                </td>
                                <td>
                                    {{ getcaps1evalution.eval1[0].dt_ptechnical }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>General Form</strong> <br>
                                    The manuscript is very well-organized and contains<br>
                                    all the main requisites of a typical thesis manuscipt. <br>
                                    The prescribed rules on the format, spacing, pagination, <br>
                                    tables and figures are strictly followed. Mechanics of <br>
                                    writing is satisfactory. The style is impersonal, straight <br>
                                    forward, objective and effective.
                                </td>
                                <td>
                                    <input @keyup="SetScore(4)" v-model="getcaps1evalution.eval1[0].dt_sgeneral" type="number"
                                        class="form-control text-center" placeholder="1-100">
                                </td>
                                <td>
                                    20%
                                </td>
                                <td>
                                    {{ getcaps1evalution.eval1[0].dt_pgeneral }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Oral Presentation</strong> <br>
                                    Oral presentation is methodical, rational and <br>
                                    coherent. It is brief but complete. Appropriate and <br>
                                    attractive visual aids are used. Presenters are <br>
                                    articulate and questions are answered satisfactorily.
                                </td>
                                <td>
                                    <input @keyup="SetScore(5)" v-model="getcaps1evalution.eval1[0].dt_soral" type="number"
                                        class="form-control text-center" placeholder="1-100">
                                </td>
                                <td>
                                    20%
                                </td>
                                <td>
                                    {{ getcaps1evalution.eval1[0].dt_poral }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>TOTAL</strong> <br>
                                </td>
                                <td>
                                    {{ getcaps1evalution.eval1[0].dt_stotal }}
                                </td>
                                <td>
                                    100%
                                </td>
                                <td>
                                    {{ getcaps1evalution.eval1[0].dt_ptotal }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Comments:</label>
                    <textarea v-model="getcaps1evalution.eval1[0].dt_comments" class="form-control"></textarea>
                </div>
            </div>
            <div class="col-md-12">
                <label>Recommendation:</label>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input v-model="getcaps1evalution.eval1[0].dt_recommendation" true-value="1" type="checkbox"
                                    class="form-check-input">
                                <span class="form-check-sign"></span>
                                Accepted
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input v-model="getcaps1evalution.eval1[0].dt_recommendation" true-value="2" type="checkbox"
                                    class="form-check-input">
                                <span class="form-check-sign"></span>
                                Accepted with Minor revision
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input v-model="getcaps1evalution.eval1[0].dt_recommendation" true-value="3" type="checkbox"
                                    class="form-check-input">
                                <span class="form-check-sign"></span>
                                Accepted with Major revision
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input v-model="getcaps1evalution.eval1[0].dt_recommendation" true-value="4" type="checkbox"
                                    class="form-check-input">
                                <span class="form-check-sign"></span>
                                Rejected
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mr-auto ml-auto mt-5">
                <button @click="Evaluate" v-if="grp.caps1 == 2" class="btn btn-info btn-round btn-block">
                    <i class="fas fa-check"></i>
                    Evaluate
                </button>
                <p v-if="grp.caps1 < 2" class="text-center text-primary" style="font-size:12px;">
                    Wait for the Adviser to Check thier System
                </p>
                <p v-if="grp.caps1 > 2" class="text-center text-primary" style="font-size:12px;">
                    Panels Already Evaluate the Documents
                </p>
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
        props: ['rating', 'user', 'grp'],
        data() {
            return {
                panellist: {},
                finaldocs: {},
                path: '',

                file: '',
                filename: '',
                comment: '',
                revise: {},

                rev_id: '',

                loading: false,
                showrevise:false,
                update:false,
                error: {},
            }
        },
        methods: {
            GetPanelListDecission() {
                var req = {
                    grp: this.grp.grp_id,
                    id: ''
                }
                var req1 = {
                    grp: this.grp.grp_id,
                    id: this.user.id
                }
                axios.post('../api/getcapstone1evaluation', req).then(res => {
                    this.panellist = res.data.eval1
                })
                axios.get('../api/finaldocuments/' + this.grp.grp_id).then(res => {
                    this.finaldocs = res.data.final[0]
                })
                // this.getCapstone1ReviseFile(req1)
            },
            FileDL() {
                this.path = '../app/myfiles/Submittedfiles/Capstone1/' + this.finaldocs.fin_file
            },
            ReviseDL() {
                this.path = '../app/myfiles/Submittedfiles/Capstone1/' + this.revise.rev_grpfile
            },
            GetPath(str){
                this.path = '../app/myfiles/Panelfiles/'+str
            },
            Decission(status) {
                if (status == 3) {
                    $('#mdlRevise').modal('show')
                } else {
                    let date = moment(Date.now()).format('YYYY-MM-DD hh:mm')
                    axios.post('../api/decissionsubmission', {
                        id: this.user.id,
                        grp: this.grp.grp_id,
                        status: status,
                        standing: 1,
                        rev_id: this.rev_id,
                        filename: this.revise.rev_grpfile,
                        grp: this.grp.grp_id,
                        date: date,
                    }).then(res => {
                        if (res.data.message == 'success') {
                            this.Alert('success', 'Successfully Approved')
                            this.getcaps1evalution.eval1[0].dt_status = 4
                            this.GetPanelListDecission()
                        } else {
                            this.Alert('info', res.data.message)
                        }
                    })
                }
            },
            UpdateModal(index){
                this.revise = this.getcaps1revisefile.revise1[index]
                this.comment = this.revise.rev_comment
                $('#mdlRevise').modal('show')
                this.update = true
            },
            Show(index){
                this.revise = this.getcaps1revisefile.revise1[index]
                this.showrevise = true
                this.rev_id = this.revise.rev_id
            },
            CloseModal() {
                $('#mdlRevise').modal('hide')
                this.update = false
            },
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
            Sendfile() {
                this.loading = true
                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
                let formdata = new FormData()
                let date = moment(Date.now()).format('YYYY-MM-DD hh:mm')
                let chapter = 'Chapter1to3'
                formdata.append('date', date)
                formdata.append('chapter', chapter)
                formdata.append('id', this.user.id)
                formdata.append('grp', this.grp.grp_id)
                formdata.append('file', this.file)
                formdata.append('comment', this.comment)
                formdata.append('name', this.user.name)
                formdata.append('group', this.grp.grp_title)
                formdata.append('rev_id', this.rev_id)
                formdata.append('standing', 1)
                axios.post('../api/panelsendreviserfile', formdata, config).then(res => {
                    if (res.data.message == 'success') {
                        this.Clear()
                    }
                    else{
                        this.loading = false
                        this.Alert('info', res.data.message)
                    }
                })
            },
            UpdateFile(){
                this.loading = true
                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
                if(this.comment == this.revise.rev_comment && this.file == ''){
                    this.loading = false
                    return this.Alert('info', 'Nothings Change')
                }
                let formdata = new FormData()
                let date = moment(Date.now()).format('YYYY-MM-DD hh:mm')
                formdata.append('rev_id', this.revise.rev_id)
                formdata.append('date', date)
                formdata.append('comment', this.comment)
                formdata.append('file', this.file)
                formdata.append('filename', this.revise.rev_panfile)
                axios.post('../api/updatepanelsendreviserfile', formdata , config).then(res => {
                    if (res.data.message == 'success') {
                        this.Clear()
                    }
                    else{
                        this.loading = false
                        this.Alert('info', res.data.message)
                    }
                })

            },
            Clear(){
                var req1 = {
                    grp: this.grp.grp_id,
                    id: ''
                }
                this.file = ''
                this.filename = ''
                this.update = false
                this.error = {}
                this.loading = false
                this.showrevise = false
                this.getcaps1evalution.eval1[0].dt_status = 3

                this.Alert('success', 'Successfully Send')
                this.getCapstone1ReviseFile(req1)
                this.GetPanelListDecission()
                $('#mdlRevise').modal('hide')
            },
            SetScore(s) {
                if (s == 1) {
                    this.getcaps1evalution.eval1[0].dt_pintro = Number(this.getcaps1evalution.eval1[0].dt_sintro * .25);
                    this.SetTotal()
                } else if (s == 2) {
                    this.getcaps1evalution.eval1[0].dt_prelated = Number(this.getcaps1evalution.eval1[0].dt_srelated * .20);
                    this.SetTotal()
                } else if (s == 3) {
                    this.getcaps1evalution.eval1[0].dt_ptechnical = Number(this.getcaps1evalution.eval1[0].dt_stechnical *
                        .15);
                    this.SetTotal()
                } else if (s == 4) {
                    this.getcaps1evalution.eval1[0].dt_pgeneral = Number(this.getcaps1evalution.eval1[0].dt_sgeneral * .20);
                    this.SetTotal()
                } else if (s == 5) {
                    this.getcaps1evalution.eval1[0].dt_poral = Number(this.getcaps1evalution.eval1[0].dt_soral * .20);
                    this.SetTotal()
                }
            },
            SetTotal() {
                this.getcaps1evalution.eval1[0].dt_stotal = Number(this.getcaps1evalution.eval1[0].dt_sintro) + Number(this
                        .getcaps1evalution.eval1[0].dt_srelated) +
                    Number(this.getcaps1evalution.eval1[0].dt_stechnical) + Number(this.getcaps1evalution.eval1[0].dt_sgeneral) +
                    Number(this.getcaps1evalution.eval1[0].dt_soral)
                this.getcaps1evalution.eval1[0].dt_ptotal = Number(this.getcaps1evalution.eval1[0].dt_pintro) + Number(this
                        .getcaps1evalution.eval1[0].dt_prelated) +
                    Number(this.getcaps1evalution.eval1[0].dt_ptechnical) + Number(this.getcaps1evalution.eval1[0].dt_pgeneral) +
                    Number(this.getcaps1evalution.eval1[0].dt_poral)
            },
            Evaluate() {
                axios.post('../api/panelevaluation1', this.getcaps1evalution.eval1[0]).then(res => {
                    if (res.data.message == 'success') {
                        this.Alert('success', 'Successfully Evaluated')
                        if (res.data.updated == 'updated') {
                            this.grp.caps1 = 3;
                        }
                    } else {
                        this.Alert('info', res.data.message)
                    }
                }).catch(err => {
                    if (err.response.status == 422) {
                        this.Alert('info', 'Make sure your input is within the range of 70-100!')
                    }
                })
            },
            Alert(icon, title) {
                toast.fire({
                    icon: icon,
                    title: title,
                })
            },
            ...mapActions(['getCapstone1ReviseFile'])
        },
        computed: mapGetters(['getcaps1evalution','getcaps1revisefile']),
        created() {
            this.GetPanelListDecission()
        }
    }

</script>
<style scoped>
    table td {
        position: relative;
    }

    table td input {
        position: absolute;
        display: block;
        top: 0;
        left: 0;
        margin: 0;
        height: 100%;
        width: 100%;
        border: none;
        padding: 10px;
        box-sizing: border-box;
    }

</style>
