<template>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <h2 class="text-center my-3">Todo Management</h2>

                    <div class="card-body">
                        <div class="input-group">
                            <input type="text" placeholder="Todo Title ..." class="form-control" aria-label="todo" aria-describedby="todo" v-model="todo_input">
                            <div class="input-group-append">
                                <button v-if="!edit_todo_id" class="btn btn-primary" type="button" @click="saveTodo()">Add</button>
                                <button v-else class="btn btn-white" type="button" @click="updateTodo()">Update</button>
                            </div>
                        </div>

                        <button type="button" class="btn btn-outline-warning float-right my-2 rounded-pill" @click="resetTodo()">Reset</button>
                        <table class="table table-striped text-center">
                            <thead>
                                <th>S.No</th>
                                <th>Title</th>
                                <th>Completed</th>
                                <th>Action</th>
                            </thead>

                            <tbody>
                                <tr v-for="(todo,index) in todos" :key="index">
                                    <td>[{{ ++index }}].</td>
                                    <td>{{ todo.title }}</td>
                                    <td>
                                        {{ todo.complete ? 'Completed' : 'Pending' }}
                                        <!-- <p v-if="todo.complete === 1">Completed</p>
                                        <p v-else>Pending</p> -->
                                    </td>
                                    <td>
                                        <button v-if="!complete_todo_id" type="button" class="btn btn-sm btn-success" @click="completeTodo(todo.id)">Completed</button>
                                        <button v-else type="button" class="btn btn-sm btn-success" @click="pendingTodo(--index)">Incomplete</button>
                                        <button type="button" class="btn btn-sm btn-info" @click="editTodo(--index)">Edit</button>
                                        <button type="button" class="btn btn-sm btn-danger" @click="deleteTodo(--index)">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                todos: [],
                api: 'http://127.0.0.1:8000/api/todos',
                todo_input: '',
                edit_todo_id: '',
                edit_index: '',
                complete_input: '1',
                complete_todo_id: '',
                complete_index: '',
            }
        },
        mounted() {
            //get api data
            this.getTodos();
        },
        methods:{
            getTodos(){
                this.axios.get(this.api).then(response => {
                this.todos = response.data;
           });
            },
            saveTodo(){
                if(this.todo_input.length > 0) {
                    this.axios.post(this.api,{'title':this.todo_input}).then(response => {
                        this.todos.push(response.data);
                        this.todo_input = '';
                    });
                }
            },
            deleteTodo(index) {
                if(this.todos[index].id){
                    this.axios.delete(this.api+'/'+this.todos[index].id).then(response => {
                        this.todos.splice(index,1);
                    })
                }
            },
            editTodo(index) {
                if(this.todos[index].id){
                    this.todo_input = this.todos[index].title;
                    this.edit_todo_id = this.todos[index].id;
                    this.edit_index = index;
                }
            },
            updateTodo() {
                if(this.todo_input.length > 0){
                    let data = {'title': this.todo_input};
                    this.axios.patch(this.api+'/'+this.todos[this.edit_index].id,data).then(res=> {
                        this.todos[this.edit_index].title = res.data.title;
                        this.resetTodo();
                    });
                }
            },
            resetTodo() {
                this.todo_input = '';
                this.edit_todo_id = '';
                this.edit_index = '';
            },
            completeTodo(index) {
                this.axios.patch(`${this.api}/complete/${index}`).then(res=> {
                    this.getTodos();
                });
            },
        }
    }
</script>
