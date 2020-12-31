<template>
    <!-- Document Wrapper
    =============================================
    -->
    <div id="wrapper" class="clearfix">
        <app-header />
        <section id="content">
            <div class="content-wrap">
                <slot />
            </div>
        </section>
        <app-footer />
        <!-- Go To Top
        ============================================= -->
        <div id="gotoTop" class="icon-angle-up"></div>
    </div>
</template>

<script>
    import AppHeader from "@/Layouts/AppHeader";
    import AppFooter from "@/Layouts/AppFooter";

    export default {
        components: {
            AppHeader,
            AppFooter,
        },
    }
</script>
