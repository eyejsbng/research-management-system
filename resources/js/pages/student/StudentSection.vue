<template >
    <div v-if="groupinfo.info">
         <div class="app-main">

        <sidebar :user="user" />

        <div class="app-main__outer">
            <div class="app-main__inner">
                <div class="app-page-title">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <i class="metismenu-icon fas fa-users fa-2x"></i>
                            <div class="ml-2">Section</div>

                        </div>

                    </div>
                </div>
            <div class="content">

            </div>
        </div>
        
    </div>
         </div>
         <val1 :sections="sections" :grp="groupinfo.info" v-if="groupinfo.info.sec_id == null && groupinfo.info.grp_standing == 0" />
        <val2 :sections="sections" :grp="groupinfo.info" v-if="groupinfo.info.sec_id2 == null && groupinfo.info.grp_standing == 2" />
    </div>
</template>
<script>
    import ValidateSection1 from './ValidateSection1'
    import ValidateSection2 from './ValidateSection2'
    import StudentSidebar from './StudentSidebar'
    import {
        mapGetters,
        mapActions
    } from 'vuex'
    export default {
        props: ['user'],
        components: {
            'val1' : ValidateSection1,
            'val2' : ValidateSection2,
            'sidebar': StudentSidebar,
        },
        data() {
            return {
                GroupInfo: {},
                members: {},
                adviser: {},
                panels: {},

                isUpload: false,

                sections:{},
            }
        },
        methods: {
            CheckSection(){
                axios.get('../../api/getsectionlist/'+ this.user.grp_id).then(res => {
                    this.sections = res.data.sections
                })
            },
            ...mapActions(["fetchadminDashboard","fetchDependencies","getGroupInfo"])
        },
        computed: {
            ...mapGetters(['getadminDashboard','groupinfo']),
        },
        created() {
            this.CheckSection()
            this.getGroupInfo(this.user.grp_id)
        }
    }

</script>
<style scoped>
</style>
