<template>
    <div class="container">
        <!-- Top Navbar -->
        <TopNavbar />
        <!-- /Top Navbar -->
        <div class="wrapper">
            <div class="page-header header-filter">
                <div class="squares square1"></div>
                <div class="squares square2"></div>
                <div class="squares square3"></div>
                <div class="squares square4"></div>
                <div class="squares square5"></div>
                <div class="squares square6"></div>
                <div class="squares square7"></div>
                <div class="container">
                    <div class="content-center brand">
                    <h1 class="h1-seo">DKB•</h1>
                    <h3>Welcome to a simplified Draggable Kanban Board.</h3>
                        <a :href="$router.resolve({name: 'kanban'}).href" class="btn btn-info btn-round btn-lg">Get Started</a>
                    </div>
                </div>
            </div>
            <div class="main">
                <router-view />
            </div>
            <!--Footer-->
            <Footer />
        </div>
    </div>
</template>

<script>
import TopNavbar from '.././layouts/top_nav.vue';
import Footer from '.././layouts/footer.vue';
    export default {
        components: {
            TopNavbar,
            Footer
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
