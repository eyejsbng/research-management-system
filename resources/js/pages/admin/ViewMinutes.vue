<template>
    <div class="app-main">
        <sidebar :user="user"></sidebar>
        <div class="app-main__outer bg-white">
            <div class="app-main__inner">
                <div class="app-page-title bg-primary text-light">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <div>Minutes </div>
                        </div>
                    </div>
                </div>
                <div class="content">
                     <div class="flex flex-col">
                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                        <table class="min-w-full divide-y divide-gray-150">
                                            <thead class="bg-gray-50">

                                                <tr>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">

                                                        Group
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Title
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Defense Type
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Status
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Action
                                                    </th>
                                        
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                <tr v-for="(m,index) in getminutes.sched.data" :key="m.min_id">
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    {{ m.grp_title }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                      
                                             
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900">{{ m.grp_researchtitle }}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        {{ m.styp_title }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ m.ds_title }}
                                                    </td>
        
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <button @click="View(index,1)"
                                                            class="btn btn-info btn-sm btn-round">View</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- This example requires Tailwind CSS v2.0+ -->
                                    <!-- <div
                                        class="px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                                        <ul class="pagination">
                                            <pagination :data="getstudentdata" @pagination-change-page="Paginate"
                                                :limit=5>
                                            </pagination>
                                        </ul>
                                    </div> -->

                                </div>
                            </div>
                            <!-- <div class="mt-3" align="center">
                                <moon-loader :loading="loading1" color="#1256b5" size="70px">
                                </moon-loader>
                            </div> -->
                    </div>
                      <div class="flex flex-col">
                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                        <table class="min-w-full divide-y divide-gray-150">
                                            <thead class="bg-gray-50">

                                                <tr>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">

                                                        Group
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Title
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Defense Type
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Status
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Action
                                                    </th>
                                        
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                <tr v-for="(m,index) in getminutes.sched2.data" :key="m.min_id">
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    {{ m.grp_title }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                      
                                             
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900">{{ m.grp_researchtitle }}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        {{ m.styp_title }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ m.ds_title }}
                                                    </td>
        
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <button @click="View(index,1)"
                                                            class="btn btn-info btn-sm btn-round">View</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- This example requires Tailwind CSS v2.0+ -->
                                    <!-- <div
                                        class="px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                                        <ul class="pagination">
                                            <pagination :data="getstudentdata" @pagination-change-page="Paginate"
                                                :limit=5>
                                            </pagination>
                                        </ul>
                                    </div> -->

                                </div>
                            </div>
                            <!-- <div class="mt-3" align="center">
                                <moon-loader :loading="loading2" color="#1256b5" size="70px">
                                </moon-loader>
                            </div> -->
                    </div>
                  
                </div>
            </div>

        </div>
        <modal name="example" :scrollable="true" :adaptive="true" width="750" height="80%">
            <perfect-scrollbar>
                <titleoutline :minutes="minutes" v-if="isTitle == true" />
                <final :minutes="minutes" v-if="isFinal == true" />
            </perfect-scrollbar>
        </modal>
    </div>
</template>
<style>
    .ps {
        height: 100%;
    }

</style>
<script>
    import AdminSidebar from './AdminSidebar'
    import TitleOutline from './Capstone1/Minutes/TitleOutline'
    import Final from './Capstone1/Minutes/Final'
    import {
        mapGetters,
        mapActions
    } from 'vuex'
    import moment from 'moment';
    export default {
        props: ['user'],
        data() {
            return {
                minutes: {},

                isTitle: false,
                isFinal: false,

                getminutes: {},
                loading1 : true,
                loading2 : true,
            }
        },
        components: {
            'sidebar': AdminSidebar,
            'titleoutline': TitleOutline,
            'final': Final
        },
        methods: {
            showModal() {
                this.$modal.show('example');
            },
            GetMinutes() {
                let req = {
                    type: '',
                    grp: '',
                    isCaps1: ''
                }
                axios.post('../api/getminutes', req).then(res => {
                    this.getminutes = res.data
                    console.log(this.getminutes)
                })
            },
            View(index, num) {
                if (num == 1) {
                    this.minutes = this.getminutes.sched.data[index]
                    this.isTitle = true
                    this.isFinal = false
                    this.showModal()
                } else {
                    this.minutes = this.getminutes.sched2.data[index]
                    this.isFinal = true
                    this.isTitle = false
                    this.showModal();
                }
            },
            Close() {
                this.isTitle = false
                this.isFinal = false
            },

        },
        watch: {
         
         
        },
        computed: {},
        created() {
            this.GetMinutes()
        }
    }

</script>
