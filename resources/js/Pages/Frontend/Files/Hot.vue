<template>
    <app-layout>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="icon-fire"></i> Hot Files
                        </div>
                        <div class="card-body">
                            <div v-if="!files.length" class="alert alert-info">
                                {{ this.message }}
                            </div>
                            <div v-else>
                                <div v-for="file in files" class="row">
                                    <div class="col-md-2">
                                        <img :src="file.image" :alt="file.name" class="w-100" />
                                    </div>
                                    <div class="col-md-7">
                                        <h5>{{ file.description }}</h5>
                                        <hr class="m-2">
                                        <h5>
                                            Size : <b>{{ Math.round(file.size/1000, 2) }} MB</b>  |
                                            Downloaded : <b>{{ file.downloads_count }} Times.</b>
                                        </h5>
                                    </div>
                                    <div class="col-md-3">
                                        <a :href="['/files/download/' + file.id]" class="btn btn-success btn-sm">
                                            <i class="icon-download"></i> Download
                                        </a>
                                        <a @click="report(file.id)" class="btn btn-danger btn-sm">
                                            <i class="icon-warning-sign"></i> Report
                                        </a>
                                    </div>
                                    <div class="col-12">
                                        <hr class="m-3">
                                    </div>
                                </div>
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
    name: "Hot",
    components: {AppLayout},
    props: ['files'],
    data() {
        return {
            message: 'No Files Uploaded Yet!',
        }
    },
    methods: {
        report(fileId) {
            if (confirm('Are you sure, you want to report this file?')) {
                this.$inertia.post(route('frontend.files.report', fileId));
            }
        },
    }
}
</script>

<style scoped>

</style>
