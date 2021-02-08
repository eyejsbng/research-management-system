<template>
    <div>
        <div class="row" v-if="system == '' || system.sys_status == 1 || system.sys_status == 3">
            <div class="col-md-12">
                <h4 class="title text-center">Certificate of Acceptance and Deployment</h4>
                <div class="row">
                    <div class="col-md-6 mr-auto ml-auto">
                        <div class="alert alert-warning text-center">
                            <span v-if="system.sys_status == 1 || system == ''">
                                Upload Picture of your Approved Certificates. <br>
                                Wait for the Research Coordinator for apporval.
                            </span>
                            <span v-if="system.sys_status == 3">
                                Certificates are Declined by the RC. <br>
                                RC comment '<strong>{{ system.sys_rccomment }}</strong>'.
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="title text-center">Acceptance</h5>
                        <picture-input ref="pictureAcceptance" @change="onChangeAcceptance" width="600" height="600"
                            margin="16" accept="image/jpeg,image/png" size="10" :hideChangeButton="true"
                            :prefill="acceptpath" :customStrings="{
                                upload: '<h1>Bummer!</h1>',
                                drag: 'Drag your Acceptance Certificate'
                        }">
                        </picture-input>
                    </div>
                    <div class="col-md-6">
                        <h5 class="title text-center">Deployment</h5>
                        <picture-input ref="pictureDeployment" @change="onChangeDeployment" width="600" height="600"
                            margin="16" accept="image/jpeg,image/png" size="10" :hideChangeButton="true"
                            :prefill="deploypath" :customStrings="{
                                upload: '<h1>Bummer!</h1>',
                                drag: 'Drag your Deployment Certificate'
                        }">
                        </picture-input>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6 mr-auto ml-auto">
                        <button v-if="this.acceptpath == '' && this.deploypath == ''" :disabled="loading == true"
                            class="btn btn-info btn-round btn-block" @click="UploadCertificate">Upload</button>
                        <button v-if="this.acceptpath != '' && this.deploypath != ''" :disabled="loading == true"
                            class="btn btn-info btn-round btn-block" @click="UpdateCertificate">Update</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" v-if="system.sys_status == 4">
            <div class="col-md-12">
                <h4 class="title text-center">Certificate of Acceptance and Deployment</h4>
            </div>
            <div class="col-md-6">
                <h5 class="title text-center">Deployment</h5>
                <div class="square">
                    <img :src="deploypath">
                </div>

            </div>
            <div class="col-md-6">
                <h5 class="title text-center">Acceptance</h5>
                <div class="square">
                    <img :src="acceptpath">
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import PictureInput from 'vue-picture-input'
    export default {
        props: ['user', 'grp'],
        data() {
            return {
                acceptance: '',
                deployment: '',

                acceptpath: '',
                deploypath: '',

                loading: false,
                system: '',
            }
        },
        components: {
            PictureInput
        },
        methods: {
            onChangeAcceptance(image) {
                if (image) {
                    this.acceptance = this.$refs.pictureAcceptance.file
                } else {
                    this.acceptance = ''
                }
            },
            onChangeDeployment(image) {
                if (image) {
                    this.deployment = this.$refs.pictureDeployment.file
                } else {
                    this.acceptance = ''
                }
            },
            GetCertificate() {
                axios.get('../api/getsystemcertificate/' + this.grp.grp_id).then(res => {
                    if (res.data.length > 0) {
                        this.system = res.data[0]
                        this.acceptpath = '../app/myfiles/Submittedfiles/Capstone2/' + res.data[0].sys_acceptfile
                        this.deploypath = '../app/myfiles/Submittedfiles/Capstone2/' + res.data[0].sys_deployfile
                    }
                })
            },
            UploadCertificate() {
                this.loading = true
                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
                if (this.acceptance == '' || this.deployment == '') {
                    this.loading = false
                    this.Alert('warning', 'Please Provide a Picture')
                } else {
                    let formdata = new FormData()
                    let date = moment(Date.now()).format('YYYY-MM-DD hh:mm')
                    formdata.append('date', date)
                    formdata.append('group', this.grp.grp_title)
                    formdata.append('grp_id', this.grp.grp_id)
                    formdata.append('acceptance', this.acceptance)
                    formdata.append('deployment', this.deployment)
                    axios.post('../api/uploadsystemcertificate', formdata, config).then(res => {
                        if (res.data.message == 'success') {
                            this.loading = false
                            this.Alert('success', 'Successfully Send')
                            this.GetCertificate()
                        } else {
                            this.loading = false
                            this.Alert('info', res.data.message)
                        }
                    })
                }

            },
            UpdateCertificate(){
                this.loading = true
                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
                let formdata = new FormData()
                    let date = moment(Date.now()).format('YYYY-MM-DD hh:mm')
                    formdata.append('date', date)
                    formdata.append('grp_id', this.grp.grp_id)
                    formdata.append('acceptname', this.system.sys_acceptfile)
                    formdata.append('deployname', this.system.sys_deployfile)
                    formdata.append('acceptance', this.acceptance)
                    formdata.append('deployment', this.deployment)
                    axios.post('../api/updatesystemcertificate', formdata, config).then(res => {
                        if (res.data.message == 'success') {
                            this.loading = false
                            this.Alert('success', 'Successfully Update')
                            this.GetCertificate()
                        } else {
                            this.loading = false
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
        },
        created() {
            this.GetCertificate()
        }
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
