<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <h4 class="title text-center">Group Check List</h4>
            </div>
            <div class="col-md-8 mr-auto ml-auto">
                <div class="table-responsive">
                    <table class="table table-hovered">
                        <thead class="text-info text-center">
                            <tr>
                                <td><strong>Filename</strong></td>
                                <td><strong>Date Submitted</strong></td>
                                <td><strong>Status</strong></td>
                                <td><strong>Action</strong></td>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr v-for="(c, index) in getfinalchecklist" :key="c.fc_id">
                                <td><a :href="path" @click="CheckDL(c.fc_file)">{{c.fc_file}}</a></td>
                                <td>{{ c.fc_date }}</td>
                                <td v-if="c.fc_status == 1">Pending</td>
                                <td v-if="c.fc_status == 4">Approved</td>
                                <td v-if="c.fc_status == 3">Declined</td>
                                <td>
                                    <button v-if="c.fc_status == 1" class="btn btn-info btn-round btn-sm" @click="ShowConfirmation(index)">Approve</button>
                                    <button v-if="c.fc_status == 1" class="btn btn-warning btn-round btn-sm" @click="OpenModal(index)">Decline</button>
                                    <button v-if="c.fc_status != 1" class="btn btn-info btn-link" disabled>Already Checked</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal fade" data-backdrop="static" data-keyboard="false" id="mdlCecklist">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header justify-content-center">
                                <button type="button" class="close" @click="CloseModal">&times;</button>
                                <h5 class="modal-title text-center">Decline Checklist</h5>
                            </div>
                            <div class="modal-body">
                                <div class="alert alert-warning text-center">
                                    <span>
                                        You Decline the Group Checklist. <br>
                                        It means there are something wrong to thier file. <br>
                                        Add Comment for further Instructions for the Group.
                                    </span>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                         <div class="form-group">
                                            <label>Comment</label>
                                            <textarea class="form-control" v-model="comment"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mr-auto ml-auto">
                                        <button class="btn btn-warning btn-round btn-block" @click="Decession(3)">Decline</button>
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
import { mapGetters,mapActions} from 'vuex'
export default {
    props:['grp'],
    data(){
        return{
            path:'',

            comment: '',
            check: {},
        }
    },
    methods:{
        CheckDL(str){
            this.path = '../app/myfiles/Submittedfiles/Done/'+str
        },
        OpenModal(index){
            $('#mdlCecklist').modal('show')
            this.check = this.getfinalchecklist[index]
        },
        CloseModal(){
            $('#mdlCecklist').modal('hide')
        },
        ShowConfirmation(index){
            this.check = this.getfinalchecklist[index]
            Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to Approve!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Approve'
                }).then((result) => {
                    if (result.value) {
                        this.Decession(4)
                    }
                })
        },
        Decession(status){
            var request  = {
                id : this.check.fc_id,
                comment: this.comment,
                status: status,
                grp: this.grp.grp_id
            }
            axios.post('../api/checklistdecission', request).then(res => {
                if (res.data.message == 'success') {
                    if (status == 3) {
                        this.comment = ''
                        this.Alert('success', 'Successfully Decline')
                        this.CloseModal()
                        this.getFinalChecklist(this.grp.grp_id)
                    }
                    else{
                        this.Alert('success', 'Successfully Approve')
                        this.CloseModal()
                        this.getFinalChecklist(this.grp.grp_id)
                    }
                }
                else{
                    this.Alert('info', res.data.message)
                }
            })
        },
        Alert(icon, title) {
            toast.fire({
                icon: icon,
                title: title,
            })
        },
        ...mapActions(['getFinalChecklist'])
    },
    computed: mapGetters(['getfinalchecklist'])
}
</script>
