<template>
    <!-- Header
            ============================================= -->
    <header id="header" class="header-size-sm" data-sticky-shrink="false">
        <div class="container">
            <div class="header-row flex-column flex-lg-row justify-content-center justify-content-lg-start">

                <!-- Logo
                ============================================= -->
                <div id="logo" class="mr-0 pt-3 mr-lg-auto">
                    <a href="#" class="standard-logo" data-dark-logo="images/logo-dark.png">
                        <img src="/assets/frontend/images/logo.png" alt="Indian Trainsim">
                    </a>
                    <a href="#" class="retina-logo" data-dark-logo="images/logo-dark@2x.png">
                        <img src="/assets/frontend/images/logo.png" alt="Indian Trainsim">
                    </a>
                </div><!-- #logo end -->

            </div>
        </div>

        <div id="header-wrap" class="border-top border-f5">
            <div class="container">
                <div class="header-row justify-content-between">

                    <div class="header-misc">

                        <!-- Top Search
                        ============================================= -->
                        <div id="top-search" class="header-misc-icon">
                            <ul class="menu-container">
                            <li class="menu-item">
                                <button v-if="$page.auth.user" class="button button-border button-rounded button-mini button-fill fill-from-right button-red"
                                              @click="logout()">
                                    <span>
                                        Logout {{ $page.auth.user.username }}
                                    </span>
                                </button>
                                <inertia-link v-else class="button button-border button-rounded button-mini button-fill fill-from-right button-blue"
                                              :href="route('frontend.auth.index')">
                                    <span>
                                        Login / Register
                                    </span>
                                </inertia-link>
                            </li>
                            </ul>
                        </div><!-- #top-search end -->

                    </div>

                    <div id="primary-menu-trigger">
                        <svg class="svg-trigger" viewBox="0 0 100 100"><path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path><path d="m 30,50 h 40"></path><path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path></svg>
                    </div>

                    <!-- Primary Navigation
                    ============================================= -->
                    <nav class="primary-menu">

                        <ul class="menu-container">
                            <li class="menu-item">
                                <inertia-link class="menu-link" :href="route('frontend.home')">
                                    <div>Home</div>
                                </inertia-link>
                            </li>
                            <li class="menu-item">
                                <a class="menu-link" href="#"><div>File Library</div></a>
                                <ul class="sub-menu-container">
                                    <li class="menu-item">
                                        <inertia-link class="menu-link" :href="route('frontend.files.index')">
                                            <div>
                                                <i class="icon-search"></i>Search Files
                                            </div>
                                        </inertia-link>
                                    </li>
                                    <li class="menu-item">
                                        <inertia-link class="menu-link" :href="route('frontend.files.hot')">
                                            <div>
                                                <i class="icon-fire"></i>Hot Files
                                            </div>
                                        </inertia-link>
                                    </li>
                                    <li class="menu-item">
                                        <inertia-link class="menu-link" :href="route('frontend.files.create')">
                                            <div>
                                                <i class="icon-upload"></i>Upload a File
                                            </div>
                                        </inertia-link>
                                    </li>
                                    <li class="menu-item">
                                        <inertia-link class="menu-link" :href="route('frontend.files.manage')">
                                            <div>
                                                <i class="icon-list"></i>Manage Files
                                            </div>
                                        </inertia-link>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item">
                                <a class="menu-link" href="#"><div>Screenshots</div></a>
                                <ul class="sub-menu-container">
                                    <li class="menu-item">
                                        <inertia-link class="menu-link" :href="route('frontend.screenshots.index')">
                                            <div>
                                                <i class="icon-picture"></i>View Screenshots
                                            </div>
                                        </inertia-link>
                                    </li>
                                    <li class="menu-item">
                                        <inertia-link class="menu-link" :href="route('frontend.screenshots.create')">
                                            <div>
                                                <i class="icon-upload-alt"></i>Upload Screenshots
                                            </div>
                                        </inertia-link>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item mega-menu">
                                <a class="menu-link" href="#"><div>Help</div></a>
                            </li>
                        </ul>

                    </nav>
                    <!-- #primary-menu end -->
                </div>

            </div>
        </div>
        <div class="header-wrap-clone"></div>
    </header><!-- #header end -->
</template>

<script>
export default {
    name: "AppHeader",
    methods: {
        logout() {
            swal({
                title: "Are you sure?",
                text: "You want to deboarded the train?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((logout) => {
                    if (logout) {
                        this.$inertia.post(route('frontend.auth.logout'))
                        swal("Great! You have deboarded the train!", {
                            icon: "success",
                        });
                    } else {
                        swal("Great! You are still on the train.");
                    }
                });
        }
    }
}
</script>

<style scoped>

</style>
