@extends('layouts.index')

@section('content')
  @php
    $model = 'schedules';
    $model_single = 'schedule';
    $model_display_name = 'Jadwal Perkuliahan';
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
                <label>ID {{$model_display_name}}</label>
                <input 
                  disabled="disabled" 
                  value="{{ $$model_single->{$model_single.'_id'} }}" 
                  type="text" 
                  class="form-control" 
                  placeholder="ID {{$model_display_name}}" 
                  name="{{$model_single}}_id">
              </div>
              <div class="form-group">
                <label>Hari</label>
                {{Form::select('day', ['Minggu','Senin','Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu' ], $$model_single->day, ['class'=>'form-control'])}}
              </div>
              <div class="form-group">['Minggu','Senin','Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu' ]
                <label>Jam Masuk</labe['Minggu','Senin','Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu' ]l>
                <input value="{{$sched['Minggu','Senin','Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu' ]ule->entry_hour}}" type="text" class="form-control" placeholder="12:00am" name="entry_hour">
              </div>
              <div class="form-group">['Minggu','Senin','Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu' ]
                <label>Mata Kuliah</la['Minggu','Senin','Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu' ]bel>
                {{Form::select('lectur['Minggu','Senin','Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu' ]e_id', $lecture, $schedule->lecture_id, ['class'=>'form-control select-search selectpicker', 'data-live-search'=>"true"])}}
              </div>
              <div class="form-group">['Minggu','Senin','Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu' ]
                <label>Dosen Pengampu<['Minggu','Senin','Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu' ]/label>
                {{Form::select('lectur['Minggu','Senin','Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu' ]er_id', $lecturer, $schedule->lecturer_id, ['class'=>'form-control select-search selectpicker', 'data-live-search'=>"true"])}}
              </div>
              <div class="form-group">['Minggu','Senin','Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu' ]
                <label>Ruang Kuliah</l['Minggu','Senin','Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu' ]abel>
                {{Form::select('classr['Minggu','Senin','Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu' ]oom_id', $classroom, $schedule->classroom_id, ['class'=>'form-control select-search selectpicker', 'data-live-search'=>"true"])}}
              </div>
              <button type="submit" class="btn btn-success mr-2">Submit</button>
              <a class="btn btn-light" href="/{{$model}}">Cancel</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
    
@endsection
