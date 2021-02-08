<template>
    <div class="app-main">

        <sidebar :user="user" />
        <div class="app-main__outer">
            <div class="app-main__inner">
                <div class="app-page-title bg-primary text-light">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <i class="fa fa-comments fa-2x"></i>
                            <div class="ml-2">Chat</div>

                        </div>

                    </div>
                </div>
                
                    <div role="group" class="btn-group-lg btn-group btn-group-toggle mb-3">
                        <button type="button" class="btn btn-outline-primary" @click="Select('group')">
                            <i class="fa fa-users pr-1"></i>
                             Group Chat
                            </button>
                        <button type="button" class="btn btn-outline-alternate" @click="Select('user')">
                            <i class="fa fa-user pr-1"></i>
                             User Chat
                            </button>

                    </div>
                    <messenger :isGroupChat="isGroupChat" :user="user" />
              
            </div>
        </div>
    </div>
</template>
<script>
    import AdminSidebar from './AdminSidebar'
    import Messenger from '../../components/Messenger'
    import {
        mapGetters,
        mapActions
    } from 'vuex'
    export default {
        props: ['user'],
        components: {
            'sidebar': AdminSidebar,
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
                    id: this.user.id
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
