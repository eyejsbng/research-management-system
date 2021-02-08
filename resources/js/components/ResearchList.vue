<template>

    <div class="research-list">
        <div class="section text-center" id="researchlist">
            <h2>Research List</h2>
        </div>
        <div class="row" data-intro="You can search here to find the researches that you need.">
            <div class="col-8 mx-auto">
              
                <div class="d-flex justify-content-center">
                 
                    <div class="search-wrapper active">
                        <div class="input-holder">
                            <input v-model="search"  @keyup="SearchResearch(search)" type="text" class="search-input" placeholder="Type to search">
                            <button class="search-icon"><span></span></button>
                        </div>
                        
                    </div>
                </div>
                <br>
                <div v-if="showPercent == true">
                    <div class="col-md-12">
                        <div v-if="Count.percent != 0" class="alert alert-warning" role="alert">
                            Based on Searching {{Count.percent}} out {{Count.research}} of Research, have already
                            been conducted.
                        </div>
                        <div v-if="Count.percent == 0" class="alert alert-success" role="alert">
                            Based on Searching {{Count.percent}} out {{Count.research}} of Research. The research
                            are Available.
                        </div>
                        
                    </div>

                </div>
                <div class="d-flex justify-content-center mt-4">
                 <pulse-loader :loading="loading" color="#1256b5" size="15px"></pulse-loader><br>
                 
                </div>
            </div>
        </div>
        <div class="row">
            <div class="researchs col-8 mx-auto mb-3">
               
                <div class=" p-3" v-for="(research, index) in files.data" :key="research.res_id">

                    <a href="#" @click="view(index)" style="color:black">
                        <p style="font-size:large">
                            <text-highlight :queries="search">{{ research.res_title }}</text-highlight>
                        </p>
                        <p style="font-size:large">
                            <strong>{{research.res_ysdate }} | {{ research.crs_title }}</strong>
                        </p>
                    </a>
                    <hr>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-8 mx-auto">
                <pagination :data="files" @pagination-change-page="Paginate" :limit=5>
                </pagination>
            </div>

        </div>
        <!-- <div v-if="showresearch == true" class="section text-center">
            <div class="row">
                <div class="col-lg-10 col-md-10 col-sm-12 mr-auto ml-auto">
                    <div ref="viewer" id="viewer">
                        <h2 class="title"> Research Viewer </h2>
                        <pdf :src="path"></pdf>
                    </div>
                </div>
            </div>
        </div> -->
    <modal name="example" adaptive="true" height="auto">

            <perfect-scrollbar>
                <pdf :src="path"></pdf>
            </perfect-scrollbar>


        </modal>
    </div>

</template>
<style>
    .pagination>.page-item.active>a,
    .pagination>.page-item.active>a:focus,
    .pagination>.page-item.active>a:hover,
    .pagination>.page-item.active>span,
    .pagination>.page-item.active>span:focus,
    .pagination>.page-item.active>span:hover {
        background-color: #1256b5;
        border-color: #2e2c2e;
        color: white;
        box-shadow: 0 4px 5px 0 rgb(156 39 176 / 14%), 0 1px 10px 0 rgb(156 39 176 / 12%), 0 2px 4px -1px rgb(156 39 176 / 20%);
    }

    .research:hover {
        background-color: #f2f4f7;
        cursor: pointer;
        border-radius: 20px;
    }

    .searchbar {
        margin-bottom: auto;
        margin-top: auto;
        height: 60px;
        background-color: #f5f5f5;
        border-radius: 30px;
        padding: 10px;
        border-style: solid;
        border-color: #303030;
    }

    .search_input {
        color: #303030;
        border: 0;
        outline: 0;
        background: none;
        width: 0;
        caret-color: transparent;
        line-height: 40px;
        transition: width 0.4s linear;
        width: 450px;
        border-color: #303030;
        font-size: 20px;
        padding-left:1rem;
        padding-bottom: 1rem;
    }


    .searchbar >.search_icon {
        background: #f5f5f5;
        color: #303030;
    }

    .search_icon {
        height: 40px;
        width: 40px;
        float: right;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        color: white;
        text-decoration: none;
    }

</style>
<script>
    import {
        mapGetters,
        mapActions,
    } from 'vuex'
    import pdf from 'vue-pdf'
    import _ from 'lodash';
    import TextHighlight from 'vue-text-highlight';
    export default {
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
                path: '',
                loading : true
            }
        },
        methods: {
             showModal() {
                this.$modal.show('example');
            },
            view(index) {
                this.showresearch = true
                this.file = this.files.data[index]
                this.path = '../app/myfiles/Files/Doneresearch/' + this.file.res_file;
                this.showModal();
            },
            showFiles() {
                axios.get('/api/archiveresearch').then(res => {
                    this.files = res.data
                    this.loading = false
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
                            console.log(this.Count.research)
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
            pdf
        }

    }

</script>
