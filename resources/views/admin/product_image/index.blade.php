@extends('admin.layouts.app')

@section('content')

<x-alert />

@if ($product_images->count() < 5) <div class="row d-flex mr-1 mb-3 justify-content-end">
  <a href="{{ route('product_image.create', $product->slug) }}" class="float-right btn btn-sm btn-primary"><i
      class="fas fa-plus"></i></a>
  </div>
  @endif

  @if ($product_images->count() != 0)
  <div class="card">

    <div class="card-header">
      <h3 class="card-title">Product Images</h3>
    </div>

    <div class="card-body">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th width="10px" class="text-center">#</th>
            <th width="150px" class="text-center">Image</th>
            <th width="40px">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1; ?>
          @foreach ($product_images as $product_image)
          <tr>
            <td class="text-center align-middle">{{ $i++ }}</td>
            <td class="text-center"><img width="150px" class="img-thumbnail"
                src="{{ asset('images/product/' . $product_image->image_path) }}" alt="{{ $product->name }}"></td>
            <td class="align-middle text-center">
              <form id="delete-form" class="d-inline" action="{{ route('product_image.destroy', $product_image->id) }}"
                method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="product_slug" value="{{ $product->slug }}">
                <button type="submit" class="btn btn-danger show_confirm"><i class="fas fa-trash"></i></button>
              </form>

            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  @else
  <x-no-data-card>
    No image found.
  </x-no-data-card>
  @endif

  @endsection