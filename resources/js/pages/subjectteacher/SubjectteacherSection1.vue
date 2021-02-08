<template>
    <div class="app-main">
        <sidebar :user="user"></sidebar>
        <div class="app-main__outer">
            <div class="app-main__inner">
                <div class="app-page-title">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <i class="metismenu-icon fas fa-users fa-2x"></i> 
                          <h5 class="ml-3">Groups</h5>
                        </div>
                        
                    </div>
                </div>
            <div class="content">
                <div class="card">
                    <div class="card-header">
                        <h4 class=" card-title">List of Capstone 1 Section</h4>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</template>
<script>
    import SubjectteacherSidebar from './SubjectteacherSidebar'
    import {
        mapGetters,
        mapActions
    } from 'vuex'
    export default {
        props: ['user'],
        components: {
            'sidebar': SubjectteacherSidebar,
        },
        data() {
            return {
                count: {
                    student: 0,
                    group: 0,
                    section: 0,
                }
            }
        },
        methods: {
            GetSTDashbaord(){
                axios.get('../api/getstdashboard/'+this.user.id).then(res => {
                    this.count = {
                        student : res.data.student,
                        section : res.data.section
                    }
                })
            }
        },
        created() {
            this.GetSTDashbaord()
        }
    }

</script>
