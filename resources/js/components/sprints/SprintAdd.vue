<template>
    <div>
        <div class="text-center mb-5">
            <h4 v-if="mode === 'create'">Create New Sprint</h4>
            <h4 v-if="mode === 'edit'">Edit Sprint</h4>
        </div>
        <div class="card shadow">
            <div class="card-body">
                <div class="card-text">
                    <form>
                        <div class="form-group">
                            <label for="titleInput">Title</label>
                            <input type="text" :class="{'border-danger':errors.title && !newSprint.title}" class="form-control shadow-sm" id="titleInput" placeholder="Enter a title" v-model="newSprint.title">
                        </div>
                        <div v-if="errors.title && !newSprint.title" class="error-message">
                            {{errors.title}}
                        </div>
                        <div class="form-group">
                            <label for="descriptionInput">Description</label>
                            <textarea class="form-control shadow-sm" :class="{'border-danger':errors.description && !newSprint.description}" id="descriptionInput" rows="3" placeholder="Enter a description" v-model="newSprint.description"></textarea>
                        </div>
                        <div v-if="errors.description && !newSprint.description" class="error-message">
                            {{errors.description}}
                        </div>
                        <div class="d-flex justify-content-end" v-if="mode === 'create'">
                            <button type="submit" class="btn btn-success shadow" @click.prevent="createNewSprint">Create New Sprint</button>
                        </div>
                        <div class="d-flex justify-content-end" v-if="mode === 'edit'">
                            <button type="submit" class="btn btn-success shadow" @click.prevent="editSprint">Edit Sprint</button>
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
            newSprint:{
                title:"",
                description:"",
            },
            errors:{
                title:'',
                description:''
            }
        }
    },
    methods:{
        createNewSprint(){
            axios.post('/api/projects/'+this.$route.params.project_id+'/sprints',this.newSprint).
            then(({data})=>{
                this.newSprint.id=data.id;
                this.$emit('newSprintCreated',this.newSprint);
                window.flash('success','A new sprint has been created');
            })
            .catch(({response}) => {
                this.errors.title=response.data.errors.title ? response.data.errors.title[0] : '';
                this.errors.description=response.data.errors.description ? response.data.errors.description[0] : '';
                window.flash('danger',response.data.message);
            })
        },
        editSprint(){
            axios.put('/api/sprints/'+this.newSprint.id,this.newSprint).
            then(({data})=>{
                this.$emit('sprintEdited',this.newSprint);
                window.flash('success','The sprint has been updated');
            })
            .catch(({response}) => {
                this.errors.title=response.data.errors.title ? response.data.errors.title[0] : '';
                this.errors.description=response.data.errors.description ? response.data.errors.description[0] : '';
                window.flash('danger',response.data.message);
            })
        }
    },
    created(){
        if(this.mode ==="edit"){
            this.newSprint = {...this.model};
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