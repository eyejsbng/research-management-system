<template>
    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="title text-center">
                    Final Defense <br>
                    Minutes of the Defense
                </h4>
                <hr>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <h5 class="col-md-12">Comments and Suggestions</h5>
                    <hr>
                    <div class="col-md-12 mt-1">
                        <h6 class="col-md-3 float-left mt-3">Document Format</h6>
                        <div class="col-md-9 float-right">
                            <textarea class="form-control" v-model="minutes.min_DocumentFormat" disabled></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 mt-1">
                        <h6 class="col-md-3 float-left mt-3">Chapter 1</h6>
                        <div class="col-md-9 float-right">
                            <textarea class="form-control" v-model="minutes.min2_chapter1" disabled></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 mt-1">
                        <h6 class="col-md-3 float-left mt-3">Chapter 2</h6>
                        <div class="col-md-9 float-right">
                            <textarea class="form-control" v-model="minutes.min2_chapter2" disabled></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 mt-1">
                        <h6 class="col-md-3 float-left mt-3">Chapter 3</h6>
                        <div class="col-md-9 float-right">
                            <textarea class="form-control" v-model="minutes.min2_chapter3" disabled></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 mt-1">
                        <h6 class="col-md-3 float-left mt-3">Methodology</h6>
                        <div class="col-md-9 float-right">
                            <textarea class="form-control" v-model="minutes.min2_methodology" disabled></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 mt-1">
                        <h6 class="col-md-3 float-left mt-3">Results and <br> Discussion</h6>
                        <div class="col-md-9 float-right">
                            <textarea class="form-control" v-model="minutes.min2_RD" disabled></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 mt-1">
                        <h6 class="col-md-3 float-left mt-3">Conclusion</h6>
                        <div class="col-md-9 float-right">
                            <textarea class="form-control" v-model="minutes.min2_conclussion" disabled></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 mt-1">
                        <h6 class="col-md-3 float-left mt-3">Recommendation</h6>
                        <div class="col-md-9 float-right">
                            <textarea class="form-control" v-model="minutes.min2_recommendation" disabled></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 mt-1">
                        <h6 class="col-md-3 float-left mt-3">References</h6>
                        <div class="col-md-9 float-right">
                            <textarea class="form-control" v-model="minutes.min_references" disabled></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 mt-1">
                        <h6 class="col-md-3 float-left mt-3">Application/ <br> System</h6>
                        <div class="col-md-9 float-right">
                            <textarea class="form-control" v-model="minutes.min2_AS" disabled></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 mt-1">
                        <h6 class="col-md-3 float-left mt-3">Others</h6>
                        <div class="col-md-9 float-right">
                            <textarea class="form-control" v-model="minutes.min_others" disabled></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['minutes']
    }

</script>
