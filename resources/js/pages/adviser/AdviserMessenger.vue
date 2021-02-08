<template>
    <div>
        <sidebar :user="user"></sidebar>
        <div class="main-panel" id="main-panel">
            <nav class="navbar navbar-expand-lg navbar-transparent  navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-toggle">
                            <button type="button" class="navbar-toggler">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </button>
                        </div>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                        aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                    </button>
                    <div class="navbar-collapse justify-content-end collapse" id="navigation">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="#" @click="Select('group')" class="nav-link">Group Chat</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" @click="Select('user')" class="nav-link">User Chat</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="panel-header panel-header-sm">
            </div>
            <div class="content">
                <messenger :isGroupChat="isGroupChat" :user="user" />
            </div>
        </div>
    </div>
</template>
<script>
import AdviserSidebar from './AdviserSidebar'
import Messenger from '../../components/Messenger'
import {mapGetters,mapActions} from 'vuex'
export default {
    props:['user'],
    components: {
        'sidebar': AdviserSidebar,
        'messenger' : Messenger
    },
    data(){
        return{
            isGroupChat: false,
        }
    },
    methods:{
        Select(str){
            if(str == 'group'){
                this.isGroupChat = true
            }
            else{
                this.isGroupChat = false
            }
        },
        GetMessenger(){
            var req = {
                typ : this.user.typ_id,
                id : this.user.id
            }
            this.fetchmessenger(req)
        },
        ...mapActions(["fetchmessenger"])
    },
    created(){
        this.GetMessenger()
    }

}
</script>
