<template>
    <transition name="flash" appear>
        <div 
            v-if="show"
            role="alert"
            class="alert flash-message m-5"
            :class="{
                'alert-primary': mode === 'primary',
                'alert-secondary': mode === 'secondary',
                'alert-danger': mode === 'danger',
                'alert-success': mode === 'success',
                'alert-warning': mode === 'warning',
                'alert-info': mode === 'info',
                'alert-dark': mode === 'dark',
            }"
        >
            <i v-if="flashType[mode].length" :class="flashType[mode]" class="mr-2"></i>    
            {{message}}
        </div> 
    </transition>
</template>
<script>
export default {
    data(){
        return {
            mode:'',
            message:'',
            show:false,
            flashType:{
                primary : '',
                secondary: '',
                danger : 'fa fa-exclamation',
                success : 'fa fa-check-circle',
                warning : 'fa fa-exclamation-triangle',
                info : 'fa fa-info',
                dark : ''
            }
        }
    },
    created(){
        window.event.$on('flash',({mode,message})=>{
            this.mode = mode;
            this.flash(message);
            this.hide();
        })
    },
    methods:{
        flash(message){
            this.message = message;
            this.show = true
        },
        hide(){
            setTimeout(()=>{
                this.show = false;
            },3000)
        }
    }
}
</script>
<style scoped>
    .flash-message{
        position: fixed;
        right: 0;
        bottom: 0;
        text-transform: capitalize;
    }
    .flash-enter{
        transform:translateX(300px);
        opacity:0;
    }
    .flash-leave-to{
        opacity:0
    }
    .flash-enter-active{
        transition: 1s all ease-in-out;
    }
    .flash-leave-active{
        transition: 3s all ease-in-out;
    }
</style>