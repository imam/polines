@extends('layouts.index')

@section('content')
  @php
    $model = 'lecturers';
    $model_single = 'lecturer';
    $model_display_name = 'Dosen';
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
                <label>NIP</label>
                <input disabled="disabled" value="{{$lecturer->NIP}}" type="text" class="form-control" placeholder="NIP" name="NIP">
              </div>
              <div class="form-group">
                <label>Nama</label>
                <input value="{{$lecturer->name}}"type="text" class="form-control" placeholder="Nama" name="name">
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