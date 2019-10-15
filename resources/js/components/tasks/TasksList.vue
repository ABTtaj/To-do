<template>
    <div class="row">
        <div class="col-md-4" v-if="tasksData.length">
            <div class="text-center mb-5">
                <h4>Tasks List</h4>
            </div>
            <ul class="list-group shadow"> 
                <li class="list-group-item task-element text-white font-italic h5"
                    v-for="task in tasks"
                    :key="task.id"
                    :class="{
                        'task-done light-bg-success': task.is_done,
                        'light-bg-danger' : !task.is_done}"
                    @click="choiseATask(task)"
                >
                <i class="fa fa-check-circle mr-2" v-if="task.is_done"></i>
                <i class="fa fa-exclamation-triangle mr-2" v-if="!task.is_done"></i>
                {{task.title | truncate}}
                </li>
            </ul>
            <div v-if="tasksData.length">
                <h5 class="text-center my-4">Filter By</h5>
                <button class="btn btn-success btn-block shadow" @click="filterByDone">Done</button>
                <button class="btn btn-danger btn-block shadow" @click="filterByNotDone">Not Done</button>
                <button class="btn btn-primary btn-block shadow" @click="giveAll">All</button>
            </div>
            <div v-if="!addNewTask && tasksData.length" class="mt-4">
                <button class="btn btn-secondary btn-block shadow" @click="addNewTask=!addNewTask">Create New Task</button>
            </div>
        </div>
        <div 
            :class="{
                'col-md-8':tasksData.length,
                'col':tasksData.length === 0
            }"
        >
            <div v-if="!addNewTask && tasksData.length && !editMode">
                <div class="text-center mb-5">
                    <h4>Task Detail</h4>
                </div>
                <task-details
                    v-if="choisenTask"
                    :data="choisenTask"
                    @taskDone="onTaskis_done()"
                    @taskUnDone="onTaskIsUnDone()"
                    @taskDeleted="onTaskDeleted()"
                    @taskEditing="onTaskEditing"
                ></task-details>
                <div class="alert alert-info" role="alert" v-if="!choisenTask">
                    No tasks found!
                </div>
            </div>
            <div v-if="addNewTask || tasksData.length === 0">
                <task-add
                    mode="create"
                    @newTaskCreated="onNewTaskCreated($event)"
                ></task-add>
            </div>
            <div v-if="editMode">
                <task-add
                    mode="edit"
                    :model="choisenTask"
                    @taskEdited="onTaskEdited($event)"
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
            addNewTask:false,
            editMode:false
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
        onTaskis_done(){
            this.choisenTask.is_done=true;
        },
        onTaskIsUnDone(){
            this.choisenTask.is_done=false;
        },
        onNewTaskCreated(newTask){
            this.tasks.unshift(newTask);
            this.addNewTask=false;
            this.taskDetail=newTask;
        },
        onTaskDeleted(){
            this.tasks=this.tasks.filter(task=>{
                return this.choisenTask.id !== task.id;
            });
            this.tasksData=this.tasksData.filter(task=>{
                return this.choisenTask.id !== task.id;
            });
            this.taskDetail = null;
        },
        onTaskEditing(){
            this.editMode=true;
        },
        onTaskEdited(editedTask){
            this.editMode=false;
            this.tasks = this.tasks.map(task => {
                return editedTask.id === task.id ? editedTask : task;
            });
            this.tasksData = this.tasksData.map(task => {
                return editedTask.id === task.id ? editedTask : task;
            });
            this.taskDetail=editedTask;
        },
        giveAll(){
            this.tasks = this.tasksData;
            this.taskDetail = null;
        },
        filterByDone(){
            this.tasks = this.tasksData.filter(task => {
                return task.is_done;
            });
            this.taskDetail = null;
        },
        filterByNotDone(){
            this.tasks = this.tasksData.filter(task => {
                return !task.is_done;
            });
            this.taskDetail = null;
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