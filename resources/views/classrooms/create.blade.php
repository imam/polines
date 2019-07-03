@extends('layouts.index')

@section('content')
  @php
    $model = 'classrooms';
    $model_single = 'classroom';
    $model_display_name = 'Ruang Kuliah';
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
                <label>ID {{$model_display_name}}</label>
                <input value="{{old($model_single.'_id')}}" type="text" class="form-control" placeholder="ID {{$model_display_name}}" name="{{$model_single}}_id">
              </div>
              <div class="form-group">
                <label>Nama</label>
                <input value="{{old('name')}}" type="text" class="form-control" placeholder="Nama" name="name">
              </div>
              <div class="form-group">
                <label>Lokasi</label>
                <input value="{{old('location')}}" type="text" class="form-control" placeholder="Lokasi" name="location">
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
