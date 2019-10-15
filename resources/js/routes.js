import ProjectsList from './components/projects/ProjectsList.vue';
import ProjectAdd from './components/projects/ProjectAdd.vue';
import SprintsList from './components/sprints/SprintsList.vue';
import TasksList from './components/tasks/TasksList.vue';

export const routes = [
    { path: '/', component: ProjectsList },
    { path: '/add-project', component: ProjectAdd },
    { path: '/projects/:project_id/sprints', component: SprintsList },
    { path: '/sprints/:sprint_id/tasks', component: TasksList },
]