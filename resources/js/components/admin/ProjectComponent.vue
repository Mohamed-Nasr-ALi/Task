<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Projects Table</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" data-toggle="modal" data-target="#addNew"
                                    @click="openModalWindow">Add New <i class="fas fa-project-plus fa-fw"></i></button>
                        </div>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <th scope="col">project title</th>
                                <th scope="col">Num of Tasks</th>
                                <th scope="col">Percent</th>
                                <th scope="col">Edit | Delete</th>
                            </tr>

                            <tr v-for="project in projects" :key="project.id">
                                <td>{{ project.id }}</td>
                                <td>{{ project.title | strToUpper }}</td>
                                <td>{{ project.count_tasks }}</td>
                                <td>{{ project.percent }} &#37;</td>

                                <td>
                                    <a href="#" data-id="project.id" @click="editModalWindow(project)">
                                        <i class="fa fa-edit blue"></i>
                                    </a>
                                    |
                                    <a href="#" @click="deleteProject(project.id)">
                                        <i class="fa fa-trash red"></i>
                                    </a>

                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer">

                    </div>
                </div>

            </div>
        </div>


        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 v-show="!editMode" class="modal-title" id="addNewLabel">Add New Project</h5>
                        <h5 v-show="editMode" class="modal-title" id="addNewLabelg">Update Project</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form @submit.prevent="editMode ? updateProject() : createProject()">
                        <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form.title" type="text" title="title"
                                       placeholder="Title"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('title') }">
                                <has-error :form="form" field="title"></has-error>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button v-show="editMode" type="submit" class="btn btn-primary">Update</button>
                            <button v-show="!editMode" type="submit" class="btn btn-primary">Create</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        mounted() {
            axios.get("admin/projects").then(data => console.log(data.data));
        },
        data() {
            return {
                editMode: false,
                projects: {},
                form: new Form({
                    id: '',
                    title: '',
                    percent: '',
                    count_tasks: ''

                })
            }
        },
        methods: {

            editModalWindow(project) {
                this.form.clear();
                this.editMode = true
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(project)
            },
            updateProject() {
                this.form.put('admin/projects/' + this.form.id)
                    .then(() => {

                        Toast.fire({
                            icon: 'success',
                            title: 'Project updated successfully'
                        })

                        Fire.$emit('AfterCreatedProjectLoadIt');

                        $('#addNew').modal('hide');
                    })
                    .catch(() => {
                        console.log("Error.....")
                    })
            },
            openModalWindow() {
                this.editMode = false
                this.form.reset();
                $('#addNew').modal('show');
            },

            loadProjects() {

                axios.get("admin/projects").then(data => (this.projects = data.data));

                //pick data from controller and push it into projects object

            },

            createProject() {

                this.$Progress.start()

                this.form.post('admin/projects')
                    .then(() => {

                        Fire.$emit('AfterCreatedProjectLoadIt'); //custom events

                        Toast.fire({
                            icon: 'success',
                            title: 'Project created successfully'
                        })

                        this.$Progress.finish()

                        $('#addNew').modal('hide');
                        $('.modal-backdrop').remove();
                    })
                    .catch(() => {
                        console.log("Error......")
                    })


                //this.loadProjects();
            },
            deleteProject(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {

                    if (result.value) {
                        //Send Request to server
                        this.form.delete('admin/projects/' + id)
                            .then((response) => {
                                Swal.fire(
                                    'Deleted!',
                                    'Project deleted successfully',
                                    'success'
                                )
                                this.loadProjects();

                            }).catch(() => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                                footer: '<a href>Why do I have this issue?</a>'
                            })
                        })
                    }

                })
            }
        },

        created() {
            this.loadProjects();

            Fire.$on('AfterCreatedProjectLoadIt', () => { //custom events fire on
                this.loadProjects();
            });

        }
    }
</script>
