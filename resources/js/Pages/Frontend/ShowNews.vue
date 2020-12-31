<template>
    <app-layout>
        <div class="container">
            <div class="row">
                <div class="postcontent col-lg-8">

                    <div class="single-post mb-0">

                        <!-- Single Post
                        ============================================= -->
                        <div class="entry clearfix">

                            <!-- Entry Title
                            ============================================= -->
                            <div class="entry-title">
                                <h2>{{ news_feed.subject }}</h2>
                            </div><!-- .entry-title end -->

                            <!-- Entry Meta
                            ============================================= -->
                            <div class="entry-meta">
                                <ul>
                                    <li><i class="icon-calendar3"></i> {{ news_feed.created_at }}</li>
                                </ul>
                            </div><!-- .entry-meta end -->

                            <!-- Entry Image
                            ============================================= -->
                            <div class="entry-image">
                                <a href="#"><img :src="news_feed.image" :alt="news_feed.subject"></a>
                            </div><!-- .entry-image end -->

                            <!-- Entry Content
                            ============================================= -->
                            <div class="entry-content mt-0">
                                <blockquote>
                                    <p>{{ news_feed.body }}</p>
                                </blockquote>

                                <!-- Post Single - Content End -->


                                <div class="clear"></div>

                                <!-- Post Single - Share
                                ============================================= -->
                                <div class="si-share border-0 d-flex justify-content-between align-items-center">
                                    <span>Share this Post:</span>
                                    <div>
                                        <a href="#" class="social-icon si-borderless si-facebook">
                                            <i class="icon-facebook"></i>
                                            <i class="icon-facebook"></i>
                                        </a>
                                        <a href="#" class="social-icon si-borderless si-twitter">
                                            <i class="icon-twitter"></i>
                                            <i class="icon-twitter"></i>
                                        </a>
                                        <a href="#" class="social-icon si-borderless si-email3">
                                            <i class="icon-email3"></i>
                                            <i class="icon-email3"></i>
                                        </a>
                                    </div>
                                </div><!-- Post Single - Share End -->

                            </div>
                        </div><!-- .entry end -->


                        <!-- Comment Form
                            ============================================= -->
                        <div id="respond">

                            <h3>Leave a <span>Comment</span></h3>

                            <form v-if="$page.auth.user" class="row" @submit.prevent="postComment">

                                <div class="col-12 form-group">
                                    <label for="comment">Comment</label>
                                    <textarea v-model="comment" id="comment" name="comment" cols="58" rows="7" tabindex="4" class="sm-form-control"></textarea>
                                </div>

                                <div class="col-12 form-group">
                                    <button id="submit-button" tabindex="5" value="Submit" class="button button-3d m-0">Submit Comment</button>
                                </div>
                            </form>

                        </div><!-- #respond end -->
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- Comments ============================================= -->
                    <div id="comments" class="clearfix" v-if="news_feed.comments">
                        <h3 id="comments-title"><span>{{ news_feed.comments.length }}</span> Comments</h3>
                        <!-- Comments List
                        ============================================= -->
                        <ol class="commentlist clearfix">
                            <li class="comment even thread-even depth-1" v-for="comment in news_feed.comments" id="li-comment-1">
                                <div id="comment-1" class="comment-wrap clearfix">
                                    <div class="comment-content clearfix">
                                        <div class="comment-author">{{ comment.user.name }}
                                            <span>
                                                <a href="#" title="Permalink to this comment">
                                                    {{ comment.created_at }}
                                                </a>
                                            </span>
                                        </div>
                                        <p>
                                            {{ comment.comment }}
                                        </p>
                                        <a class='comment-reply-link' href='#'>
                                            <i class="icon-reply"></i>
                                        </a>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </li>
                        </ol><!-- .commentlist end -->
                        <div class="clear"></div>

                    </div><!-- #comments end -->
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
export default {
    name: "ShowNews",
    components: {AppLayout},
    props: ['news_feed'],
    data() {
        return {
            comment: '',
        }
    },
    methods: {
        postComment() {
            this.$inertia.post(route('frontend.comment.store'), {
                news_feed_id: this.news_feed.id,
                comment: this.comment
            })
        }
    }
}
</script>

<style scoped>

</style>
