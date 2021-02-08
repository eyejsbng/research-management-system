<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <h4 class="title text-center">Adviser Submission</h4>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title text-center">Document History</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hovered">
                                <thead>
                                    <tr class="text-info">
                                        <td><strong>Rev. #</strong></td>
                                        <td><strong>Documents</strong></td>
                                        <td><strong>Date Submitted</strong></td>
                                        <td><strong>Date Check</strong></td>
                                        <td><strong>Submitted By</strong></td>
                                        <td><strong>Status</strong></td>
                                        <!-- <td><strong>Action</strong></td> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(docs) in getcaps1checkdocs.document2" :key="docs.dcs_id">
                                        <td>{{ docs.dcs_revID }}</td>
                                        <td><a :href="'../app/myfiles/Submittedfiles/Capstone2/'+docs.dcs_file">{{ docs.dcs_document }}</a></td>
                                        <td>{{ docs.dcs_date }}</td>
                                        <td v-if="docs.adv_date == null">Not yet check</td>
                                        <td v-if="docs.adv_date != null">{{docs.adv_date}}</td>
                                        <td>{{ docs.submitby }}</td>
                                        <td>{{ docs.ss_title }}</td>
                                        <!-- <td>
                            <button @click="Check(index)" class="btn btn-info btn-round btn-sm">
                                <i class="fas fa-edit"></i>
                            </button>
                        </td> -->
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h5 class="title">Grammarly Report</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hovered">
                                <thead class="text-info text-center">
                                    <tr>
                                        <td><strong>Document</strong></td>
                                        <td><strong>Date Check</strong></td>
                                        <td><strong>Percentage</strong></td>
                                        <td><strong>Download</strong></td>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr v-for="g in getcaps1grammarly.grammar2" :key="g.gra_id">
                                        <td>{{ g.gra_document }}</td>
                                        <td>{{ g.gra_date }}</td>
                                        <td>{{ g.gra_percent }}%</td>
                                        <td><a @click="GrammarlyDL(g.gra_file)" :href="path">download</a></td>
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
        props: ['user'],
        data(){
            return{
                path:''
            }
        },
        methods:{
            GrammarlyDL(str){
                this.path = '../app/myfiles/Adviserfiles/Grammarly/'+str
            },
        },
        computed: mapGetters(['getcaps1checkdocs', 'getcaps1grammarly']),
    }

</script>
