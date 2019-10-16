<template>
    <div class="card shadow">
        <div class="card-header">
            <h5 class="align-items-end card-title d-flex justify-content-between m-0">
                <span>{{data.title}}</span> 
                <span class="h6 m-0 text-black-50">{{data.created_at}}</span>
            </h5>
        </div>
        <div class="card-body">
            <p class="card-text mx-4 my-2">
                {{data.description}}
            </p>
            <div class="d-flex justify-content-between mt-3">
                <router-link tag="button" :to="'/projects/'+data.id+'/sprints'" class="btn btn-link">Show Details</router-link>
                <div>
                    <router-link tag="button" :to="'/projects/'+data.id+'/edit'" class="btn btn-primary shadow" @click="deleteProject">Edit</router-link>
                    <button class="btn btn-danger ml-2 shadow" @click="deleteProject">Delete</button>
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
        deleteProject(){
            axios.delete('/api/projects/'+this.data.id)
            .then(({data}) => {
                this.$emit('projectDeleted');
                window.flash('success','Project Deleted');
            })
        }
    }
}
</script>