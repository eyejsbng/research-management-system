<template>
    <div class="app-main">

        <sidebar :user="user" />

        <div class="app-main__outer">
            <div class="app-main__inner">
                <div class="app-page-title">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <i class="metismenu-icon fas fa-comment-alt fa-2x"></i>
                            <div class="ml-2">Chat</div>

                        </div>

                    </div>
                </div>
                <div class="content">

                    <div role="group" class="btn-group-lg btn-group btn-group-toggle mb-3" data-toggle="buttons">
                        <label class="btn btn-outline-alternate active">
                            <input type="radio" name="options" id="option1" autocomplete="off" @click="Select('user')" checked>
                            <i class="fa fa-user pr-1"></i> User Chat
                        </label>
                        <label class="btn btn-outline-alternate">
                            <input type="radio" name="options" id="option2" autocomplete="off" @click="Select('group')">
                            <i class="fa fa-users pr-1"></i> Group
                        </label>
                        <!-- <button type="button" class="btn btn-outline-primary active" @click="Select('group')">
                            <i class="fa fa-users pr-1"></i>
                            Group Chat
                        </button>
                        <button type="button" class="btn btn-outline-alternate" @click="Select('user')">
                            <i class="fa fa-user pr-1"></i>
                            User Chat
                        </button> -->

                    </div>
                    <messenger :isGroupChat="isGroupChat" :user="user" />
                </div>
            </div>
        </div>
    </div>

</template>
<script>
    import StudentSidebar from './StudentSidebar'
    import Messenger from '../../components/Messenger'
    import {
        mapGetters,
        mapActions
    } from 'vuex'
    export default {
        props: ['user'],
        components: {
            'sidebar': StudentSidebar,
            'messenger': Messenger
        },
        data() {
            return {
                isGroupChat: false,
            }
        },
        methods: {
            Select(str) {
                if (str == 'group') {
                    this.isGroupChat = true
                } else {
                    this.isGroupChat = false
                }
            },
            GetMessenger() {
                var req = {
                    typ: this.user.typ_id,
                    id: this.user.id,
                    grp: this.user.grp_id
                }
                this.fetchmessenger(req)
            },
            ...mapActions(["fetchmessenger"])
        },
        created() {
            this.GetMessenger()
        }
    }

</script>
