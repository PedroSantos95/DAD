@extends('master')

@section('title', 'Vue.js App')

@section('content')

<nav class="navbar navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Restaurant Management</a>
          <router-link to="/items">Menu</router-link>            
          <router-link to="/users">Users</router-link>
          <router-link to="/orders">Orders</router-link>
          <router-link to="/meals">Meals</router-link>
          <router-link to="/profile">Profile</router-link>
          <router-link to="/login">Login</router-link>
          <router-link to="/logout">Logout</router-link>
          <router-link to="/invoices">Invoices</router-link>
          <router-link to="/shift">Shift</router-link>
          <router-link to="/restaurantTables">Tables</router-link>
          <router-link to="/changePass">Change-Pass</router-link>
    </ul>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
  </div>
</nav>
<router-view> </router-view>

@endsection
@section('pagescript')
<script src="js/vue.js"></script>
@stop 