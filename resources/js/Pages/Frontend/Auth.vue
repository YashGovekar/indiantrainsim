<template>
    <app-layout>
        <div class="container clearfix">
            <div class="tabs mx-auto mb-0 clearfix" id="tab-login-register" style="max-width: 500px;">

                <ul class="tab-nav tab-nav2 center clearfix">
                    <li class="inline-block"><a href="#tab-login">Login</a></li>
                    <li class="inline-block"><a href="#tab-register">Register</a></li>
                </ul>

                <div class="tab-container">

                    <div class="tab-content" id="tab-login">
                        <div class="card mb-0">
                            <div class="card-body" style="padding: 40px;">
                                <div v-if="$page.flash.message" class="alert alert-danger">
                                    {{ $page.flash.message }}
                                </div>
                                <form id="login-form" name="login-form" class="mb-0" @submit.prevent="login" method="post">

                                    <h3>Login to your Account</h3>

                                    <div class="row">
                                        <div class="col-12 form-group">
                                            <label for="login-form-username">Username / Email:</label>
                                            <input type="text" id="login-form-username" name="login-form-username" class="form-control" />
                                        </div>

                                        <div class="col-12 form-group">
                                            <label for="login-form-password">Password:</label>
                                            <input type="password" id="login-form-password" name="login-form-password" class="form-control" />
                                        </div>

                                        <div class="col-12 form-group">
                                            <button class="button button-3d button-black m-0" id="login-form-submit" name="login-form-submit" value="login">Login</button>
                                            <a href="#" class="float-right">Forgot Password?</a>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="tab-content" id="tab-register">
                        <div class="card mb-0">
                            <div class="card-body" style="padding: 40px;">
                                <h3>Register for an Account</h3>

                                <div v-if="$page.flash.message" class="alert alert-danger">
                                    {{ $page.flash.message }}
                                </div>

                                <form id="register-form" name="register-form" class="row mb-0" @submit.prevent="register()" method="post">

                                    <div class="col-12 form-group">
                                        <label for="register-form-name">Name:</label>
                                        <input type="text" id="register-form-name" name="register-form-name" v-model="user.name" class="form-control" />
                                    </div>

                                    <div class="col-12 form-group">
                                        <label for="register-form-email">Email Address:</label>
                                        <input type="text" id="register-form-email" name="register-form-email" v-model="user.email" class="form-control" />
                                    </div>

                                    <div class="col-12 form-group">
                                        <label for="register-form-username">Choose a Username:</label>
                                        <input type="text" id="register-form-username" name="register-form-username" v-model="user.username" class="form-control" />
                                    </div>

                                    <div class="col-12 form-group">
                                        <label for="register-form-phone">Phone:</label>
                                        <input type="text" id="register-form-phone" name="register-form-phone" v-model="user.phone" class="form-control" />
                                    </div>

                                    <div class="col-12 form-group">
                                        <label for="register-form-password">Choose Password:</label>
                                        <input type="password" id="register-form-password" name="register-form-password" v-model="user.password" class="form-control" />
                                    </div>

                                    <div class="col-12 form-group">
                                        <label for="register-form-re_password">Re-enter Password:</label>
                                        <input type="password" id="register-form-re_password" name="register-form-re_password" v-model="user.re_password" class="form-control" />
                                    </div>

                                    <div class="col-12 form-group">
                                        <button class="button button-3d button-black m-0" id="register-form-submit" name="register-form-submit" value="register">Register Now</button>
                                    </div>

                                </form>
                            </div>
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
    name: "Auth",
    components: {AppLayout},
    data () {
        return {
            user: {
                name: '',
                username: '',
                email: '',
                phone: '',
                password: '',
                re_password: '',
            }
        }
    },
    methods: {
        login() {
            this.$inertia.post(route('frontend.auth.login'), new FormData(document.getElementById('login-form')));
        },
        register() {
            this.$inertia.post(route('frontend.auth.register'), this.user, {
                onSuccess: () => {
                    if (Object.keys(this.$page.errors).length) {
                        swal("Oops!", "Please check all inputs!", "error");
                    }
                },
                onError: (errors) => {
                    swal("Oops!", "Something went wrong!", "error");
                },
            });

        }
    },
    mounted() {
        SEMICOLON.widget.tabs();
    }
}
</script>

<style scoped>

</style>
