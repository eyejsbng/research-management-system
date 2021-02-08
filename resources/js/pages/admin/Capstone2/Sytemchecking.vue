<template>
    <div class="row">
        <div class="col-md-12">
            <h4 class="title text-center">Certificate Checking</h4>
            <div class="row" v-if="system.sys_status == 1 || system.sys_status == 3">
                <div class="col-md-6 mr-auto ml-auto">
                    <div class="alert alert-warning text-center">
                        <span>
                            Check if their Certificate are Valid or Not. <br>
                            Make Decission if Approve or Revise. <br>
                            Group Certificates are <strong>{{ system.ss_title }}</strong>.
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h5 class="title text-center">Deployment</h5>
            <div class="square">
                <img :src="path.deploypath">
            </div>

        </div>
        <div class="col-md-6">
            <h5 class="title text-center">Acceptance</h5>
            <div class="square">
                <img :src="path.acceptpath">
            </div>
        </div>
        <div class="col-md-8 mr-auto ml-auto mt-2" v-if="system.sys_status == 1 || system.sys_status == 3">
            <div class="row">
                <div class="col-md-6 mr-auto ml-auto">
                    <h5 class="title text-center">Decission</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <button class="btn btn-info btn-round btn-block" @click="Decission(4)"
                        :disabled="loading == true">Approve</button>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-warning btn-round btn-block" @click="Decission(3)"
                        :disabled="loading == true">Revise</button>
                </div>
            </div>
            <div class="modal fade" data-backdrop="static" data-keyboard="false" id="mdlRevise">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" @click="CloseModal">&times;</button>
                        <h5 class="title">Add Comment</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Comment</label>
                            <textarea v-model="comment" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button class="btn btn-warning btn-round btn-block" @click="Revise" :disabled="loading == true">Revise</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="col-md-6 mr-auto ml-auto mt-2" v-if="system.sys_status == 4">
            <h5 class="title text-center">You Already Approved the Certificate.</h5>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['grp', 'path', 'system'],
        data() {
            return {
                loading: false,
                comment: '',
            }
        },
        methods: {
            Decission(status) {
                this.loading = true
                let date = moment(Date.now()).format('YYYY-MM-DD hh:mm')
                if (status == 4) {
                    this.Confirmation(status, date)
                } else {
                    this.ShowReviseModal(status,date)
                }

            },
            ShowReviseModal(){
                $('#mdlRevise').modal('show')
                this.loading = false
            },
            CloseModal(){
                $('#mdlRevise').modal('hide')
                this.loading = false
            },
            Revise(){
                let date = moment(Date.now()).format('YYYY-MM-DD hh:mm')
                axios.post('../api/adminsystemcheckcaps2', {
                        date: date,
                        grp_id: this.grp.grp_id,
                        status: 3,
                        comment: this.comment
                    }).then(res => {
                        if (res.data.message == 'success') {
                            this.CloseModal()
                            this.Alert('success', 'Successfully Revised')
                            this.system.ss_title = 'Revised'
                            this.system.sys_status = 3

                        } else {
                            this.loading = false
                            this.Alert('info', res.data.message)
                        }
                    })
            },
            Confirmation(status,date) {
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
                        axios.post('../api/adminsystemcheckcaps2', {
                            date: date,
                            grp_id: this.grp.grp_id,
                            status: status
                        }).then(res => {
                            if (res.data.message == 'success') {
                                this.loading = false
                                this.Alert('success', 'Successfully Approved')
                                if (status == 4) {
                                    this.system.ss_title = 'Approved'
                                    this.system.sys_status = 4
                                } else {
                                    this.system.ss_title = 'Revised'
                                    this.system.sys_status = 3
                                }
                            } else {
                                this.loading = false
                                this.Alert('info', res.data.message)
                            }
                        })
                    }
                    else{
                        this.loading = false
                    }
                })
            },
            Alert(icon, title) {
                toast.fire({
                    icon: icon,
                    title: title,
                })
            },
        },
    }

</script>
<style scoped>
    img {
        max-width: 100%;
        max-height: 100%;
    }

    .square {
        height: 100%;
        width: 100%;
    }

</style>
