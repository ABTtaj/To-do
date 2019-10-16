<template>
    <div class="row">
        <div class="col-md-4" v-if="sprints.length">
            <div v-if="sprints.length">
                <div class="text-center mb-5">
                    <h4>Sprints List</h4>
                </div>
                <ul class="list-group shadow">
                    <li class="list-group-item sprint-element d-flex justify-content-between" @click="choiseASprint(sprint)" v-for="sprint in sprints" :key="sprint.id">
                        <span>
                            {{sprint.title | truncate}}
                        </span>
                        <div>
                            <span class="badge badge-success">{{sprint.tasksDone}}</span>
                            <span class="badge badge-danger">{{sprint.tasksNotDone}}</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div 
            :class="{
                'col-md-8':sprints.length,
                'col':sprints.length === 0
            }"
        >
            <div v-if="!addNewSprint && sprints.length && !editMode">
                <div class="text-center mb-5">
                    <h4>Sprint Detail</h4>
                </div>
                <sprint-details
                    v-if="choisenSprint"
                    :data="choisenSprint"
                    @sprintDeleted="onSprintDeleted"
                    @sprintEditing="onSprintEditing"
                ></sprint-details>
                <div v-if="!addNewSprint && sprints.length" class="mt-4 d-flex justify-content-end">
                    <button class="btn btn-secondary shadow" @click="addNewSprint = true">Create New Sprint</button>
                </div>
            </div>
            <div v-if="addNewSprint || sprints.length === 0">
                <sprint-add
                    mode="create"
                    @newSprintCreated="onNewSprintCreated"
                ></sprint-add>
            </div>
            <div v-if="editMode">
                <sprint-add
                    mode="edit"
                    :model="choisenSprint"
                    @sprintEdited="onSprintEdited($event)"
                ></sprint-add>
            </div>
        </div>
    </div>
</template>
<script>
import SprintDetails from './SprintDetails.vue';
import SprintAdd from './SprintAdd.vue';
export default {
    components:{
        SprintDetails,
        SprintAdd
    },
    data(){
        return {
            sprints:[],
            sprintDetail:null,
            addNewSprint:false,
            editMode:false
        }
    },
    computed:{
        choisenSprint(){
            this.sprintDetail = this.sprintDetail ? this.sprintDetail : (this.sprints.length ? this.sprints[0] : null);
            return this.sprintDetail;
        }
    },
    methods:{
        choiseASprint(sprint){
            this.addNewSprint=false;
            this.sprintDetail = sprint;
        },
        onNewSprintCreated(newSprint){
            this.sprints.unshift(newSprint);
            this.addNewSprint=false;
            this.sprintDetail=newSprint;
        },
        onSprintDeleted(){
            this.sprints = this.sprints.filter(sprint => {
                return this.choisenSprint.id !== sprint.id;
            });
            this.sprintDetail=null;
        },
        onSprintEditing(){
            this.editMode=true;
        },
        onSprintEdited(editedSprint){
            this.editMode=false;
            this.sprints = this.sprints.map(sprint => {
                return editedSprint.id === sprint.id ? editedSprint : sprint;
            });
            this.sprintDetail=editedSprint;
        }
    },
    created(){
        axios.get('/api/projects/'+this.$route.params.project_id+'/sprints')
        .then(({data})=>{
            this.sprints=data;
            window.event.$emit('dataFetched');
        })
    },
    beforeCreate() {
        window.event.$emit('pageBeforeCreate');
    }
}
</script>

<style scoped>
    .sprint-element{
        cursor:pointer;
    }
</style>