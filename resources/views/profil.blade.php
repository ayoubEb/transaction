@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-body p-2">
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <table class="table table-bordered table-sm m-0">
                        <tbody>
                            <tr>
                                <th class="bg-light">Name</th>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Email</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Rôle</th>
                                <td>{{ $user->role }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Statut</th>
                                <td>{{ $user->statut }}</td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection