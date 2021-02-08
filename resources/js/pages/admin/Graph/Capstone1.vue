<script>
import {HorizontalBar} from 'vue-chartjs'
import { mapGetters, mapActions } from 'vuex'
    export default {
        extends: HorizontalBar,
        props:['getadminDashboard'],
        data(){
            return{
                groupname:[],
                grouppercent:[]
            }
        },
        methods: {
            getGroup(){
                 this.renderChart({
                    labels: this.groupname,
                    datasets:[{
                        label: 'Student Progress',
                        backdropColor:'#cfd602',
                        backgroundColor: '#cfd602',
                        data:this.grouppercent,
                    }]
                },
                    {
                        responsive:true,
                        maintainAspectRatio: false,
                        scales:{
                            xAxes:[{
                                ticks:{
                                    beginAtZero: true,
                                }
                            }]
                        }
                    }
                )
            },
        },
        mounted() {
            console.log(this.getadminDashboard)
            for(const key in this.getadminDashboard) {
                this.groupname[key] = this.getadminDashboard[key].grp_title,
                this.grouppercent[key] = this.getadminDashboard[key].grp_percent
            }
            this.getGroup()
        }
    }
</script>
