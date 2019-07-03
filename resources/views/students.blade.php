@extends('layouts.index')

@section('content')
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="card-title">
          Data Mahasiswa
        </div>
        @if(session('student_deleted'))
          <div class="alert alert-primary" role="alert">
            Mahasiswa berhasil dihapus!
          </div>
        @endif
        <a href="/students/create" class="btn btn-primary mb-3">Tambah Mahasiswa</a>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>
                No
              </th>
              <th>
                ID Mahasiswa
              </th>
              <th>
                NIM
              </th>
              <th>
                Nama
              </th>
              <th>
                Kelas
              </th>
              <th>
                Tindakan
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($students as $key => $student)
              <tr>
                <td class="py-1">
                  {{ ($students->currentpage()-1) * $students->perpage() + $loop->iteration }}
                </td>
                <td>
                  {{$student->student_id}}
                </td>
                <td>
                  {{$student->NIM}}
                </td>
                <td>
                  {{$student->name}}
                </td>
                <td>
                  {{$student->class}}
                </td>
                <td>
                <a href="/students/{{$student->id}}/edit" class="btn btn-primary">Edit Mahasiswa</a>
                <form class="d-inline" action="/students/{{$student->id}}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger">Hapus Mahasiswa</button>
                </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <div class="mt-5">
          {{$students->links()}}
        </div>
      </div>
    </div>
    
  </div>
    
@endsection
