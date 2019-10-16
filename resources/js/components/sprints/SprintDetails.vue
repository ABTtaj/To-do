<template>
    <div 
        class="card shadow"  
    >
        <div class="card-header">
            <h5 class="align-items-end card-title d-flex justify-content-between m-0">
                <span>{{data.title}}</span> 
                <span class="h6 m-0 text-black-50">{{data.created_at}}</span>
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
                window.flash('success','Sprint Deleted');
            });
        },
        editSprint(){
            this.$emit('sprintEditing');
        }
    }
}
</script>