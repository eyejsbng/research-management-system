<template>
    <div class="modal fade" data-backdrop="static" data-keyboard="false" id="mdlSection">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <h5 class="modal-title text-center">Group Section for Capstone 2</h5>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning text-center">
                        <span>
                            Select Section That you want to join.
                        </span>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Select Section</label>
                                <select class="form-control">
                                    <option v-for="s in sections" :key="s.sec_id" :value="s.sec_id">{{ s.sec_code }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mr-auto ml-auto">
                            <button class="btn btn-warning btn-round btn-block" @click="UpdateSection">Update</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['grp','sections'],
        data(){
            return{
                details:{
                    grpid:'',
                    secid:'',
                }
            }
        },
        methods:{
            UpdateSection(){
                $('#mdlSection').modal('hide')
            }
        },
        created(){
            $('#mdlSection').modal('show')
        }
    }

</script>
