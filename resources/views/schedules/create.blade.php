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
            <h4 class="card-title">Tambah {{$model_display_name}}</h4>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{Form::open(['url'=> $model, 'class'=> 'forms-sample'])}}
              @csrf
              <div class="form-group">
                <label>ID {{$model_display_name}}</label>
                <input value="{{old($model_single.'_id')}}" type="text" class="form-control" placeholder="ID {{$model_display_name}}" name="{{$model_single}}_id">
              </div>
              <div class="form-group">
                <label>Hari</label>
                {{Form::select('day', ['Minggu','Senin','Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu' ], 'Senin', ['class'=>'form-control'])}}
              </div>
              <div class="form-group">
                <label>Jam Masuk</label>
                <input value="{{old('entry_hour')}}" type="text" class="form-control" placeholder="12:00am" name="entry_hour">
              </div>
              <div class="form-group">
                <label>Mata Kuliah</label>
                {{Form::select('lecture_id', $lecture, null, ['class'=>'form-control select-search selectpicker', 'data-live-search'=>"true"])}}
              </div>
              <div class="form-group">
                <label>Dosen Pengampu</label>
                {{Form::select('lecturer_id', $lecturer, null, ['class'=>'form-control select-search selectpicker', 'data-live-search'=>"true"])}}
              </div>
              <div class="form-group">
                <label>Ruang Kuliah</label>
                {{Form::select('classroom_id', $classroom, null, ['class'=>'form-control select-search selectpicker', 'data-live-search'=>"true"])}}
              </div>
              <button type="submit" class="btn btn-success mr-2">Submit</button>
              <a class="btn btn-light" href="/{{$model}}">Cancel</a>
            </form>
          {{Form::close()}}
          </div>
        </div>
      </div>
    </div>
  </div>

    
@endsection
