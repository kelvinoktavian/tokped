@extends('admin.layouts.app')

@section('content')

<x-alert />

<div class="row mb-3">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header font-weight-bold">
        <h3 class="card-title">Filter</h3>
      </div>
      <div class="card-body">
        <form action="{{ route('user.index') }}" method="GET" role="search">
          <div class="form-group">
            <label for="search">User name</label>
            <input id="search" name="search" type="text" class="form-control" placeholder="Search user..."
              value="{{ request('search') }}">
          </div>

          <div class="col-6">
            <div class="form-group">
              <label for="sortBy">Sort By</label>
              <select name="sortBy" id="sortBy" class="form-control">
                <option value="">--Sort By--</option>
                <option value="usernameAsc" {{ (request('sortBy') == 'usernameAsc') ? 'selected' : '' }}>Username
                  (ASC)
                </option>
                <option value="usernameDesc" {{ (request('sortBy') == 'usernameDesc') ? 'selected' : '' }}>Username
                  (DESC)
                </option>
                <option value="latest" {{ (request('sortBy') == 'latest') ? 'selected' : '' }}>Latest</option>
                <option value="oldest" {{ (request('sortBy') == 'oldest') ? 'selected' : '' }}>Oldest</option>
              </select>
            </div>
          </div>

          <button class="btn btn-default btn-sm font-weight-bold" type="submit">
            <i class="bi bi-search"></i> Search
          </button>

          <a href="{{ route('user.index') }}">
            <button class="btn btn-danger btn-sm font-weight-bold" type="button">
              <i class="fas fa-sync-alt"></i> Reset
            </button>
          </a>

        </form>
      </div>
    </div>

  </div>
</div>

<div class="row d-flex mr-1 mb-3 justify-content-end">
  <a href="{{ route('user.create') }}" class="float-right btn btn-sm btn-primary"><i class="fas fa-plus"></i> Add
    New User</a>
</div>

@if ($users->count() != 0)
<div>
  <div class="card">

    <div class="card-header">
      <h3 class="card-title">{{ $title }} List</h3>
      <h3 class="card-title float-right">Showing {{ $users->total() }} @if($users->total() <= 1) result @else results
          @endif</h3> </div> <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th width="10px">Picture</th>
                  <th>Username</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th class="text-center">Role</th>
                  <th class="text-center">Phone</th>
                  <th class="text-center">Registration Date</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Last Active</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                <td class="text-center"><img class="img-circle img-md"
                    src="{{ asset('images/user/' . $user->image_path) }}" alt="{{ $user->name }}"></td>
                <td class="align-middle"><a href="{{ route('user.show', $user->username) }}">{{ $user->username }}</a>
                </td>
                <td class="align-middle">{{ $user->name }}</td>
                <td class="align-middle"><a href="https://mail.google.com/mail/?view=cm&fs=1&tf=1&to={{ $user->email }}"
                    target="_blank">{{ $user->email }}</a></td>
                <td class="align-middle">
                  @if($user->is_admin == 1)
                  <span class="d-block badge rounded-pill bg-warning text-dark">Admin</span>
                  @else
                  <span class="d-block badge rounded-pill bg-primary text-dark">User</span>
                  @endif
                </td>
                @if($user->phone != NULL)
                <td class="align-middle text-center">+62 {{ $user->phone }}<a target="_blank"
                    href="https://api.whatsapp.com/send?phone=+62{{ $user->phone }}"
                    class="ml-2 btn btn-whatsapp">Whatsapp
                    <i class="fab fa-whatsapp fa-lg"></i></a></td>
                @else
                <td class="align-middle text-center">No phone number found.</td>
                @endif
                <td class="align-middle text-center">{{ $user->created_at->format('d F Y') }}</td>
                <td class="align-middle text-center">
                  @if(Cache::has('is_online' . $user->id))
                  <span class="text-success">Online</span>
                  @else
                  <span class="text-secondary">Offline</span>
                  @endif
                </td>
                <td class="align-middle text-center">{{ \Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}</td>
                <td class="align-middle text-center">
                  <a class="d-inline btn btn-info" href="{{ route('user.show', $user->username) }}" title="Detail"><i
                      class="bi bi-info-square"></i></a>
                </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
    </div>

    <div class="card-footer clearfix">
      {{ $users->links() }}
    </div>
  </div>
</div>

@else
<x-no-data-card>
  No user found.
</x-no-data-card>
@endif

@endsection