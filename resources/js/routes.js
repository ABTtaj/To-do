import ProjectsList from './components/projects/ProjectsList.vue';
import ProjectAdd from './components/projects/ProjectAdd.vue';
import SprintsList from './components/sprints/SprintsList.vue';
import SprintAdd from './components/sprints/SprintAdd.vue';
import TasksList from './components/tasks/TasksList.vue';

export const routes = [
    { path: '/', name:'projects_list',component: ProjectsList },
    { path: '/projects', component: ProjectsList },
    { path: '/projects/create', component: ProjectAdd },
    { path: '/projects/:project_id/edit', component: ProjectAdd},
    { path: '/projects/:project_id/sprints',name:'project_details', component: SprintsList },
    { path: '/sprints/:sprint_id/tasks', component: TasksList },
    { path: '/projects/:project_id/sprints/:sprint_id/edit', component: SprintAdd },
]