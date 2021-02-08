<template>
    <div>
        <div class="row">
            <div class="col-md-8 mr-auto ml-auto">
                <h4 class="text-center">Grammarly Report</h4>
                <div class="alert alert-warning">
                    <span>
                        Wait for the Adviser to Grammarly your Documents. <br>
                    </span>
                </div>
                <div class="table-responsive">
                    <table class="table table-hovered">
                        <thead class="text-center text-info">
                            <tr>
                                <td><strong>Document</strong></td>
                                <td><strong>Date Check</strong></td>
                                <td><strong>Percentage</strong></td>
                                <td><strong>Grammarly By</strong></td>
                                <td><strong>Download</strong></td>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr v-for="g in getcaps1grammarly.grammar" :key="g.gra_id">
                                <td>{{ g.gra_document }}</td>
                                <td>{{ g.gra_date }}</td>
                                <td>{{ g.gra_percent }}%</td>
                                <td>{{ g.name }}</td>
                                <td><a @click="GrammarlyDL(g.gra_file)" :href="path">download</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-8 mr-auto ml-auto">
                <h4 class="text-center">Plagiarism Report</h4>
                <div class="alert alert-warning">
                    <span>
                        Wait for the Research Coordinator to Plagiarized your Documents. <br>
                    </span>
                </div>
                <div class="table-responsive">
                    <table class="table table-hovered">
                        <thead class="text-center text-info">
                            <tr>
                                <td><strong>Document</strong></td>
                                <td><strong>Date Check</strong></td>
                                <td><strong>Percentage</strong></td>
                                <td><strong>Grammarly By</strong></td>
                                <td><strong>Download</strong></td>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr v-for="g in getcaps1grammarly.plagiarism" :key="g.pla_id">
                                <td>{{ g.pla_document }}</td>
                                <td>{{ g.pla_date }}</td>
                                <td>{{ g.pla_percent }}%</td>
                                <td>{{ g.name }}</td>
                                <td><a @click="PlagiarismDL(g.pla_file)" :href="path">download</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapGetters} from 'vuex'
export default {
    data(){
        return{
            path: ''
        }
    },
    methods:{
        GrammarlyDL(str){
            this.path = '../storage/Adviserfiles/Grammarly/'+str
        },
        PlagiarismDL(str){
            this.path = '../storage/RCFiles/Plagiarism/'+str
        },
    },
    computed: mapGetters(['getcaps1grammarly']),
}
</script>
