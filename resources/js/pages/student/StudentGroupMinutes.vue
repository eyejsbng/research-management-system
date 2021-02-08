<template>
    <div v-if="groupinfo.info">
        <div class="app-main">

            <sidebar :user="user" />

            <div class="app-main__outer">
                <div class="app-main__inner">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <i class="metismenu-icon fas fa-file-alt fa-2x"></i>
                                <div class="ml-2">Minutes</div>

                            </div>

                        </div>
                    </div>
                    <div class="content">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <minutes :capstone="user" />
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
    import Minutes from '../admin/Capstone1/Minutes'
    import {
        mapGetters,
        mapActions
    } from 'vuex'
    export default {
        props: ['user'],
        data() {
            return {
                sections: {}
            }
        },
        components: {
            'val1': ValidateSection1,
            'val2': ValidateSection2,
            'sidebar': StudentSidebar,
            'minutes': Minutes
        },
        methods: {
            CheckSection() {
                axios.get('../../api/getsectionlist/' + this.user.grp_id).then(res => {
                    this.sections = res.data.sections
                })
            },
            ...mapActions(["fetchadminDashboard", "fetchDependencies", "getGroupInfo"])
        },
        computed: mapGetters(['getadminDashboard', 'groupinfo']),
        created() {
            this.CheckSection()
            this.fetchadminDashboard();
            this.fetchDependencies();
            this.getGroupInfo(this.user.grp_id)
        }
    }

</script>
