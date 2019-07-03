@extends('layouts.index')

@section('content')
  @php
    $model = 'presences';
    $model_single = 'presence';
    $model_display_name = 'Presensi';
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
        <form action="/presences"  autocomplete="off">
          <div class="form-group">
            <label>Tipe Presensi</label>
            {{Form::select('type', ['student' => 'Mahasiswa', 'lecturer' => 'Dosen'], request()->type, ['class'=>'form-control select-search selectpicker', 'data-live-search'=>"true"])}}
          </div>
          <div class="form-group">
            <label>Mata Kuliah</label>
            {{Form::select('lecture_id', $lectures, request()->lecture_id, ['class'=>'form-control select-search selectpicker', 'data-live-search'=>"true"])}}
          </div>
          <div class="form-group">
            <label>Tanggal</label>
            <input type='text' class="form-control datepick" id='datetimepicker4' name="date" value="{{request()->date}}" />  
          </div>
          <button class="btn btn-primary mr-2">Pilih Materi dan Tanggal Presensi</button>
        </form>
        @if(request()->lecture_id && request()->date)
          <form class="mt-3" action="/presences/create">
            <input type="hidden" name="type" value="{{request()->type}}">
            <input type="hidden" name="lecture_id" value="{{request()->lecture_id}}">
            <input type="hidden" name="date" value="{{request()->date}}">
            <button class="btn btn-info" >Tambah {{$model_display_name}}</button>
          </form>
        @endif
        @if(request()->lecture_id && request()->date)
        <table class="table table-striped">
          <thead>
            <tr>
              <th>
                No
              </th>
              <th>
                Nama
              </th>
              <th>
                NIM/NIP
              </th>
              <th>
                Tanggal
              </th>
              <th>
                Hari
              </th>
              <th>
                Jam Masuk
              </th>
              <th>
                Jam Datang
              </th>
              <th>
                Keterangan
              </th>
              <th>
                Tindakan
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($$model as $model_data)
              <tr>
                <td class="py-1">
                  {{ ($$model->currentpage()-1) * $$model->perpage() + $loop->iteration }}
                </td>
                <td>
                  {{$model_data->name}}
                </td>
                <td>
                  {{$model_data->nim_or_nip}}
                </td>
                <td>
                  {{$model_data->date}}
                </td>
                <td>
                  {{$model_data->schedule->day_name}}
                </td>
                <td>
                  {{$model_data->schedule->entry_hour}}
                </td>
                <td>
                  {{$model_data->entry_hour}}
                </td>
                <td>
                  @php
                    $entry_hour = new Carbon\Carbon($model_data->entry_hour);
                    $class_entry_hour = new Carbon\Carbon($model_data->schedule->entry_hour);
                  @endphp
                  {{$entry_hour->isBefore($class_entry_hour) ? 'Tepat Waktu' : 'Terlambat '.$entry_hour->diffInMinutes($class_entry_hour). ' Menit'}}
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
          {{$$model->appends(['lecture_id'=> request()->lecture_id, 'date'=>request()->date])->links()}}
        </div>
      @endif
      </div>
    </div>
    
  </div>
    
@endsection
