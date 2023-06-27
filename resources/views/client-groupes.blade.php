@extends('layouts.master')
@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
      <h4 class="mb-3 mb-md-0">Liste du groupes client</h4>
    </div>
    <div class="d-flex align-items-center flex-wrap text-nowrap">

        @can("client-create")
            <button type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0 py-1 px-3" data-bs-toggle="modal" data-bs-target="#add">
                Ajouter
            </button>
        @endcan
    </div>
</div>
@endsection