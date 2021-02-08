<template>
    <!-- <div class="sidebar" id="sidebar" data-color="red">
        <div class="logo">
            <a href="#" class="logo-mini">
                <img src="/assets/img/logo.png" />
            </a>

            <a href="#" class="simple-text logo-normal">
                CCERMS
            </a>
        </div>
        <div class="sidebar-wrapper" id="sidebar-wrapper">
            <div class="user">
                <div class="photo">
                    <img src="/nowasset/assets/img/james.jpg" />
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                        <span>
                            {{ user.name }}
                            <b class="caret"></b>
                        </span>
                    </a>
                    <div class="clearfix"></div>
                    <div class="collapse" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <router-link to="/student/profile">
                                    <span class="sidebar-mini-icon">||</span>
                                    <span class="sidebar-normal">My Profile</span>
                                </router-link>
                            </li>
                             <li>
                                <a href="#">
                                    <span class="sidebar-mini-icon">||</span>
                                    <span class="sidebar-normal">Notifications</span>
                                </a>
                            </li>
                             <li>
                                <router-link to="/student/messenger">
                                    <span class="sidebar-mini-icon">||</span>
                                    <span class="sidebar-normal">Messages</span>
                                </router-link>
                            </li>
                            <li>
                                <a @click="logout" href="#">
                                    <span class="sidebar-mini-icon">||</span>
                                    <span class="sidebar-normal">Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav">
                <li>
                    <router-link to="/student/dashboard">
                        <i class="now-ui-icons design_app"></i>
                        <p>Dashboard</p>
                    </router-link>
                </li>
                 <li>
                    <a data-toggle="collapse" href="#manageusers">
                        <i class="fas fa-users-cog"></i>
                        <p>
                            Groups<b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse " id="manageusers">
                        <ul class="nav">
                            <li>
                                <router-link to="/student/group/information">
                                    <span class="sidebar-mini-icon">I</span>
                                    <span class="sidebar-normal">Information</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/student/group/section">
                                    <span class="sidebar-mini-icon">S</span>
                                    <span class="sidebar-normal">Section</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/student/group/submission">
                                    <span class="sidebar-mini-icon">S</span>
                                    <span class="sidebar-normal">Submission</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/student/group/minutes">
                                    <span class="sidebar-mini-icon">M</span>
                                    <span class="sidebar-normal">Minutes</span>
                                </router-link>
                            </li>
                        </ul>
                    </div>
                 </li>
                <li>
                    <router-link to="/student/schedule">
                        <i class="fas fa-calendar-alt"></i>
                        <p>Schedule</p>
                    </router-link>
                </li>
                <li>
                    <router-link to="/student/researchlist">
                        <i class="fas fa-calendar-alt"></i>
                        <p>Research List</p>
                    </router-link>
                </li>
                <li>
                    <router-link to="/student/evaluation">
                        <i class="fas fa-calendar-alt"></i>
                        <p>Evaluation</p>
                    </router-link>
                </li>
            </ul>
        </div>
    </div> -->
    <div class="app-sidebar sidebar-shadow bg-dark sidebar-text-light">
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
                       
                        <li class="app-sidebar__heading">Menu</li>
                        <li>
                            <router-link to="/student/dashboard"
                                :class="[currentPage.includes('/student/dashboard') ? activeClass: '','']">
                                <i class="metismenu-icon fas fa-layer-group"></i>
                                <p>Dashboard</p>
                            </router-link>

                        </li>
                        <li>
                            <router-link to="/student/schedule"
                                :class="[currentPage.includes('/student/schedule') ? activeClass: '','']">
                                <i class="metismenu-icon fas fa-calendar-alt"></i>
                                <p>Schedule</p>
                            </router-link>
                        </li>
                        <li class="app-sidebar__heading">My Group</li>
                        <li>
                            <router-link to="/student/information" :class="[currentPage.includes('/student/information') ? activeClass: '','']">
                                <i class="metismenu-icon fas fa-mail-bulk"></i>
                                <p>Information</p>
                            </router-link>
                        <li>
                            <router-link to="/student/section" :class="[currentPage.includes('/student/section') ? activeClass: '','']">
                               <i class="metismenu-icon fas fa-users"></i>
                                <p>Section</p>
                            </router-link>
                            
                        </li>
                         <li>
                            <router-link to="/student/submission" :class="[currentPage.includes('/student/submission') ? activeClass: '','']">
                               <i class="metismenu-icon fas fa-users"></i>
                                <p>Submissions</p>
                            </router-link>
                            
                        </li>
                         <li>
                            <router-link to="/student/minutes" :class="[currentPage.includes('/student/minutes') ? activeClass: '','']">
                               <i class="metismenu-icon fas fa-users"></i>
                                <p>Minutes</p>
                            </router-link>
                            
                        </li>
                    </ul>

                </div>
            </perfect-scrollbar>
        </div>
</div>
</template>
<script>
    export default {
        props:['user'],
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
        methods:{
            logout(){
                axios.post('../../logout').then(() => {
                    location.reload()
                })
            }
        }
    }

</script>
