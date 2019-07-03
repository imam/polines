@extends('layouts.index')

@section('content')
  @php
    $model = 'lectures';
    $model_single = 'lecture';
    $model_display_name = 'Mata Kuliah';
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
            <form class="forms-sample" action="/lectures" method="POST">
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
                <label>SKS</label>
                <input value="{{old('sks')}}" type="text" class="form-control" placeholder="SKS" name="sks">
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
