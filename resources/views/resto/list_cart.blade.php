
<div id="cartlist"></div>

<?php
if($count == 0){    
?>
<img src="assets_resto/images/nocart.png" class="img-fluid" alt="...">
<h2 class="text-center text-success" style="font-weight: bold;">List cart tidak tersedia</h2>
<?php
}else{
?>
@php
$totalharga= 0;
@endphp
@foreach ($cart as $list)

<div class="col-sm-3 col-3 mb-2">
    <?php
         if($list->kategori == 'makanan'){
     ?>
     <img src="{{ Storage::url('public/img_makanan/').$list->gambar }}" class="img-thumbnail" alt="...">
     <?php 
         }elseif ($list->kategori == 'minuman') {
     ?>
          <img src="{{ Storage::url('public/img_minuman/').$list->gambar }}" class="img-thumbnail" alt="...">
     <?php }else{ ?>
         <img src="{{ Storage::url('public/img_cemilan/').$list->gambar }}" class="img-thumbnail" alt="...">
     <?php } ?>
 </div>
<div class="col-sm-3 col-3">
<h4>Pesanan</h4>
<p>{{ $list->nama }} (Rp. {{ $list->harga }})</p>
</div>

<div class="col-sm-3 col-3 mb-2">
<h4>QTY</h4>
<p>{{ $list->qty. ' Qty' }}</p>
</div>
<div class="col-sm-3 col-3 mb-2">
<h4>Total Harga</h4>
<p>Rp. {{ $list->total_harga }}</p>
<button class="btn btn-danger btn-small" id="hapuscart{{ $list->id }}"><i class="fas fa-trash"></i></button>
</div>
<hr>
@php
$totalharga+= $list->total_harga
@endphp

<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
$("#hapuscart{{ $list->id }}").click(function(){
    var url = 'resto/hapus_cart/'+{{ $list->id }}
    $("#cartlist").load(url);
})
})
</script>

@endforeach

<div class="col-sm-6 col-6">
<h3>Total Harga : </h3>
</div>

<div class="col-sm-6 col-6">
<h3 class="text-right text-success">Rp. {{ $totalharga }}</h3>
</div>
<hr>

<form action="{{ url('resto/act_pesanan') }}" method="post">
@csrf
@foreach ($meja as $data)
<div class="form-check form-check-inline mt-3">
    <input class="form-check-input" type="radio" name="meja" id="inlineRadio1" value="{{ $data->no_meja }}" style="width: 20px; height: 20px">
    <label class="form-check-label" for="inlineRadio1" style="font-size: 20px;">{{ $data->no_meja }}</label>
  </div>
  @endforeach
<input type="hidden" name="total_harga" value="{{ $totalharga }}">
<input type="hidden" name="kode" value="{{ session()->get('kode') }}">
<button type="submit" class="btn btn-success btn-block" style="width: 100%">Pesan Sekrang</button>
</form>

<h4 class="text-center"></h4>
<?php
}
?>