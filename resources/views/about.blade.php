@extends('layouts.app')

@section('content')

<x-alert />

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">

        <div class="card-header">{{ $title }}</div>

        <div class="card-body">
          {{-- @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif --}}

          This is about page
        </div>
      </div>
    </div>
  </div>
</div>
@endsection