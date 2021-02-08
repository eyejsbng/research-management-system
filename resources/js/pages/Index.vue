<template>
    <div>
        <nav-bar> </nav-bar>
        <div class="hero-area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-xl-9">
                        <div class="hero-content">
                            <h5>A multiplatform</h5>
                            <h2>Research Management System</h2>
                            <h5>for COllege of Computing Education</h5>
                        </div>
                    </div>

                    <div class="col-lg-7 col-xl-6">
                        <div class="subscription-form">          
                                <div class="form-group">
                                    <input type="text" v-model="search" style="border-color:blue;border-width:2px" class="form-control"
                                        placeholder="Search capstone project">
                                    <button @click="scroll" class="submit-btn btn--hover-shine">Search</button>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="feature-area">
            <div class="container">
                <div class="row mb-d-30">
                    <div class="col-lg-4 col-sm-6 mb--30">
                        <div class="feature-widget">
                            <div class="widget-icon">
                                <i class="icon icon-edit-72"></i>
                            </div>
                            <div class="content">
                                <h5>Searching</h5>
                                <p>You can search researches in Research Archived.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb--30">
                        <div class="feature-widget">
                            <div class="widget-icon">
                                <i class="icon icon-layers-3"></i>
                            </div>
                            <div class="content">
                                <h5>Documents</h5>
                                <p>You can submit your documents anytime.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb--30">
                        <div class="feature-widget">
                            <div class="widget-icon">
                                <i class="icon icon-tablet-mobile"></i>

                            </div>
                            <div class="content">
                                <h5>Monitor Progress</h5>
                                <p>You can monitor your progress.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       <index-list />
    </div>
</template>
<style>
    .footerr {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        background-color: white;
        color: black;
        text-align: center;
    }

</style>
<script>
    import Navbar from '../components/Navbar'
    import IndexResearchList from '../components/IndexResearchList'
    export default {
        props: ['search'],
        components: {
            'nav-bar': Navbar,
            'index-list': IndexResearchList
        },
        methods: {
            scroll() {
                const element = document.getElementById('research')
                element.scrollIntoView({ behavior: 'smooth'})
            }
        }

    }

</script>
