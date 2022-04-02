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

{!! DNS2D::getBarcodeHTML($product->kode, 'QRCODE') !!}
<span class="fw-semibold">Kode: {{ $product->kode }}</span>

<hr>
{!! DNS1D::getBarcodeHTML($product->kode, 'PHARMA') !!}
<span class="fw-semibold">Kode: {{ $product->kode }}</span>
