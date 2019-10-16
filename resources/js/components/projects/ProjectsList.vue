<template>
    <div class="row">
        <div class="col-md-12 text-center mb-5">
            <h4>Projects List</h4>
        </div>
        <div class="col-md-3 mb-2">
            <form>
                <div class="form-group">
                    <input v-model="searchBy" type="text" class="form-control shadow" placeholder="Search" @input="filterProjects" v-if="projectsData.length">
                </div>
            </form>
        </div>
        <div class="col-md-12 mb-4" v-for="project in projects" :key="project.id">
            <project-details :data="project" @projectDeleted="onProjectDeleted(project)"></project-details>
        </div>
        <div class="col-md-12" v-if="!projects.length">
            <div class="alert alert-dark shadow" role="alert">
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
            projects :[],
            projectsData : [],
            searchBy:''
        }
    },
    methods:{
        onProjectDeleted(deletedProject){
            this.projects= this.projectsData.filter(project=>{
                return deletedProject.id !== project.id;
            })
        },
        filterProjects(){
            this.projects = this.projectsData.filter(project => {
                return project.title.toLowerCase().includes(this.searchBy.toLowerCase());
            });
        }
    },
    created(){
        axios.get('/api/projects').then(({data})=>{
            this.projectsData=data;
            this.projects=data;
            window.event.$emit('dataFetched');
        });
    },
    beforeCreate() {
        window.event.$emit('pageBeforeCreate');
    }
}
</script>