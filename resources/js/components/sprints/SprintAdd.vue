<template>
    <div>
        <form>
            <div class="form-group">
                <label for="titleInput">Title</label>
                <input type="text" class="form-control" id="titleInput" placeholder="Enter a title" v-model="newSprint.title">
            </div>
            <div class="form-group">
                <label for="descriptionInput">Description</label>
                <textarea class="form-control" id="descriptionInput" rows="3" placeholder="Enter a description" v-model="newSprint.description"></textarea>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success" @click.prevent="createNewSprint">Create New Sprint</button>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    data(){
        return{
            newSprint:{
                title:"",
                description:"",
                tasksDone:0,
                tasksNotDone:0
            }
        }
    },
    methods:{
        createNewSprint(){
            this.$emit('newSprintCreated',this.newSprint);
        }
    }
}
</script>