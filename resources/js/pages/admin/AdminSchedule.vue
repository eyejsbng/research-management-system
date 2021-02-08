<template>
    <div class="app-main">
        <sidebar :user="user" />
        <div class="app-main__outer bg-white">
            <div class="app-main__inner">
                <div class="app-page-title bg-primary text-light">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <div v-if="create == false">
                                <i class="metismenu-icon fas fa-calendar-week fa-2x mt-2"></i>
                                Manage Schedule
                            </div>
                            <div v-if="create == true">
                                <a href="#" v-if="create == true" 
                                    @click="create = false"><i class="fas fa-chevron-left text-light mr-2"></i>
                                    </a>
                                Create New Schedule</div>
                        </div>
                    </div>
                </div>
               

                <div class="row">
                    <div v-if="create == true" class="create col-md-7">
                        <!-- <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Create New Defense Schedule</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="text-center">Type</label>
                                        <div class="form-group">
                                            <select class="form-control" v-model="typ_id" @change="ChangeDefenseType">
                                                <option v-for="type in getdependencies.schedType" :key="type.styp_id"
                                                    :value='type.styp_id'>{{type.styp_title}}
                                                </option>
                                            </select>
                                        </div>
                                        <p style="font-size:12px;color:red">{{ error.type }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="text-center">Group</label>
                                        <div class="form-group">
                                            <select class="form-control" v-model="grp_id">
                                                <option v-for="group in groups" :key="group.grp_id"
                                                    :value="group.grp_id">{{ group.grp_title }}</option>
                                            </select>
                                        </div>
                                        <p style="font-size:12px;color:red">{{ error.group }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="text-center">Venue</label>
                                        <div class="form-group">
                                            <input type="text" placeholder="Add the Defense Venue" class="form-control"
                                                v-model="venue">
                                        </div>
                                        <p style="font-size:12px;color:red">{{ error.venue }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Date</label>
                                            <datetime id="date" format="MM/DD/YYYY" v-model="date"></datetime>
                                        </div>
                                        <p style="font-size:12px;color:red">{{ error.date }}</p>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Start Time</label>
                                        <div class="form-group">
                                            <datetime id="stime" format="h:i" v-model="stime"></datetime>
                                        </div>
                                        <p style="font-size:12px;color:red">{{ error.stime }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <label>End Time</label>
                                        <div class="form-group">
                                            <datetime id="etime" format="h:i" v-model="etime"></datetime>
                                        </div>
                                        <p style="font-size:12px;color:red">{{ error.etime }}</p>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="text-center">Status</label>
                                        <div class="form-group">
                                            <select class="form-control" v-model="ds_id" :disabled="isUpdate == false">
                                                <option v-for="status in getdependencies.defStatus" :key="status.ds_id"
                                                    :value="status.ds_id">{{ status.ds_title }}
                                                </option>
                                            </select>
                                        </div>
                                        <p style="font-size:12px;color:red">{{ error.status }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 float-right">
                                        <button v-if="isUpdate == false" @click="CreateSchedule"
                                            class="btn btn-primary  btn-round "><i class="fas fa-calendar-alt"></i>
                                            Create Schedule</button>
                                        <button v-if="isUpdate == true" @click="UpdateSchedule"
                                            class="btn btn-primary btn-round "><i class="fas fa-calendar-alt"></i>
                                            Updsdate Schedule</button>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div
                            class="col-md-12 max-w-md border border-gray-200 shadow-xs rounded-lg p-10 bg-white space-y-6 flex-grow">
                            <div class="col-md-6">
                                <h3>Create New</h3>
                            </div>

                            <div class="row ">

                                <div class="col-md-6">
                                    <label class="block tracking-wide text-gray-500 font-bold mb-2">
                                        Type
                                    </label>
                                    <div class="relative">
                                        <select
                                            class="block appearance-none w-full bg-gray-50 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                            v-model="typ_id" @change="ChangeDefenseType">
                                            <option v-for="type in getdependencies.schedType" :key="type.styp_id"
                                                :value='type.styp_id'>{{type.styp_title}}</option>

                                        </select>
                                        <div
                                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                            </svg>
                                        </div>
                                        <p class="text-red-500 text-xs"> {{ error.typ_id}}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="block tracking-wide text-gray-500 font-bold mb-2">
                                        Group
                                    </label>
                                    <div class="relative">
                                        <select
                                            class="block appearance-none w-full bg-gray-50 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                            v-model="grp_id">>
                                            <option v-for="group in groups" :key="group.grp_id" :value="group.grp_id">
                                                {{ group.grp_title }}</option>

                                        </select>
                                        <div
                                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                            </svg>
                                        </div>
                                        <p class="text-red-500 text-xs"> {{ error.grp_id }}</p>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="block tracking-wide text-gray-500 font-bold mb-2" for="grid-city">
                                        Date
                                    </label>
                                    <date-time id="date"
                                        input-class="appearance-none block w-full bg-gray-50 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                        v-model="date"></date-time>
                                    <p class="text-red-500 text-xs"> {{ error.date}}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="block tracking-wide text-gray-500 font-bold mb-2" for="grid-city">
                                        Venue
                                    </label>
                                    <input
                                        class="appearance-none block w-full bg-gray-50 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                        v-model="venue" type="text" placeholder="">
                                    <p class="text-red-500 text-xs"> {{ error.venue}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="block tracking-wide text-gray-500 font-bold mb-2">
                                        Start Time
                                    </label>
                                    <date-time id="stime" type="time" v-model="stime" input-class="appearance-none block w-full bg-gray-50 text-gray-700 
                                    border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:
                                    bg-white focus:border-gray-500" use12-hour></date-time>
                                    <p class="text-red-500 text-xs"> {{ error.stime}}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="block tracking-wide text-gray-500 font-bold mb-2">
                                        End Time
                                    </label>
                                    <date-time id="etime" use12-hour type="time" v-model="etime" input-class="appearance-none block w-full bg-gray-50 text-gray-700 
                                    border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:
                                    bg-white focus:border-gray-500"></date-time>
                                    <p class="text-red-500 text-xs"> {{ error.etime}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="relative">
                                        <label class="block tracking-wide text-gray-500 font-bold mb-2" for="grid-city">
                                            Status
                                        </label>
                                        <select
                                            class="block appearance-none w-full bg-gray-50 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                            v-model="ds_id" :disabled="isUpdate == false">
                                            <option v-for="status in getdependencies.defStatus" :key="status.ds_id"
                                                :value="status.ds_id">{{ status.ds_title }}</option>

                                        </select>
                                        <div
                                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                            </svg>
                                        </div>
                                        <p class="text-red-500 text-xs"> {{ error.ds_id}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 float-right">
                                    <button v-if="isUpdate == false" @click="CreateSchedule"
                                        class="btn btn-primary btn-round btn-lg"><i class="fas fa-calendar-alt"></i>
                                        Create Schedule</button>
                                    <button v-if="isUpdate == true" @click="UpdateSchedule"
                                        class="btn btn-primary btn-round "><i class="fas fa-calendar-alt"></i>
                                        Update Schedule</button>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>


                <!-- This example requires Tailwind CSS v2.0+ -->
                <div v-if="create == false">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="col-span-6 sm:col-span-3">
                                <label for="country" class="block text-sm font-medium text-gray-700">Sort by
                                    type</label>
                                <select id="country" v-model="searching.type"
                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option v-for="type in getdependencies.schedType" :key="type.styp_id"
                                        :value="type.styp_id">{{ type.styp_title}}</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                <label for="city" class="block text-sm font-medium text-gray-700">Search</label>
                                <input type="text" class="form-control form-control" @keyup="SearchGroups"
                                    placeholder="Search group" v-model="searching.grp">
                            </div>
                        </div>
                         <div class="col-md-3 mt-4">
                            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                 <button v-if="create == false" class="btn btn-primary btn-lg"
                    @click="create = true"><i class="fas fa-plus"></i>
                    Create New</button>
                            </div>
                            
                        </div>


                    </div>

                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-150" >
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                                    Group
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Type
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Date
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Time
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Venue
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Status
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                    Action
                                                </th>

                                            </tr>
                                        </thead>

                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <tr v-for="(sched,index) in getdefenseschedule.data" :key="sched.def_id">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">
                                                                {{ sched.grp_title }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ sched.styp_title }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ sched.def_date }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ sched.def_stime }} ~ {{ sched.def_etime }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ sched.def_address }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ sched.ds_title }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    <div class="items-center">
                                                        <button v-if="sched.def_status == 1"
                                                            @click="SelectUpdate(index)"
                                                            class="btn btn-outline-primary btn-sm">Edit</button>

                                                        <button v-else disabled=""
                                                            class="mb-2 mr-2 btn btn-shadow btn-light disabled">No
                                                            action</button>
                                                    </div>

                                                </td>
                                            </tr>

                                            <!-- More items... -->
                                        </tbody>
                                    </table>

                                </div>

                            </div>

                        </div>
                        <div class="mt-3" align="center">
                            <moon-loader :loading="loading" color="#1256b5" size="70px">
                            </moon-loader>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <modal name="updatesched" :adaptive="true" height="auto">
            <div class="card-header">
                Update Schedule Information
            </div>
            <div class="row ml-auto mr-auto">

                <div class="col-md-6">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        Type
                    </label>
                    <div class="relative">
                        <select
                            class="block appearance-none w-full bg-gray-50 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            v-model="typ_id" @change="ChangeDefenseType">
                            <option v-for="type in getdependencies.schedType" :key="type.styp_id" :value='type.styp_id'>
                                {{type.styp_title}}</option>

                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                        <p class="text-red-500 text-xs"> {{ error.typ_id}}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        Group
                    </label>
                    <div class="relative">
                        <select
                            class="block appearance-none w-full bg-gray-50 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            v-model="grp_id">>
                            <option v-for="group in groups" :key="group.grp_id" :value="group.grp_id">
                                {{ group.grp_title }}</option>

                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                        <p class="text-red-500 text-xs"> {{ error.grp_id }}</p>
                    </div>
                </div>

            </div>
            <div class="row ml-auto mr-auto">
                <div class="col-md-6">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
                        Date
                    </label>
                    <date-time id="date"
                        input-class="appearance-none block w-full bg-gray-50 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        v-model="date"></date-time>
                    <p class="text-red-500 text-xs"> {{ error.date}}</p>
                </div>
                <div class="col-md-6">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
                        Venue
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-50 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        v-model="venue" type="text" placeholder="">
                    <p class="text-red-500 text-xs"> {{ error.venue}}</p>
                </div>
            </div>
            <div class="row ml-auto mr-auto">
                <div class="col-md-6">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        Start Time
                    </label>
                    <date-time id="stime" type="time" v-model="stime" input-class="appearance-none block w-full bg-gray-50 text-gray-700 
                                    border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:
                                    bg-white focus:border-gray-500" use12-hour></date-time>
                    <p class="text-red-500 text-xs"> {{ error.stime}}</p>
                </div>
                <div class="col-md-6">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        End Time
                    </label>
                    <date-time id="etime" use12-hour type="time" v-model="etime" input-class="appearance-none block w-full bg-gray-50 text-gray-700 
                                    border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:
                                    bg-white focus:border-gray-500"></date-time>
                    <p class="text-red-500 text-xs"> {{ error.etime}}</p>
                </div>
            </div>
            <div class="row ml-auto mr-auto">
                <div class="col-md-6">
                    <div class="relative">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-city">
                            Status
                        </label>
                        <select
                            class="block appearance-none w-full bg-gray-50 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            v-model="ds_id" :disabled="isUpdate == false">
                            <option v-for="status in getdependencies.defStatus" :key="status.ds_id"
                                :value="status.ds_id">{{ status.ds_title }}</option>

                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                        <p class="text-red-500 text-xs"> {{ error.ds_id}}</p>
                    </div>
                </div>
            </div>
            <div class="row ml-auto mr-auto">
                <div class="col-md-6 float-right">
                    <button v-if="isUpdate == false" @click="CreateSchedule" class="btn btn-primary  btn-round "><i
                            class="fas fa-calendar-alt"></i>
                        Create Schedule</button>
                    <button v-if="isUpdate == true" @click="UpdateSchedule" class="btn btn-primary btn-round "><i
                            class="fas fa-calendar-alt"></i>
                        Update Schedule</button>
                </div>
            </div>

        </modal>
    </div>




</template>
<style>

</style>
<script>
    import AdminSidebar from './AdminSidebar'
    import datetime from 'vuejs-datetimepicker';
    import {
        Datetime
    } from 'vue-datetime'
    import 'vue-datetime/dist/vue-datetime.css'
    import TextHighlight from 'vue-text-highlight';
    import _ from 'lodash';
    import {
        mapGetters,
        mapActions
    } from 'vuex'
    import moment from 'moment';
    export default {
        props: ['user'],
        data() {
            return {
                date: '',
                create: false,
                typ_id: 2,
                grp_id: '',
                stime: '',
                etime: '',
                venue: '',
                ds_id: 1,

                idtoUpdate: '',

                error: {},

                isUpdate: false,

                groups: {},
                searching: {
                    grp: '',
                    type: 2
                },

                loading: true
            }
        },
        components: {
            'sidebar': AdminSidebar,
            'text-highlight': TextHighlight,
            'date-time': Datetime,
        },
        methods: {
            showCreate() {
                $(".sched").fadeOut()
                $(".create").fadeIn()
            },

            ChangeDefenseType() {
                axios.get('../api/getgroupsfordefense/' + this.typ_id).then(res => {
                    this.groups = res.data.groups
                })
            },
            SearchGroups: _.debounce(function () {
                if (this.searching.grp == '') {
                    this.fetchdefenseschedule()
                } else {
                    this.searchdefenseschedule(this.searching)
                }
            }, 2000),
            Paginate(page = 1) {
                this.paginatedefenseschedule(page)
            },
            CreateSchedule() {
                this.loading = true
                var stime = moment(this.stime).format('hh:mm:ss')
                var etime = moment(this.etime).format('hh:mm:ss')
                console.log(stime)
                this.date = moment(this.date).format('YYYY-MM-DD')
                axios.post('../api/createdefenseschedule', {
                    type: this.typ_id,
                    date: this.date,
                    stime: stime,
                    group: this.grp_id,
                    etime: etime,
                    venue: this.venue,
                    status: this.ds_id
                }).then(res => {
                    if (res.data.message == 'success') {
                        this.Clear()
                        this.error = {}
                    } else {
                        this.Alert('info', res.data.message)
                        this.loading = false
                        this.date = moment(Date.now()).format('MM/DD/YYYY')
                        this.grp = 2
                        this.venue = ''
                    }
                }).catch(err => {
                    if (err.response.status == 422) {
                        this.date = moment(Date.now()).format('MM/DD/YYYY')
                        this.error = err.response.data.errors
                    }
                })
            },
            UpdateSchedule() {
                this.loading = true
                this.date = moment(this.date).format('YYYY-MM-DD')
                var stime = moment(this.stime).format('hh:mm:ss')
                var etime = moment(this.etime).format('hh:mm:ss')
                axios.post('../api/updatedefenseschedule', {
                    def_id: this.idtoUpdate,
                    type: this.typ_id,
                    date: this.date,
                    group: this.grp_id,
                    stime: stime,
                    etime: etime,
                    venue: this.venue,
                    status: this.ds_id
                }).then(res => {
                    if (res.data.message == 'success') {
                        this.Clear()
                        this.isUpdate = false
                    } else {
                        this.Alert('info', res.data.message)
                        this.loading = false
                        this.date = moment(Date.now()).format('MM/DD/YYYY')
                    }
                }).catch(err => {
                    if (err.response.status == 422) {
                        this.date = moment(Date.now()).format('MM/DD/YYYY')
                        this.error = err.response.data.errors
                    }
                })
            },
            SelectUpdate(index) {
                this.$modal.show('updatesched')
                this.isUpdate = true
                this.idtoUpdate = this.getdefenseschedule.data[index].def_id
                this.grp_id = this.getdefenseschedule.data[index].grp_id
                this.typ_id = this.getdefenseschedule.data[index].styp_id
                this.venue = this.getdefenseschedule.data[index].def_address
                this.stime = this.getdefenseschedule.data[index].def_stime
                this.etime = this.getdefenseschedule.data[index].def_etime
                this.date = moment(this.getdefenseschedule.data[index].def_date).format('MM/DD/YYYY')

                this.ChangeDefenseType()
            },
            Clear() {
                this.typ_id = 2
                this.grp_id = ''
                this.stime = ''
                this.etime = ''
                this.venue = ''
                this.ds_id = 1
                this.date = moment(Date.now()).format('MM/DD/YYYY')
                this.loading = false
                this.Alert('success', 'Successfully Created')
                this.fetchdefenseschedule()
            },
            Alert(icon, title) {
                toast.fire({
                    icon: icon,
                    title: title,
                })
            },
            ...mapActions(["fetchDependencies", "fetchdefenseschedule", "searchdefenseschedule",
                "paginatedefenseschedule"
            ])
        },
        watch: {
            getdefenseschedule() {
                if (this.getdependencies != '') {
                    this.loading = false
                }
            }
        },
        computed: mapGetters(['getdependencies', 'getdefenseschedule']),
        created() {
            this.fetchDependencies()
            this.fetchdefenseschedule()
            this.ChangeDefenseType(this.typ_id)
        }
    }

</script>
