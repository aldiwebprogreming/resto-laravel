@extends('layout.main', ['title' => "Data Makanan", "label" => "Data minuman"])

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="card">
          <div class="card-body">
            <!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
    Tambah minuman
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah minuman</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="post" action="{{ url('admin/act_minuman') }}" enctype="multipart/form-data">
               
                @csrf
                <div class="form-group">
                    <label>Kode</label>
                    <input type="text" class="form-control" name="kode" value="{{ $kode }}">
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="nama">
                    @error('nama')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Harga</label>
                    <input type="text" class="form-control" name="harga">
                    @error('harga')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                </div>
                <div class="form-group">
                    <label>Gambar</label>
                    <input type="file" name="gambar" class="form-control">
                    @error('gambar')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                </div>
                <div class="form-group">
                    <label for="ere">Keterangan</label>
                    <textarea name="keterangan" id="" cols="30" rows="10" class="form-control"></textarea>
                    @error('keterangan')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                </div>
           
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
        </div>
      </div>
    </div>
  </div>
              <div class="row">
                  <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Nama</th>
                          <th scope="col">Harga</th>
                          <th scope="col">Keterangan</th>
                          <th scope="col">Gambar</th>
                          <th scope="col">Opsi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($drinks as $item)
                        <tr>
                          <th scope="row">{{ $no++ }}</th>
                          <td>{{ $item->nama }}</td>
                          <td>{{ $item->harga }}</td>
                          <td>{{ $item->keterangan }}</td>
                          <td><img src="{{ Storage::url('public/img_minuman/').$item->gambar }}" alt="" style="height: 100px;"></td>
                          <td>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalhapus{{ $item->id }}">
                               <i class="fa fa-trash"></i> Hapus
                            </button>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModaledit{{ $item->id }}">
                              <i class="fas fa-pen"></i> Edit
                           </button>
                          </td>
                        </tr>

                         <!-- Modal hapus -->
                          <div class="modal fade" id="exampleModalhapus{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Pesan</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                    <h5 class="">Apakah anda ingin menghapus data ini?</h5>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <form method="post" action="{{ url('admin/hapus_drink') }}">
                                      @method('delete')
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <button type="submit" class="btn btn-primary">Yes</button>
                                    </form>
                                </div>
                              </div>
                            </div>
                          </div>

                          {{-- end modal hapus --}}

                           <!-- Modal Edit -->
                           <div class="modal fade" id="exampleModaledit{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Pesan</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" enctype="multipart/form-data" action="{{ url('admin/act_edit_drink/') }}/{{ $item->id }}">
                                      @method('put')
                                      @csrf
                                      
                                      <div class="form-group">
                                        <label>Kode</label>
                                        <input type="text" class="form-control" name="kode" value="{{ $item->kode }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" class="form-control" name="nama" value="{{ $item->nama }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Harga</label>
                                        <input type="text" class="form-control" name="harga" value="{{ $item->harga }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Gambar</label>
                                        <input type="file" name="gambar" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="ere">Keterangan</label>
                                        <textarea name="keterangan" id="" cols="30" rows="10" class="form-control">{{ $item->keterangan }}</textarea>
                                    </div>
                                    
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Edit</button>
                                </form>
                                </div>
                              </div>
                            </div>
                          </div>

                          {{-- end modal edit --}}


                        @endforeach
                      </tbody>
                    </table>
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