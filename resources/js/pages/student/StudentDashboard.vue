<template>
    <div class="app-main">
        <sidebar :user="user" />
        <div class="app-main__outer">
            <div class="app-main__inner">
                <div class="app-page-title text-focus">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <i class="metismenu-icon fas fa-layer-group fa-2x"></i>
                            <div class="ml-2">Dashboard</div>

                        </div>

                    </div>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="container" v-if="this.groupinfo.info && groupinfo.info.grp_standing == 0">
                            <div class="bg-blue-100 border-t-4 border-blue-500 rounded-b text-teal-900 px-4 py-3 shadow-md"
                                role="alert">
                                <div class="flex">
                                    <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path
                                                d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                                            </svg></div>
                                    <div>
                                        <p class="font-bold">Note: Dashboard will only be unlocked if you are already
                                            done with Outline Defense.</p>
                                        <p class="text-sm"> If you already take the Outline Defense, and you cannot
                                            submit files
                                            contact Research Coordinator to make your schedule and minutes.</p>
                                    </div>
                                </div>
                            </div>
                
                        </div>
                    </div>
                    <div class="row" v-if="this.groupinfo.info && groupinfo.info.grp_standing != 0">
                        <div class="col-md-12">
                            <div class="card card-stats">
                                <div class="card-body">

                                    <form-wizard v-if="this.groupinfo.info && groupinfo.info.grp_standing == 1"
                                        color="#f44336" :start-index="this.groupinfo.info.caps1" ref="wizzard">
                                        <h2 slot="title">Milestone for Capstone 1</h2>
                                        <p slot="title" v-if="groupinfo.info.grp_percent < 50">Complete each Milestone
                                            to gain progress in your groups</p>
                                        <p slot="title" v-if="groupinfo.info.grp_percent == 50" class="text-primary">
                                            Your group is waiting for Research Coordinator to update your group standing
                                            to Capstone/Thesis 2</p>
                                        <tab-content title="Chapter 1 to 3" icon="fas fa-file">
                                            <c1-chapters :user="user" />
                                        </tab-content>
                                        <tab-content title="Capstone 1 System" icon="fas fa-cogs">
                                            <c1-system />
                                        </tab-content>
                                        <tab-content title="Evaluation" icon="fas fa-file">
                                            <c1-evaluation :getcaps1evalution="getcaps1evalution" :user="user"
                                                :grp="groupinfo.info" />
                                        </tab-content>
                                        <tab-content title="Grammarly and Plagiarism" icon="fas fa-file">
                                            <c1-grammarly />
                                        </tab-content>
                                        <tab-content title="Validator" icon="fas fa-file">
                                            <c1-validation :getcaps1validation="getcaps1validation" />
                                        </tab-content>
                                        <template slot="footer">
                                            <div class="wizard-footer-right">

                                            </div>
                                        </template>
                                    </form-wizard>
                                    <form-wizard v-if="this.groupinfo.info && groupinfo.info.grp_standing == 2"
                                        color="#f44336" :start-index="this.groupinfo.info.caps2" ref="wizzard">
                                        <h2 slot="title">Milestone for Thesis/Capstone 2</h2>
                                        <p slot="title" v-if="groupinfo.info.caps2 < 4">Complete each Milestone to gain
                                            progress in your groups</p>
                                        <p slot="title" v-if="groupinfo.info.caps2 == 4" class="text-primary">Your Group
                                            is waiting for the panels to Validate or the RC to Update your Group
                                            standing to Capstone/Thesis 2</p>
                                        <tab-content title="Certificates" icon="fas fa-file">
                                            <c2-system :user="user" :grp="groupinfo.info" />
                                        </tab-content>
                                        <tab-content title="Chapter 1 to 6" icon="fas fa-file">
                                            <c2-chapters :user="user" />
                                        </tab-content>
                                        <tab-content title="Evaluation" icon="fas fa-file">
                                            <c2-evaluation :getcaps1evalution="getcaps1evalution" :user="user"
                                                :grp="groupinfo.info" />
                                        </tab-content>
                                        <tab-content title="Grammarly and Plagiarism" icon="fas fa-file">
                                            <c2-grammarly />
                                        </tab-content>
                                        <tab-content title="Validation" icon="fas fa-file">
                                            <c2-validation :getcaps1validation="getcaps1validation" />
                                        </tab-content>
                                        <template slot="footer">
                                            <div class="wizard-footer-right">

                                            </div>
                                        </template>
                                    </form-wizard>
                                    <div class="container"
                                        v-if="this.groupinfo.info && groupinfo.info.grp_standing == 3">
                                        <final-submission v-if="groupinfo.info.isDone == 0" :grp="groupinfo.info" />
                                        <congratualation v-if="groupinfo.info.isDone == 1" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <val1 :sections="sections" :grp="groupinfo.info"
            v-if="groupinfo.info.sec_id == null && groupinfo.info.grp_standing == 0" />
        <val2 :sections="sections" :grp="groupinfo.info"
            v-if="groupinfo.info.sec_id2 == null && groupinfo.info.grp_standing == 2" />
    </div>
</template>
<script>
    import ValidateSection1 from './ValidateSection1'
    import ValidateSection2 from './ValidateSection2'

    import StudentSidebar from './StudentSidebar'
    import Chapters1 from './Milestone/Capstone1/Chapters'
    import System1 from './Milestone/Capstone1/SystemChecking'
    import Evaluation from './Milestone/Capstone1/Evaluation'
    import Grammarly from './Milestone/Capstone1/Grammarly'
    import Validation from './Milestone/Capstone1/Validation'

    import System2 from './Milestone/Capstone2/System'
    import Chapters2 from './Milestone/Capstone2/Chapters'
    import Evaluation2 from './Milestone/Capstone2/Evaluation'
    import Grammarly2 from './Milestone/Capstone2/Grammarly'
    import Validation2 from './Milestone/Capstone2/Validation'

    import FinalSubmission from './Milestone/FinalSubmission'
    import Congratualation from './Milestone/Congratualation'
    import {
        mapGetters,
        mapActions
    } from 'vuex'
    export default {
        props: ['user'],
        components: {
            'val1': ValidateSection1,
            'val2': ValidateSection2,

            'sidebar': StudentSidebar,
            'c1-chapters': Chapters1,
            'c1-system': System1,
            'c1-grammarly': Grammarly,
            'c1-evaluation': Evaluation,
            'c1-validation': Validation,

            'c2-system': System2,
            'c2-chapters': Chapters2,
            'c2-evaluation': Evaluation2,
            'c2-grammarly': Grammarly2,
            'c2-validation': Validation2,

            'final-submission': FinalSubmission,
            'congratualation': Congratualation
        },
        data() {
            return {
                req: {
                    grp: this.user.grp_id,
                    id: ''
                },
                sections: {},
            }
        },
        methods: {
            CheckSection() {
                axios.get('../api/getsectionlist/' + this.user.grp_id).then(res => {
                    this.sections = res.data.sections
                })
            },
            ...mapActions(["fetchadminDashboard", "fetchDependencies", "getGroupInfo", "getCapstone1SubmittedDocs",
                "getCapstone1checkSys", "getCapstone1Evaluation", "getCapston1Grammarly", "getCapstone1Validation",
                "getFinalChecklist"
            ])
        },
        computed: mapGetters(['getadminDashboard', 'groupinfo', 'getcaps1evalution', 'getcaps1validation']),
        created() {
            this.CheckSection()
            // this.fetchadminDashboard();
            // this.fetchDependencies();
            this.getFinalChecklist(this.user.grp_id)
            this.getGroupInfo(this.user.grp_id)
            console.log(this.groupinfo)
            this.getCapstone1SubmittedDocs(this.user.grp_id)
            this.getCapstone1checkSys(this.user.grp_id)
            this.getCapstone1Evaluation(this.req)
            this.getCapstone1Validation(this.req)
            this.getCapston1Grammarly(this.user.grp_id)
        }
    }

</script>
