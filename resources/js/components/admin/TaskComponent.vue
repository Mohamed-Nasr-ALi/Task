<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tasks Table</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" data-toggle="modal" data-target="#addNew"
                                    @click="openModalWindow">Add New <i class="fas fa-task-plus fa-fw"></i></button>
                        </div>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <th scope="col">task title</th>
                                <th scope="col">status</th>
                                <th scope="col">project name</th>
                                <th scope="col">Edit | Delete</th>
                            </tr>

                            <tr v-for="task in tasks" :key="task.id">
                                <td>{{ task.id }}</td>
                                <td>{{ task.task_title | strToUpper }}</td>
                                <td>{{ task.status }} &#37;</td>
                                <td>{{ task.project_tasks }}</td>

                                <td>
                                    <a href="#" data-id="task.id" @click="editModalWindow(task)">
                                        <i class="fa fa-edit blue"></i>
                                    </a>
                                    |
                                    <a href="#" @click="deleteTask(task.id)">
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

                        <h5 v-show="!editMode" class="modal-title" id="addNewLabel">Add New Task</h5>
                        <h5 v-show="editMode" class="modal-title" id="addNewLabelg">Update Task</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form @submit.prevent="editMode ? updateTask() : createTask()">
                        <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form.task_title" type="text" name="task_title"
                                       placeholder="Title"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('task_title') }">
                                <has-error :form="form" field="task_title"></has-error>
                            </div>
                        </div>
                        <div class="form-group">

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
            axios.get("admin/tasks").then(data => console.log(data.data));
        },
        data() {
            return {
                editMode: false,
                tasks: {},
                projects:{},
                form: new Form({
                    id: '',
                    task_title: '',
                    status: '',
                    project_id: '',
                    project_tasks: '',

                })
            }
        },
        methods: {

            editModalWindow(task) {
                this.form.clear();
                this.editMode = true
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(task)
            },
            updateTask() {
                this.form.put('admin/tasks/' + this.form.id)
                    .then(() => {

                        Toast.fire({
                            icon: 'success',
                            title: 'Task updated successfully'
                        })

                        Fire.$emit('AfterCreatedTaskLoadIt');

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

            loadTasks() {

                axios.get("admin/tasks").then(data => (this.tasks = data.data));

                //pick data from controller and push it into tasks object

            },

            createTask() {

                this.$Progress.start()

                this.form.post('admin/tasks')
                    .then(() => {

                        Fire.$emit('AfterCreatedTaskLoadIt'); //custom events

                        Toast.fire({
                            icon: 'success',
                            title: 'Task created successfully'
                        })

                        this.$Progress.finish()

                        $('#addNew').modal('hide');

                    })
                    .catch(() => {
                        console.log("Error......")
                    })


                //this.loadTasks();
            },
            deleteTask(id) {
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
                        this.form.delete('admin/tasks/' + id)
                            .then((response) => {
                                Swal.fire(
                                    'Deleted!',
                                    'Task deleted successfully',
                                    'success'
                                )
                                this.loadTasks();

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
            this.loadTasks();

            Fire.$on('AfterCreatedTaskLoadIt', () => { //custom events fire on
                this.loadTasks();
            });

        }
    }
</script>
