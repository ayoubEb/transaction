


    <!-- ========== Left Sidebar Start ========== -->
    <div class="vertical-menu">

        <div data-simplebar class="h-100">

            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metismenu list-unstyled" id="side-menu">
                        <li>
                            <a href="{{ route('home') }}" class="waves-effect">
                                <i class="dripicons-device-desktop"></i>
                                <span>Tableau de bord</span>
                            </a>
                        </li>
                    @can('categorie-list')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="dripicons-suitcase"></i>
                            <span>Catalogues</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('categorie-list')
                                <li>
                                    <a href="{{ route('categorie.index') }}">Catégories</a>
                                </li>
                            @endcan
                            @can('produit-list')
                                <li>
                                    <a href="{{ route('produit.index') }}">Produits</a>
                                </li>
                            @endcan

                            @can('caracteristique-list')
                                <li>
                                    <a href="{{ route('caracteristique.index') }}">Caractéristiques</a>
                                </li>
                            @endcan
                            @can('stock-list')
                                <li>
                                    <a href="{{ route('stock.index') }}">Stock</a>
                                </li>
                            @endcan

                        </ul>
                    </li>


                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="dripicons-suitcase"></i>
                            <span>Achat</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('user-list')
                                <li>
                                    <a href="{{ route('fournisseur.index') }}">Fournisseur</a>
                                </li>
                            @endcan
                    

                        </ul>
                    </li>
                    @elsecan('produit-list')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="dripicons-suitcase"></i>
                            <span>GRH</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('user-list')
                            <li>
                                <a href="{{ route('user.index') }}">Utilisateurs</a>
                            </li>
                            @endcan
                            @can('role-list')
                            <li>
                                <a href="{{ route('role.index') }}">Rolls</a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can("client-list")
                    <li>
                        <a href="{{ route('client.index') }}" class="waves-effect">
                            <i class="mdi mdi-account-multiple mdi-18px"></i>
                            <span>Clients</span>
                        </a>
                    </li>
                    @endcan


                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="dripicons-suitcase"></i>
                            <span>Ventes</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('facture-list')
                                <li>
                                    <a href="{{ route('facture.index') }}">Factures</a>
                                </li>
                            @endcan


                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="dripicons-suitcase"></i>
                            <span>GRH</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('user-list')
                            <li>
                                <a href="{{ route('user.index') }}">Utilisateurs</a>
                            </li>
                            @endcan
                            @can('role-list')
                            <li>
                                <a href="{{route('role.index')}}">Roles</a>
                            </li>
                            @endcan
                        </ul>
                    </li>

                    @can("groupe-list")
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="dripicons-suitcase"></i>
                            <span>Paramètre</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('groupe-list')
                            <li>
                                <a href="{{ route('group.index') }}">Groupes</a>
                            </li>
                            @endcan
                            @can('entreprise-list')
                            <li>
                                <a href="{{ route('entreprise.index') }}">Entreprise</a>
                            </li>
                            @endcan
                            @can('type-client-list')
                            <li>
                                <a href="{{route('type-client.index')}}">Type client</a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @elsecan('entreprise-list')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="dripicons-suitcase"></i>
                            <span>Collaboration</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('groupe-list')
                            <li>
                                <a href="{{ route('group.index') }}">Groupes</a>
                            </li>
                            @endcan
                            @can('entreprise-list')
                            <li>
                                <a href="{{ route('entreprise.index') }}">Entreprise</a>
                            </li>
                            @endcan
                            @can('type-client-list')
                            <li>
                                <a href="{{route('type-client.index')}}">Type client</a>
                            </li>
                            @endcan
                        </ul>
                    </li>

                    @elsecan('type-client-list')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="dripicons-suitcase"></i>
                            <span>Collaboration</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('groupe-list')
                            <li>
                                <a href="{{ route('group.index') }}">Groupes</a>
                            </li>
                            @endcan
                            @can('entreprise-list')
                            <li>
                                <a href="{{ route('entreprise.index') }}">Entreprise</a>
                            </li>
                            @endcan
                            @can('type-client-list')
                            <li>
                                <a href="{{route('type-client.index')}}">Type client</a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan


                    @can('transaction-list')
                        <li>
                            <a href="{{ route('transaction.index') }}" class="waves-effect">
                                <i class="mdi mdi-file-outline mdi-18px"></i>
                                <span>Transactions</span>
                            </a>
                        </li>
                    @endcan



                    @can('vente-semaine-list')
                    <li>
                        <a href="{{ route('week-amount.index') }}" class="waves-effect">
                            <i class="mdi mdi-currency-usd"></i>
                            <span>Vente semaine</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('customize.index') }}" class="waves-effect">
                            <i class="dripicons-device-desktop"></i>
                            <span>Personalisation</span>
                        </a>
                    </li>



                @endcan

                </ul>
            </div>
            <!-- Sidebar -->
        </div>
    </div>
    <!-- Left Sidebar End -->
