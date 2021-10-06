@extends('admin.layouts.app')

@section('content')

<x-alert />

<div class="row">
  <div class="col-lg-6 col-md-8">
    <div class="card">

      <div class="card-header">
        <h3 class="card-title">{{ $title }}</h3>
        <x-back-button />
      </div>

      <div class="card-body">

        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="form-group">
            <label for="name">Name
              <x-asterisk-required-symbol /></label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
              value="{{ old('name') }}" placeholder="Name" autofocus>
            @error('name')
            <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          <div class="form-group">
            <label for="email">Email
              <x-asterisk-required-symbol /></label>
            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
              value="{{ old('email') }}" placeholder="Email">
            @error('email')
            <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          <div class="form-group">
            <label for="username">Username
              <x-asterisk-required-symbol /></label>
            <input type="text" name="username" id="username"
              class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}"
              placeholder="Username">
            @error('username')
            <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          <div class="form-group">
            <label for="password">Password
              <x-asterisk-required-symbol /></label>
            <input type="password" name="password" id="password"
              class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}"
              placeholder="Password">
            @error('password')
            <small class="text-danger">{{ $message }}</small>
            @enderror

            <div class="form-check mt-2">
              <input class="form-check-input" onclick="showPassword()" type="checkbox" id="show-password">
              <label class="form-check-label" for="show-password">
                <small>Show Password</small>
              </label>
            </div>
          </div>

          <div class="form-group">
            <label for="is_admin">Role
              <x-asterisk-required-symbol /></label>
            <select name="is_admin" id="is_admin" class="form-control @error('is_admin') is-invalid @enderror">
              <option value="1">Admin</option>
              <option value="0">User</option>
            </select>
            @error('is_admin')
            <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          <div class="form-group">
            <label for="image_path">Profile Image</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" accept="image/*" onchange="loadFile(event)" name="image_path" type="file"
                  class="custom-file-input @error('image_path') is-invalid @enderror" id="image_path"
                  value="{{ old('image_path') }}">
                <label class="custom-file-label" for="image_path">Choose file</label>
              </div>
            </div>
            <img class="my-3" width="200px" id="output" />
            @error('image_path')
            <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          <div class="form-group float-right">
            <x-submit-button>
              Add
            </x-submit-button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
@endsection