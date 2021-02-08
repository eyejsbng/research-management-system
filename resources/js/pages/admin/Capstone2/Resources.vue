<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                            <div class="card-header text-center">
                                <h4 class="card-title">Schedule History</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hovered">
                                        <thead class="text-center text-info">
                                            <tr>
                                                <td><strong>Defense Type</strong></td>
                                                <td><strong>Defense Date</strong></td>
                                                <td><strong>Defense Time</strong></td>
                                                <td><strong>Defense Venue</strong></td>
                                                <td><strong>Defense Status</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <tr v-for="sched in getgroupschedule" :key="sched.def_id">
                                                <td>{{ sched.styp_title }}</td>
                                                <td>{{ sched.def_date }}</td>
                                                <td>{{ sched.def_stime }} - {{ sched.def_etime }}</td>
                                                <td>{{ sched.def_address }}</td>
                                                <td>{{ sched.ds_title }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
        </div>
        <div class="col-md-12">
            <minutes :capstone="capstone" />
        </div>
        <div class="col-md-12">
            <h4 class="title text-center">Evaluation and Validation Report</h4>
        </div>
        <div class="col-md-12">
            <h4 class="btn btn-link btn-block btn-info text-center" data-toggle="collapse" data-target="#title">Title/Outline Form</h4>
        </div>
        <div class="col-md-12 mr-auto ml-auto collapse show" id="title" v-for="e in getcaps1evalution.eval1" :key="e.dt_id">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <p>{{ e.name }}</p>
                            <label>Panel Name</label>
                        </div>
                        <div class="col-md-4">
                            <p v-if="e.dt_recommendation == null">Noy yet check</p>
                            <p v-if="e.dt_recommendation == 1">Approved</p>
                            <p v-if="e.dt_recommendation == 2">Approved with Minor revision</p>
                            <p v-if="e.dt_recommendation == 3">Approved with Major revision</p>
                            <p v-if="e.dt_recommendation == 4">Rejected</p>
                            <label>Recommendation</label>
                        </div>
                        <div class="col-md-4">
                            <p v-if="e.dt_date != null">{{ e.dt_date }}</p>
                            <p v-if="e.dt_date == null">Not yet Check</p>
                            <label>Date of Evaluation</label>
                        </div>
                        <div class="col-md-12 table-responsive">
                            <table class="table table-bordered">
                                <thead class="text-center text-info">
                                    <tr>
                                        <td><strong>Criterion</strong></td>
                                        <td><strong>Score</strong></td>
                                        <td><strong>Weight</strong></td>
                                        <td><strong>Points</strong></td>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr>
                                        <td>
                                            <strong>Introduction</strong> <br>
                                            An Exposition on the Project Context, Purpose and <br>
                                            Description of the study are given. The objectives are <br>
                                            specific, measurable, achievable, realistic and time-bound. <br>
                                            The scope and deliminations of the study are clearly <br>
                                            explained.
                                        </td>
                                        <td>
                                            {{ e.dt_sintro }}
                                        </td>
                                        <td>
                                            25%
                                        </td>
                                        <td>
                                            {{ e.dt_pintro }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Related Literature</strong> <br>
                                            There is evidence that the writer made a scholarly attempt<br>
                                            to find his precursors in the field. The review provides <br>
                                            relevant discussion on the theories, concepts, facts, and/or <br>
                                            ideas related to the subject. The materials are current,<br>
                                            adequate and carefully selected. A Synthesis is provided at <br>
                                            the end of the section describing the review's significance.
                                        </td>
                                        <td>
                                            {{ e.dt_srelated }}
                                        </td>
                                        <td>
                                            10%
                                        </td>
                                        <td>
                                            {{ e.dt_prelated }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>General Form</strong> <br>
                                            The manuscript is very well-organized and contains<br>
                                            all the main requisites of a typical thesis manuscipt. <br>
                                            The prescribed rules on the format, spacing, pagination, <br>
                                            tables and figures are strictly followed. Mechanics of <br>
                                            writing is satisfactory. The style is impersonal, straight <br>
                                            forward, objective and effective.
                                        </td>
                                        <td>
                                            {{ e.dt_sgeneral }}
                                        </td>
                                        <td>
                                            15%
                                        </td>
                                        <td>
                                            {{ e.dt_pgeneral }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Oral Presentation</strong> <br>
                                            Oral presentation is methodical, rational and <br>
                                            coherent. It is brief but complete. Appropriate and <br>
                                            attractive visual aids are used. Presenters are <br>
                                            articulate and questions are answered satisfactorily.
                                        </td>
                                        <td>
                                            {{ e.dt_soral }}
                                        </td>
                                        <td>
                                            20%
                                        </td>
                                        <td>
                                            {{ e.dt_poral }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>System Software</strong> <br>
                                            <ul class="text-left">
                                                <li>Punctuality</li>
                                                <li>Reliability</li>
                                                <li>Usability</li>
                                                <li>Efficiency</li>
                                                <li>Maintability</li>
                                                <li>Portability</li>
                                            </ul>
                                        </td>
                                        <td>
                                            {{ e.dt_ssystem }}
                                        </td>
                                        <td>
                                            30%
                                        </td>
                                        <td>
                                            {{ e.dt_psystem }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>TOTAL</strong> <br>
                                        </td>
                                        <td>
                                            {{ e.dt_stotal }}
                                        </td>
                                        <td>
                                            100%
                                        </td>
                                        <td>
                                            {{ e.dt_ptotal }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-8 mr-auto ml-auto">
                            <div class="form-group text-center">
                                <label>Comment</label>
                                <textarea v-model="e.dt_comments" class="form-control" disabled></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h4 class="btn btn-link btn-block btn-info text-center" data-toggle="collapse" data-target="#validate">Validator's Checklist and Criteria</h4>
            </div>
            <div class="col-md-12 collapse show" id="validate">
                <div class="card" v-for="val in getcaps1validation.valid" :key="val.val_id">
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
import Minutes from '../Capstone1/Minutes'
import Schedule from '../../student/StudentSchedule'
import { mapGetters, mapActions } from 'vuex'
export default {
    props:['getcaps1evalution', 'getcaps1validation', 'capstone', 'user'],
    components:{
        'minutes' : Minutes,
        'schedule' : Schedule
    },
    methods:{
        ...mapActions(["GetStudentGroupSchedule"])
    },
    computed: mapGetters(['getgroupschedule']),
    created(){
        this.GetStudentGroupSchedule(this.user.grp_id)
    }
}
</script>
