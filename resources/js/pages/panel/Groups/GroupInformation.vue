<template>
    <div class="row">
        <div class="col-md-12">
            <form-wizard color="#f44336" v-if="grp.grp_standing == 0 || grp.grp_standing == 1" :start-index="grp.caps1" ref="wizzard">
                <h4 slot="title" class="title">Group Milestone</h4>
                <tab-content title="Chapter 1 to 3" icon="fas fa-file"></tab-content>
                <tab-content title="Capstone 1 System" icon="fas fa-cogs"></tab-content>
                <tab-content title="Evaluation" icon="fas fa-file"></tab-content>
                <tab-content title="Grammarly and Plagiarism" icon="fas fa-file"></tab-content>
                <tab-content title="Validator" icon="fas fa-file"></tab-content>
                <template slot="footer">
                    <div class="wizard-footer-right">

                    </div>
                </template>
            </form-wizard>
            <form-wizard v-if="grp.grp_standing == 2" color="#f44336" :start-index="grp.caps2" ref="wizzard">
                <h2 slot="title">Group Milestone</h2>
                <tab-content title="Certificates" icon="fas fa-file"></tab-content>
                <tab-content title="Chapter 1 to 6" icon="fas fa-file"></tab-content>
                <tab-content title="Evaluation" icon="fas fa-file"></tab-content>
                <tab-content title="Grammarly and Plagiarism" icon="fas fa-file"></tab-content>
                <tab-content title="Validation" icon="fas fa-file"></tab-content>
                <template slot="footer">
                    <div class="wizard-footer-right">

                    </div>
                </template>
            </form-wizard>
            <h4 class="title text-center">Group Information</h4>
            <hr>
            <div class="row">
                <div class="col-md-4">
                    <p style="font-size:15px;" class="category text-center">Group Members:</p>
                    <h6 class="text-center" v-for="mem in members" :key="mem.id">
                        {{ mem.name }}
                    </h6>
                </div>
                <div class="col-md-4">
                    <p style="font-size:15px;" class="category text-center">Group Panels:</p>
                    <h6 class="text-center" v-for="pans in panels" :key="pans.id">
                        {{ pans.name }}
                    </h6>
                </div>
                <div class="col-md-4">
                    <p style="font-size:15px;" class="category text-center">Group Adviser</p>
                    <h6 class="text-center">
                        {{ adviser.name }}
                    </h6>
                </div>
                <div class="col-md-4 mr-auto ml-auto">
                    <p style="font-size:15px;" class="category text-center">Group Standing</p>
                    <h6 class="text-center" v-if="grp.grp_standing == 1">
                        Capstone 1
                    </h6>
                    <h6 class="text-center" v-if="grp.grp_standing == 2">
                        Capstone 2
                    </h6>
                </div>
            </div>
        </div>
        <hr>
        <div class="col-md-12 mt-3">
            <h4 class="title text-center">Group Progress</h4>
            <hr>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="title text-center">RC Progress</h4>
                        </div>
                        <div class="card-body">
                            <rc-progress v-if="this.groupinfo.info" />
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="title text-center">Adviser Progress</h4>
                        </div>
                        <div class="card-body">
                            <adviser-progress v-if="this.groupinfo.info" />
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="title text-center">Panel Progress</h4>
                        </div>
                        <div class="card-body">
                            <panel-progress v-if="this.groupinfo.info" />
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
    import RCProgress from '../../../components/Progress/RCProgress'
    import AdviserProgress from '../../../components/Progress/AdviserProgress'
    import PanelProgress from '../../../components/Progress/PanelProgress'
    export default {
        props: ['grp'],
        components: {
            'rc-progress': RCProgress,
            'adviser-progress': AdviserProgress,
            'panel-progress': PanelProgress,
        },
        data() {
            return {
                members: {},
                adviser: {},
                panels: {},
            }
        },
        methods: {
            GetGroupDetails() {
                axios.get('../api/selectCap1/' + this.grp.grp_id).then(res => {
                    this.members = res.data.members
                    this.adviser = res.data.adviser
                    this.panels = res.data.panels
                })
            },
        },
        created() {
            this.GetGroupDetails()
        },
        computed: mapGetters(['groupinfo'])
    }

</script>
