<template>
    <div>
        <h4 class="title text-center">Capstone 1 Prototype <br> Rubric/Checklist</h4>
        <div class="alert alert-warning text-center">
            <span>
                Check the system. <br>
                Press the check button if Complied, if not press the other button <br>
                Click Done button to save the changes.
            </span>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="text-center">
                            <tr>
                                <td><strong>Criteria</strong></td>
                                <td><strong>Description <br> The Students were able
                                        to:</strong></td>
                                <td><strong>Complied/ <br> Not Complied</strong></td>
                                <td><strong>Remarks</strong></td>
                            </tr>
                        </thead>
                        <tbody class="text-center" v-if="getcaps1checksys[0]">
                            <tr>
                                <td rowspan="2">User Interface</td>
                                <td>
                                    Design a professional looking <br>
                                    prototype that follows the Human <br>
                                    Interface Guidelines (HIG)
                                </td>
                                <td>
                                    <button @click="CompliedNot(1, 'c')" class="btn btn-round"
                                        :class="{' btn-info' : getcaps1checksys[0].sys1_c1 == true}"><i
                                            class="fas fa-check"></i></button>
                                    <button @click="CompliedNot(1, 'nc')" class="btn btn-round"
                                        :class="{' btn-primary' :  getcaps1checksys[0].sys1_c1 == false}"><i
                                            class="fas fa-times"></i></button>
                                </td>
                                <td>
                                    <textarea v-model="getcaps1checksys[0].sys1_remarks1" class="form-control" cols="10"
                                        rows="5"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Design applications for Desktop,<br>
                                    Web and/or Mobile Interface <br>
                                    wherein the Key pages (Home <br>
                                    Page, Main Menu, etc.) are <br>
                                    present for the target platform/s
                                </td>
                                <td>
                                    <button @click="CompliedNot(2, 'c')" class="btn btn-round"
                                        :class="{' btn-info' : getcaps1checksys[0].sys1_c2 == true}"><i
                                            class="fas fa-check"></i></button>
                                    <button @click="CompliedNot(2, 'nc')" class="btn btn-round"
                                        :class="{' btn-primary' : getcaps1checksys[0].sys1_c2 == false}"><i
                                            class="fas fa-times"></i></button>
                                </td>
                                <td>
                                    <textarea v-model="getcaps1checksys[0].sys1_remarks2" class="form-control" cols="10"
                                        rows="5"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Appropriate <br> Controls / User <br> Experience
                                </td>
                                <td>
                                    Incorporate transitions to <br>
                                    workflows between different <br>
                                    pages/forms/menu (Actions <br>
                                    Events, Triggers, Handleres, and <br>
                                    Listeners are working)
                                </td>
                                <td>
                                    <button @click="CompliedNot(3, 'c')" class="btn btn-round"
                                        :class="{' btn-info' : getcaps1checksys[0].sys1_c3 == true}"><i
                                            class="fas fa-check"></i></button>
                                    <button @click="CompliedNot(3, 'nc')" class="btn btn-round"
                                        :class="{' btn-primary' : getcaps1checksys[0].sys1_c3 == false}"><i
                                            class="fas fa-times"></i></button>
                                </td>
                                <td>
                                    <textarea v-model="getcaps1checksys[0].sys1_remarks3" class="form-control" cols="10"
                                        rows="5"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Presence of <br> Base Classes</td>
                                <td>
                                    Develop base classes to create a <br>
                                    well-defined and flexible model <br>
                                    for the application
                                </td>
                                <td>
                                    <button @click="CompliedNot(4, 'c')" class="btn btn-round"
                                        :class="{' btn-info' : getcaps1checksys[0].sys1_c4 == true}"><i
                                            class="fas fa-check"></i></button>
                                    <button @click="CompliedNot(4, 'nc')" class="btn btn-round"
                                        :class="{' btn-primary' : getcaps1checksys[0].sys1_c4 == false}"><i
                                            class="fas fa-times"></i></button>
                                </td>
                                <td>
                                    <textarea v-model="getcaps1checksys[0].sys1_remarks4" class="form-control" cols="10"
                                        rows="5"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Relevance</td>
                                <td>Present a prototype that meets <br> the user
                                    requirements</td>
                                <td>
                                    <button @click="CompliedNot(5, 'c')" class="btn btn-round"
                                        :class="{' btn-info' : getcaps1checksys[0].sys1_c5 == true}"><i
                                            class="fas fa-check"></i></button>
                                    <button @click="CompliedNot(5, 'nc')" class="btn btn-round"
                                        :class="{' btn-primary' : getcaps1checksys[0].sys1_c5 == false}"><i
                                            class="fas fa-times"></i></button>
                                </td>
                                <td>
                                    <textarea v-model="getcaps1checksys[0].sys1_remarks5" class="form-control" cols="10"
                                        rows="5"></textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6 mr-auto ml-auto">
                <button @click="CheckSystem" class="btn btn-info btn-block btn-round" :disabled="grp.caps1 != 1">Done</button>
            </div>
        </div>
    </div>
</template>
<script>
    import {
        mapGetters,
        mapActions
    } from 'vuex'
    export default {
        props: ['grp', 'user'],
        methods:{
            CompliedNot(td, c) {
                if (td == 1) {
                    if (c == 'c') {
                        this.getcaps1checksys[0].sys1_c1 = 1
                    } else {
                        this.getcaps1checksys[0].sys1_c1 = 0
                    }
                } else if (td == 2) {
                    if (c == 'c') {
                        this.getcaps1checksys[0].sys1_c2 = 1
                    } else {
                        this.getcaps1checksys[0].sys1_c2 = 0
                    }
                } else if (td == 3) {
                    if (c == 'c') {
                        this.getcaps1checksys[0].sys1_c3 = 1
                    } else {
                        this.getcaps1checksys[0].sys1_c3 = 0
                    }
                } else if (td == 4) {
                    if (c == 'c') {
                        this.getcaps1checksys[0].sys1_c4 = 1
                    } else {
                        this.getcaps1checksys[0].sys1_c4 = 0
                    }
                } else if (td == 5) {
                    if (c == 'c') {
                        this.getcaps1checksys[0].sys1_c5 = 1
                    } else {
                        this.getcaps1checksys[0].sys1_c5 = 0
                    }
                }
            },
            CheckSystem() {
                axios.post('../api/adviserchecksystem', {
                    grp: this.grp.grp_id,
                    id: this.user.id,
                    complied: this.getcaps1checksys[0]
                }).then(res => {
                    if (res.data.message == 'success') {
                        this.Alert('success', 'Successfully Check')
                        if(res.data.update == 'Updated'){
                            this.grp.caps1 = 2
                        }
                    }
                    else {
                        this.Alert('info', res.data.message)
                    }
                })
            },
            Alert(icon, title) {
                toast.fire({
                    icon: icon,
                    title: title,
                })
            },
        },
        computed: mapGetters(['getcaps1checksys']),
    }

</script>
