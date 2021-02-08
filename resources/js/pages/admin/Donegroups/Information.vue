<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <h4 class="title text-center">Group Information</h4>
            </div>
            <hr>
            <div class="col-md-4">
                <p style="font-size:15px;" class="category text-center">Group Members:
                </p>
                <h6 class="text-center" v-for="mem in grp.members" :key="mem.id">
                    {{ mem.name }}</h6>
            </div>
            <div class="col-md-4">
                <p style="font-size:15px;" class="category text-center">Group Adviser:
                </p>
                <h6 class="text-center" v-if="grp.adviser">{{ grp.adviser.name }}</h6>
            </div>
            <div class="col-md-4">
                <p style="font-size:15px;" class="category text-center">Group Panels:
                <h6 class="text-center" v-for="mem in grp.panels" :key="mem.id">
                    {{ mem.name }}</h6>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['grp']
    }

</script>
