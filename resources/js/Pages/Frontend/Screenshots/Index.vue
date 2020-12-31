<template>
    <app-layout>
        <div class="container clearfix">
            <div class="widget clearfix">

                <h4>Indian Trainsim Photo Stream</h4>

                <div class="masonry-thumbs grid-container grid-6" data-big="3" data-lightbox="gallery">
                    <a v-for="screenshot in screenshots" class="grid-item" :href="screenshot.path" data-lightbox="gallery-item">
                        <img :src="screenshot.path" :alt="screenshot.title">
                    </a>
                </div>

            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
export default {
    name: "Index",
    components: {AppLayout},
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
    created() {
        SEMICOLON.widget.counter();
        SEMICOLON.widget.loadFlexSlider();
        SEMICOLON.widget.masonryThumbs();
        this.getScreenshots();
    }
}
</script>

<style scoped>

</style>
