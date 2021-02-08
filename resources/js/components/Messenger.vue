<template>
    <div id="chat" class="app-inner-layout chat-layout">
        <div class="app-inner-layout__wrapper">
            <div class="app-inner-layout__content card" style="height:60vh;">
                <div class="table-responsive" style="overflow:hidden;">
                    <div class="app-inner-layout__top-pane">
                        <div class="pane-left">
                            <div class="mobile-app-menu-btn">
                                <button type="button" class="hamburger hamburger--elastic"
                                    @click="userSelected = false">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </div>

                        </div>

                    </div>
                   
                        <div class="card-header" style="margin-top:-25px;">
                            <p v-if="select.userid != ''" class="text-nowrap">{{ select.username }}</p>
                            <p v-if="select.grpid != ''" class="text-nowrap">{{ select.grpname }}</p>
                            <p v-if="select.userid == '' && select.grpid == ''" class="text-nowrap">Select User
                            </p>
                        </div>
                        <div class="scroll-area-lg">
                            <div class="scrollbar-container">
                                <p class="mt-5" align="center" v-if="message == '' && loadMessage == false">
                                    No message to show
                                </p>
                                <p v-if="loadMessage == true" class="mt-5" align="center">
                                    <moon-loader :loading="loadMessage" color="#1256b5" size="25px"></moon-loader>
                                    Loading messages . . .
                                </p>


                                <perfect-scrollbar ref="scroll">

                                    <div class="chat-wrapper" v-for="msg in message" :key="msg.key">

                                        <div v-if="user.id != msg.senderID" class="chat-box-wrapper">
                                            <div>
                                                <div class="avatar-icon-wrapper mr-1">
                                                    <!-- <div
                                                class="badge badge-bottom btn-shine badge-success badge-dot badge-dot-lg">
                                            </div> -->
                                                    <!-- <div class="avatar-icon avatar-icon-lg rounded">
                                                <img src="assets/images/avatars/2.jpg" alt="">
                                            </div> -->
                                                </div>
                                            </div>
                                            <div>
                                                <div class="chat-box"> {{ msg.message }}</div>
                                                <small class="opacity-6">
                                                    <i class="fa fa-clockt mr-1"></i>
                                                    {{ msg.created_at | moment("from", "now")}}
                                                </small>
                                            </div>

                                        </div>
                                        <div v-if="user.id == msg.senderID" class="">
                                            <div class="float-right chat-box-wrapper chat-box-wrapper-right">
                                                <div>
                                                    <div class="chat-box">{{ msg.message }}</div>
                                                    <small class="opacity-6">
                                                        <i class="fa fa-clock mr-1"></i>

                                                        {{ msg.created_at | moment("from", "now")}}
                                                    </small>
                                                </div>

                                            </div>
                                        </div>


                                    </div>

                                </perfect-scrollbar>
                            </div>
                        </div>
                        <div class="card-footer mt-4" style="height:70px;">
                            <div class="row col-md-12">
                                <div class="col-md-10">
                                    <input v-model="msg" v-on:keyup.enter="SendMessage" placeholder="Type a message..."
                                        type="text" class="form-control mb-2">
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-block btn-outline-alternate btn-lg" :disabled="msg == ''"><i
                                            class="fas fa-paper-plane mr-2">
                                        </i>Send</button>
                                </div>
                            </div>
                        </div>
                 
                </div>
            </div>
            <div class="chat-list app-inner-layout__sidebar card" style="height:60vh">
                <div class="app-inner-layout__sidebar-header">
                    <div class="card-header bg-light" style="border-color:white">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <div class="input-group mb-3 mt-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-white text-alternate">
                                            <i class="fa fa-search"></i>
                                        </div>
                                    </div>
                                    <input v-model="$store.state.search" placeholder="Search..." type="text"
                                        class="form-control">
                                    <hr>
                                </div>
                            </li>
                        </ul>
                    </div>

                </div>

                <ul class="nav flex-column">

                    <div v-if="isGroupChat == true">
                       
                        <div class="scroll-area-lg">
                            <div class="scrollbar-container">
                                <li class="nav-item" v-for="(grp, index) in filteredGroups" :key="grp.grp_id">
                                    <button type="button" @click="SelectGroup(index,1)" class="dropdown-item">
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-3">
                                                    <div class="avatar-icon-wrapper">

                                                        <div class="avatar-icon">
                                                            <img src="/nowasset/assets/img/default-avatar.png" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="widget-content-left">
                                                    <div class="widget-heading">{{ grp.grp_title }}</div>

                                                </div>
                                            </div>
                                        </div>
                                    </button>
                                </li>
                            </div>
                        </div>
                    </div>
                    <div v-if="isGroupChat == false" style="background-color:white;">

                     
                         <div v-if="filteredUsers == ''" class="mx-auto mt-5">
                                        <moon-loader loading="true" color="#1256b5" size="50px"></moon-loader>
                                    </div>
                        <div class="scroll-area-lg">
                            <div class="scrollbar-container">
                                <perfect-scrollbar>
                                    
                                    <li class="list-group-item adad" v-for="(user, index) in filteredUsers" :key="user.id">
                                    <div class="message-list">
                                            <div @click="SelectUser(index)" class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left mr-3">
                                                        <div class="avatar-icon-wrapper">

                                                            <div class="avatar-icon">
                                                                <img src="/nowasset/assets/img/default-avatar.png"
                                                                    alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="widget-content-left">
                                                        <div class="widget-heading">{{ user.name }}</div>
                                                        <div class="widget-subheading">{{ user.typ_title }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    </li>
                               
                                </perfect-scrollbar>
                            </div>
                        </div>
                    </div>
                </ul>

            </div>
        </div>
    </div>

    <!-- <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            <div class="msg-header" v-if="select.userid != ''">
                                <div class="msg-header-img">
                                    <img src="/nowasset/assets/img/james.jpg" alt="">
                                </div>
                                <div class="active">
                                    <h4>{{ select.username }}</h4>
                                 
                                </div>
                            </div>
                            <div class="msg-header" v-if="select.grpid != ''">
                                <div class="msg-header-img">
                                    <img src="/nowasset/assets/img/james.jpg" alt="">
                                </div>
                                <div class="active">
                                    <h4>{{ select.grpname }}</h4>
                                    
                                </div>
                            </div>
                            <div class="msg-header" v-if="select.userid == '' && select.grpid == ''">
                                <div class="active">
                                    <h4>Select User First</h4>
                                </div>
                            </div>
                            <div class="chat-page">
                                <div class="msg-inbox">
                                    <div class="chats">
                                        <div class="msg-page">
                                            <div v-for="msg in message" :key="msg.key"
                                                :class="`${user.id != message.senderID ? 'received-chats' : 'outgoing-chats'}`">
                                              
                                                <div
                                                    :class="`${user.id != msg.senderID ? 'received-msg' : 'outgoing-chats-msg'}`">
                                                    <div
                                                        :class="`${user.id != msg.senderID ? 'received-msg-inbox' : 'outgoing-msg-inbox'}`">
                                                        <p>{{ msg.message }}</p>
                                                        <span
                                                            class="time">{{ ConverDateandTime(msg.created_at) }}</span>
                                                    </div>
                                                </div>
                                             
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="msg-bottom">
                                <div class="input-group">
                                    <input v-model="msg" @keyup.enter="SendMessage" type="text" class="form-control"
                                        placeholder="Write a message">
                                    <div class="input-group-append">
                                        
                                        <span class="input-group-text" @click="SendMessage">
                                            <i class="fas fa-paper-plane"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center" v-if="isGroupChat == true">
                            Group Chat List
                            <div class="row mb-2">
                                <div class="col-md-10 mr-auto ml-auto">
                                    <div class="from-group">
                                        <input type="text" class="form-control" placeholder="Group User">
                                    </div>
                                </div>
                            </div>
                        </h4>
                        <h4 class="card-title text-center" v-if="isGroupChat == false">
                            User Chat List
                            <div class="row mb-2">
                                <div class="col-md-10 mr-auto ml-auto">
                                    <div class="from-group">
                                        <input type="text" class="form-control" placeholder="Search User">
                                    </div>
                                </div>
                            </div>
                        </h4>
                    </div>
                    <div class="card-body mt-2" style="overflow-y: scroll; height: 440px;" v-if="isGroupChat == false">
                        <div class="row">
                            <div class="col-md-12" v-for="(user, index) in getmessenger.users" :key="user.id">
                                <div class="card card-testimonial">
                                    <div class="card-header card-header-avatar">
                                        <a href="#">
                                            <img src="/nowasset/assets/img/default-avatar.png" class="img img-raised">
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <p class="title text-center" style="font-size:15px;line-height:1px;">
                                            {{ user.name }}</p>
                                        <p class="title text-center" style="font-size:12px;">{{ user.typ_title }}</p>
                                        <button class="btn btn-round btn-sm btn-info" @click="SelectUser(index, 1)"><i
                                                class="fas fa-paper-plane"></i> Message</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="overflow-y: scroll; height: 440px;" v-if="isGroupChat == true">
                        <div class="row">
                            <div class="col-md-12" v-for="(grp, index) in getmessenger.groups" :key="grp.grp_id">
                                <div class="card card-testimonial">
                                    <div class="card-header card-header-avatar">
                                        <a href="#">
                                            <img src="/nowasset/assets/img/default-avatar.png" class="img img-raised">
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <p class="title text-center" style="font-size:15px;line-height:1px;">
                                            {{ grp.grp_title }}</p>
                                        <p class="title text-center" style="font-size:12px;">{{ grp.crs_title }}</p>
                                        <button class="btn btn-round btn-sm btn-info" @click="SelectUser(index, 2)"><i
                                                class="fas fa-paper-plane"></i> Select</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

</template>
<style>
    .card {
        border-radius: 10px;
    }
    .footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;

    }

    .adad:hover {
        box-shadow: 6px 5px 23px -1px rgba(0,0,0,0.8);
        background-color: #f5f5f5;
    }
</style>
<script>
    import firebase from '../Firebase'
    import moment from 'moment'
    import {
        mapGetters
    } from 'vuex'
    export default {
        props: ['isGroupChat', 'user'],
        data() {
            return {
                select: {
                    userid: '',
                    username: '',
                    grpid: '',
                    grpname: '',
                    title: ''
                },
                msg: '',
                message: [],
                count: '',
                userSelected: false,
                userID: '',

                loading: true,
                loadMessage: false,
                search: '',

            }
        },
        mounted() {


        },
        methods: {
            SelectGroup(index) {
                $("#chat").removeClass('open-mobile-menu')
                this.select.userid = ''
                this.select.username = ''
                this.select.grpid = this.filteredGroups[index].grp_id
                this.select.grpname = this.filteredGroups[index].grp_title
                firebase.database().ref('/messages/group/' + this.select.grpid).on('value', data => {
                    let tmp = [];
                    data.forEach(data => {
                        tmp.push({
                            key: data.key,
                            senderID: data.val().senderID,
                            receiverID: data.val().receiverID,
                            message: data.val().message,
                            created_at: data.val().created_at
                        })
                        if (data.val().status == 0) {
                            this.count += 1
                        }
                    });
                    this.message = tmp
                })
            },
            SelectUser(index) {
                $("#chat").removeClass('open-mobile-menu')
                this.loadMessage = true,
                    this.message = []
                this.select.userid = this.filteredUsers[index].id
                this.select.username = this.filteredUsers[index].name
                this.select.grpid = ''
                this.select.grpname = ''

                this.MatchUser()
                firebase.database().ref('/messages/user/' + this.userID).on('value', data => {

                    let tmp = [];
                    data.forEach(data => {
                        tmp.push({
                            key: data.key,
                            senderID: data.val().senderID,
                            receiverID: data.val().receiverID,
                            message: data.val().message,
                            created_at: data.val().created_at
                        })
                        if (data.val().status == 0) {
                            this.count += 1
                        }
                    });
                    this.loadMessage = false,
                        this.message = tmp
                    this.userSelected = true



                })

            },
            SendMessage() {
                if (this.select.userid != '') {
                    if (this.msg == '') {
                        this.Alert('warning', 'Please Provide Message')
                    } else {
                        firebase.database().ref('/messages/user/' + this.userID).push({
                            senderID: this.user.id,
                            receiverID: this.select.userid,
                            message: this.msg,
                            status: 0,
                            created_at: Date.now()
                        })
                    }

                    this.msg = ''
                } else {
                    if (this.msg == '') {
                        this.Alert('warning', 'Please Provide Message')
                    } else {
                        firebase.database().ref('/messages/group/' + this.select.grpid).push({
                            senderID: this.user.id,
                            receiverID: this.select.userid,
                            message: this.msg,
                            status: 0,
                            created_at: Date.now()
                        })
                    }

                    this.msg = ''
                }
            },
            MatchUser() {
                if (this.user.id < this.select.userid) {
                    this.userID = this.user.id + '' + this.select.userid
                } else {
                    this.userID = this.select.userid + '' + this.user.id
                }
            },
            ConverDateandTime(date) {
                return moment(date).format('YYYY-MM-DD, hh:mm')
            },
            Alert(type, title) {
                toast.fire({
                    icon: type,
                    title: title
                })
            },
            searchUser(users, keyword) {
                const search = keyword.trim().toLowerCase()
                if (!search.length) return users
                return users.filter(item => item.name.toLowerCase().indexOf(search) > -1)
            }
        },
        // watch: {
        //     filteredUsers() {
        //         if (this.users != '') {
        //             this.loading = false
        //         }
        //     },

        // },
        computed: {
            ...mapGetters(['filteredUsers', 'filteredGroups']),

            groups() {
                return this.$store.getters.getmessenger.groups
            }
        }



    }

</script>
