<template>
    <div>
        <h4 class="title text-center">Captone 1 History</h4>
        <div class="row">
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
                                    <tr v-for="d in getcaps1checkdocs" :key="d.dcs_id">
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
                                    <tr v-for="e in getcaps1evalution" :key="e.dt_id">
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
                                    <tr v-for="val in getcaps1validation" :key="val.val_id">
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
        props: ['getcaps1evalution','getcaps1validation'],
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
            ...mapActions(['getCapston1Grammarly'])
        },
        computed: mapGetters(['getcaps1checkdocs', 'getcaps1grammarly']),
    }

</script>
