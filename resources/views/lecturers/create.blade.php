@extends('layouts.index')

@section('content')
  <div class="d-flex align-items-stretch grid-margin">
    <div class="row flex-grow">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Tambah Dosen</h4>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="forms-sample" action="/lecturers" method="POST">
              @csrf
              <div class="form-group">
                <label>ID Dosen</label>
                <input value="{{old('lecturer_id')}}" type="text" class="form-control" placeholder="ID Dosen" name="lecturer_id">
              </div>
              <div class="form-group">
                <label>NIP</label>
                <input value="{{old('NIP')}}" type="text" class="form-control" placeholder="NIP" name="NIP">
              </div>
              <div class="form-group">
                <label>Nama</label>
                <input value="{{old('name')}}" type="text" class="form-control" placeholder="Nama" name="name">
              </div>
              <button type="submit" class="btn btn-success mr-2">Submit</button>
              <a class="btn btn-light" href="/lecturers">Cancel</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
    
@endsection