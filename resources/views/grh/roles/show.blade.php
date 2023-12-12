@extends('layouts.master')
@section('title')
Authorisation : {{ $role->name }}
@endsection
@section('content')
<div class="card">
    <div class="card-body">

            <ul class="list-group">
                <div class="row row-cols-6 m-0">
                    @if(!empty($rolePermissions))
                        @foreach($rolePermissions as $v)
                            <div class="col mb-2">
                                <li class="list-group-item py-2">
                                    {{ $v->name }}
                                </li>
                            </div>
                            {{-- <tr>
                                <td>{{ $role->name }}</td>
                                <td>{{ $v->name }}</td>
                            </tr> --}}
                        @endforeach
                    @endif
                </div>
            </ul>
    </div>
</div>



@endsection