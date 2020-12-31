<template>
    <app-layout>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <i class="icon-list"></i> Manage Files
                        </div>
                        <div class="card-body">
                            <div v-if="$page.flash.message" class="alert alert-info">
                                {{ $page.flash.message }}
                            </div>
                            <div class="table-responsive" v-if="files.length">
                                <table class="table table-bordered">
                                    <thead>
                                        <th>File Name</th>
                                        <th>File Downloads</th>
                                        <th>Actions</th>
                                    </thead>
                                    <tbody>
                                        <tr v-for="file in files">
                                            <td>{{ file.name }}</td>
                                            <td>{{ file.downloads_count }}</td>
                                            <td>
                                                <button @click="manageUsers(file.user_downloads)" class="btn btn-success btn-sm">
                                                    <i class="icon-users"></i> View Users
                                                </button>
                                                <a :href="['/files/download/' + file.id]" class="btn btn-info btn-sm">
                                                    <i class="icon-download"></i> Download
                                                </a>
                                                <a @click="destroy(file.id)" class="btn btn-danger btn-sm">
                                                    <i class="icon-warning-sign"></i> Delete File
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="alert alert-info" v-else>
                                <strong>You have not uploaded any files yet!</strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="heading-block fancy-title border-bottom-0 title-bottom-border">
                        <h4>Who Downloaded Your <span>File</span>?</h4>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                        <th>Name</th>
                        <th>Email</th>
                        </thead>
                        <tbody v-if="users.length">
                        <tr v-for="user in users">
                            <td>
                                <h5>{{ user.user.name }}</h5>
                            </td>
                            <td>
                                <h5>{{ user.user.email }}</h5>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
export default {
    name: "Manage",
    components: {AppLayout},
    props: ['files'],
    data() {
        return {
            message: 'You have not uploaded any Files!',
            users: [],
        }
    },
    methods: {
        destroy(fileId) {
            if (confirm('Are you sure, you want to delete this file?')) {
                this.$inertia.delete(route('frontend.files.destroy', fileId));
            }
        },
        manageUsers(users) {
            this.users = users;
        }
    },
    mounted() {
        SEMICOLON.initialize.modal();
    }
}
</script>

<style scoped>

</style>
