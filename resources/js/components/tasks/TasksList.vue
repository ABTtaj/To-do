<template>
    <div class="row">
        <div class="col-md-4">
            <div class="my-4 text-center">
                <h4>Tasks List</h4>
            </div>
            <ul class="list-group"> 
                <li class="list-group-item task-element text-white font-italic h5"
                    v-for="task in tasks"
                    :key="task.id"
                    :class="{
                        'task-done light-bg-success': task.isDone,
                        'light-bg-danger' : !task.isDone}"
                    @click="choiseATask(task)"
                >
                <i class="fa fa-check-circle mr-2" v-if="task.isDone"></i>
                <i class="fa fa-exclamation-triangle mr-2" v-if="!task.isDone"></i>
                {{task.title | truncate}}
                </li>
            </ul>
            <div v-if="tasks.length" class="mb-4">
                <h5 class="text-center my-3">Filter By</h5>
                <button class="btn btn-success btn-block" @click="filterByDone">Done</button>
                <button class="btn btn-danger btn-block" @click="filterByNotDone">Not Done</button>
                <button class="btn btn-primary btn-block" @click="giveAll">All</button>
            </div>
            <div v-if="!addNewTask && tasks.length">
                <button class="btn btn-secondary btn-block" @click="addNewTask=!addNewTask">Create New Task</button>
            </div>
        </div>
        <div class="col-md-8">
            <div v-if="!addNewTask && tasks.length">
                <div class="my-4 text-center">
                    <h4>Task Detail</h4>
                </div>
                <task-details
                    v-if="choisenTask"
                    :data="choisenTask"
                    @taskDone="onTaskIsDone()"
                    @taskUnDone="onTaskIsUnDone()"
                    @taskDeleted="onTaskDeleted()"
                ></task-details>
            </div>
            <div v-if="addNewTask || tasks.length === 0">
                <div class="my-4 text-center">
                    <h4>Create New Task</h4>
                </div>
                <task-add
                    @newTaskCreated="onNewTaskCreated($event)"
                ></task-add>
            </div>
        </div>
    </div>
</template>
<script>
import TaskDetails from './TaskDetails.vue';
import TaskAdd from './TaskAdd.vue';
export default {
    data(){
        return {
            tasks:[],
            tasksData:[],
            taskDetail:null,
            addNewTask:false
        }
    },
    computed:{
        choisenTask(){
            this.taskDetail = this.taskDetail ? this.taskDetail : (this.tasks.length ? this.tasks[0] : null);
            return this.taskDetail;
        }
    },
    components:{
        TaskDetails,
        TaskAdd
    },
    methods:{
        choiseATask(task){
            this.addNewTask=false;
            this.taskDetail=task;
        },
        onTaskIsDone(){
            this.choisenTask.isDone=true;
        },
        onTaskIsUnDone(){
            this.choisenTask.isDone=false;
        },
        onNewTaskCreated(newTask){
            newTask.id=(this.tasks.length + 1);
            this.tasks.unshift(newTask);
            this.addNewTask=false;
            this.taskDetail=newTask;
        },
        onTaskDeleted(){
            this.tasks=this.tasks.filter(task=>{
                return this.choisenTask.id !== task.id;
            });
            this.taskDetail = null;
        },
        giveAll(){
            this.tasks = this.tasksData;
        },
        filterByDone(){
            this.tasks = this.tasksData.filter(task => {
                return task.isDone;
            });
        },
        filterByNotDone(){
            this.tasks = this.tasksData.filter(task => {
                return !task.isDone;
            });
        }
    },
    created(){
        axios.get('/api/sprints/'+this.$route.params.sprint_id+'/tasks')
        .then(({data})=>{
            this.tasks = data;
            this.tasksData = data;
        })
    }
}
</script>

<style scoped>
    .task-done{
        text-decoration:line-through;
        color:gray;
    }
    .task-element{
        cursor:pointer;
    }
    .light-bg-success{
        background-color: rgba(56,193,114,0.6);
    }
    .light-bg-danger{
        background-color: rgba(227,52,47,0.6);
    }
</style>