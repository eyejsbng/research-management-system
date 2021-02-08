import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';
import _ from 'lodash';
Vue.use(Vuex);

export function getByUser(list, keyword) {
    const search = keyword.trim().toLowerCase()
    if (!search.length) return list
    return list.filter(item => item.name.toLowerCase().indexOf(search) > -1)
}

export function getByGroup(list, keyword) {
    const search = keyword.trim().toLowerCase()
    if (!search.length) return list
    return list.filter(item => item.grp_title.toLowerCase().indexOf(search) > -1)
}

const state = {

    //ADMIN
    adminDashboard: [], //for admin dashboard
    dependencies: [],   //for dependecies of admin
    adviserlist:{}, //get all adviserlist
    panellist:{}, //get all panellist
    studentdata: {}, //get all student for admin
    stdata: {}, //get all subject teacher for admin
    rpdata:{}, //get all research personnel for admin
    defenseschedule: {}, // get all Defense Schedule
    minutes: {}, //get minutes
    messenger: {}, //get user and groups for messenger
    search: '',
    //STUDENT
    groupinfo:{}, //get group information
    caps1submitteddocs:{}, //get Group Capstone 1 Submitted Docs
    finalchecklist: {}, //get Group Final Checklist
    groupschedule: {}, // Get Group Schedule

    //ADVISER
    caps1checkdocs:{},
    caps1checksys:{},
    caps1grammarly:{},
    //PANEL
    caps1evalution:{},
    caps1revisefile:{},
    caps1validation:{},

};

const getters = {
    getadminDashboard: state => state.adminDashboard,
    getdependencies: state => state.dependencies,
    getadviserList: state => state.adviserlist,
    getpanelList: state => state.panellist,
    getstudentdata: state => state.studentdata,
    getstdata: state => state.stdata,
    getrpdata: state => state.rpdata,
    getdefenseschedule: state => state.defenseschedule,
    getminutes: state => state.minutes,
    getmessenger: state => state.messenger,

    groupinfo: state => state.groupinfo,
    getcaps1submitteddocs: state => state.caps1submitteddocs,
    getfinalchecklist: state => state.finalchecklist,
    getgroupschedule : state => state.groupschedule,

    getcaps1checkdocs: state => state.caps1checkdocs,
    getcaps1checksys: state => state.caps1checksys,
    getcaps1grammarly: state => state.caps1grammarly,

    getcaps1evalution: state => state.caps1evalution,
    getcaps1revisefile: state => state.caps1revisefile,
    getcaps1validation: state => state.caps1validation,
    filteredUsers() {
        return getByUser(state.messenger.users, state.search)
    },
    filteredGroups() {
        return getByGroup(state.messenger.groups, state.search)
    }

};

const actions = {
    async fetchadminDashboard({ commit }){
        const response  = await axios.get('/api/adminDashboard');

        commit('setadminDashboard', response.data);
    },
    async fetchDependencies({ commit }){
        const response  = await axios.get('/api/Dependencies');

        commit('setDependencies', response.data);
    },
    async fetchallAdviserlist({commit}){
        const response = await axios.get('/api/adviserlist');

        commit('setadviserlist', response.data.adviser);
    },
    async fetchallPanellist({commit}){
        const response = await axios.get('/api/panellist');

        commit('setpanellist', response.data.panel);
    },
    async fetchdefenseschedule({commit}) {
        const response = await axios.get('/api/getdefenseschedule');

        commit('setdefenseschedule', response.data.sched);
    },
    async searchdefenseschedule({commit}, searching){
        const response = await axios.post('/api/searchdefenseschedule', searching);

        commit('searchschedule', response.data.sched)
    },
    async paginatedefenseschedule({commit}, page){
        const response = await axios.post('/api/searchdefenseschedule?page='+page);

        commit('paginateschedule', response.data.sched);
    },
    async fetchminutes({commit}, req){
        const response = await axios.post('/api/getminutes', req);

        commit('setminutes', response.data)
    },
    async fetchmessenger({commit}, req){
        const response = await axios.post('/api/getmessenger',req);

        commit('setmessenger', response.data)
    },

        //student method for admin
    async fetchstudentdata({ commit }){
        const response = await axios.get('/api/allstudent');

        commit('setstudentdata', response.data.student)
    },
    async searchStudent({commit},searching){
        const response = await axios.post('/api/searchstudent', searching);

        commit('searchstudent', response.data.student)
    },
    async paginatestudent({commit},page){
        const response = await axios.post('/api/searchstudent?page='+page);

        commit('paginatestudent', response.data.student);
    },

        //stdata method for admin
    async fetchstdata({commit}){
        const response = await axios.get('/api/allst');

        commit('setstdata', response.data.st);
    },
    async searchST({commit}, searching){
        const response = await axios.post('/api/searchST', searching);

        commit('searchST', response.data.st);
    },
    async paginatest({commit}, page){
        const response = await axios.post('/api/searchST?page='+page);

        commit('paginatest', response.data.st);
    },
        //rpdata method for admin
    async fetchrpdata({commit}){
        const response = await axios.get('/api/allRP');

        commit('setrpdata', response.data.rp);
    },
    async searchRP({commit}, searching){
        const response = await axios.post('/api/searchRP', searching);

        commit('searchRP', response.data.rp);
    },
    async paginaterp({commit}, page){
        const response = await axios.post('/api/searchRP?page='+page);

        commit('paginaterp', response.data.rp);
    },


    //STUDENT Functions
    async getGroupInfo({commit}, grp_id){
        const response = await axios.get('/api/selectCap1/'+grp_id);

        commit('getgroupinfo', response.data);
    },
    async getCapstone1SubmittedDocs({commit}, grp_id){
        const response = await axios.get('/api/getcapstone1submitteddocs/'+grp_id);

        commit('getcaps1subdocs', response.data);
    },
    async getFinalChecklist({commit}, grp_id){
        const response = await axios.get('/api/getfinalchecklist/'+grp_id);

        commit('getfinalchecklist', response.data)
    },
    async GetStudentGroupSchedule({commit}, grp_id){
        const response = await axios.get('/api/getstudentgroupschedule/'+grp_id);

        commit('getstudentgroupschedule', response.data.schedule);
    },


    //ADVIER Function
    async getCapstone1checkDocs({commit}, req){
        const response = await axios.post('/api/getcapstone1checkdocs', req);

        commit('getcaps1checkdocs', response.data);
    },
    async getCapstone1checkSys({commit}, grp_id){
        const response = await axios.get('/api/getcapstone1checksys/'+grp_id);

        commit('setcaps1checksys', response.data);
    },
    async getCapston1Grammarly({commit}, grp_id){
        const response = await axios.get('/api/getcapstone1grammarly/'+grp_id);

        commit('getcaps1grammar', response.data)
    },

    //PANEL Function
    async getCapstone1Evaluation({commit}, req){
        const response = await axios.post('/api/getcapstone1evaluation', req);

        commit('getcaps1evaluation', response.data);
    },
    async getCapstone1ReviseFile({commit}, req){
        const response = await axios.post('/api/getcapstone1revisefile', req);

        commit('getcaps1revisefile', response.data);
    },
    async getCapstone1Validation({commit}, req){
        const response = await axios.post('/api/getcastone1validation', req);

        commit('getcaps1validation', response.data);
    }

};

const mutations = {
    setadminDashboard: (state, adminDashboard) => 
        (state.adminDashboard = adminDashboard),
    setDependencies: (state, dependencies) => (state.dependencies = dependencies),
    setadviserlist: (state, adviserlist) => (state.adviserlist = adviserlist),
    setpanellist: (state, panellist) => (state.panellist = panellist),
    setdefenseschedule: (state, defenseschedule ) => (state.defenseschedule = defenseschedule),
    searchschedule: (state, defenseschedule ) => (state.defenseschedule = defenseschedule),
    paginateschedule: (state, defenseschedule ) => (state.defenseschedule = defenseschedule),
    setminutes: (state, minutes) => (state.minutes = minutes),
    setmessenger: (state, messenger) => (state.messenger = messenger),
    //student mutations for admin
    setstudentdata: (state, studentdata) => (state.studentdata = studentdata),
    searchstudent: (state, studentdata) => (state.studentdata = studentdata),
    paginatestudent: (state, studentdata) => (state.studentdata = studentdata),
    //st mutations for admin
    setstdata: (state, stdata) => (state.stdata = stdata),
    searchST: (state, stdata) => (state.stdata = stdata),
    paginatest: (state, stdata) => (state.stdata = stdata),
    //rp mutations for admin
    setrpdata: (state, rpdata) => (state.rpdata = rpdata),
    searchRP: (state, rpdata) => (state.rpdata = rpdata),
    paginaterp: (state, rpdata) => (state.rpdata = rpdata),


    //STUDENT
    getgroupinfo: (state, groupinfo) => (state.groupinfo = groupinfo),
    getcaps1subdocs:(state , caps1submitteddocs) => (state.caps1submitteddocs = caps1submitteddocs),
    getfinalchecklist:(state, finalchecklist) => (state.finalchecklist = finalchecklist ),
    getstudentgroupschedule:(state, groupschedule) => (state.groupschedule = groupschedule),

    //ADVISER
    getcaps1checkdocs: (state, caps1checkdocs) => (state.caps1checkdocs = caps1checkdocs),
    setcaps1checksys: (state, caps1checksys) => (state.caps1checksys = caps1checksys),
    getcaps1grammar: (state, caps1grammarly) => (state.caps1grammarly = caps1grammarly),
    //PANEL
    getcaps1evaluation: (state, caps1evalution) => (state.caps1evalution = caps1evalution),
    getcaps1revisefile: (state, caps1revisefile) => (state.caps1revisefile = caps1revisefile),
    getcaps1validation: (state, caps1validation) => (state.caps1validation = caps1validation)
};

export default new Vuex.Store({
    state,
    getters,
    actions,
    mutations
})
