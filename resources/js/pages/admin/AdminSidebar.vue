<template>
    <div class="app-sidebar sidebar-shadow bg-primary sidebar-text-light">
        <div class="app-header__logo">
            <div class="logo-src">
              
            </div>
            <div class="header__pane ml-auto">
                <div>
                    <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                        data-class="closed-sidebar">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
        <div class="app-header__mobile-menu">
            <div>
                <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
        <div class="app-header__menu">
            <span>
                <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                    <span class="btn-icon-wrapper">
                        <i class="fa fa-ellipsis-v fa-w-6"></i>
                    </span>
                </button>
            </span>
        </div>
        <div class="scrollbar-sidebar">
            <perfect-scrollbar>
            <div class="app-sidebar__inner">
                
                <ul class="vertical-nav-menu">
                    <li class="app-sidebar__heading">Login As</li>
                    <li>
                         <a>
                            <i class="metismenu-icon fas fa-user"></i>
                            User
                            <i class="metismenu-state-icon fas fa-chevron-down"></i>
                        </a>
                        <ul>
                            <li>
                                <router-link to="/subjectteacher/dashboard">
                               
                                    <span class="sidebar-normal">Subject Teacher</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/adviser/dashboard">
                                
                                    <span class="sidebar-normal">Adviser</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/panel/dashboard">
                                  
                                    <span class="sidebar-normal">Panel</span>
                                </router-link>
                            </li>
                        </ul>
                    </li>
                    <li class="app-sidebar__heading">Menu</li>
                    
                    <li >
                        <router-link to="/admin/dashboard" :class="[currentPage.includes('/admin/dashboard') ? activeClass: '','']">
                            <i class="metismenu-icon fas fa-layer-group"></i>
                            Dashboard
                        </router-link>

                    </li>

                    <li>
                        <router-link to="/admin/schedule" :class="[currentPage.includes('/admin/schedule') ? activeClass: '','']">
                            <i class="metismenu-icon fas fa-calendar-week"></i>
                            Manage Schedule
                        </router-link>

                    </li>
                    <li class="app-sidebar__heading" exact>Users</li>

                    <li>
                        <router-link to="/admin/student" :class="[currentPage.includes('/admin/student') ? activeClass: '','']">
                            <i class="metismenu-icon fas fa-graduation-cap"></i>
                            Students
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/admin/subjectteacher" :class="[currentPage.includes('/admin/subjectteacher') ? activeClass: '','']">
                            <i class="metismenu-icon fas fa-chalkboard-teacher"></i>
                            <span class="sidebar-normal">Subject Teacher</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/admin/researchpersonnel" :class="[currentPage.includes('/admin/researchpersonnel') ? activeClass: '','']">
                            <i class="metismenu-icon fas fa-user-tie"></i>
                            <span class="sidebar-normal">Research Personnel</span>
                        </router-link>
                    </li>
                    <li class="app-sidebar__heading">Groups</li>

                    <li>
                        <router-link to="/admin/capstone1" :class="[currentPage.includes('/admin/capstone1') ? activeClass: '','']">
                            <i class="metismenu-icon fas fa-book-reader"></i>
                            <span class="sidebar-normal">Capstone 1</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/admin/capstone2" :class="[currentPage.includes('/admin/capstone2') ? activeClass: '','']"> 
                            <i class="metismenu-icon fas fa-book-reader"></i>
                            <span class="sidebar-normal">Capstone 2</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/admin/groupdone" :class="[currentPage.includes('/admin/groupdone') ? activeClass: '','']">
                            <i class="metismenu-icon fas fa-book-reader"></i>
                            <span class="sidebar-normal">Done</span>
                        </router-link>
                    </li>
                    <li class="app-sidebar__heading">Minutes</li>
                    <li>
                        <router-link to="/admin/viewminutes" :class="[currentPage.includes('/admin/viewminutes') ? activeClass: '','']">
                            <i class="metismenu-icon fas fa-file-invoice"></i>
                            <span class="sidebar-normal"> View Minutes </span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/admin/titleoutlineminutes" :class="[currentPage.includes('/admin/titleoutlineminutes') ? activeClass: '','']">
                            <i class="metismenu-icon fas fa-file-alt"></i>
                            <span class="sidebar-normal">Title-Outline</span>
                        </router-link>
                    </li>

                    <li>
                        <router-link to="/admin/finalminutes" :class="[currentPage.includes('/admin/finalminutes') ? activeClass: '','']">
                            <i class="metismenu-icon fas fa-file-invoice"></i>
                            <span class="sidebar-normal">Final</span>
                        </router-link>
                    </li>
                    <li class="app-sidebar__heading">Research Archive</li>
                    <li>
                        <router-link to="/admin/viewdocuments" :class="[currentPage.includes('/admin/viewdocuments') ? activeClass: '','']">
                            <i class="metismenu-icon fas fa-book"></i>
                            <span class="sidebar-normal">Research</span>
                        </router-link>
                    </li>
                  
                    <li class="app-sidebar__heading">Generate Report</li>
                    <li>
                        <a>
                            <i class="metismenu-icon far fa-file-pdf"></i>
                            Reports
                            <i class="metismenu-state-icon fas fa-chevron-down"></i>
                        </a>
                        <ul>
                            <li>
                        <router-link to="/admin/researchpersonnelreport" :class="[currentPage.includes('/admin/researchpersonnelreport') ? activeClass: '','']">
                      
                            <span class="sidebar-normal">Research Personnel</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/admin/groupprogressreport" :class="[currentPage.includes('/admin/groupprogressreport') ? activeClass: '','']">
                           
                            <span class="sidebar-normal">Group Progress</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/admin/listofresearchreport" :class="[currentPage.includes('/admin/listofresearchreport') ? activeClass: '','']">
                          
                            <span class="sidebar-normal">List of Research</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/admin/schedulereport" :class="[currentPage.includes('/admin/schedulereport') ? activeClass: '','']">
                        
                            <span class="sidebar-normal">Schedule Report</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/admin/evaluationreport" :class="[currentPage.includes('/admin/evaluationreport') ? activeClass: '','']"> 
                           
                            <span class="sidebar-normal">Evaluation Report</span>
                        </router-link>
                    </li>
                     <li>
                        <router-link to="/admin/adviserreports">
                    
                            <span class="sidebar-normal">Adviser Per Groups</span>
                        </router-link>
                    </li>
                        </ul>
                  
                    </li>
                    
                </ul>
               
            </div>
             </perfect-scrollbar>
        </div>
    </div>
    
</template>
<style scoped>
.ps {
    height: 100%;
}
 
</style>
<script>
    export default {
        props: ['user'],
        data() {
            return {
                activeClass: 'mm-active'
            }
        },
        computed: {
            currentPage() {
                $("#app").removeClass('sidebar-mobile-open')
                return this.$route.path;
            }
        },
        methods: {
            logout() {
                axios.post('../logout').then(() => {
                    location.reload()
                })
            },
            
        }
    }

</script>
