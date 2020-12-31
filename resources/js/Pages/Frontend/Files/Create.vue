<style scoped>
@import "../../../../css/Frontend/components/bs-filestyle.css";
</style>

<template>
    <app-layout>
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-header">
                    Upload a File
                </div>
                <div class="card-body">
                    <div v-if="$page.flash.message" class="alert alert-info">
                        {{ $page.flash.message }}
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="file-name">File Name</label>
                                <input id="file-name" class="form-control" v-model="file.name" type="text">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="file-section-id">File Section</label>
                                <select id="file-section-id" class="form-control" v-model="file.file_section_id">
                                    <option value="0">Select File Section</option>
                                    <option v-for="section in file_sections" :value="section.id">{{ section.name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="file-desc">File Description</label>
                                <textarea id="file-desc" class="form-control" v-model="file.description"></textarea>
                            </div>
                        </div>
                        <div class="col-md-10 mx-auto">
                            <div class="form-group">
                                <label for="file">Upload Your File</label>
                                <input id="file" type="file" ref="file" @change="handleFileUpload(1)" class="file" data-show-preview="false" data-show-upload="false">
                            </div>
                        </div>
                        <div class="col-md-10 mx-auto">
                            <div class="form-group">
                                <label for="image">Upload File's Image</label>
                                <input id="image" type="file" ref="image" @change="handleFileUpload(0)" class="file" data-show-preview="true" data-show-upload="false">
                            </div>
                        </div>
                        <div class="col-sm-6 mx-auto">
                            <button @click="uploadFile()" class="button button-3d button-aqua w-100">
                                Upload File
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
require('@/Layouts/Frontend/assets/js/components/bs-filestyle.js')
export default {
    name: "Create",
    components: {AppLayout},
    props: ['file_sections'],
    data() {
        return {
            file: {
                name: '',
                description: '',
                file_section_id: 0,
                file: '',
                image: '',
            }
        }
    },
    methods: {
        handleFileUpload(isFile) {
            if (!isFile) {
                this.file.image = this.$refs.image.files[0];
            } else {
                this.file.file = this.$refs.file.files[0];
            }
        },
        uploadFile() {
            if (this.file.file_section_id === 0) {
                swal('Error!', 'Please check Input properly!', 'error');
                return;
            }
            let data = new FormData();
            data.append('name', this.file.name)
            data.append('description', this.file.description)
            data.append('file_section_id', this.file.file_section_id)
            data.append('file', this.file.file)
            data.append('image_file', this.file.image)

            this.$inertia.post(route('frontend.files.store'), data, {
                onError: (errors) => {
                    swal('Error!', 'Please check Input properly!', 'error');
                },
            });
        }
    },
    mounted() {
        $("#file").fileinput();
    }
}
</script>
