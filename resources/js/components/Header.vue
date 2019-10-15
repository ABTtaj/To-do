<template>
    <div class="align-items-center bg-secondary d-flex justify-content-between p-3 text-white">
        <router-link tag="div" to="/" class="nav-title-item h2 m-0">To Do</router-link>
        <div class="d-flex">
            <router-link tag="div" to="/" class="nav-link-item">
                Projects
            </router-link>
            <router-link tag="div" to="/add-project" class="mx-3 nav-link-item">
                Add New Project
            </router-link>
        </div>
    </div>
</template>
<style scoped>
    .nav-title-item{
        cursor:pointer;
        padding:10px;
    }
    .nav-link-item{
        cursor:pointer;
        padding:10px;
    }
    .nav-link-item:hover{
        background-color:rgba(0,0,0,0.3);
    }
</style>