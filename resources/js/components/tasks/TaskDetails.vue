<template>
    <div 
        class="card text-white" 
        :class="{
            'light-bg-success':data.isDone
            ,'light-bg-danger':!data.isDone
        }" 
    >
        <div class="card-body">
            <h5 class="card-title" :class="{'task-done':data.isDone}">{{data.title}}</h5>
            <p class="card-text" :class="{'task-done':data.isDone}">{{data.description}}</p>
            <div class="d-flex justify-content-end">
                <button class="btn btn-success" @click="taskDone" v-if="!data.isDone">Done</button>
                <button class="btn btn-light" @click="unDoneTask" v-if="data.isDone">Not Done Yet</button>
                <button class="btn btn-danger ml-2" @click="deleteTask">Delete</button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:[
        'data'
    ],
    methods:{
        taskDone(){
            this.$emit('taskDone');
        },
        unDoneTask(){
            this.$emit('taskUnDone');
        },
        deleteTask(){
            this.$emit('taskDeleted');
        }
    }
}
</script>
<style scoped>
    .task-done{
        text-decoration:line-through;
    }
    .light-bg-success{
        background-color: rgba(56,193,114,0.6);
    }
    .light-bg-danger{
        background-color: rgba(227,52,47,0.6);
    }
</style>