<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <h4 class="title text-center">Validator's Checklist and Criteria</h4>
            </div>
            <div class="col-md-12">
                <div class="card" v-for="val in getcaps1validation.valid2" :key="val.val_id">
                    <div class="card-body">
                         <div class="table-responsive" >
                    <div class="row">
                        <div class="col-md-6 mr-auto ml-auto">
                            <h6 class="title text-center" style="line-heigth:1px;">{{ val.name }}</h6>
                            <p class="title text-center">Panel Name</p>
                        </div>
                    </div>
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
                                    {{ val.val_doca }}
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
                                    {{ val.val_docb }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    c.) There is a complete documentation (from Cover page <br>
                                        to Curriculum Vitae)
                                </td>
                                <td>
                                    10%
                                </td>
                                <td>
                                    {{ val.val_docc }}
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
                                    {{ val.val_docd }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    e.) The contents of the documentation follow PSITE Capstone/Thesis format
                                </td>
                                <td>
                                    20%
                                </td>
                                <td>
                                    {{ val.val_doce }}
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
                                    {{ val.val_sysa }}
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
                                    {{ val.val_sysb }}
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
                                    {{ val.val_sysc}}
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
                                    {{ val.val_sysd }}
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
                                    {{ val.val_syse }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"><strong>Total</strong></td>
                                <td></td>
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
import {mapGetters, mapActions } from 'vuex'
    export default {
        props: ['getcaps1validation']
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
