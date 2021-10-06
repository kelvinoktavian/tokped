@extends('admin.layouts.app')

@section('content')

<x-alert />

<div class="row mb-3">
  <div class="col-md-8 mx-auto">
    <form action="{{ route('brand.index') }}" method="GET" role="search">
      <div class="input-group">
        <input name="search" type="text" class="form-control" placeholder="Search brand..."
          value="{{ request('search') }}">
        <div class="input-group-append">
          <button type="submit" class="btn btn-default" title="Search">
            <i class="fa fa-search"></i>
          </button>
          <a href="{{ route('brand.index') }}">
            <button class="btn btn-danger" type="button" title="Reset">
              <span class="fas fa-sync-alt"></span>
            </button>
          </a>
        </div>
      </div>
    </form>
  </div>
  <button class="btn">
    <a href="{{ route('brand.create') }}" class="float-right btn btn-sm btn-primary"><i class="fas fa-plus"></i> Add New
      Brand</a>
  </button>
</div>

@if ($brands->count() != 0)
<div class="card">

  <div class="card-header">
    <h3 class="card-title">{{ $title }} List</h3>
    <h3 class="card-title float-right">Showing {{ $brands->total() }} @if($brands->total() <= 1) result @else results
        @endif</h3> </div> <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th width="10px" class="text-center">#</th>
                <th width="150px" class="text-center">Image</th>
                <th width="200px">Name</th>
                <th style="width: 40px">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($brands as $brand)
              <tr>
                <td class="text-center align-middle">{{ ($no++) + 1 }}</td>
                <td class="text-center"><img width="150px" class="img-thumbnail"
                    src="{{ asset('images/brand/' . $brand->image_path) }}" alt="{{ $brand->name }}"></td>
                <td class="align-middle">{{ $brand->name }}</td>
                <td class="align-middle text-center">
                  <a class="d-inline btn btn-warning" href="{{ route('brand.edit', $brand->slug) }}" title="Edit"><i
                      class="fas fa-edit"></i></a>
                  <form id="delete-form" class="d-inline" action="{{ route('brand.destroy', $brand->slug) }}"
                    method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger show_confirm" title="Delete"><i
                        class="fas fa-trash"></i></button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
  </div>

  <div class="card-footer clearfix">
    {{ $brands->links() }}
  </div>
</div>

@else
<x-no-data-card>
  No brand found.
</x-no-data-card>
@endif

@endsection