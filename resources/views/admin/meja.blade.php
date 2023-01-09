@extends('layout.main', ['title' => "Data Makanan", "label" => "Data cemilan"])

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="card">
          <div class="card-body">
            <!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
    Tambah meja
  </button>

  <hr>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Meja</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="post" action="{{ url('admin/act_meja') }}">
               
                @csrf
                <div class="form-group">
                    <label>Kode</label>
                    <input type="text" class="form-control" name="kode" value="{{ $kode }}" readonly>
                </div>
                <div class="form-group">
                    <label>Nomor Meja</label>
                 @foreach ($meja as $item)
                 @endforeach
                    <input type="number" class="form-control" name="no_meja" value="{{ $item->no_meja + 1}}" readonly>
                     @error('no_meja')
                        <small class="text-danger">{{ $message }}</small>
                     @enderror
                </div
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
        </div>
      </div>
    </div>
  </div>
          </div>
              <div class="row">
                @foreach ($meja as $item)
                    
                <div class="col-sm-3">
                    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                        <div class="card-header"><h4> MEJA - {{ $item->no_meja }} </h4></div>
                        <div class="card-body">
                          <h5 class="card-title">Pesanan</h5>
                        

                        </div>
                    </div>
                </div>

                @endforeach
                     
              </div>
            
          </div>
      </div>
    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
  </div>

 
  
@endsection