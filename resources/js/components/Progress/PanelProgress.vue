<script>
import {Doughnut} from 'vue-chartjs'
import { mapGetters, mapActions } from 'vuex'
    export default {
        extends: Doughnut,
        methods: {
            getGroup(){
                 this.renderChart({
                    labels: ['Done', 'Not'],
                    datasets:[{
                        data:[this.DonePercent, this.NotPercent],
                        backgroundColor:['Yellow','rgba(0, 0, 0, 0.1)']
                    }]
                }, {responsive:true, maintainAspectRatio: false})
            },
        },
        computed: {
            DonePercent(){
                if (this.groupinfo.info) {
                    return this.groupinfo.info.pan_percent
                }
            },
            NotPercent(){
                if (this.groupinfo.info) {
                    return 100 - this.groupinfo.info.pan_percent
                }
            },
            ...mapGetters(['groupinfo'])
        },
        mounted() {
            this.getGroup()
        }
    }
</script>
