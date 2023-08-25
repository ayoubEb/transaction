










@extends('layouts.master')
@section('title')
    Liste des catégories
@endsection
@section('content')
    @include('sweetalert::alert')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-1">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Acceuil</a></li>
          <li class="breadcrumb-item active" aria-current="page">Liste des catégories</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body p-2">
            <div class="d-flex justify-content-evenly">
                @can('categorie-create')
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addCategorie">
                        <span class="mdi mdi-plus-circle-outline align-middle"></span>
                        <span>Ajouter une catégorie</span>
                    </button>
                @endcan
                @can('sousCategorie-create')
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addSous">
                        <span class="mdi mdi-plus-circle-outline align-middle"></span>
                        <span>Ajouter une sous catégorie</span>
                    </button>
                @endcan

            </div>
            <div class="table-responsive">
                <table class="table table-bordered mb-0 table-sm datatable">
                    <thead>
                        <tr class="bg-info">
                            <th class="text-white">Nom</th>
                            <th class="text-white">description</th>
                            <th class="text-white">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $categorie)
                            <tr>
                                <td class="align-middle">
                                    @can('categorie-show')
                                        <button class="accordion-button p-0 collapsed fw-bolder"  type="button"  data-bs-toggle="collapse"  data-bs-toggle="collapse" data-bs-target="#sous{{$categorie->id}}" aria-expanded="false">
                                            <span class="mdi mdi-plus-circle align-middle text-dark me-1 mdi-18px"></span>
                                            <span class="align-middle">
                                                {{ $categorie->nom }}
                                            </span>
                                        </button>
                                    @endcan
                                </td>
                                <td class="align-middle">{{ Str::limit($categorie->description, 30, '...') ?? 'Aucun description' }}</td>
                                <td class="align-middle">
                                    @can('categorie-edit')
                                        <button type="button" class="btn p-0 bg-transparent border-0 text-primary" data-bs-toggle="modal" data-bs-target="#edit{{ $categorie->id }}">
                                            <i class="ti-pencil" style="font-size: 0.90rem;"></i>
                                        </button>
                                    @endcan

                                    @can('categorie-destroy')
                                        <button type="button" class="btn p-0 bg-transparent border-0 text-danger" data-bs-toggle="modal" data-bs-target="#destroy{{ $categorie->id }}">
                                            <i class="ti-trash" style="font-size: 0.90rem;"></i>
                                        </button>
                                    @endcan
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="p-0">
                                    <div id="sous{{$categorie->id}}" class="accordion-collapse collapse" aria-labelledby="sous{{$categorie->id}}" data-bs-parent="#sous{{$categorie->id}}">
                                        <table class="table table-bordered table-sm m-0">
                                            <thead>
                                                <tr class="fw-bolder table-info">
                                                    <th class="text-dark">Nom</th>
                                                    <th class="text-dark">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($categorie->sous as $sous)
                                                    <tr>
                                                        <td class="align-middle">{{ $sous->nom ?? '' }}</td>
                                                        <td class="align-middle">
                                                            @can('sousCategorie-edit')
                                                                <button type="button" class="btn p-0 bg-transparent border-0 text-primary" data-bs-toggle="modal" data-bs-target="#editSous{{ $categorie->id }}">
                                                                    <i class="ti-pencil" style="font-size: 0.90rem;"></i>
                                                                </button>
                                                            @endcan
                                                            @can('sousCategorie-destroy')
                                                                <button type="button" class="btn p-0 bg-transparent border-0 text-danger" data-bs-toggle="modal" data-bs-target="#destroySous{{ $categorie->id }}">
                                                                    <i class="ti-trash" style="font-size: 0.90rem;"></i>
                                                                </button>
                                                            @endcan
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">
                                    <h6 class="text-center m-0">
                                        Aucun catégorie saisir
                                    </h6>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

















        </div>
    </div>




    @foreach ($categories as $categorie)
        <div class="modal fade" id="edit{{ $categorie->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header bg-primary py-2">
                        <h6 class="modal-title text-white m-0" id="varyingModalLabel">Modifier la catégorie : {{ $categorie->nom }}</h6>
                        <button type="button" class="btn btn-transparent p-0 text-white" data-bs-dismiss="modal" aria-label="btn-close">
                            <span class="mdi mdi-close-thick"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('categorie.update',$categorie) }}" method="post">
                            @csrf
                            @method("PUT")
                            <div class="form-group mb-2">
                                <label for="" class="form-label">Nom</label>
                                <input type="text" name="nom_u" id="" class="form-control" value="{{ $categorie->nom ?? '' }}">
                            </div>
                            <div class="form-group mb-2">
                                <label for="" class="form-label">Description</label>
                                <textarea name="description_u" rows="5" class="form-control" style="resize: none;">{{ $categorie->description ?? '' }}</textarea>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-success btn-sm">
                                    <i class="mdi mdi-checkbox-marked-circle-outline align-middle"></i>
                                    <span>Modifier</span>
                                </button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="destroy{{ $categorie->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="{{ route('categorie.destroy',$categorie) }}" method="POST">
                            @csrf
                            @method("DELETE")
                            <h3 class="text-primary mb-3 text-center">Confirmer la suppression</h3>
                            <h6 class="mb-2 fw-bolder text-center text-muted">
                                Voulez-vous vraiment déplacer du catégorie vers la corbeille
                            </h6>
                            <h6 class="text-danger mb-2 text-center">{{ $categorie->nom }}</h6>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary px-5 fw-bolder py-2 me-2">
                                    Je confirme
                                </button>
                                <button type="button" class="btn btn-light px-5 py-2 fw-bolder" data-bs-dismiss="modal" aria-label="btn-close" style="background:#CEAD6D">
                                    Annuler
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>


        @if (count($categorie->sous) > 0)
            @foreach ($categorie->sous as $sous)
                <div class="modal fade" id="editSous{{ $sous->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header bg-primary py-2">
                                <h6 class="modal-title text-white m-0" id="varyingModalLabel">Modifier la catégorie : {{ $categorie->nom }}</h6>
                                <button type="button" class="btn btn-transparent p-0 text-white" data-bs-dismiss="modal" aria-label="btn-close">
                                    <span class="mdi mdi-close-thick"></span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('sousCategorie.update',$sous) }}" method="post">
                                    @csrf
                                    @method("PUT")
                                    <div class="form-group mb-2">
                                        <label for="" class="form-label">Nom</label>
                                        <input type="text" name="sous_u" id="" class="form-control" value="{{ $sous->nom ?? '' }}">
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="mdi mdi-checkbox-marked-circle-outline align-middle"></i>
                                            <span>Modifier</span>
                                        </button>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="destroySous{{ $sous->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <form action="{{ route('sousCategorie.destroy',$sous) }}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <h3 class="text-primary mb-3 text-center">Confirmer la suppression</h3>
                                    <h6 class="mb-2 text-center">Voulez-vous vraiment déplacer du sous catégorie vers la corbeille ?</h6>
                                    <h6 class="text-danger mb-2 text-center">{{ $sous->nom }}</h6>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary px-5 fw-bolder py-2 me-2">
                                            Je confirme
                                        </button>
                                        <button type="button" class="btn btn-light px-5 py-2 fw-bolder" data-bs-dismiss="modal" aria-label="btn-close" style="background:#CEAD6D">
                                            Annuler
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    @endforeach






    <div class="modal fade" id="addCategorie" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary py-2">
                    <h6 class="modal-title m-0 text-white" id="varyingModalLabel">Ajouter catégorie</h6>
                    <button type="button" class="btn btn-transparent p-0 text-white border-0" data-bs-dismiss="modal" aria-label="btn-close">
                        <span class="mdi mdi-close-thick"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('categorie.store') }}" method="post">
                        @csrf


                        <div class="form-group mb-2">
                            <label for="" class="form-label">Nom</label>
                            <input type="text" name="nom" id="" class="form-control @error('nom') is-invalid @enderror" placeholder="Nom du catégorie" value="{{ old('nom') }}" required>
                        </div>

                        <div class="form-group mb-2">
                            <label for="" class="form-label">Description</label>
                            <input type="text" name="description" id="" class="form-control" placeholder="Description" value="{{ old('description') }}">
                        </div>





                        <div class="d-flex justify-content-center">


                            <button type="submit" class="btn btn-success btn-sm px-3">
                                <i class="mdi mdi-checkbox-marked-circle-outline align-middle"></i>
                                <span>Enregistrer</span>
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addSous" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary py-2">
                    <h6 class="modal-title m-0 text-white" id="varyingModalLabel">Ajouter sous-catégorie</h6>
                    <button type="button" class="btn btn-transparent p-0 text-white border-0" data-bs-dismiss="modal" aria-label="btn-close">
                        <span class="mdi mdi-close-thick"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('sousCategorie.store') }}" method="post">
                        @csrf

                        <div class="form-group mb-2">
                            <label for="" class="form-label">Parent</label>
                            <select name="categorie" id="" class="form-select">
                                <option value="">Choisir le catégorie</option>
                                @foreach ($categories as $categorie)
                                    <option value="{{ $categorie->id }}" >{{ $categorie->nom ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-2">
                            <label for="" class="form-label">Sous-catégorie</label>
                            <input type="text" name="sous" id="" class="form-control" value="">
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="mdi mdi-checkbox-marked-circle-outline align-middle"></i>
                                <span>Enregistrer</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection







