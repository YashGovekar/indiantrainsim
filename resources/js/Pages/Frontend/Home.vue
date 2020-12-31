<template>
    <app-layout>
        <div class="section header-stick bottommargin-lg py-3">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-auto">
                        <div class="d-flex">
                            <span class="badge badge-danger text-uppercase col-auto">News</span>
                        </div>
                    </div>

                    <div class="col-lg mt-2 mt-lg-0">
                        <div class="fslider" data-speed="800" data-pause="6000" data-arrows="false" data-pagi="false" style="min-height: 0;">
                            <div class="flexslider">
                                <div class="slider-wrap">
                                    <div v-for="news_feed in news_feeds" class="slide"><a href="#"><strong>{{ news_feed.body }}</strong></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container clearfix">

            <div class="row">
                <div class="col-lg-8 bottommargin">
                    <div class="row col-mb-50">
                        <div class="col-12">
                            <div class="fancy-title title-border">
                                <h3> News</h3>
                            </div>
                            <div class="row posts-md col-mb-30 border-r-2 border-opacity-25">
                                <div v-for="news_feed in news_feeds" class="entry col-sm-6 col-xl-4">
                                    <div class="grid-inner">
                                        <div class="entry-image">
                                            <a href="#"><img :src="news_feed.image" alt="Image"></a>
                                        </div>
                                        <div class="entry-title title-xs nott">
                                            <h3>
                                                <inertia-link :href="route('frontend.newsfeed.show', news_feed.id)">{{ news_feed.subject }}</inertia-link>
                                            </h3>
                                        </div>
                                        <div class="entry-meta">
                                            <ul>
                                                <li><i class="icon-calendar3"></i> {{ news_feed.created_at }}</li>
                                                <li v-if="news_feed.comments">
                                                    <inertia-link :href="route('frontend.newsfeed.show', news_feed.id)"><i class="icon-comments"></i> {{ news_feed.comments.length }}</inertia-link>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="entry-content">
                                            <p>{{ news_feed.body }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ml-auto col-lg-4">

                    <div class="line d-block d-lg-none"></div>

                    <div class="widget clearfix">

                        <div class="row text-center">
                            <div class="col-lg-6 bottommargin-sm">
                                <div class="counter counter-small"><span data-from="0" :data-to="downloads" data-refresh-interval="80" data-speed="3000" data-comma="true"></span></div>
                                <h5 class="mb-0">Total Downloads</h5>
                            </div>

                            <div class="col-lg-6 bottommargin-sm">
                                <div class="counter counter-small"><span data-from="0" :data-to="users" data-refresh-interval="50" data-speed="2000" data-comma="true"></span></div>
                                <h5 class="mb-0">Users</h5>
                            </div>
                        </div>

                        <hr>

                        <div class="widget clearfix">

                            <h4>Indian Trainsim Photo Stream</h4>

                            <div class="masonry-thumbs grid-container grid-6" data-big="3" data-lightbox="gallery">
                                <a v-for="screenshot in screenshots" class="grid-item" :href="screenshot.path" data-lightbox="gallery-item">
                                    <img :src="screenshot.path" :alt="screenshot.title">
                                </a>
                            </div>

                        </div>

                        <div class="widget clearfix">
                            <iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2FEnvato&amp;width=350&amp;height=240&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=false&amp;show_border=true&amp;appId=499481203443583" style="border:none; overflow:hidden; width:350px; height:240px; max-width: 100% !important;"></iframe>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
export default {
    name: "Home",
    components: {AppLayout},
    props: ['news_feeds', 'users', 'downloads'],
    data() {
        return {
            screenshots: [],
        }
    },
    methods: {
        getScreenshots() {
            axios.get('/api/screenshots').then(res => {
                this.screenshots = res.data;
            })
        }
    },
    mounted() {
        SEMICOLON.widget.counter();
        SEMICOLON.widget.loadFlexSlider();
        SEMICOLON.widget.masonryThumbs();
        this.getScreenshots();
    }
}
</script>

<style scoped>

</style>
