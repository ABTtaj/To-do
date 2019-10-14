<template>
    <div class="row">
        <div class="col-md-4">
            <div class="my-4 text-center">
                <h4>Sprints List</h4>
            </div>
            <div class="my-4">
                <button class="btn btn-success btn-block" @click="sortByTasksDone">Sort By Tasks Done</button>
                <button class="btn btn-danger btn-block" @click="sortByTasksNotDone">Sort By Tasks Not Done</button>
            </div>
            <ul class="list-group">
                <li class="list-group-item sprint-element d-flex justify-content-between" @click="choiseASprint(sprint)" v-for="sprint in sprints" :key="sprint.id">
                    <span>
                        {{sprint.title}}
                    </span>
                    <div>
                        <span class="badge badge-success">{{sprint.tasksDone}}</span>
                        <span class="badge badge-danger">{{sprint.tasksNotDone}}</span>
                    </div>
                </li>
            </ul>
            <div class="my-4">
                <button class="btn btn-secondary btn-block" @click="addNewSprint = true">Create New Task</button>
            </div>
        </div>
        <div class="col-md-8">
            <div v-if="!addNewSprint">
                <div class="my-4 text-center">
                    <h4>Sprint Detail</h4>
                </div>
                <sprint-details
                    v-if="choisenSprint"
                    :data="choisenSprint"
                    @sprintDeleted="onSprintDeleted()"
                ></sprint-details>
            </div>
            <div v-if="addNewSprint">
                <div class="my-4 text-center">
                    <h4>Create New Sprint</h4>
                </div>
                <sprint-add
                    @newSprintCreated="onNewSprintCreated"
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
            sprints:[
                {
                    id:1,
                    title:"Sprint #1",
                    description:"Sprint #1 Description",
                    tasksDone:10,
                    tasksNotDone:15
                },
                {
                    id:2,
                    title:"Sprint #2",
                    description:"Sprint #2 Description",
                    tasksDone:15,
                    tasksNotDone:3
                },
                {
                    id:3,
                    title:"Sprint #3",
                    description:"Sprint #3 Description",
                    tasksDone:7,
                    tasksNotDone:13
                },
                {
                    id:4,
                    title:"Sprint #4",
                    description:"Sprint #4 Description",
                    tasksDone:4,
                    tasksNotDone:2
                }
            ],
            sprintDetail:null,
            addNewSprint:false,
            sortByTasksDoneFactor:1,
            sortByTasksNotDoneFactor:1
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
            newSprint.id=(this.sprints.length + 1);
            this.sprints.unshift(newSprint);
            this.addNewSprint=false;
            this.sprintDetail=newSprint;
        },
        onSprintDeleted(){
            this.sprints = this.sprints.filter(sprint => {
                return this.choisenSprint.id !== sprint.id;
            })
        },
        sortByTasksDone(){
            this.sprints.sort((a,b)=>{
                let rslt;
                if(parseInt(a.tasksDone) > parseInt(b.tasksDone)){
                    rslt = -1;
                } else if (parseInt(a.tasksDone) < parseInt(b.tasksDone)){
                     rslt = 1
                } else {
                     rslt = 0;
                }
                return rslt * this.sortByTasksDoneFactor;
            });
            this.sortByTasksDoneFactor = -1 * this.sortByTasksDoneFactor;
            this.sortByTasksNotDoneFactor = 1;
        },
        sortByTasksNotDone(){
            this.sprints.sort((a,b)=>{
                let rslt;
                if(parseInt(a.tasksNotDone) > parseInt(b.tasksNotDone)){
                    rslt = -1;
                } else if (parseInt(a.tasksNotDone) < parseInt(b.tasksNotDone)){
                     rslt = 1
                } else {
                     rslt = 0;
                }
                return rslt * this.sortByTasksNotDoneFactor;
            });
            this.sortByTasksNotDoneFactor = -1 * this.sortByTasksNotDoneFactor;
            this.sortByTasksDoneFactor = 1;
        }
    }
}
</script>

<style scoped>
    .sprint-element{
        cursor:pointer;
    }
</style>