<template>
     <header class="site-header">
        <div class="container">
            <div class="row justify-content-center align-items-center position-relative">
                <div class="col-sm-3 col-6 col-lg-2 col-xl-2 order-lg-1">
                  <!-- Brand Logo -->
                    <div class="brand-logo">
                        <a href=""><img src="/img/logo.png"></a>
                        
                    </div>
                </div>
                <div class="col-sm-8 col-lg-3 col-xl-3 d-none d-sm-block order-lg-3 offset-xl-1">
                    <div class="header-btns justify-content-end">
                        <a href="/login" class="btn btn-outlined--primary btn-sm mr-2">Sign in</a>
                        <a href="/register" class="btn btn-primary btn-sm">Get started</a>
                    </div>

                </div>
                <!-- Menu Block -->
                <div class="col-sm-1 col-6 col-lg-7 col-xl-6  position-static order-lg-2">
                    <div class="main-navigation">
                        <ul class="main-menu">
                            <li class="menu-item" data-title="Welcome" data-intro="Click next to continue"><a href="#" @click="click">How to use</a></li>
                            <li class="menu-item"><a href="#research">Research List</a></li>
                            <li class="menu-item mobile"><a href="/login">Sign in</a></li>
                            <li class="menu-item mobile"><a href="/register">Get started</a></li>
                            </ul>
                    </div>
                    <div class="mobile-menu"></div>
                </div>
            </div>
        </div>
    </header>
</template>
<style>

@media screen and (max-width: 300px) {
    li.mobile { display: block; }
}

@media screen and (min-width: 1192px) {
    li.mobile { display: none; }
}
.introjs-helperLayer {
    background: transparent;
}
</style>
<script>
    export default {
            methods: {
                 scroll() {
                const element = document.getElementById('research')
                element.scrollIntoView({ behavior: 'smooth'})
            },
                click() {
                
                introJs().start();
            }
            },
           
        }
    

</script>
