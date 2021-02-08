<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <h4 class="title text-center">Final Submission</h4>
            </div>
            <div class="col-md-8 mr-auto ml-auto">
                <div class="alert alert-warning text-center">
                    <span>
                        This is the Last Part of your Destinitaion. <br>
                        Zip the files such as: <br>
                        <ul class="text-left">
                            <li>Final Documents (From Cover Page to Curriculum Vitae to Appendices)</li>
                            <li>Powerpoint Presentation</li>
                            <li>Source Code</li>
                            <li>Installer</li>
                            <li>PDF File of your Thesis Summary</li>
                        </ul>
                        Upload the Zip file and wait the RC for Approval.
                    </span>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-file-upload form-file-simple">
                            <label>Submit Zip File</label>
                            <input v-model="filename" type="text" class="form-control inputFileVisible"
                                placeholder="Upload Zip file...">
                            <input @change="updatefiles" type="file" class="inputFileHidden">
                        </div>
                    </div>
                    <div class="col-md-6 mr-auto ml-auto">
                        <button v-if="update == false" class="btn btn-info btn-round btn-block" @click="Submit" :disabled="loading == true">Submit</button>
                        <button v-if="update == true" class="btn btn-warning btn-round btn-block" @click="Update" :disabled="loading == true">Update</button>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-2">
                <div class="table-responsive">
                    <table class="table table-hovered">
                        <thead class="text-info">
                            <tr>
                                <td><strong>File</strong></td>
                                <td><strong>Submit To</strong></td>
                                <td><strong>Date</strong></td>
                                <td><strong>File Name</strong></td>
                                <td><strong>Status</strong></td>
                                <td><strong>Action</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(c,index) in getfinalchecklist" :key="c.fc_id">
                                <td>Final Checklist</td>
                                <td>{{ c.name }}</td>
                                <td>{{ c.fc_date }}</td>
                                <td><a :href="path" @click="CheckDL(c.fc_file)">{{c.fc_file}}</a></td>
                                <td>{{ c.ss_title }}</td>
                                <td>
                                    <button v-if="c.fc_status == 1" class="btn btn-sm btn-round btn-info" @click="GetUpdate(index)" >Update</button>
                                    <button v-if="c.fc_status != 1" class="btn btn-info btn-link" disabled>Already Checked</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapGetters, mapActions} from 'vuex'
    export default {
        props: ['grp'],
        data(){
            return{
                filename:'',
                file:'',
                path: '',

                loading: false,
                update: false,


                check: {},
            }
        },
        methods:{
            updatefiles(e) {
                let file = e.target.files[0];
                let reader = new FileReader();
                if (file['size'] < 10111775) {
                    if (file['type'] == 'application/zip') {
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
            CheckDL(str){
                this.path = '../app/myfiles/Submittedfiles/Done/'+str
            },
            Submit(){
                this.loading = true
                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
                let formdata = new FormData()
                let date = moment(Date.now()).format('YYYY-MM-DD hh:mm')
                formdata.append('date', date)
                formdata.append('file', this.file)
                formdata.append('grp_id', this.grp.grp_id)
                formdata.append('group', this.grp.grp_title)
                axios.post('../api/finalsubmission', formdata, config).then(res => {
                    if (res.data.message == 'success') {
                        this.loading = false
                        this.Alert('success', 'Successfully Submitted')
                        this.getFinalChecklist(this.grp.grp_id)
                        this.file = ''
                        this.filename = ''
                    }
                    else{
                        this.loading = false
                        this.file = ''
                        this.filename = ''
                        this.Alert('info', res.data.message)
                    }
                })
            },
            GetUpdate(index){
                this.update = true
                this.check = this.getfinalchecklist[index]
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
                formdata.append('date' ,date)
                formdata.append('id', this.check.fc_id)
                formdata.append('filename', this.check.fc_file)
                formdata.append('file', this.file)
                axios.post('../api/updatefinalsubmission', formdata, config).then(res => {
                    if (res.data.message == 'success') {
                        this.update = false
                        this.loading = false
                        this.filename = ''
                        this.file = ''
                        this.Alert('success', 'Successfully Updated')
                        this.getFinalChecklist(this.grp.grp_id)
                    }
                    else{
                        this.loading = false
                        this.Alert('info' , res.data.message)
                    }
                })

            },
             Alert(icon, title) {
                toast.fire({
                    icon: icon,
                    title: title,
                })
            },
             ...mapActions(["getFinalChecklist"])
        },
        computed:{
            ...mapGetters(['getfinalchecklist'])
        },
    }

</script>
