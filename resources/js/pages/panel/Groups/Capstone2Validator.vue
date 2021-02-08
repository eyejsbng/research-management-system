<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <h4 class="title text-center">Validator's Checklist and Criteria</h4>
                <p class="text-center">Thesis/Capstone 2</p>
            </div>
            <div class="col-md-12">
                <div class="alert alert-primary text-center">
                    <span>
                        Check the minutes and final Documents of the group in Resource tab. <br>
                        Don't forget to click the <strong>Validate</strong> button.
                    </span>
                </div>
            </div>
            <div class="col-md-12">
                <div class="table-responsive" v-if="getcaps1validation.valid2">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td><strong>Documentation</strong></td>
                                <td><strong>Weight(100%)</strong></td>
                                <td><strong>Score</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    a.) The contents of the manuscript are not plagiarized
                                </td>
                                <td>
                                    10%
                                </td>
                                <td>
                                    <input v-model="getcaps1validation.valid2[0].val_doca" @keyup="ComputeScore" type="number" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    b.) The manuscript follows the ACM format
                                </td>
                                <td>
                                    10%
                                </td>
                                <td>
                                    <input v-model="getcaps1validation.valid2[0].val_docb" @keyup="ComputeScore" type="number" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    c.) c.) There is a complete documentation (from Cover page <br>
                                        to Curriculum Vitae)
                                </td>
                                <td>
                                    10%
                                </td>
                                <td>
                                    <input v-model="getcaps1validation.valid2[0].val_docc" @keyup="ComputeScore" type="number" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    d.) There is a CD that contains the soft copy of the <br>
                                        documentation, source code and the System
                                </td>
                                <td>
                                    10%
                                </td>
                                <td>
                                    <input v-model="getcaps1validation.valid2[0].val_docd" @keyup="ComputeScore" type="number" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    e.) The contents of the documentation follow PSITE Capstone/Thesis format
                                </td>
                                <td>
                                    10%
                                </td>
                                <td>
                                    <input v-model="getcaps1validation.valid2[0].val_doce" @keyup="ComputeScore" type="number" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3"><strong>System Software</strong></td>
                            </tr>
                            <tr>
                                <td>
                                    a.) The System is already deployed and being utilized by the client.
                                </td>
                                <td>
                                    10%
                                </td>
                                <td>
                                    <input v-model="getcaps1validation.valid2[0].val_sysa" @keyup="ComputeScore" type="number" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    b.) Conducted Users Training.
                                </td>
                                <td>
                                    10%
                                </td>
                                <td>
                                    <input v-model="getcaps1validation.valid2[0].val_sysb" @keyup="ComputeScore" type="number" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    c.) The produced software is authentic.
                                </td>
                                <td>
                                    10%
                                </td>
                                <td>
                                    <input v-model="getcaps1validation.valid2[0].val_sysc" @keyup="ComputeScore" type="number" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    d.) The produced software is based on the CSD Research <br>
                                        Agenda.
                                </td>
                                <td>
                                    10%
                                </td>
                                <td>
                                    <input v-model="getcaps1validation.valid2[0].val_sysd" @keyup="ComputeScore" type="number" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    e.) The produced software is compliant to the PSITE <br>
                                        Capstone/Thesis Manual guidelines on areas of software development.
                                </td>
                                <td>
                                    10%
                                </td>
                                <td>
                                    <input v-model="getcaps1validation.valid2[0].val_syse" @keyup="ComputeScore" type="number" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"><strong>Total</strong></td>
                                <td></td>
                                <td>{{ getcaps1validation.valid2[0].val_total }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6 mr-auto ml-auto">
                <button @click="Validate" class="btn btn-info btn-round btn-block" :disabled="grp.caps2 != 4" v-if="grp.grp_standing == 2">Validate</button>
                <p v-if="grp.grp_standing == 3" style="font-size:12px;color:red" class="text-center">Groups Already Valitadated</p>
            </div>
        </div>
    </div>
</template>
<script>
import {mapGetters, mapActions } from 'vuex'
    export default {
        props:['user','grp'],
        computed: mapGetters(['getcaps1validation']),
        methods:{
            ComputeScore(){
                if(this.getcaps1validation.valid2[0].val_doca > 10){
                    this.Alert('info', 'Maximum input is 10')
                    this.getcaps1validation.valid2[0].val_doca = 0
                }
                else if(this.getcaps1validation.valid2[0].val_docb > 10){
                    this.Alert('info', 'Maximum input is 10')
                    this.getcaps1validation.valid2[0].val_docb = 0
                }
                else if(this.getcaps1validation.valid2[0].val_docc > 10){
                    this.Alert('info', 'Maximum input is 10')
                    this.getcaps1validation.valid2[0].val_docc = 0
                }
                else if(this.getcaps1validation.valid2[0].val_docd > 10){
                    this.Alert('info', 'Maximum input is 10')
                    this.getcaps1validation.valid2[0].val_docd = 0
                }
                else if(this.getcaps1validation.valid2[0].val_doce > 10){
                    this.Alert('info', 'Maximum input is 10')
                    this.getcaps1validation.valid2[0].val_doce = 0
                }
                else if(this.getcaps1validation.valid2[0].val_sysa > 10){
                    this.Alert('info', 'Maximum input is 10')
                    this.getcaps1validation.valid2[0].val_sysa = 0
                }
                else if(this.getcaps1validation.valid2[0].val_sysb > 10){
                    this.Alert('info', 'Maximum input is 10')
                    this.getcaps1validation.valid2[0].val_sysb = 0
                }
                else if(this.getcaps1validation.valid2[0].val_sysc > 10){
                    this.Alert('info', 'Maximum input is 10')
                    this.getcaps1validation.valid2[0].val_sysc = 0
                }
                else if(this.getcaps1validation.valid2[0].val_sysd > 10){
                    this.Alert('info', 'Maximum input is 10')
                    this.getcaps1validation.valid2[0].val_sysd = 0
                }
                else if(this.getcaps1validation.valid2[0].val_syse > 10){
                    this.Alert('info', 'Maximum input is 10')
                    this.getcaps1validation.valid2[0].val_syse = 0
                }
                else{
                    this.getcaps1validation.valid2[0].val_total = Number(this.getcaps1validation.valid2[0].val_doca) + Number(this.getcaps1validation.valid2[0].val_docb) +
                                                       Number(this.getcaps1validation.valid2[0].val_docc) + Number(this.getcaps1validation.valid2[0].val_docd) +
                                                       Number(this.getcaps1validation.valid2[0].val_doce) + Number(this.getcaps1validation.valid2[0].val_sysa) +
                                                       Number(this.getcaps1validation.valid2[0].val_sysb) + Number(this.getcaps1validation.valid2[0].val_sysc) +
                                                        Number(this.getcaps1validation.valid2[0].val_sysd) + Number(this.getcaps1validation.valid2[0].val_syse)
                }
            },
            Validate(){
                axios.post('../api/caps2validate', this.getcaps1validation.valid2[0]).then(res => {
                        if(res.data.message == 'success'){
                            this.Alert('success', 'Successfully Validate')
                        }
                        else{
                            this.Alert('info', res.data.message)
                        }
                }).catch(err => {
                    if (err.response.status == 422) {
                        this.Alert('warning', 'Make sure input is valid! Minimum is 1 Maximum is 10')
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
