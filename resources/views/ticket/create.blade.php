@extends('dashboard')
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Tambah Ticket</h1>
      </div>
      <!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item">
            <a href="#">Ticket</a>
          </li>
          <li class="breadcrumb-item active">Create</li>
        </ol>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <form action="{{ route('ticket.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label class="font-weight-bold">Class</label>
                  <input type="text" class="form-control @error('class') is-invalid @enderror" name="class" value="{{ old('class') }}" placeholder="Masukkan Nama Ticket">
                  @error('class')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="form-group col-md-6">
                  <label class="font-weight-bold">price</label>
                  <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" placeholder="Masukkan price">
                  @error('price')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
              <div>
                <label class="font-weight-bold">Movie</label>
                <select id="inputState" class="form-select" name="id_movie">
                  <option selected value="">Pilih Movie</option>
                  @forelse($movie as $item)
                  @php
                  $isSelected = (old('movie') == $item->id) ? 'selected' : '';
                  @endphp
                  <option value="{{ $item->id }}" {{ $isSelected }}>{{ $item->title }}</option>
                  @empty
                  <option disabled>Data Movies belum tersedia</option>
                  @endforelse
                </select>
              </div>

              <br>
              <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
            </form>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</div>
@endsection