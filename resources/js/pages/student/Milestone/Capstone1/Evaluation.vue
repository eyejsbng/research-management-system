<template>
    <div class="row">
        <div class="col-md-12">
            <h4 class="text-center">Title/Outline Defense Evaluation Form</h4>
            <div class="alert alert-warning text-center" v-if="grp.caps1 == 2">
                <span>
                    Check if the Panel Revised your Documents. <br>
                    Download the revised file by the panel. <br>
                    Revised then upload.
                </span>
            </div>
        </div>
        <div class="col-md-12 mr-auto ml-auto" v-for="e in getcaps1evalution.eval1" :key="e.dt_id">
            <div class="card" v-if="e.dt_status != 4">
                <div class="card-header text-center">
                    {{ e.name }} Submission History
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hovered">
                            <thead class="text-info">
                                <tr>
                                    <td><strong>Rev. #</strong></td>
                                    <td><strong>Chapter</strong></td>
                                    <td><strong>Date Submitted</strong></td>
                                    <td><strong>File</strong></td>
                                    <td><strong>Status</strong></td>
                                    <td><strong>Action</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(revise, index) in getcaps1revisefile.revise1" :key="revise.rev_id">
                                    <td v-if="revise.rev_panID == e.dt_panID">{{ revise.rev_revID }}</td>
                                    <td v-if="revise.rev_panID == e.dt_panID">{{ revise.rev_document }}</td>
                                    <td v-if="revise.rev_panID == e.dt_panID">{{ revise.rev_date }}</td>
                                    <td v-if="revise.rev_panID == e.dt_panID"><a :href="path" @click="GetPath(revise.rev_panfile)">{{ revise.rev_panfile }}</a></td>
                                    <td v-if="revise.rev_panID == e.dt_panID">{{ revise.ss_title }}</td>
                                    <td v-if="revise.rev_panID == e.dt_panID">
                                        <button class="btn btn-info btn-round btn-sm" @click="OpenModal(index)" v-if="revise.rev_grpfile == null && revise.rev_status == 1">Revise</button>
                                        <button class="btn btn-info btn-round btn-sm" @click="UpdateModal(index)" v-if="revise.rev_grpfile != null && revise.rev_status == 1">Update</button>
                                        <button class="btn btn-link btn-sm btn-info" v-if="revise.rev_status != 1" disabled>Panel Already Check!</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
                                    <div class="col-md-12 text-center">
                                        <div class="alert alert-warning text-center" v-if="update == true">
                                            <span>
                                                Select Another File if you want to Update File. <br>
                                                You Can Download your file. <br>
                                                <a :href="path" @click="GroupDL" class="btn btn-info btn-round">Download File</a>
                                            </span>
                                        </div>
                                        <div class="form-group">
                                            <label>Panel Comment</label>
                                            <textarea v-model="revise.rev_comment" class="form-control text-center" disabled></textarea>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col-md-12">
                                        <div class="form-group form-file-upload form-file-simple">
                                            <label>Submit File</label>
                                            <input v-model="filename" type="text" class="form-control inputFileVisible"
                                                placeholder="Choose your file...">
                                            <input @change="updatefiles" type="file" class="inputFileHidden">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Comment</label>
                                            <textarea v-model="comment" class="form-control"
                                                placeholder="Add Comment to the group"></textarea>
                                        </div>
                                    </div>
                                     <div class="col-md-12" v-if="update == true">
                                        <div class="form-group">
                                            <label>Date Submitted</label>
                                            <input type="text" class="form-control" disabled v-model="revise.rev_grpdate">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mr-auto ml-auto">
                                        <button v-if="update == false" class="btn btn-info btn-round btn-block" :disabled="loading == true"
                                            @click="Sendfile">Send</button>
                                        <button v-if="update == true" class="btn btn-info btn-round btn-block" :disabled="loading == true"
                                            @click="Updatefile">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>

            </div>
            <div class="card" v-if="e.dt_status == 4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <p>{{ e.name }}</p>
                            <label>Panel Name</label>
                        </div>
                        <div class="col-md-4">
                            <p v-if="e.dt_recommendation == null">Not yet check</p>
                            <p v-if="e.dt_recommendation == 1">Approved</p>
                            <p v-if="e.dt_recommendation == 2">Approved with Minor revision</p>
                            <p v-if="e.dt_recommendation == 3">Approved with Major revision</p>
                            <p v-if="e.dt_recommendation == 4">Rejected</p>
                            <label>Recommendation</label>
                        </div>
                        <div class="col-md-4">
                            <p v-if="e.dt_date == null">Not yet check</p>
                            <p>{{ e.dt_date }}</p>
                            <label>Date of Evaluation</label>
                        </div>
                        <div class="col-md-12 table-responsive">
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
                                            {{ e.dt_sintro }}
                                        </td>
                                        <td>
                                            25%
                                        </td>
                                        <td>
                                            {{ e.dt_pintro }}
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
                                            {{ e.dt_srelated }}
                                        </td>
                                        <td>
                                            20%
                                        </td>
                                        <td>
                                            {{ e.dt_prelated }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Technical Background</strong> <br>
                                            Include in-depth discussion on relevant technical <br>
                                            aspects of the project.
                                        </td>
                                        <td>
                                            {{ e.dt_stechnical }}
                                        </td>
                                        <td>
                                            15%
                                        </td>
                                        <td>
                                            {{ e.dt_ptechnical }}
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
                                            {{ e.dt_sgeneral }}
                                        </td>
                                        <td>
                                            20%
                                        </td>
                                        <td>
                                            {{ e.dt_pgeneral }}
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
                                            {{ e.dt_soral }}
                                        </td>
                                        <td>
                                            20%
                                        </td>
                                        <td>
                                            {{ e.dt_poral }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>TOTAL</strong> <br>
                                        </td>
                                        <td>
                                            {{ e.dt_stotal }}
                                        </td>
                                        <td>
                                            100%
                                        </td>
                                        <td>
                                            {{ e.dt_ptotal }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-8 mr-auto ml-auto">
                            <div class="form-group text-center">
                                <label>Comment</label>
                                <textarea v-model="e.dt_comments" class="form-control" disabled></textarea>
                            </div>
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
        props: ['getcaps1evalution','user','grp'],
        data(){
            return{
                path:'',
                file:'',
                filename:'',
                comment:'',

                loading: false,
                update: false,
                revise: {},

            }
        },
        methods:{
            GetPath(str){
                this.path = '../app/myfiles/Panelfiles/'+str
            },
            GroupDL(){
                this.path = '../app/myfiles/Submittedfiles/Capstone1/'+this.revise.rev_grpfile
            },
            OpenModal(index){
                $('#mdlRevise').modal('show')
                this.revise = this.getcaps1revisefile.revise1[index]
            },
            UpdateModal(index){
                this.OpenModal(index)
                this.comment = this.revise.rev_grpcomment
                this.update = true
            },
            CloseModal(){
                $('#mdlRevise').modal('hide')
                this.filename = ''
                this.file = ''
                this.comment = ''
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
                formdata.append('date', date)
                formdata.append('chapter', 'Chapter1to6' )
                formdata.append('comment', this.comment)
                formdata.append('file', this.file)
                formdata.append('rev_id', this.revise.rev_id)
                formdata.append('group', this.grp.grp_title)
                formdata.append('id', this.revise.rev_panID)
                formdata.append('rev_revID', this.revise.rev_revID)
                formdata.append('standing', 1)
                axios.post('../api/groupsubmitrevisetopanel', formdata, config).then(res => {
                    if(res.data.message == 'success'){
                        this.Alert('success', 'Successfully Send')
                        this.Clear()
                    }
                    else{
                        this.loading = false
                        this.Alert('info', res.data.message)
                    }
                })


            },
            Updatefile(){
                this.loading = true
                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
                if(this.comment == this.revise.rev_grpcomment && this.file == ''){
                    this.loading = false
                    return this.Alert('info', 'Nothing Changes')
                }
                let formdata = new FormData()
                let date = moment(Date.now()).format('YYYY-MM-DD hh:mm')
                formdata.append('date', date)
                formdata.append('filename', this.revise.rev_grpfile)
                formdata.append('file', this.file)
                formdata.append('comment', this.comment)
                formdata.append('rev_id', this.revise.rev_id)
                formdata.append('standing', 1)
                axios.post('../api/updategroupsubmitrevisetopanel', formdata, config).then(res => {
                    if(res.data.message == 'success'){
                        this.Alert('success', 'Successfully Send')
                        this.Clear()
                    }
                    else{
                        this.loading = false
                        this.Alert('info', res.data.message)
                    }
                })

            },
            Clear(){
                this.loading = false
                var req = {
                    grp : this.user.grp_id,
                    id : '',
                }
                this.getCapstone1ReviseFile(req)
                this.CloseModal()
            },
            Alert(icon, title) {
                toast.fire({
                    icon: icon,
                    title: title,
                })
            },
            ...mapActions(['getCapstone1ReviseFile'])
        },
        created(){
            this.Clear()
        },
        computed: mapGetters(['getcaps1revisefile']),
    }

</script>
