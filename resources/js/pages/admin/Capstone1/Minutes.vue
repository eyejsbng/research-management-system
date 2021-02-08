<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <h4 class="title text-center">
                    Group Minutes
                    Title / Outline
                </h4>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-hovered">
                        <thead class="text-info">
                            <tr>
                                <td><strong>Group Name</strong></td>
                                <td><strong>Research Title</strong></td>
                                <td><strong>Defense Type</strong></td>
                                <td><strong>Defense Status</strong></td>
                                <td><strong>View</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(m,index) in minutes" :key="m.min_id">
                                <td>{{ m.grp_title }}</td>
                                <td>{{ m.grp_researchtitle }}</td>
                                <td>{{ m.styp_title }}</td>
                                <td>{{ m.ds_title }}</td>
                                <td>
                                    <button @click="View(index,1)" class="btn btn-info btn-sm btn-round">View</button>
                                </td>
                            </tr>
                             <tr v-for="(m,index) in minutes2" :key="m.min_id">
                                <td>{{ m.grp_title }}</td>
                                <td>{{ m.grp_researchtitle }}</td>
                                <td>Final</td>
                                <td>{{ m.ds_title }}</td>
                                <td>
                                    <button @click="View(index,2)" class="btn btn-info btn-sm btn-round">View</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12">
                
            </div>
        </div>
          <modal :styles="{'z-index': 0,}" name="minutes" adaptive="true" height="750">
              <perfect-scrollbar>
              <titleoutline :minutes="min" v-if="isTitle == true"/>
                <final :minutes="min" v-if="isFinal == true"/>
               
              </perfect-scrollbar>
        </modal>
    </div>
</template>
<script>
import TitleOutline from './Minutes/TitleOutline'
import Final from './Minutes/Final'
export default {
    props:['capstone'],
    components:{
        'titleoutline' : TitleOutline,
        'final' : Final
    },
    data(){
        return{
            minutes: {},
            minutes2:{},

            min: {},
            isTitle: false,
            isFinal: false,
        }
    },
    methods:{
        GetMinutes(){
            let req ={
                grp: this.capstone.grp_id,
                type: '',
                isCaps1: 1,
            }
            axios.post('../../api/getminutes', req).then(res => {
                this.minutes = res.data.sched
                this.minutes2 = res.data.sched2
            })
        },
        View(index, num){
           
            if (num == 1) {
                this.$modal.show('minutes')
                this.min = this.minutes[index]
                this.isTitle = true
                this.isFinal = false
            }
            else{
                this.min = this.minutes2[index]
                this.isTitle = false
                this.isFinal = true
            }
        },
        Close(){
            this.isTitle = false
            this.isFinal = false
        }
    },
    created(){
        this.GetMinutes()
    }
}
</script>
