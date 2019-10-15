import ProjectsList from './components/projects/ProjectsList.vue';
import ProjectAdd from './components/projects/ProjectAdd.vue';

export const routes = [
    { path: '/', component: ProjectsList },
    { path: '/add-project', component: ProjectAdd },
]