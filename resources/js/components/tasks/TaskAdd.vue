<template>
    <div>
        <div class="text-center mb-5">
            <h4 v-if="mode ==='create'">Create New Task</h4>
            <h4 v-if="mode ==='edit'">Edit Task</h4>
        </div>
        <div class="card shadow">
            <div class="card-body">
                <div class="card-text">
                    <form>
                        <div class="form-group">
                            <label for="titleInput">Title</label>
                            <input type="text" class="form-control shadow-sm" id="titleInput" placeholder="Enter a title" v-model="newTask.title">
                        </div>
                        <div class="form-group">
                            <label for="descriptionInput">Description</label>
                            <textarea class="form-control shadow-sm" id="descriptionInput" rows="3" placeholder="Enter a description" v-model="newTask.description"></textarea>
                        </div>
                        <div class="d-flex justify-content-end" v-if="mode ==='create'">
                            <button type="submit" class="btn btn-success shadow" @click.prevent="createNewTask">Create New Task</button>
                        </div>
                        <div class="d-flex justify-content-end" v-if="mode ==='edit'">
                            <button type="submit" class="btn btn-success shadow" @click.prevent="editTask">Edit Task</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:[
        'mode',
        'model'
    ],
    data(){
        return{
            newTask:{
                title:"",
                description:"",
            }
        }
    },
    methods:{
        createNewTask(){
            axios.post('/api/sprints/'+this.$route.params.sprint_id+'/tasks',this.newTask)
            .then(({data}) => {
                this.newTask.id=data.id;
                this.$emit('newTaskCreated',this.newTask);
            })
        },
        editTask(){
            axios.put('/api/tasks/'+this.newTask.id,this.newTask).
            then(({data})=>{
                this.$emit('taskEdited',this.newTask);
            })
        }
    },
    mounted(){
        if(this.mode ==='edit'){
            this.newTask = {...this.model};
        }
    }
}
</script>