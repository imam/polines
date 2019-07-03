@extends('layouts.index')

@section('content')
  @php
    $model = 'presences';
    $model_single = 'presence';
    $model_display_name = 'Presensi';
  @endphp
  <div class="d-flex align-items-stretch grid-margin">
    <div class="row flex-grow">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Edit {{$model_display_name}}</h4>
            @if(session($model_single.'_added'))
              <div class="alert alert-primary" role="alert">
                {{$model_display_name}} berhasil ditambahkan!
              </div>
            @endif
            @if(session($model_single.'_edited'))
              <div class="alert alert-primary" role="alert">
                {{$model_display_name}} berhasil diedit!
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
              <form class="forms-sample" action="/{{$model}}/{{$$model_single->id}}" method="POST">
              @csrf
              @method('PUT')
              <div class="form-group">
                <label>Tipe Presensi</label>
                {{Form::select('type', ['student' => 'Mahasiswa', 'lecturer' => 'Dosen'], $presence->type, ['class'=>'form-control select-search selectpicker', 'data-live-search'=>"true"])}}
              </div>
              <div class="form-group">
                <label>Tanggal</label>
                <input type='text' class="form-control datepick" id='datetimepicker4' name="date" value="{{$presence->date}}" autocomplete="off" />  
              </div>
              <div class="form-group">
                <label>ID Jadwal</label>
                <input value="{{$presence->schedule->schedule_id}}" type="text" class="form-control" placeholder="ID Jadwal" name="schedule_id">
              </div>
              <div class="form-group">
                <label>NIM atau NIP</label>
                <input value="{{$presence->nim_or_nip}}" type="text" class="form-control" placeholder="NIM Atau NIP" name="nim_or_nip">
              </div>
              <div class="form-group">
                <label>Jam Masuk</label>
                <input value="{{$presence->entry_hour}}" type="text" class="form-control" placeholder="12:00am" name="entry_hour">
              </div>
              <button type="submit" class="btn btn-success mr-2">Submit</button>
            </form>
              <form id="cancel-form" class="mt-3" action="/presences">
                <input type="hidden" name="type" value="{{$presence->student_id ? 'student' : 'lecturer'}}">
                <input type="hidden" name="lecture_id" value="{{$presence->schedule->lecture_id}}">
                <input type="hidden" name="date" value="{{$presence->date}}">
                <button form="cancel-form" class="btn btn-light" >Cancel</button>
              </form>
          </div>
        </div>
      </div>
    </div>
  </div>
    
@endsection
