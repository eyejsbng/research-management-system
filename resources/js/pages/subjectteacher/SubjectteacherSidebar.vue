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
                            <li v-if="user.typ_id == 4">
                                <router-link to="/subjectteacher/profile">
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
                    <router-link to="/subjectteacher/dashboard">
                        <i class="now-ui-icons design_app"></i>
                        <p>Dashboard</p>
                    </router-link>

                </li>
                <li>
                    <router-link to="/subjectteacher/schedule">
                        <i class="fas fa-calendar-alt"></i>
                        <p>Manage Schedule</p>
                    </router-link>

                </li>
                <li>
                    <router-link to="/subjectteacher/groups">
                        <i class="fas fa-users"></i>
                        <p>Manage Groups</p>
                    </router-link>

                </li>
                <li>
                    <a data-toggle="collapse" href="#section">
                        <i class="fas fa-users"></i>
                        <p>
                            Sections <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="section">
                        <ul class="nav">
                            <li>
                                <router-link to="/subjectteacher/sections1">
                                    <span class="sidebar-mini-icon">C1</span>
                                    <span class="sidebar-normal">Capstone 1</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/subjectteacher/sections2">
                                    <span class="sidebar-mini-icon">C2</span>
                                    <span class="sidebar-normal">Capstone 2</span>
                                </router-link>
                            </li>
                        </ul>
                    </div>

                </li>
                 <li v-if="user.typ_id != 2">
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
                            <li>
                               <router-link to="/adviser/dashboard">
                                    <span class="sidebar-mini-icon">A</span>
                                    <span class="sidebar-normal">Adviser</span>
                                </router-link>
                            </li>
                            <li>
                               <router-link to="/panel/dashboard">
                                    <span class="sidebar-mini-icon">P</span>
                                    <span class="sidebar-normal">Panel</span>
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
                        <div v-if="user.typ_id == 1">
                        <li class="app-sidebar__heading">Login As</li>
                        <li>
                            <a>
                                <i class="metismenu-icon fas fa-user"></i>
                                User
                                <i class="metismenu-state-icon fas fa-chevron-down"></i>
                            </a>
                            <ul>
                                <li>
                                    <router-link to="/admin/dashboard">

                                        <span class="sidebar-normal">Research Coordinator</span>
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
                        </div>
                        <li class="app-sidebar__heading">Menu</li>
                        <li>
                            <router-link to="/subjectteacher/dashboard"
                                :class="[currentPage.includes('/subjectteacher/dashboard') ? activeClass: '','']">
                                <i class="metismenu-icon fas fa-layer-group"></i>
                                Dashboard
                            </router-link>

                        </li>
                        <li>
                            <router-link to="/subjectteacher/schedule"
                                :class="[currentPage.includes('/subjectteacher/schedule') ? activeClass: '','']">
                                <i class="metismenu-icon fas fa-calendar-alt"></i>
                                <p>Manage Schedule</p>
                            </router-link>

                        </li>
                        <li>
                            <router-link to="/subjectteacher/groups"
                                :class="[currentPage.includes('/subjectteacher/groups') ? activeClass: '','']">
                                <i class="metismenu-icon fas fa-users"></i>
                                <p>Manage Groups</p>
                            </router-link>

                        </li>
                        <li class="app-sidebar__heading">Sections</li>

                        <li>
                            <router-link to="/subjectteacher/sections1">
                               
                                <span class="sidebar-normal">Capstone 1</span>
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/subjectteacher/sections2">
                               
                                <span class="sidebar-normal">Capstone 2</span>
                            </router-link>
                        </li>

                    </ul>

                </div>
            </perfect-scrollbar>
        </div>
    </div>
</template>
<style>
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
            }
        }
    }

</script>
