<template>
    <app-layout>
        <div class="ml-5 mr-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Search Files
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="file-keyword">Enter Keywords Here</label>
                                        <input id="file-keyword" class="form-control" v-model="keywords" type="text">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="file-section-id">by file section</label>
                                        <select id="file-section-id" class="form-control" v-model="file_section_id">
                                            <option value="0">None</option>
                                            <option v-for="section in file_sections" :value="section.id">{{ section.name }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="divider divider-center text-black-50 m-2"><b>OR</b></div>
                                    <div class="form-group">
                                        <label for="file-name">Enter File Name</label>
                                        <input id="file-name" class="form-control" type="text" v-model="file_name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="orderBy">Order Files By</label>
                                        <select id="orderBy" class="form-control" v-model="order_by">
                                            <option value="created_at">Date</option>
                                            <option value="downloads_count">Downloads</option>
                                            <option value="name">File Name</option>
                                            <option value="size">Size</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sort-by">Sort By</label>
                                        <select id="sort-by" class="form-control" v-model="sort_by">
                                            <option value="desc">Descending</option>
                                            <option value="asc">Ascending</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <button @click="search()" class="button button-3d button-aqua w-100">
                                        Search
                                    </button>
                                </div>
                                <div class="col-sm-6">
                                    <button class="button button-3d button-dark w-100">
                                        Reset
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            Search Results
                        </div>
                        <div class="card-body">
                            <div v-if="!results.length" class="alert alert-info">
                                {{ this.message }}
                            </div>
                            <div v-else>
                                <div v-for="result in results" class="row">
                                    <div class="col-md-2">
                                        <img :src="result.image" :alt="result.name" class="w-100" />
                                    </div>
                                    <div class="col-md-7">
                                        <h5>{{ result.description }}</h5>
                                    </div>
                                    <div class="col-md-3">
                                        <a :href="['/files/download/' + result.id]" class="btn btn-success btn-sm">
                                            <i class="icon-download"></i> Download
                                        </a>
                                        <a @click="report(result.id)" class="btn btn-danger btn-sm">
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
    name: "Files",
    components: {AppLayout},
    props: ['file_sections',],
    data() {
        return {
            keywords: '',
            file_name: '',
            sort_by: 'desc',
            order_by: 'created_at',
            file_section_id: 0,
            files: [],
            results: [],
            message: 'Search Something from Left Box.'
        }
    },
    methods: {
        getAll() {
            axios.get(route('api.files')).then(
                res => {
                    this.files = res.data;
                }
            )
        },
        report(fileId) {
            if (confirm('Are you sure, you want to report this file?')) {
                this.$inertia.post(route('frontend.files.report', fileId));
            }
        },
        search() {
            this.results = [];

            let keywords_results = [];
            let file_name_results = [];

            if (this.keywords.length) {
                keywords_results = this.files.filter(el => {
                    return el.name.toLowerCase().includes(this.keywords.toLowerCase()) || el.description.toLowerCase().includes(this.keywords.toLowerCase())
                });
            }
            if (this.file_name.length) {
                file_name_results = this.files.filter(el => {
                    let filePath = el.path.split('/');
                    let fileName = filePath[filePath.length - 1];
                    return fileName.toLowerCase() === this.file_name.toLowerCase()
                });
            }

            let results = keywords_results.concat(file_name_results);

            let duplicates = [];
            results = results.filter(function(el) {
                if (duplicates.indexOf(el.id) === -1) {
                    duplicates.push(el.id);
                    return true;
                }
                return false;
            });

            if (results.length > 1) {

                let order_by = this.order_by;
                let sort_by = this.sort_by;

                results.sort(function(a, b) {
                    let return_stmt;
                    if (order_by === 'created_at') {
                        if (sort_by === 'asc') {
                            return_stmt = new Date(b.created_at) + new Date(a.created_at);
                        } else {
                            return_stmt = new Date(b.created_at) - new Date(a.created_at);
                        }
                        console.log(return_stmt);
                    }
                    else if (order_by === 'name') {
                        if (sort_by === 'asc') {
                            return_stmt = a.name.localeCompare(b.name);
                        } else {
                            return_stmt = b.name.localeCompare(a.name);
                        }
                    }
                    else {
                        if (b[order_by] > a[order_by]) {
                            if (sort_by === 'asc') {
                                return_stmt = -1;
                            } else {
                                return_stmt = 1;
                            }
                        } else {
                            if (sort_by === 'asc') {
                                return_stmt = 1
                            } else {
                                return_stmt = -1;
                            }
                        }
                    }
                    return return_stmt;
                });
            }
            if (!results.length) {
                this.message = 'No Files Found!';
            }
            this.results = results;
        },
    },
    mounted() {
        this.getAll();
    }
}
</script>

<style scoped>

</style>
