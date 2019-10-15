<template>
    <div class="card my-4">
        <div class="card-body">
                <h5 class="card-title d-flex justify-content-between">
                   <span>{{data.title}}</span> 
                    <span class="badge badge-danger"></span>
                </h5>
            <p class="card-text my-4">
                {{data.description}}
            </p>
            <div class="d-flex justify-content-end">
                <router-link tag="button" :to="'/projects/'+data.id+'/sprints'" class="btn btn-secondary">Show Details</router-link>
                <button class="btn btn-danger ml-2" @click="deleteProject">Delete</button>
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
            this.$emit('projectDeleted');
        }
    }
}
</script>