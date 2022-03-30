<div class="table-responsive">
  <table class="table table-striped">
    <tr>
      <td>Nama</td>
      <td>:</td>
      <td>{{ $product->name }}</td>
    </tr>
    <tr>
      <td>Qty</td>
      <td>:</td>
      <td>{{ $product->qty }}</td>
    </tr>
    <tr>
      <td>Kategori</td>
      <td>:</td>
      <td>{{ $product->category->name }}</td>
    </tr>
  </table>
</div>

<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">QR Code</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Barcode</button>
  </li>
</ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
    {!! DNS2D::getBarcodeHTML($product->kode, 'QRCODE') !!}
    <span class="fw-semibold">Kode: {{ $product->kode }}</span>
  </div>
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
    {!! DNS1D::getBarcodeHTML($product->kode, 'PHARMA') !!}
    <span class="fw-semibold">Kode: {{ $product->kode }}</span>
  </div>
</div>