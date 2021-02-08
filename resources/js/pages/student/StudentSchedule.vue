<template>
    <div v-if="groupinfo.info">
         <div class="app-main">
        <sidebar :user="user" />
        <div class="app-main__outer">
            <div class="app-main__inner">
                <div class="app-page-title text-focus">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <i class="metismenu-icon fas fa-calendar fa-2x"></i>
                            <div class="ml-2">Schedule</div>

                        </div>

                    </div>
                </div>
            <div class="content">
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
                </div>
            </div>

        </div>
        <val1 :sections="sections" :grp="groupinfo.info" v-if="groupinfo.info.sec_id == null && groupinfo.info.grp_standing == 0" />
        <val2 :sections="sections" :grp="groupinfo.info" v-if="groupinfo.info.sec_id2 == null && groupinfo.info.grp_standing == 2" />
    </div>
         </div>
    </div>
</template>
<script>
import ValidateSection1 from './ValidateSection1'
import ValidateSection2 from './ValidateSection2'
import StudentSidebar from './StudentSidebar'
import { mapGetters, mapActions } from 'vuex'
export default {
    props:['user'],
    data(){
        return{
            sections:{}
        }
    },
    components:{
        'val1' : ValidateSection1,
        'val2' : ValidateSection2,
        'sidebar' : StudentSidebar,
    },
    methods:{
        CheckSection(){
            axios.get('../../api/getsectionlist/'+ this.user.grp_id).then(res => {
                this.sections = res.data.sections
            })
        },
        ...mapActions(["GetStudentGroupSchedule", "getGroupInfo"])
    },
    computed: mapGetters(['getadminDashboard', 'getgroupschedule', 'groupinfo']),
    created(){
        this.CheckSection()
        this.GetStudentGroupSchedule(this.user.grp_id)
        this.getGroupInfo(this.user.grp_id)
    }
}
</script>
