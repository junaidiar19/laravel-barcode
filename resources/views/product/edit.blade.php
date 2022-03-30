@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
  <div class="col-md-4">
    <div class="card">
      <div class="card-header py-2">
        <h6 class="mb-0">Edit Product</h6>
      </div>
      <div class="card-body">
        {{-- if success --}}
        @if (session('success'))
          <div class="alert alert-success" role="alert">
            {{ session('success') }}
          </div>
        @endif
        <form action="{{ route('product.update', $product->id) }}" method="post">
          @csrf
          @method('put')
          <div class="form-group mb-3">
            <label for="name">Nama</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}">
          </div>
          <div class="form-group mb-3">
            <label for="qty">Qty</label>
            <input type="number" name="qty" id="qty" class="form-control" value="{{ $product->qty }}">
          </div>
          <div class="form-group mb-3">
            <label for="category_id">Kategori</label>
            <select name="category_id" id="category_id" class="form-control">
              @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ ($category->id == $product->category_id) ? 'selected' : '' }}>{{ $category->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('product.index') }}" class="btn btn-light">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection