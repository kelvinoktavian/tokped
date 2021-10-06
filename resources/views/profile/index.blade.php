@extends('layouts.app')

@section('content')

<x-alert />

<div class="flex justify-center">
  <h4 class="pb-4">My {{ $title }}</h4>

  <div class="card p-4">
    <div class="card-body">
      <form action="{{ route('profile.update', $user->username) }}" method="POST" enctype="multipart/form-data">

        @csrf
        @method('PATCH')

        <div class="d-flex align-items-start py-3 border-bottom">

          <div class="form-group">
            <label for="image_path">Profle Picture</label>

            <div class="d-flex align-items-end">
              <div class="image-cropper">
                <img src="{{ asset('images/user/' . $user->image_path) }}" width="200px" id="output"
                  class="profile-picture img-circle img-lg" />
              </div>

              <div class="input-group ml-3">
                <div class="custom-file">
                  <input type="file" accept="image/*" onchange="loadFile(event)" name="image_path" type="file"
                    class="custom-file-input" id="image_path" value="{{ old('image_path') }}">
                  <label class="custom-file-label" for="image_path">{{ $user->image_path }}</label>
                </div>
              </div>
            </div>

            <small class="my-2 d-block">File size: maximum <span class="font-weight-bold">2048 kilobytes</span>. Allowed
              file extensions: <span class="font-weight-bold">.jpeg
                .png
                .jpg
                .gif
                .svg</span></small>

            @error('image_path')
            <small class="text-danger"><i class="bi bi-exclamation-circle"></i> {{ $message }}</small>
            @enderror
          </div>
        </div>

        <div class="mt-2">
          <div class="row my-2">

            <div class="col-md-6">
              <label for="name">Full Name</label>
              <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                placeholder="Your name" value="{{ old('name') ?? $user->name }}" required>
              @error('name')
              <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>

            <div class="col-md-6">
              <label for="username">Username</label>
              <input id="username" name="username" type="text"
                class="form-control @error('username') is-invalid @enderror" placeholder="Your username"
                value="{{ old('username') ?? $user->username }}" required>
              @error('username')
              <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>

          </div>

          <div class="row my-2">
            <div class="col-md-6">
              <label>Email</label>
              <input type="email" class="form-control" value="{{ $user->email }}" disabled>
            </div>

            <div class="col-md-6">
              <label for="phone">Phone</label>
              <div class="input-group mb-3">
                <span class="input-group-text">+62</span>
                <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror"
                  value="{{ old('phone') ?? $user->phone }}" placeholder="Phone number" required>
              </div>
              @error('phone')
              <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
          </div>

          <div class="mt-3">
            <button type="submit" class="btn btn-dark btn-custom-primary">Save</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection