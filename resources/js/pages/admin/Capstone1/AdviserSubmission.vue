<template>
    <div>
        <h4 class="title text-center">Adviser Submission</h4>
        <div class="card">
            <div class="card-header text-center">
                <h5 class="card-title">Document History</h5>
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
                            <tr v-for="(docs) in getcaps1checkdocs.document1" :key="docs.dcs_id">
                                <td>{{ docs.dcs_revID }}</td>
                                <td><a :href="'../app/myfiles/Submittedfiles/Capstone1/'+docs.dcs_file">{{ docs.dcs_document }}</a></td>
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
        <div class="card">
            <div class="card-header text-center">
                <h5 class="card-title">System Checking</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="text-center">
                                    <tr>
                                        <td><strong>Criteria</strong></td>
                                        <td><strong>Description <br> The Students were able
                                                to:</strong></td>
                                        <td><strong>Complied/ <br> Not Complied</strong></td>
                                        <td><strong>Remarks</strong></td>
                                    </tr>
                                </thead>
                                <tbody class="text-center" v-if="getcaps1checksys[0]">
                                    <tr>
                                        <td rowspan="2">User Interface</td>
                                        <td>
                                            Design a professional looking <br>
                                            prototype that follows the Human <br>
                                            Interface Guidelines (HIG)
                                        </td>
                                        <td>
                                            <button class="btn btn-round btn-info"
                                                v-if="getcaps1checksys[0].sys1_c1 == true"><i
                                                    class="fas fa-check"></i></button>
                                            <button class="btn btn-round btn-primary"
                                                v-if="getcaps1checksys[0].sys1_c1 == false"><i
                                                    class="fas fa-times"></i></button>
                                        </td>
                                        <td>
                                            {{ getcaps1checksys[0].sys1_remarks1 }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Design applications for Desktop,<br>
                                            Web and/or Mobile Interface <br>
                                            wherein the Key pages (Home <br>
                                            Page, Main Menu, etc.) are <br>
                                            present for the target platform/s
                                        </td>
                                        <td>
                                            <button class="btn btn-round btn-info"
                                                v-if="getcaps1checksys[0].sys1_c2 == true"><i
                                                    class="fas fa-check"></i></button>
                                            <button class="btn btn-round btn-primary"
                                                v-if="getcaps1checksys[0].sys1_c2 == false"><i
                                                    class="fas fa-times"></i></button>
                                        </td>
                                        <td>
                                            {{ getcaps1checksys[0].sys1_remarks2 }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Appropriate <br> Controls / User <br> Experience
                                        </td>
                                        <td>
                                            Incorporate transitions to <br>
                                            workflows between different <br>
                                            pages/forms/menu (Actions <br>
                                            Events, Triggers, Handleres, and <br>
                                            Listeners are working)
                                        </td>
                                        <td>
                                            <button class="btn btn-round btn-info"
                                                v-if="getcaps1checksys[0].sys1_c3 == true"><i
                                                    class="fas fa-check"></i></button>
                                            <button class="btn btn-round btn-primary"
                                                v-if="getcaps1checksys[0].sys1_c3 == false"><i
                                                    class="fas fa-times"></i></button>
                                        </td>
                                        <td>
                                            {{ getcaps1checksys[0].sys1_remarks3 }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Presence of <br> Base Classes</td>
                                        <td>
                                            Develop base classes to create a <br>
                                            well-defined and flexible model <br>
                                            for the application
                                        </td>
                                        <td>
                                            <button class="btn btn-round btn-info"
                                                v-if="getcaps1checksys[0].sys1_c4 == true"><i
                                                    class="fas fa-check"></i></button>
                                            <button class="btn btn-round btn-primary"
                                                v-if="getcaps1checksys[0].sys1_c4 == false"><i
                                                    class="fas fa-times"></i></button>
                                        </td>
                                        <td>
                                            {{ getcaps1checksys[0].sys1_remarks4 }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Relevance</td>
                                        <td>Present a prototype that meets <br> the user
                                            requirements</td>
                                        <td>
                                            <button class="btn btn-round btn-info"
                                                v-if="getcaps1checksys[0].sys1_c5 == true"><i
                                                    class="fas fa-check"></i></button>
                                            <button class="btn btn-round btn-primary"
                                                v-if="getcaps1checksys[0].sys1_c5 == false"><i
                                                    class="fas fa-times"></i></button>
                                        </td>
                                        <td>
                                            {{ getcaps1checksys[0].sys1_remarks5 }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6 mr-auto ml-auto text-center">
                        <h6>Check By:</h6>
                        <p v-if="getcaps1checksys[0]">{{ getcaps1checksys[0].name }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header text-center">
                <h5 class="card-title">Grammarly Report</h5>
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
                            <tr v-for="g in getcaps1grammarly.grammar" :key="g.gra_id">
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
        computed: mapGetters(['getadminDashboard', 'getcaps1checkdocs', 'getcaps1checksys','getcaps1grammarly']),
    }

</script>
