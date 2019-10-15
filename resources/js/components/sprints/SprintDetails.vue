<template>
    <div 
        class="card shadow"  
    >
        <div class="card-header">
            <h5 class="card-title d-flex justify-content-between m-0">
                <span>
                    {{data.title}}
                </span>
                <div>
                    <span class="badge badge-success">{{data.tasksDone}}</span>
                    <span class="badge badge-danger">{{data.tasksNotDone}}</span>
                </div>
            </h5>
        </div>
        <div class="card-body">
            <div class="card-text mx-4 my-2">
                {{data.description}}
            </div>
            <div class="d-flex justify-content-between mt-3">
                <router-link tag="button" :to="'/sprints/'+data.id+'/tasks'" class="btn btn-link">Show Tasks</router-link>
                <div>
                    <button class="btn btn-primary shadow" @click="editSprint()">Edit</button>
                    <button class="btn btn-danger ml-2 shadow" @click="deleteSprint()">Delete</button>
                </div>
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
            axios.delete('/api/sprints/'+this.data.id).then(({data})=>{
                this.$emit('sprintDeleted');
            });
        },
        editSprint(){
            this.$emit('sprintEditing');
        }
    }
}
</script>