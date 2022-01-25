<template>
    <div>
<!--        <div v-if="tasks" class="progress mb-2">-->
<!--            <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>-->
<!--        </div>-->
        <form v-on:submit.prevent="addTask" autocomplete="off">
            <div class="input-group input-group-sm mb-3">
                <input  autocomplete="off" type="text" class="form-control" placeholder="کارهایی که باید انجام شود..." v-model="taskText">
            </div>
        </form>
        <p v-if="!tasks" class="text-sm">هیچ وظیفه ای وجود ندارد</p>
        <div v-else v-for="task in tasks" class="mb-2">
            <div class="d-block px-3 py-1 bg-light" style="border-radius: 15px 15px 15px 15px">
                <div class="d-inline-block">
                    <input v-on:change="taskIsDone(task.id,task.is_done)" :checked="task.is_done" type="checkbox" checked>

                    <span v-if="!task.is_done" class="text-sm">{{task.task}}</span>
                    <span v-else class="text-sm text-decoration-line-through text-success">{{task.task}}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:[
            'project_id','user_id'
        ],
        data () {

            return{
                users:[],
                tasks:[],
                taskText:''
            }
        },
        mounted() {
            this.getUsers();
            this.getTasks();

        },
        methods: {
            addTask(){
                axios.post('/v/task/add/',
                    {
                        user_id:this.user_id,
                        project_id:this.project_id,
                        task:this.taskText
                    },
                    {

                    }).then(
                    this.getTasks,
                    this.taskText=''

                );

            },
            taskIsDone(id,done){
                done=!done;
                axios.post('/v/task/done/',
                    {id:id,is_done: done},
                    {

                    }).then(this.getTasks)

            },
            getTasks(){
                axios.get('/v/project/tasks/'+this.project_id)
                    .then(response => {
                        this.tasks = response.data;
                    });
            },
            getUsers() {

                axios.get('/v/users/all')
                    .then(response => {
                        this.users = response.data;
                    });
            },
        }
    }
</script>
