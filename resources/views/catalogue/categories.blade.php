@extends('layouts.master')
@section('title')
    Liste des catégories
@endsection
@section('content')
    @include('sweetalert::alert')

    <div class="card">
        <div class="card-body p-2">
            <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#categorie"
                        role="tab">
                        Catégorie
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#sous" role="tab">sous-catégorie</a>
                </li>


            </ul>

            <div class="tab-content">
                <div class="tab-pane active py-2 px-2" id="categorie" role="tabpanel">
                    <div class="d-flex justify-content-center mb-3">
                        @can('categorie-create')
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addCategorie">
                                <span class="mdi mdi-plus-circle-outline align-middle"></span>
                                <span>Ajouter catégorie</span>
                            </button>
                        @endcan
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0 table-sm datatable">
                            <thead>
                                <tr class="table-success">
                                    <th>Nom</th>
                                    <th>description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $categorie)
                                    <tr>
                                        <td class="align-middle">{{ $categorie->nom }}</td>
                                        <td class="align-middle">{{ Str::limit($categorie->description, 30, '...') }}</td>
                                        <td class="align-middle">
                                            @can('categorie-edit')
                                                <button type="button" class="btn p-0 bg-transparent border-0 text-primary" data-bs-toggle="modal" data-bs-target="#edit{{ $categorie->id }}">
                                                    <i class="ti-pencil" style="font-size: 0.90rem;"></i>
                                                </button>
                                            @endcan
                                            @can('categorie-show')
                                                <button type="button" class="btn p-0 bg-transparent border-0 text-warning" data-bs-toggle="modal" data-bs-target="#show{{ $categorie->id }}">
                                                    <i class="ti-info" style="font-size: 0.90rem;"></i>
                                                </button>
                                            @endcan
                                            @can('categorie-destroy')
                                                <button type="button" class="btn p-0 bg-transparent border-0 text-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $categorie->id }}">
                                                    <i class="ti-trash" style="font-size: 0.90rem;"></i>
                                                </button>
                                            @endcan
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
                <div class="tab-pane py-2 px-2" id="sous" role="tabpanel">
                    <div class="d-flex justify-content-center mb-3">
                        @can('sous-categorie-create')
                            <button type="button" class="btn btn-sm btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addSous">
                                <span class="mdi mdi-plus-circle-outline align-middle"></span>
                                <span>Ajouter sous-catégorie</span>
                            </button>
                        @endcan

                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0 table-sm datatable">
                            <thead>
                                <tr class="table-success">
                                    <th>parent</th>
                                    <th>nom</th>
                                    <th>actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($sous_categories as $sous)
                                    <tr>
                                        <td class="align-middle">{{ $sous->categorie->nom ?? '' }}</td>
                                        <td class="align-middle">{{ $sous->nom }}</td>
                                        <td class="align-middle">
                                            @can('categorie-edit')
                                                <button type="button" class="btn p-0 bg-transparent border-0 text-primary" data-bs-toggle="modal" data-bs-target="#editSous{{ $sous->id }}">
                                                    <i class="ti-pencil" style="font-size: 0.90rem;"></i>
                                                </button>
                                            @endcan
                                            @can('categorie-destroy')
                                                <button type="button" class="btn p-0 bg-transparent border-0 text-danger" data-bs-toggle="modal" data-bs-target="#deleteSous{{ $sous->id }}">
                                                    <i class="ti-trash" style="font-size: 0.90rem;"></i>
                                                </button>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">
                                            <h6 class="text-center m-0">
                                                Aucun sous-catégorie saisir
                                            </h6>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
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
        <div class="modal fade" id="show{{ $categorie->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary py-2">
                        <h6 class="modal-title m-0 text-white" id="varyingModalLabel">Catégorie : {{ $categorie->nom }}</h6>
                        <button type="button" class="btn btn-transparent p-0 border-0 text-white" data-bs-dismiss="modal" aria-label="btn-close">
                            <span class="mdi mdi-close-thick"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped table-sm {{ count($categorie->sous) == 0 ? 'm-0':'mb-4' }}">
                            <tbody>
                                <tr>
                                    <th class="text-center">nom</th>
                                </tr>
                                <tr>
                                    <td class="align-middle text-center">{{ $categorie->nom }}</td>
                                </tr>
                                <tr>
                                    <th class="text-center">description</th>
                                </tr>
                                <tr>
                                    <td class="align-middle text-center">{{ $categorie->description }}</td>
                                </tr>
                            </tbody>
                        </table>
                        @if (count($categorie->sous) > 0)
                            <h6 class="text-center text-uppercase mb-3 text-primary">
                                sous-catégorie
                            </h6>
                            <div class="row row-cols-3">
                                @foreach ($categorie->sous as $sous)
                                    <div class="col">
                                        <p class="text-uppercase m-0">
                                            <span class="mdi mdi-check-bold align-middle"></span>
                                            <span>{{ $sous->nom ?? '' }}</span>
                                        </p>
                                    </div>
                                @endforeach
                            </div>

                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="delete{{ $categorie->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
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
                            <div class="d-flex justify-content-center">
                                <div class="form-check">
                                    <input type="checkbox" name="force" id="del{{$categorie->id}}" class="form-input-check">
                                    <label for="del{{$categorie->id}}" class="form-label-check fw-bolder">Ignorer la corbeille et supprimer définitivement du catégorie</label>
                                </div>
                            </div>
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
    @endforeach





    @foreach ($sous_categories as $sous_cat)
        <div class="modal fade" id="editSous{{ $sous_cat->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header bg-primary py-2">
                        <h6 class="modal-title text-white m-0" id="varyingModalLabel">Modifier le sous-catégorie : {{ $sous_cat->nom }}</h6>
                        <button type="button" class="btn btn-transparent p-0 text-white border-0" data-bs-dismiss="modal" aria-label="btn-close">
                            <span class="mdi mdi-close-thick"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('sousCategorie.update',$sous_cat) }}" method="post">
                            @csrf
                            @method("PUT")
                            <div class="form-group mb-2">
                                <label for="" class="form-label">Parent</label>
                                <select name="categorie_u" id="" class="form-select">
                                    <option value="">Choisir le catégorie</option>
                                    @foreach ($categories as $categorie)
                                        <option value="{{ $categorie->id }}" {{ $categorie->id == $sous_cat->categorie_id ? 'selected':'' }}>{{ $categorie->nom ?? '' }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-2">
                                <label for="" class="form-label">Sous-catégorie</label>
                                <input type="text" name="sous_u" id="" class="form-control" value="{{ $sous_cat->nom }}">
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


        <div class="modal fade" id="deleteSous{{ $sous_cat->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="{{ route('sousCategorie.destroy',$sous_cat) }}" method="POST">
                            @csrf
                            @method("DELETE")

                            <h3 class="text-primary mb-3 text-center">Confirmer la suppression</h3>
                            <h6 class="mb-2 fw-bolder text-center text-muted">
                                Voulez-vous vraiment déplacer du sous-catégorie vers la corbeille
                            </h6>
                            <div class="d-flex justify-content-center mb-2">
                                <div class="form-check">
                                    <input type="checkbox" name="force" id="delSous{{$sous_cat->id}}" class="form-check-input">
                                    <label for="delSous{{$sous_cat->id}}" class="form-check-label fw-bolder">Ignorer la corbeille et supprimer définitivement du sous-catégorie</label>
                                </div>

                            </div>
                            <h6 class="text-danger mb-2 text-center">{{ $sous_cat->nom }}</h6>
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
