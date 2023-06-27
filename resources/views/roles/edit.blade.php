@extends('layouts.master')
@section('content')
<div class="card">

    <div class="card-body p-2">
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
        {!! Form::model($role, ['method' => 'PATCH','route' => ['role.update', $role->id]]) !!}
        <div class="row justify-content-center mb-4">
            <div class="col-md-6">
                <div class="row align-items-center">
                    <label class="form-label col-md-2">Name : </label>
                    <div class="col">
                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-cols-5">
            @foreach($permission as $value)
                <div class="col mb-2">
                    {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                    {{ $value->name }}
                </div>
            @endforeach

        </div>
        <div class="row row-cols-2 justify-content-between">
            <div class="col">
                <a href="{{ route('role.index') }}" class="btn btn-sm btn-info">Retour</a>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary btn-sm float-end">Modifier</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>


@endsection
