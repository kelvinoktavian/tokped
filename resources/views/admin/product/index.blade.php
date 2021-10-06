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
        <form action="{{ route('product.index') }}" method="GET" role="search">
          <div class="form-group">
            <label for="search">Product Name</label>
            <input id="search" name="search" type="text" class="form-control" placeholder="Search product..."
              value="{{ request('search') }}">
          </div>

          <div class="row">
            <div class="col-4">
              <div class="form-group">
                <label for="brand">Brand</label>
                <select name="brand" id="brand" class="form-control">
                  <option value="">--Choose Brand--</option>
                  @if ($brands->count() != 0)
                  @foreach($brands as $brand)
                  <option value="{{ $brand->id }}" {{ ($brand->id == request('brand')) ? 'selected' : '' }}>
                    {{ $brand->name }}
                  </option>
                  @endforeach
                  @endif
                </select>
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label for="category">Category</label>
                <select name="category" id="category" class="form-control">
                  <option value="">--Choose Category--</option>
                  @if ($categories->count() != 0)
                  @foreach($categories as $category)
                  <option value="{{ $category->id }}" {{ ($category->id == request('category')) ? 'selected' : '' }}>
                    {{ $category->name }}
                  </option>
                  @endforeach
                  @endif
                </select>
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label for="sortBy">Sort By</label>
                <select name="sortBy" id="sortBy" class="form-control">
                  <option value="">--Sort By--</option>
                  <option value="latest" {{ (request('sortBy') == 'latest') ? 'selected' : '' }}>Latest</option>
                  <option value="highestPrice" {{ (request('sortBy') == 'highestPrice') ? 'selected' : '' }}>Highest
                    Price
                  </option>
                  <option value="lowestPrice" {{ (request('sortBy') == 'lowestPrice') ? 'selected' : '' }}>Lowest Price
                  </option>
                  <option value="highestStock" {{ (request('sortBy') == 'highestStock') ? 'selected' : '' }}>Highest
                    Stock
                  </option>
                  <option value="lowestStock" {{ (request('sortBy') == 'lowestStock') ? 'selected' : '' }}>Lowest Stock
                  </option>
                  <option value="bestSeller" {{ (request('sortBy') == 'bestSeller') ? 'selected' : '' }}>Best Seller
                  </option>
                </select>
              </div>
            </div>
          </div>

          <button class="btn btn-default btn-sm font-weight-bold" type="submit">
            <i class="bi bi-search"></i> Search
          </button>

          <a href="{{ route('product.index') }}">
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
  <a href="{{ route('product.create') }}" class="float-right btn btn-sm btn-primary"><i class="fas fa-plus"></i> Add New
    Product</a>
</div>

@if ($products->count() != 0)
<div class="card">

  <div class="card-header">
    <h3 class="card-title">{{ $title }} List</h3>
    <h3 class="card-title float-right">Showing {{ $products->total() }} @if($products->total() <= 1) result @else
        results @endif</h3> </div> <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th width="10px" class="text-center">#</th>
                <th width="150px" class="text-center">Image</th>
                <th>Category</th>
                <th>Name</th>
                <th>Price</th>
                <th class="text-center">Stock</th>
                <th class="text-center">Sold</th>
                <th style="width: 300px">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($products as $product)
              <tr class="@if($product->qty == 0) table-danger @endif">
                <td class="text-center align-middle">{{ ($no++) + 1 }}</td>
                <td class="text-center"><img width="150px" class="img-thumbnail"
                    src="{{ asset('images/product/' . $product->image_path) }}" alt="{{ $product->name }}"></td>
                <td class="align-middle">{{ $product->category->name }}</td>
                <td class="align-middle"><a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a>
                </td>
                <td class="align-middle">Rp. {{ number_format($product->price) }}</td>
                <td class="text-center align-middle">{{ number_format($product->qty) }}</td>
                <td class="text-center align-middle">{{ $product->sold }}</td>
                <td class="align-middle text-center">
                  <a class="d-inline btn btn-info" href="{{ route('product.show', $product->slug) }}" title="Detail"><i
                      class="bi bi-info-square"></i></a>
                  <a class="d-inline btn btn-warning" href="{{ route('product.edit', $product->slug) }}" title="Edit"><i
                      class="fas fa-edit"></i></a>

                  <form id="delete-form" class="d-inline" action="{{ route('product.destroy', $product->slug) }}"
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
    {{ $products->links() }}
  </div>
</div>

@else
<x-no-data-card>
  No product found.
</x-no-data-card>
@endif

@endsection