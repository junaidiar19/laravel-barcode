@extends('layouts.app')
@section('content')

@push('after-scripts')
<script>
  function getProduct(value) {
    let alert = $("#alert");

    $.ajax({
      url: '{{ route('product.getProduct') }}?kode=' + value,
      type: 'GET',
      success: function(result) {
        let data = result.data;

        if(result.status == 'success') {
          $('#name').text(data.name);
          $('#qty').text(data.qty);
          $('#category').text(data.category.name);

          alert.html('<i class="fas fa-check-circle me-1"></i>Produk Ditemukan');
        } else {
          $('#name').text('...');
          $('#qty').text('...');
          $('#category').text('...');
          alert.html('')
        }
      }
    });
  }
</script>
@endpush

<div class="row">
  <div class="col-md-8">
    <div class="card mb-4">
      <div class="card-body">
        <div class="form-group mb-3">
          <label class="fw-bold mb-1">Scan Barcode:</label>
          <input type="number" class="form-control" onkeyup="getProduct(this.value)" autocomplete="off" autofocus placeholder="Masukan Kode">
          <span class="text-sm text-success" id="alert"></span>
        </div>
        <div class="row">
          <div class="col-md-4">
            <p class="text-sm text-muted mb-0">Nama</p>
            <span class="fw-semibold" id="name">...</span>
          </div>
          <div class="col-md-3">
            <p class="text-sm text-muted mb-0">Qty</p>
            <span class="fw-semibold" id="qty">...</span>
          </div>
          <div class="col-md-3">
            <p class="text-sm text-muted mb-0">Kategori</p>
            <span class="fw-semibold" id="category">...</span>
          </div>
        </div>
      </div>
    </div>
    <div class="card mb-4">
      <div class="card-header py-2">
        <h6 class="mb-0">Data Product</h6>
      </div>
      <div class="card-body">
        {{-- if success --}}
        @if (session('success'))
          <div class="alert alert-success" role="alert">
            {{ session('success') }}
          </div>
        @endif
        <div class="table-responsive">
          <table class="table table-striped table-bordered" style="white-space: nowrap">
            <thead>
              <tr>
                <th width="10">#</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Qty</th>
                <th>Kategori</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($products as $product)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $product->kode }}</td>
                  <td>{{ $product->name }}</td>
                  <td>{{ $product->qty }}</td>
                  <td>{{ $product->category->name }}</td>
                  <td>
                    <form action="{{ route('product.destroy', $product->id) }}" method="post" class="d-inline">
                      @csrf
                      @method('delete')
                      <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data?')">Hapus</button>
                    </form>
                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-success">Edit</a>
                    <button data-bs-toggle="modal" data-bs-target="#show" data-title="Detail Product" data-url="{{ route('product.show', $product->id) }}" class="btn btn-primary btn-sm">Detail</button>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" align="center">-tidak ada data-</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <h6 class="mb-0">Tambah</h6>
      </div>
      <div class="card-body">
        <form action="{{ route('product.store') }}" method="post">
        @csrf
          <div class="form-group mb-3">
            <label class="fw-bold mb-1">Kode</label>
            <input type="text" name="kode" class="form-control" value="{{ $kode }}" readonly>
          </div>
          <div class="form-group mb-3">
            <label class="fw-bold mb-1">Nama</label>
            <input type="text" name="name" class="form-control" placeholder="Nama" required>
          </div>
          <div class="form-group mb-3">
            <label class="fw-bold mb-1">Qty</label>
            <input type="number" name="qty" class="form-control" placeholder="Jumlah" required>
          </div>
          <div class="form-group mb-3">
            <label class="fw-bold mb-1">Kategori</label>
            <select name="category_id" class="form-select" required>
              <option value="">Pilih Kategori</option>
              @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="d-grid">
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@include('partials.modal')
@endsection