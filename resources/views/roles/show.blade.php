@extends('layouts.master')
@section('content')
<div class="card">
    <div class="card-header bg-warning">
        <div class="card-title mb-2 fs-5" style="color:black">
            Rôle : {{ $role->name }}
        </div>
        <div class="card-title-desc m-0">
            <ul class="list-unstyled d-flex m-0">
                <li>
                    <a href="{{ route('admin') }}" style="color:black">
                       <i class="mdi mdi-home"></i>
                       Acceuil
                    </a>

                <li class="mx-2" style="color:black">
                   <i class="mdi mdi-chevron-double-right"></i> 
                </li>
                <li>
                    <a href="{{ route('roles.index') }}" style="color:black">
                        Liste du rôles
                    </a>
                </li>
                <li class="mx-2" style="color:black">
                   <i class="mdi mdi-chevron-double-right"></i> 
                </li>
                <li>
                    <a href="{{ route('roles.show',$role->id) }}" style="color:black">
                        Rôle : {{ $role->name }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped table-sm mb-0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Permission</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($rolePermissions))
                @foreach($rolePermissions as $v)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>{{ $v->name }}</td>
                    </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

@endsection