<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <h4 class="btn btn-link btn-block btn-info text-center" data-toggle="collapse" data-target="#validate">Validator's Checklist and Criteria</h4>
            </div>
            <div class="col-md-12 collapse show" id="validate">
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
                                <td><strong>Weight</strong></td>
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
                                    c.) There is a complete documentation (from Chapter 1 to Chapter 3)
                                </td>
                                <td>
                                    20%
                                </td>
                                <td>
                                    {{ val.val_docc }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    d.) The contents of the documentation follow PSITE Capstone/Thesis format
                                </td>
                                <td>
                                    20%
                                </td>
                                <td>
                                    {{ val.val_docd }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3"><strong>System Software</strong></td>
                            </tr>
                            <tr>
                                <td>
                                    a.) The System is 60% completed
                                </td>
                                <td>
                                    20%
                                </td>
                                <td>
                                    {{ val.val_sysa }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    b.) The producted software is based on the CCE Research Agenda
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
                                    c.) The producted software is compliant to the PSITE Capstone/Thesis Manual
                                    guidelines on areas of software devepolment
                                </td>
                                <td>
                                    10%
                                </td>
                                <td>
                                    {{ val.val_sysc }}
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

