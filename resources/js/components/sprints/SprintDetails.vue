<template>
    <div 
        class="card"  
    >
        <div class="card-body">
            <h5 class="card-title d-flex justify-content-between">
                <span>
                    {{data.title}}
                </span>
                <div>
                    <span class="badge badge-success">{{data.tasksDone}}</span>
                    <span class="badge badge-danger">{{data.tasksNotDone}}</span>
                </div>
            </h5>
            <div class="card-text my-4">
                {{data.description}}
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn btn-primary">Show Tasks</button>
                <button class="btn btn-danger ml-2" @click="deleteSprint()">Delete</button>
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
        deleteSprint(){
            this.$emit('sprintDeleted');
        }
    }
}
</script>