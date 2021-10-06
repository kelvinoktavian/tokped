@extends('admin.layouts.app')

@section('content')

<x-alert />

<h1>{{ $user->name }}</h1>

@endsection