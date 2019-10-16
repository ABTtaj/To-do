<template>
    <div class="row">
        <div class="col">
            <div class="text-center mb-5">
                <h4 v-if="mode==='create'">Create New Project</h4>
                <h4 v-if="mode==='edit'">Edit Project</h4>
            </div>
            <div class="card shadow">
                <div class="card-body">
                    <div class="card-text">
                        <form>
                            <div class="form-group">
                                <label for="titleInput">Title</label>
                                <input type="text" class="form-control shadow-sm" :class="{'border-danger':errors.title && !newProject.title}" id="titleInput" placeholder="Enter a title" v-model="newProject.title">
                            </div>
                            <div v-if="errors.title && !newProject.title" class="error-message">
                                {{errors.title}}
                            </div>
                            <div class="form-group">
                                <label for="descriptionInput">Description</label>
                                <textarea class="form-control shadow-sm" :class="{'border-danger':errors.description && !newProject.description}" id="descriptionInput" rows="3" placeholder="Enter a description" v-model="newProject.description"></textarea>
                            </div>
                            <div v-if="errors.description && !newProject.description" class="error-message">
                                {{errors.description}}
                            </div>
                            <div class="d-flex justify-content-end" v-if="mode==='create'">
                                <button type="submit" class="btn btn-success shadow" @click.prevent="createNewProject">Add New Project</button>
                            </div>
                            <div class="d-flex justify-content-end" v-if="mode==='edit'">
                                <button type="submit" class="btn btn-success shadow" @click.prevent="editProject">Edit Project</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            newProject:{
                title:"",
                description:"",
            },
            errors:{
                title:'',
                description:''
            },
            mode:'create'
        }
    },
    methods:{
        createNewProject(){
            axios.post('/api/projects',this.newProject)
            .then(({data})=>{
                this.$router.push({ name: 'projects_list'});
                window.flash('success','A new project has been created');
            })
            .catch(({response}) => {
                this.errors.title=response.data.errors.title ? response.data.errors.title[0] : '';
                this.errors.description=response.data.errors.description ? response.data.errors.description[0] : '';
                window.flash('danger',response.data.message);
            });
        },
        editProject(){
            axios.put('/api/projects/'+this.$route.params.project_id,this.newProject)
            .then(({data})=>{
                this.$router.push({ name: 'projects_list'});
                window.flash('success','The project has been updated');
            })
            .catch(({response}) => {
                this.errors.title=response.data.errors.title ? response.data.errors.title[0] : '';
                this.errors.description=response.data.errors.description ? response.data.errors.description[0] : '';
                window.flash('danger',response.data.message);
            });
        }
    },
    created(){
        if(this.$route.params.project_id){
            axios.get('/api/projects/'+this.$route.params.project_id)
            .then(({data}) => {
                this.newProject = data;
                this.mode = 'edit';
            })
        }
    }
}
</script>
<style scoped>
.error-message{
    color: #e3342f;
    font-size: 12px;
    margin: 10px;
}
</style>