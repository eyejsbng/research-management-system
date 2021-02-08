<template>
    <div class="p-5">
        <div class="row mb-3">
            <div class="col-md-12">
                <h4 class="text-center"><i>{{ minutes.grp_researchtitle}}</i></h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Defense Type</label>
                    <input class="form-control text-center" type="text" v-model="minutes.styp_title" disabled>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Defense Schedule</label>
                    <input class="form-control text-center" type="text" v-model="minutes.min_date" disabled>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Defense Status</label>
                    <input class="form-control text-center" type="text" v-model="minutes.ds_title" disabled>
                </div>
            </div>
        </div>
        <div class="row text-center">
            <h5 class="col-md-12">Comments and Suggestions</h5>
            <hr>
            <div class="col-md-12 mt-1">
                <h6 class="col-md-3 float-left mt-3">Document Format</h6>
                <div class="col-md-9 float-right">
                    <textarea class="form-control text-center" v-model="minutes.min_DocumentFormat" disabled></textarea>
                </div>
            </div>
            <div class="col-md-12 mt-1">
                <h6 class="col-md-3 float-left mt-3">Title</h6>
                <div class="col-md-9 float-right">
                    <textarea class="form-control text-center" v-model="minutes.min1_title" disabled></textarea>
                </div>
            </div>
            <div class="col-md-12 mt-1">
                <h6 class="col-md-3 float-left mt-3">Introduction/ <br> Project Context</h6>
                <div class="col-md-9 float-right">
                    <textarea class="form-control text-center" v-model="minutes.min1_IP" disabled></textarea>
                </div>
            </div>
            <div class="col-md-12 mt-1">
                <h6 class="col-md-3 float-left mt-3" style="text-transform:uppercase">Purpose and Description</h6>
                <div class="col-md-9 float-right">
                    <textarea class="form-control text-center" v-model="minutes.min1_PD" disabled></textarea>
                </div>
            </div>
            <div class="col-md-12 mt-1">
                <h6 class="col-md-3 float-left mt-3">Objectives <br> General</h6>
                <div class="col-md-9 float-right">
                    <textarea class="form-control text-center" v-model="minutes.min1_OG" disabled></textarea>
                </div>
            </div>
            <div class="col-md-12 mt-1">
                <h6 class="col-md-3 float-left mt-3">Specific</h6>
                <div class="col-md-9 float-right">
                    <textarea class="form-control text-center" v-model="minutes.min1_specific" disabled></textarea>
                </div>
            </div>
            <div class="col-md-12 mt-1">
                <h6 class="col-md-3 float-left mt-3">RRL/S</h6>
                <div class="col-md-9 float-right">
                    <textarea class="form-control text-center" v-model="minutes.min1_rrl" disabled></textarea>
                </div>
            </div>
            <div class="col-md-12 mt-1">
                <h6 class="col-md-3 float-left mt-3">Technical <br> Background</h6>
                <div class="col-md-9 float-right">
                    <textarea class="form-control text-center" v-model="minutes.min1_tb" disabled></textarea>
                </div>
            </div>
            <div class="col-md-12 mt-1">
                <h6 class="col-md-3 float-left mt-3">References</h6>
                <div class="col-md-9 float-right">
                    <textarea class="form-control text-center" v-model="minutes.min_references" disabled></textarea>
                </div>
            </div>
            <div class="col-md-12 mt-1">
                <h6 class="col-md-3 float-left mt-3">Others</h6>
                <div class="col-md-9 float-right">
                    <textarea class="form-control text-center" v-model="minutes.min_others" disabled></textarea>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
    export default {
        props: ['minutes'],
        methods: {

        }
    }

</script>
