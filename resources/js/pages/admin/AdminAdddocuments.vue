<template>
    <div>
        <sidebar :user="user"></sidebar>
        <div class="main-panel" id="main-panel">
            <div class="panel-header panel-header-sm">
            </div>
            <div class="content">
                <div class="section text-center" id="researchlist">
                    <h2 class="title">RESEARCH LIST</h2>
                    <div class="row">
                        <div class="col-lg-10 col-md-12 ml-auto mr-auto">
                            <h4><small>Search Title</small><input v-model="search" @keyup="SearchResearch(search)"
                                    type="text" placeholder="Please Enter Research Title"
                                    class="form-control text-center"></h4>
                            <div v-if="showPercent == true">
                                <div class="col-md-12">
                                    <div v-if="Count.percent != 0" class="alert alert-primary" role="alert">
                                        Based on Searching {{Count.percent}} out {{Count.research}} of Research, have
                                        already
                                        been conducted.
                                    </div>
                                    <div v-if="Count.percent == 0" class="alert alert-success" role="alert">
                                        Based on Searching {{Count.percent}} out {{Count.research}} of Research. The
                                        research
                                        are Available.
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><strong> Research Title </strong></th>
                                            <th><strong> Year Published </strong></th>
                                            <th><strong> Course </strong></th>
                                            <th><strong> Action </strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(research, index) in files.data" :key="research.res_id">
                                            <td>
                                                <text-highlight :queries="search">{{ research.res_title }}
                                                </text-highlight>
                                            </td>
                                            <td>{{ research.res_ysdate }}</td>
                                            <td>{{ research.crs_title }}</td>
                                            <td class="td-actions text-right">
                                                <a href="#viewer" @click="view(index)" type="button" rel="tooltip"
                                                    class="btn btn-danger btn-link btn-sm">
                                                    <i class="fas fa-search"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <pagination :data="files" @pagination-change-page="Paginate" :limit=5>
                                        </pagination>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="showresearch == true" class="section text-center">
                    <div class="row">
                        <div class="col-lg-10 col-md-10 col-sm-12 mr-auto ml-auto">
                            <div ref="viewer" id="viewer">
                                <h2 class="title"> Research Viewer </h2>
                                <pdf :src="path"></pdf>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import AdminSidebar from './AdminSidebar'
    import {
        mapGetters,
        mapActions,
    } from 'vuex'
    import pdf from 'vue-pdf'
    import _ from 'lodash';
    import TextHighlight from 'vue-text-highlight';
    export default {
        props:['user'],
        data() {
            return {
                search: '',
                files: {},
                Count: {
                    percent: '',
                    research: ''
                },
                showPercent: false,
                showresearch: false,

                file: {},
                path: ''
            }
        },
        methods: {
            view(index) {
                this.showresearch = true
                this.file = this.files.data[index]
                this.path = '../app/myfiles/Files/Doneresearch/' + this.file.res_file;
            },
            showFiles() {
                axios.get('/api/archiveresearch').then(res => {
                    this.files = res.data
                });
            },
            SearchResearch: _.debounce(function (search) {
                if (search == '') {
                    this.showPercent = false
                    axios.get('../api/archiveresearch').then(({
                        data
                    }) => (this.files = data))
                } else {
                    axios.get('../api/searcharchived?q=' + search).then(res => {
                            this.files = res.data.files
                            this.Count.percent = res.data.countSearch
                            this.Count.research = res.data.countResearch
                            this.showPercent = true
                        })
                        .catch()
                }
            }, 1000),
            Paginate(page = 1) {
                if (this.search == '') {
                    axios.get('../api/archiveresearch/' + '?page=' + page)
                        .then(response => {
                            this.files = response.data;
                        });
                } else {
                    axios.get('../api/searcharchived?q=' + this.search + "&" + 'page=' + page)
                        .then(response => {
                            this.files = response.data.files;
                        });
                }
            }
        },
        created() {
            this.showFiles()
        },
        components: {
            'text-highlight': TextHighlight,
            pdf,
            'sidebar': AdminSidebar,
        }

    }

</script>
