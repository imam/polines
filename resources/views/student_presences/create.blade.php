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
            <form class="forms-sample" action="/{{$model}}" method="POST">
              @csrf
              <div class="form-group">
                <label>Tipe Presensi</label>
                {{Form::select('type', ['student' => 'Mahasiswa', 'lecturer' => 'Dosen'], request()->type, ['class'=>'form-control select-search selectpicker', 'data-live-search'=>"true"])}}
              </div>
              <div class="form-group">
                <label>Tanggal</label>
                <input type='text' class="form-control datepick" id='datetimepicker4' name="date" value="{{request()->date}}" autocomplete="off" />  
              </div>
              <div class="form-group">
                <label>ID Jadwal</label>
                <input value="{{old('schedule_id')}}" type="text" class="form-control" placeholder="ID Jadwal" name="schedule_id">
              </div>
              <div class="form-group">
                <label>NIM atau NIP</label>
                <input value="{{old('nim_or_nip')}}" type="text" class="form-control" placeholder="NIM Atau NIP" name="nim_or_nip">
              </div>
              <div class="form-group">
                <label>Jam Masuk</label>
                <input value="{{old('entry_hour')}}" type="text" class="form-control" placeholder="12:00am" name="entry_hour">
              </div>
              <button type="submit" class="btn btn-success mr-2">Submit</button>
              <a class="btn btn-light" href="/student-presences">Cancel</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
    
@endsection
