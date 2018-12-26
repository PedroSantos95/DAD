<template>
    <table class="table table-striped" v-if="user.shift_active === 1">     
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Username</th>
            <th>Shift-Start</th>
            <th>Time-Passed</th>
            <th>Action</th>
        </tr>
        <tr v-for="(user, index) in users"  :key="user.id">
            <td>{{user.id}}</td>
            <td>{{user.name}}</td>
            <td>{{user.username}}</td>
            <td>{{user.last_shift_start}}</td>
            <td><CountdownTimer :date="(user.last_shift_start)"></CountdownTimer></td>
            <td>
                <div class="form-group">
                    <a id="buttonLeave" class="btn btn-danger" v-on:click.prevent="endShift()">End Shift</a>
                </div>
            </td>
        </tr>
    </table>
 
    <table class="table table-striped" v-else>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Username</th>
            <th>Last-Shift-End</th>
            <th>Time-Passed</th>
            <th>Action</th>
        </tr>
        <tr v-for="(user, index) in users"  :key="user.id">
            <td>{{user.id}}</td>
            <td>{{user.name}}</td>
            <td>{{user.username}}</td>
            <td>{{user.last_shift_end}}</td>
            <td><CountdownTimer :date="(user.last_shift_end)"></CountdownTimer></td>
            <td>
                <div class="form-group">
                    <a id="buttonStart" class="btn btn-primary" v-on:click.prevent="startShift(user.id)">Start Shift</a>
                </div>
            </td>
        </tr>
    </table>
</template>
<script type="text/javascript">
    import CountdownTimer from './Timer.vue';
    import axios from 'axios';
    export default{
        props: ['user'],   
        components: {  
            CountdownTimer,
        },
       
        data: function(){
            return {      
                users: [],
            };
        },
 
        methods: {
            endShift: function(){
                //var now = new Date().format('dd-m-yy');
                //this.user.last_shift_end = now+"";
                axios.post('api/shiftEnd/'+this.user.id, this.user)
                    .then(response=>{
                        console.log(this.user.last_shift_end);
                        // Copy object properties from response.data.data to this.user
                        // without creating a new reference
                        this.getUsers();
                        Object.assign(this.user, response.data.data);
                        this.$emit('shift-End', this.user);
                    });
            },
            getUsers: function(){
                axios.get('api/users')
                    .then(response=>{this.users = response.data;
                        console.log(response.data)
                    });
            },
            startShift: function(id) {
                //this.user.last_shift_start= new Date();
                //this.user.shift_active= 1;
                axios.post('api/shiftStart/' + id, this.user)
                    .then(response=>{
                        this.getUsers();
                        Object.assign(this.user, response.data.data);
                        this.$emit('shift-Start', this.user);
                    })      
                    .catch(error => {
                        console.log(error)
                });
            }
        },
        mounted() {
            this.getUsers();
        }
    }
</script>
 
<style scoped> 
.label{
    color: red,
}
h2 {
  text-align: center;
}
.btn-danger .btn{
    text-align: center;
}
#buttonLeave{
    color: white !important;
}
caption {
    caption-side: top;
    align-content: center;
    align-items: center;
    text-align: center;
    font-size: 30px;
}
</style>