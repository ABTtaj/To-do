<template>
    <div>
        <form>
            <div class="form-group">
                <label for="titleInput">Title</label>
                <input type="text" class="form-control" id="titleInput" placeholder="Enter a title" v-model="newTask.title">
            </div>
            <div class="form-group">
                <label for="descriptionInput">Description</label>
                <textarea class="form-control" id="descriptionInput" rows="3" placeholder="Enter a description" v-model="newTask.description"></textarea>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success" @click.prevent="createNewTask">Create New Task</button>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    data(){
        return{
            newTask:{
                title:"",
                description:"",
                isDone:false
            }
        }
    },
    methods:{
        createNewTask(){
            this.$emit('newTaskCreated',this.newTask);
        }
    }
}
</script>