<template>
    <section class="pricing-section section-spacing" id="research">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-7 col-md-8 col-sm-11">
                    <div class="section-title pb-lg--85">
                        <h2>Researches in Archive</h2>
                        <div class="subscription-form">
                          
                                <div class="form-group">
                                    <input type="text" class="form-control" v-model="search"
                                        @keyup="SearchResearch(search)" placeholder="Search capstone project">
                                    <button class="submit-btn btn--hover-shine ">Search</button>
                                </div>

                           
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="showPercent == true">
                <div class="col-lg-12">
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
            <div class="row mb-d-30">
                <div class="col-lg-12">
                    <div class="pricing-card">
                        <div class="card-content">
                            <h5 v-if="files.data == ''" align="center">No data found.</h5>
                            <ul class="pricing-list">
                                <li v-for="(research, index) in files.data" :key="research.res_id"><a href="#"
                                        @click="view(index)">
                                        <h5><text-highlight :queries="search">{{ research.res_title }}</text-highlight></h5>
                                    </a> ( {{ research.res_ysdate}})</li>
                            </ul>
                        </div>
                        <div class="card-footer" style="background-color:white">
                            <pagination :data="files" @pagination-change-page="Paginate" :limit=10>
                            </pagination>
                        </div>
                    </div>

                </div>

            </div>

        </div>
        <modal name="example" :adaptive="true" height="auto">

            <perfect-scrollbar>
                <pdf :src="path"></pdf>
            </perfect-scrollbar>


        </modal>
    </section>
</template>
<style>
    .pricing-list > li {
        font-size:30px;
        
    }


</style>
<script>
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
                loading: true
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
                            this.Count.percent = res.data.files.total
                            this.Count.research = res.data.countResearch
                            this.showPercent = true

                            console.log(res.data.files.total)
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
