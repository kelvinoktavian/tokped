@extends('admin.layouts.app')

@section('content')
<div class="row">
  <div class="col-md-8 col-lg-7">
    <div class="widget-user-header bg-dark p-4">
      <div class="row">
        <div class="col-md-3">
          <div class="widget-user-image">
            <img width="100px" class="img-circle mb-2" src="{{ asset('images/user/' . $user->image_path) }}"
              alt="User Avatar">
          </div>
        </div>
        <div class="col-md-9 d-flex align-items-center">
          <a href="" class="btn btn-sm btn-secondary">Edit Profile</a>
        </div>
      </div>
      <h3 class="widget-user-username mb-3">{{ $user->name }}</h3>
      <h5 class="widget-user-desc">{{ $user->email }}</h5>
      <h5 class="widget-user-desc">{{ $user->phone }}</h5>
    </div>
  </div>
</div>
@endsection