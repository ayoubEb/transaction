@extends('layouts.master')
@section('content')
<div class="card">
    <div class="card-body">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
        </ul>
        </div>
        @endif
        {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="col">
                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                </div>
            </div>
        </div>
        <div class="row row-cols-5">
            <h6 class="text-center w-100 my-4">Permission</h6>
            @foreach($permission as $value)
                <div class="col mb-3">
                    
                    {{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                    <label for="" class="form-label">{{ $value->name }}</label>
                </div>
            @endforeach
        </div>
        <div class="row row-cols-2">
            <div class="col">
                <a href="{{ route('roles.index') }}" class="btn btn-sm btn-info">Retour</a>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-sm btn-primary float-end">Enregistrer</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>






@endsection
