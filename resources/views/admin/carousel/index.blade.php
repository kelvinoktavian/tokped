@extends('admin.layouts.app')

@section('content')

<x-alert />

<div class="row mb-3">
  <div class="col-md-8 mx-auto">
  </div>
  <button class="btn">
    <a href="{{ route('carousel.create') }}" class="float-right btn btn-sm btn-primary"><i class="fas fa-plus"></i> Add
      New
      Carousel</a>
  </button>
</div>

@if ($carousels->count() != 0)
<div class="card">

  <div class="card-header">
    <h3 class="card-title">{{ $title }} List</h3>
    <h3 class="card-title float-right">Showing {{ $carousels->count() }} @if($carousels->count() <= 1) result @else
        results @endif</h3> </div> <div class="card-body">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th width="10px" class="text-center">#</th>
              <th width="150px" class="text-center">Image</th>
              <th width="200px">Title</th>
              <th width="200px">Body</th>
              <th style="width: 40px">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            @foreach ($carousels as $carousel)
            <tr>
              <td class="text-center align-middle">{{ $i++ }}</td>
              <td class="text-center"><img width="150px" class="img-thumbnail"
                  src="{{ asset('images/carousel/' . $carousel->image_path) }}" alt=""></td>
              <td class="align-middle">{{ $carousel->title }}</td>
              <td class="align-middle">{{ $carousel->body }}</td>
              <td class="align-middle text-center">
                <a class="d-inline btn btn-warning" href="{{ route('carousel.edit', $carousel->id) }}"><i
                    class="fas fa-edit" title="Edit"></i></a>
                <form id="delete-form" class="d-inline" action="{{ route('carousel.destroy', $carousel->id) }}"
                  method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger show_confirm" title="Delete"><i
                      class="fas fa-trash"></i></button>
                </form>
              </td>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
  </div>
</div>

@else
<x-no-data-card>
  No carousel found.
</x-no-data-card>
@endif

@endsection