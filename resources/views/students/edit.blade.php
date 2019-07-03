@extends('layouts.index')

@section('content')
  <div class="d-flex align-items-stretch grid-margin">
    <div class="row flex-grow">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Edit Mahasiswa</h4>
            @if(session('student_added'))
              <div class="alert alert-primary" role="alert">
                Mahasiswa berhasil ditambahkan!
              </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
              <form class="forms-sample" action="/students/{{$student->id}}" method="POST">
              @csrf
              @method('PUT')
              <div class="form-group">
                <label>ID Mahasiswa</label>
                <input disabled="disabled" value="{{$student->student_id}}" type="text" class="form-control" placeholder="ID Mahasiswa" name="student_id">
              </div>
              <div class="form-group">
                <label>NIM</label>
                <input disabled="disabled" value="{{$student->NIM}}" type="text" class="form-control" placeholder="NIM" name="NIM">
              </div>
              <div class="form-group">
                <label>Nama</label>
                <input value="{{$student->name}}"type="text" class="form-control" placeholder="Nama" name="name">
              </div>
              <div class="form-group">
                <label>Kelas</label>
                <input value="{{$student->class}}" type="text" class="form-control" placeholder="Kelas" name="class">
              </div>
              <button type="submit" class="btn btn-success mr-2">Submit</button>
              <a class="btn btn-light" href="/students">Cancel</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
    
@endsection