<template>
    <div>
        <div class="alert alert-success" v-if="showSuccess">             
            <button type="button" class="close-btn" v-on:click="showSuccess=false">&times;</button>
            <strong>{{ successMessage }}</strong>
        </div>
        <show-Shift :user="this.user" @shift-End="shiftEnd" @shift-Start="shiftStart"></show-Shift>
    </div>              
</template>

<script type="text/javascript">    
    import showShift from './showShift.vue';
    import CountdownTimer from './Timer.vue';

    export default {
        components: {
            'show-Shift': showShift, 
            CountdownTimer,
        }, 
        data: function(){
            return { 
                user: {
                    email:"",
                    id:"",
                    name:"",
                    type:"", 
                    last_shift_start:"",  
                    last_shift_end:"",  
                    shift_active:"", 
                },
                successMessage: "",
                showSuccess: false
            }
        },
        methods: {
           /* getInformationFromLoggedUser() {
                //this.user = this.$store.state.user;
                //console.log(this.user);
            },*/
            shiftEnd: function(){
                this.currentUser = null;
	            this.showSuccess = true;
                this.successMessage = 'Shift Ended';
            }, 
            shiftStart: function(){
                this.currentUser = null;
	            this.showSuccess = true;
                this.successMessage = 'Shift Started';
            },   
            getUsers: function(){
	            axios.get('api/users')
	                .then(response=>{this.users = response.data;
                    });			
                },       

        },
        mounted() {
            //this.getInformationFromLoggedUser();
            this.getUsers();
        }     
    }
</script>