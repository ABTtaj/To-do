<template>
    <div class="row">
        <div class="col-md-12 text-center mb-5">
            <h4>Projects List</h4>
        </div>
        <div class="col-md-12 mb-4" v-for="project in projects" :key="project.id">
            <project-details :data="project" @projectDeleted="onProjectDeleted(project)"></project-details>
        </div>
        <div class="col-md-12" v-if="!projects.length">
            <div class="alert alert-info" role="alert">
                You don't have any project !
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
            projects :[]
        }
    },
    methods:{
        onProjectDeleted(deletedProject){
            this.projects= this.projects.filter(project=>{
                return deletedProject.id !== project.id;
            })
        }
    },
    mounted(){
        axios.get('/api/projects').then(({data})=>{
            this.projects=data;
        });
    }
}
</script>