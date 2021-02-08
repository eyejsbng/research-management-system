<template>
    <div class="row">
        <div class="col-md-12">
            <minutes :capstone="grp" />
        </div>
        <div class="col-md-12">
            <h4 class="title text-center">Submission History</h4>
            <div class="table-responsive">
                <table class="table table-hovered">
                    <thead class="text-info">
                        <tr>
                            <td><strong>Rev. #</strong></td>
                            <td><strong>Chapter</strong></td>
                            <td><strong>Panel Name</strong></td>
                            <td><strong>Date Submitted</strong></td>
                            <td><strong>File</strong></td>
                            <td><strong>Status</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(revise) in getcaps1revisefile.revise1" :key="revise.rev_id">
                            <td>{{ revise.rev_revID }}</td>
                            <td>{{ revise.rev_document }}</td>
                            <td>{{ revise.name }}</td>
                            <td>{{ revise.rev_date }}</td>
                            <td><a :href="path" @click="PanelDL(revise.rev_panfile)">{{ revise.rev_panfile }}</a></td>
                            <td>{{ revise.ss_title }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-8 mr-auto ml-auto text-center" v-if="finaldocs">
            <h4 class="title text-center">Final Documents</h4>
            <a :href="path" @click="FinalDL" class="text-primary">{{ finaldocs.fin_file }}</a>
        </div>
    </div>
</template>
<script>
    import Minutes from '../../admin/Capstone1/Minutes'
    import {
        mapGetters,
        mapActions
    } from 'vuex'
    export default {
        data() {
            return {
                finaldocs: {},
                path: '',
            }
        },
        props: ['grp', 'user'],
        components: {
            'minutes': Minutes
        },
        methods: {
            GetRevisefile() {
                var req = {
                    grp: this.grp.grp_id,
                    id: ''
                }
                this.getCapstone1ReviseFile(req)
                axios.get('../api/finaldocuments/' + this.grp.grp_id).then(res => {
                    this.finaldocs = res.data.final[0]
                })
            },
            FinalDL() {
                this.path = '../app/myfiles/Submittedfiles/Capstone1/' + this.finaldocs.fin_file
            },
            PanelDL(str) {
                this.path = '../app/myfiles/Panelfiles/' + str
            },
            ...mapActions(["getCapstone1ReviseFile"])
        },
        computed: mapGetters(['getcaps1revisefile']),
        created() {
            this.GetRevisefile()
        },
    }

</script>
