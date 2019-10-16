<template>
    <div class="row">
        <div class="col-md-4" v-if="tasks.length">
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
                    <span>
                        <i class="fa fa-check-circle mr-2" v-if="task.is_done"></i>
                        <i class="fa fa-exclamation-triangle mr-2" v-if="!task.is_done"></i>
                        {{task.title | truncate}}
                    </span>
                </li>
            </ul>
        </div>
        <div 
            :class="{
                'col-md-8':tasks.length,
                'col':tasks.length === 0
            }"
        >
            <div v-if="!addNewTask && tasks.length && !editMode">
                <div class="text-center mb-5">
                    <h4>Task Detail</h4>
                </div>
                <task-details
                    v-if="choisenTask"
                    :data="choisenTask"
                    @taskDone="onTaskDone"
                    @taskUnDone="onTaskIsUnDone"
                    @taskDeleted="onTaskDeleted"
                    @taskEditing="onTaskEditing"
                ></task-details>
                <div v-if="!addNewTask && tasks.length" class="d-flex justify-content-end mt-4">
                    <button class="btn btn-secondary shadow" @click="addNewTask=!addNewTask">Create New Task</button>
                </div>
                <div class="alert alert-dark shadow" role="alert" v-if="!choisenTask">
                    No tasks found!
                </div>
            </div>
            <div v-if="addNewTask || tasks.length === 0">
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
        onTaskDone(){
            this.taskDetail.is_done=true;
        },
        onTaskIsUnDone(){
            this.taskDetail.is_done=false;
        },
        onNewTaskCreated(newTask){
            this.tasks.unshift(newTask);
            this.tasks.unshift(newTask);
            this.addNewTask=false;
            this.taskDetail=newTask;
        },
        onTaskDeleted(){
            this.tasks=this.tasks.filter(task=>{
                return this.choisenTask.id !== task.id;
            });
            this.tasks=this.tasks.filter(task=>{
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
            this.tasks = this.tasks.map(task => {
                return editedTask.id === task.id ? editedTask : task;
            });
            this.taskDetail=editedTask;
        }
    },
    created(){
        axios.get('/api/sprints/'+this.$route.params.sprint_id+'/tasks')
        .then(({data})=>{
            this.tasks = data;
            window.event.$emit('dataFetched');
        })
    },
    beforeCreate() {
        window.event.$emit('pageBeforeCreate');
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