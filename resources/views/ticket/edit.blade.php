@extends('dashboard')
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Edit Ticket</h1>
      </div>
      <!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item">
            <a href="#">Ticket</a>
          </li>
          <li class="breadcrumb-item active">Edit</li>
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
            <form action="{{ route('ticket.update', $ticket->id)}}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label class="font-weight-bold">Class</label>
                  <input type="text" class="form-control @error('class') is-invalid @enderror" name="class" value="{{ old('class', $ticket->class) }}" placeholder="Masukkan Nama Ticket">
                  @error('class')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="form-group col-md-6">
                  <label class="font-weight-bold">price</label>
                  <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price', $ticket->price) }}" placeholder="Masukkan price">
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
                  @foreach($movies as $movie)
                  @php
                  $isSelected = (old('id_movie', $ticket->id_movie) == $movie->id) ? 'selected' : '';
                  @endphp
                  <option value="{{ $movie->id }}" {{ $isSelected }}>{{ $movie->title }}</option>
                  @endforeach
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