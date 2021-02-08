<template>
    <div>
        <h4 class="title text-center">Turnitin</h4>
        <div class="row">
            <div class="col-md-8 mr-auto ml-auto">
                <div class="alert alert-warning text-center">
                    <span v-if="grp.caps1 == 3">
                        Download the Grammarly File and Plagiarise the file.<br>
                        Upload the Plagiarized file with percentage.
                    </span>
                     <span v-if="grp.caps1 > 3">
                         Files Already Plagiarized.
                    </span>
                </div>
            </div>
            <div class="col-md-8 mr-auto ml-auto" v-if="grp.caps1 == 3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-center">Upload Plagiarized File</h5>
                    </div>
                    <div class="card-body">
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
                    </div>
                    <div class="card-body">
                        <button :disabled="loading == true" @click="UploadPlagiarism" class="btn btn-info btn-round btn-block">Upload</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mr-auto ml-auto">
                <h5 class="text-center">Approved Chapter 1 to 3</h5>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hovered">
                                <thead class="text-center text-info">
                                    <tr>
                                        <td><strong>Document</strong></td>
                                        <td><strong>Status</strong></td>
                                        <td><strong>Download</strong></td>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr v-for="d in getcaps1checkdocs.document1" :key="d.dcs_id">
                                        <td v-if="d.dcs_status == 4">{{ d.dcs_document }}</td>
                                        <td v-if="d.dcs_status == 4">{{ d.ss_title }}</td>
                                        <td v-if="d.dcs_status == 4"><a @click="DocumentDL(d.dcs_file)"
                                                :href="path">download</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mr-auto ml-auto">
                <h5 class="text-center">Grammarly Report</h5>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hovered">
                                <thead class="text-info text-center">
                                    <tr>
                                        <td><strong>Document</strong></td>
                                        <td><strong>Percentage</strong></td>
                                        <td><strong>Download</strong></td>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr v-for="g in getcaps1grammarly.grammar" :key="g.gra_id">
                                        <td>{{ g.gra_document }}</td>
                                        <td>{{ g.gra_percent }}%</td>
                                        <td><a @click="GrammarlyDL(g.gra_file)" :href="path">download</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mr-auto ml-auto">
                <h5 class="text-center">Panels Score Evaluation</h5>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hovered">
                                <thead class="text-center text-info">
                                    <tr>
                                        <td><strong>Name</strong></td>
                                        <td><strong>Recommendation</strong></td>
                                        <td><strong>Score</strong></td>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr v-for="e in getcaps1evalution.eval1" :key="e.dt_id">
                                        <td>{{ e.name }}</td>
                                        <td v-if="e.dt_recommendation == 1">Accepted</td>
                                        <td v-if="e.dt_recommendation == 2">Accepted with Minor revision</td>
                                        <td v-if="e.dt_recommendation == 3">Accepted with Major revision</td>
                                        <td v-if="e.dt_recommendation == 4">Rejected</td>
                                        <td>{{ e.dt_ptotal }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mr-auto ml-auto">
                <h5 class="text-center">Plagiarism Report</h5>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hovered">
                                <thead class="text-center text-info">
                                    <tr>
                                        <td><strong>Document</strong></td>
                                        <td><strong>Percentage</strong></td>
                                        <td><strong>Donwload</strong></td>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                   <tr v-for="g in getcaps1grammarly.plagiarism" :key="g.pla_id">
                                        <td>{{ g.pla_document }}</td>
                                        <td>{{ g.pla_percent }}%</td>
                                        <td><a @click="PlagiarismDL(g.pla_file)" :href="path">download</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mr-auto ml-auto">
                <h5 class="text-center">Panels Validation</h5>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hovered">
                                <thead class="text-center text-info">
                                    <tr>
                                        <td><strong>Name</strong></td>
                                        <td><strong>Score</strong></td>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr v-for="val in getcaps1validation.valid" :key="val.val_id">
                                        <td>{{ val.name }}</td>
                                        <td>{{ val.val_total }}</td>
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
        props: ['getcaps1evalution','getcaps1validation','grp','user'],
        data() {
            return {
                loading: false,

                path: '',
                file: '',
                filename: '',
                percentage: '',
            }
        },
        methods: {
            GrammarlyDL(str) {
                this.path = '../app/myfiles/Adviserfiles/Grammarly/' + str
            },
            DocumentDL(str) {
                this.path = '../app/myfiles/Submittedfiles/Capstone1/' + str
            },
            PlagiarismDL(str){
                this.path = '../app/myfiles/RCFiles/Plagiarism/' + str
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
            UploadPlagiarism(){
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
                formdata.append('document', 'Plagiarism 1')
                formdata.append('percentage', this.percentage)
                formdata.append('file', this.file)
                formdata.append('standing', 1)
                axios.post('../api/uploadplagiarism', formdata, config).then(res => {
                    if(res.data.message == 'success'){
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
                this.grp.caps1 = 4
                this.Alert('success', 'Successfully Uploaded')
                this.file = ''
                this.fiilename = ''
                this.percentage = ''
                this.getCapston1Grammarly(this.grp.grp_id)
            },
            Alert(icon, title) {
                toast.fire({
                    icon: icon,
                    title: title,
                })
            },
            ...mapActions(['getCapston1Grammarly'])
        },
        computed: mapGetters(['getcaps1checkdocs', 'getcaps1grammarly','groupinfo']),
    }

</script>
