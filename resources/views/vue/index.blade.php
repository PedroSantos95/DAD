@extends('master')

@section('title', 'Vue.js App')

@section('content')

          <router-link to="/items">Menu</router-link> -           
          <router-link to="/users">Users</router-link> -
          <router-link to="/orders">Orders</router-link>

          <router-view> </router-view>

@endsection
@section('pagescript')
<script src="js/vue.js"></script>
@stop 