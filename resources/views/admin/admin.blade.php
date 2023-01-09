@extends('layout.main', ['title' => "Data Admin", "label" => "Data Admin"])

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="card">
          <div class="card-body">
            <!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
    Tambah Admin
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="post" action="{{ url('admin/add_admin') }}">
               
                @csrf
                <div class="form-group">
                    <label>Kode</label>
                    <input type="text" class="form-control" name="kode" value="{{ $kode }}">
                </div>
                <div class="form-group">
                    <label>Usrname</label>
                    <input type="text" class="form-control" name="username">
                    @error('username')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="text" class="form-control" name="pass">
                    @error('pass')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select class="form-control" name="role">
                        <option value="">-- Pilih Role --</option>
                        <option value="Admin">Admin</option>
                        
                    </select>
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
                          <th scope="col">Username</th>
                          <th scope="col">Role</th>
                          <th scope="col">Date</th>
                          <th scope="col">Opsi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($admin as $item)
                        <tr>
                          <th scope="row">{{ $no++ }}</th>
                          <td>{{ $item->username }}</td>
                          <td>{{ $item->role }}</td>
                        <td>{{ $item->created_at }}</td>
                          <td>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalhapus{{ $item->id }}">
                               <i class="fa fa-trash"></i> Hapus
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
                                    <form method="post" action="{{ url('admin/hapus_admin') }}">
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