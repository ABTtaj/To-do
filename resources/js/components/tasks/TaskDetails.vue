<template>
    <div 
        class="card text-white shadow" 
        :class="{
            'light-bg-success':data.is_done
            ,'light-bg-danger':!data.is_done
        }" 
    >
        <div class="card-header">
            <h5 class="card-title m-0" :class="{'task-done':data.is_done}">{{data.title}}</h5>
        </div>
        <div class="card-body">
            <p class="card-text mx-4 my-2" :class="{'task-done':data.is_done}">{{data.description}}</p>
            <div class="d-flex justify-content-between mt-3">
                <div>
                    <button class="btn btn-success shadow" @click="taskDone" v-if="!data.is_done">Done</button>
                    <button class="btn btn-danger shadow" @click="unDoneTask" v-if="data.is_done">Not Done Yet</button>
                </div>
                <div>
                    <button class="btn btn-primary shadow" @click="editTask">Edit</button>
                    <button class="btn btn-danger ml-2 shadow" @click="deleteTask">Delete</button>
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
        taskDone(){
            axios.put('/api/tasks/'+this.data.id,{
                title:this.data.title,
                description:this.data.title,
                is_done:true
            }).
            then(({data})=>{
                this.$emit('taskDone');
            });
        },
        unDoneTask(){
            axios.put('/api/tasks/'+this.data.id,{
                title:this.data.title,
                description:this.data.title,
                is_done:false
            }).
            then(({data})=>{
                this.$emit('taskUnDone');
            });
        },
        deleteTask(){
            axios.delete('/api/tasks/'+this.data.id)
            .then(({data})=>{
                this.$emit('taskDeleted');
            })
        },
        editTask(){
            this.$emit('taskEditing');
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