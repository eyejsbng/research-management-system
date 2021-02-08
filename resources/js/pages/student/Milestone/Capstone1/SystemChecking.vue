<template>
    <div class="row">
        <div class="col-md-12">
             <h4 class="text-center">System Checking</h4>
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
                                <button  class="btn btn-round btn-info"
                                    v-if="getcaps1checksys[0].sys1_c1 == true"><i
                                        class="fas fa-check"></i></button>
                                <button  class="btn btn-round btn-primary"
                                    v-if="getcaps1checksys[0].sys1_c1 == false"><i
                                        class="fas fa-times"></i></button>
                            </td>
                            <td>
                                {{ getcaps1checksys[0].sys1_remarks1 }}
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
                                <button class="btn btn-round btn-info"
                                    v-if="getcaps1checksys[0].sys1_c2 == true"><i
                                        class="fas fa-check"></i></button>
                                <button  class="btn btn-round btn-primary"
                                    v-if="getcaps1checksys[0].sys1_c2 == false"><i
                                        class="fas fa-times"></i></button>
                            </td>
                            <td>
                                {{ getcaps1checksys[0].sys1_remarks2 }}
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
                                <button class="btn btn-round btn-info"
                                    v-if="getcaps1checksys[0].sys1_c3 == true"><i
                                        class="fas fa-check"></i></button>
                                <button class="btn btn-round btn-primary"
                                    v-if="getcaps1checksys[0].sys1_c3 == false"><i
                                        class="fas fa-times"></i></button>
                            </td>
                            <td>
                                {{ getcaps1checksys[0].sys1_remarks3 }}
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
                                <button class="btn btn-round btn-info"
                                    v-if="getcaps1checksys[0].sys1_c4 == true"><i
                                        class="fas fa-check"></i></button>
                                <button class="btn btn-round btn-primary"
                                    v-if="getcaps1checksys[0].sys1_c4 == false"><i
                                        class="fas fa-times"></i></button>
                            </td>
                            <td>
                                {{ getcaps1checksys[0].sys1_remarks4 }}
                            </td>
                        </tr>
                        <tr>
                            <td>Relevance</td>
                            <td>Present a prototype that meets <br> the user
                                requirements</td>
                            <td>
                                <button class="btn btn-round btn-info"
                                    v-if="getcaps1checksys[0].sys1_c5 == true"><i
                                        class="fas fa-check"></i></button>
                                <button class="btn btn-round btn-primary"
                                    v-if="getcaps1checksys[0].sys1_c5 == false"><i
                                        class="fas fa-times"></i></button>
                            </td>
                            <td>
                                {{ getcaps1checksys[0].sys1_remarks5 }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6 mr-auto ml-auto text-center">
            <h6>Check By:</h6>
            <p v-if="getcaps1checksys[0]">{{ getcaps1checksys[0].name }}</p>
        </div>
    </div>
</template>
<script>
import { mapGetters, mapActions } from 'vuex'
    export default {
        computed: mapGetters(['getcaps1checksys']),
    }

</script>
