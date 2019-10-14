<template>
    <div>
        <app-header></app-header>
        <div class="container mb-4">
            <sprints-list></sprints-list>
        </div>
    </div>
</template>
<script>
import Header from './components/Header.vue';
import SprintsList from './components/sprints/SprintsList.vue';
export default {
    components:{
        SprintsList,
        appHeader : Header
    }
}
</script>