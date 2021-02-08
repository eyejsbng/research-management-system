<template>
    <div>
        <sidebar :user="user"></sidebar>
        <div class="main-panel" id="main-panel">
            <div class="panel-header panel-header-sm">
                <!-- <div class="header text-center">
                    <h2 class="title">{{ user.name }}</h2>
                    <p class="category">Research Coordinator</p>
                </div> -->
            </div>
            <div class="content">
                <profile :user="user" />
            </div>
        </div>
    </div>
</template>
<script>
import StudentSidebar from './StudentSidebar'
import Profile from '../../components/Profile'
export default {
    props:['user'],
    components: {
        'sidebar': StudentSidebar,
        'profile' : Profile
    },
}
</script>
