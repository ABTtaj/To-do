<template>
    <div class="row">
        <div class="col">
            <div class="my-4 text-center">
                <h4>Create a New Project</h4>
            </div>
            <form>
                <div class="form-group">
                    <label for="titleInput">Title</label>
                    <input type="text" class="form-control" id="titleInput" placeholder="Enter a title" v-model="newProject.title">
                </div>
                <div class="form-group">
                    <label for="descriptionInput">Description</label>
                    <textarea class="form-control" id="descriptionInput" rows="3" placeholder="Enter a description" v-model="newProject.description"></textarea>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success" @click.prevent="createNewProject">Create New Sprint</button>
                </div>
            </form>
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
                tasksNotDone:0
            }
        }
    },
    methods:{
        createNewProject(){
            console.log(this.newProject);
        }
    }
}
</script>