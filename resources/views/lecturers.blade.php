@extends('layouts.index')

@section('content')
  @php
    $model = 'lecturers';
    $model_single = 'lecturer';
    $model_display_name = 'Dosen';
  @endphp
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="card-title">
          Data {{$model_display_name}}
        </div>
        @if(session($model_single.'_deleted'))
          <div class="alert alert-primary" role="alert">
             {{$model_display_name}} berhasil dihapus!
          </div>
        @endif
        <a href="/{{$model}}/create" class="btn btn-primary mb-3">Tambah {{$model_display_name}}</a>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>
                No
              </th>
              <th>
                ID Dosen
              </th>
              <th>
                NIP
              </th>
              <th>
                Nama
              </th>
              <th>
                Tindakan
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($$model as $key => $model_data)
              <tr>
                <td class="py-1">
                  {{ ($$model->currentpage()-1) * $$model->perpage() + $loop->iteration }}
                </td>
                <td>
                  {{$model_data->lecturer_id}}
                </td>
                <td>
                  {{$model_data->NIP}}
                </td>
                <td>
                  {{$model_data->name}}
                </td>
                <td>
                <a href="/{{$model}}/{{$model_data->id}}/edit" class="btn btn-primary">Edit {{$model_display_name}}</a>
                <form class="d-inline" action="/{{$model}}/{{$model_data->id}}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger">Hapus {{$model_display_name}}</button>
                </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <div class="mt-5">
          {{$$model->links()}}
        </div>
      </div>
    </div>
    
  </div>
    
@endsection
