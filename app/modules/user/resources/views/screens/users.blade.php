@extends('dashboard::layouts.dashboardLayout')
@section('page-title', 'Users')
@section('content')
    <x-user::usercard :users=$data />
@endsection
