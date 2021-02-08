<template>

    <modal name="section" width="450" height="auto">
        <div class="row">
            <div class="col-md-12">
                  <div class="alert alert-info">
            <span>
                Select section that you want to join.
            </span>
        </div>
            </div>
           
        </div>
       
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Select Section</label>
                    <select class="form-control" v-model="details.secid">
                        <option v-for="s in sections" :key="s.sec_id" :value="s.sec_id">{{ s.sec_code }}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <button class="btn btn-warning btn-round btn-block" @click="UpdateSection">Update</button>
            </div>
        </div>

    </modal>

</template>
<script>
    export default {
        props: ['grp', 'sections'],
        data() {
            return {
                loading: false,
                details: {
                    grpid: '',
                    secid: '',
                    type: 1,
                }
            }
        },

        methods: {
            UpdateSection() {
                this.loading = true
                this.details.grpid = this.grp.grp_id
                axios.post('../api/updategroupsection', this.details).then(res => {
                    if (res.data.message == 'success') {
                        this.loading = false
                        this.grp.sec_id = this.details.secid
                        this.Alert('success', 'Successfully Updated')
                        $('#mdlSection').modal('show')
                    } else {
                        this.loading = false
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
        mounted() {
            this.$modal.show('section')
        }
    }

</script>
