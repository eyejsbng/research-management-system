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
                            <li v-if="user.typ_id == 1">
                                <router-link to="/admin/profile">
                                    <span class="sidebar-mini-icon">||</span>
                                    <span class="sidebar-normal">Profile</span>
                                </router-link>
                            </li>
                             <li v-if="user.typ_id == 5">
                                <router-link to="/panel/profile">
                                    <span class="sidebar-mini-icon">||</span>
                                    <span class="sidebar-normal">Profile</span>
                                </router-link>
                            </li>
                            <li v-if="user.typ_id == 4">
                                <router-link to="/subjectteacher/profile">
                                    <span class="sidebar-mini-icon">||</span>
                                    <span class="sidebar-normal">Profile</span>
                                </router-link>
                            </li>
                            <li v-if="user.typ_id == 6">
                                <router-link to="/adviser/profile">
                                    <span class="sidebar-mini-icon">||</span>
                                    <span class="sidebar-normal">Profile</span>
                                </router-link>
                            </li>
                             <li>
                                <a href="#">
                                    <span class="sidebar-mini-icon">||</span>
                                    <span class="sidebar-normal">Notifications</span>
                                </a>
                            </li>
                             <li>
                                <a href="#">
                                    <span class="sidebar-mini-icon">||</span>
                                    <span class="sidebar-normal">Messages</span>
                                </a>
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
                    <router-link to="/panel/dashboard">
                        <i class="now-ui-icons design_app"></i>
                        <p>Dashboard</p>
                    </router-link>

                </li>
                <li>
                    <router-link to="/panel/schedule">
                        <i class="fas fa-calendar-alt"></i>
                        <p>Manage Schedule</p>
                    </router-link>

                </li>
                <li>
                    <a data-toggle="collapse" href="#managegroups">
                        <i class="fas fa-users-cog"></i>
                        <p>
                            Manage Groups <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse " id="managegroups">
                        <ul class="nav">
                             <li>
                                <router-link to="/panel/grouprequest">
                                    <span class="sidebar-mini-icon">GR</span>
                                    <span class="sidebar-normal">Group Request</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/panel/group">
                                    <span class="sidebar-mini-icon">G</span>
                                    <span class="sidebar-normal">Groups</span>
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </li>
                 <li v-if="user.typ_id != 5">
                    <a data-toggle="collapse" href="#loginas">
                        <i class="fas fa-cogs"></i>
                        <p>
                            Login As <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse " id="loginas">
                        <ul class="nav">
                             <li v-if="user.typ_id == 1">
                               <router-link to="/admin/dashboard">
                                    <span class="sidebar-mini-icon">RC</span>
                                    <span class="sidebar-normal">Research Coordinator</span>
                                </router-link>
                            </li>
                            <li v-if="user.typ_id == 1 || user.typ_id == 4">
                               <router-link to="/subjectteacher/dashboard">
                                    <span class="sidebar-mini-icon">ST</span>
                                    <span class="sidebar-normal">Subject Teacher</span>
                                </router-link>
                            </li>
                             <li>
                               <router-link to="/adviser/dashboard">
                                    <span class="sidebar-mini-icon">A</span>
                                    <span class="sidebar-normal">Adviser</span>
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div> -->
<div class="app-sidebar sidebar-shadow">
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
                        <div v-if="user.typ_id != 5">
                            <li class="app-sidebar__heading">Login As</li>
                            <li>
                                <a>
                                    <i class="metismenu-icon fas fa-user"></i>
                                    User
                                    <i class="metismenu-state-icon fas fa-chevron-down"></i>
                                </a>
                                <ul>
                                    <li v-if="user.typ_id == 1">
                                        <router-link to="/admin/dashboard">

                                            <span class="sidebar-normal">Research Coordinator</span>
                                        </router-link>
                                    </li>
                                    <li v-if="user.typ_id == 1 || user.typ_id == 4">
                                        <router-link to="/subjectteacher/dashboard">

                                            <span class="sidebar-normal">Subject Teacher</span>
                                        </router-link>
                                    </li>
                                    <li>
                                        <router-link to="/adviser/dashboard">

                                            <span class="sidebar-normal">Adviser</span>
                                        </router-link>
                                    </li>
                                </ul>
                            </li>
                        </div>
                        <li class="app-sidebar__heading">Menu</li>
                        <li>
                            <router-link to="/panel/dashboard"
                                :class="[currentPage.includes('/panel/dashboard') ? activeClass: '','']">
                                <i class="metismenu-icon fas fa-layer-group"></i>
                                <p>Dashboard</p>
                            </router-link>

                        </li>
                        <li>
                            <router-link to="/panel/schedule"
                                :class="[currentPage.includes('/panel/schedule') ? activeClass: '','']">
                                <i class="metismenu-icon fas fa-calendar-alt"></i>
                                <p>Manage Schedule</p>
                            </router-link>
                        </li>
                        <li class="app-sidebar__heading">Manage Groups</li>
                        <li>
                            <router-link to="/panel/grouprequest" :class="[currentPage.includes('/panel/grouprequest') ? activeClass: '','']">
                                <i class="metismenu-icon fas fa-mail-bulk"></i>
                                <p>Group Request</p>
                            </router-link>
                        <li>
                            <router-link to="/panel/group" :class="[currentPage.includes('/panel/group') ? activeClass: '','']">
                               <i class="metismenu-icon fas fa-users"></i>
                                <p>Groups</p>
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
                axios.post('../logout').then(() => {
                    location.reload()
                })
            }
        }
    }

</script>
