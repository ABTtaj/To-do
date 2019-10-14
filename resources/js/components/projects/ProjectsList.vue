<template>
    <div>
        <div class="row my-4">
            <div class="col text-center mt-4 d-flex justify-content-between">
                <div>
                    <h4>Projects List</h4>
                </div>
                <div>
                    <button class="btn btn-primary">Add New Project</button>
                </div>
            </div>
        </div>
        <div class="row" v-if="projects.length">
            <div class="col-md-6" v-for="project in projects" :key="project.id">
                <project-details :data="project" @projectDeleted="onProjectDeleted(project)"></project-details>
            </div>
        </div>
        <div class="row" v-if="!projects.length">
            <div class="col">
                <div class="alert alert-info" role="alert">
                    You don't have any project !
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import ProjectDetails from './ProjectDetails.vue';
export default {
    components:{
        ProjectDetails
    },
    data(){
        return {
            projects :[
                {
                    id:1,
                    title:"Project #1",
                    description : "Description Project #1",
                    tasksNotDone:15
                },
                {
                    id:2,
                    title:"Project #2",
                    description : "Description Project #2",
                    tasksNotDone:30
                },
                {
                    id:3,
                    title:"Project #3",
                    description : "Description Project #3",
                    tasksNotDone:2
                },
                {
                    id:4,
                    title:"Project #4",
                    description : "Description Project #4",
                    tasksNotDone:0
                },
                {
                    id:5,
                    title:"Project #5",
                    description : "Description Project #5",
                    tasksNotDone:15
                },
                {
                    id:6,
                    title:"Project #6",
                    description : "Description Project #6",
                    tasksNotDone:30
                },
                {
                    id:7,
                    title:"Project #7",
                    description : "Description Project #7",
                    tasksNotDone:2
                },
                {
                    id:8,
                    title:"Project #8",
                    description : "Description Project #8",
                    tasksNotDone:0
                },
            ]
        }
    },
    methods:{
        onProjectDeleted(deletedProject){
            this.projects= this.projects.filter(project=>{
                return deletedProject.id !== project.id;
            })
        }
    }
}
</script>