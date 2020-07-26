@extends('layouts.dashboard')
@section('content')
<div class="app-main__outer">
                    <div class="app-main__inner">
                        <div class="row">

                            <h2 class="ml-3 mb-3 w-100">{{ $shop->name }}</h2>
                                <div class="col-md-12 col-lg-6">
                                        <div class="main-card mb-3 card">
                                            <div class="card-header">Liste de produits
                                                <div class="ml-auto"><a href="{{ route('admin.product.create',['commerce' => $id]) }}">Ajouter un produit</a></div>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Nom</th>
                                                        <th>En ligne</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($products as $product)
                                                    <tr>
                                                        <td class="text-muted">#
                                                        {{ $product->id }}
                                                        </td>
                                                        <td>
                                                            <div class="widget-content p-0">
                                                                <div class="widget-content-wrapper">
                                                                    <div class="widget-content-left mr-3">
                                                                        <div class="widget-content-left">
                                                                            <img width="40" src="{{$product->image}}" alt="{{ $product->name }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="widget-content-left flex2">
                                                                        <div class="widget-heading">{{ $product->name }}</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            @if($product->activated == 0)
                                                            <div class="badge badge-danger">Désactivé</div>
                                                            @else
                                                            <div class="badge badge-success">Activé</div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <form action="{{ route('admin.product.active', ['commerce' => $id]) }}" enctype="multipart/form-data" method="POST">
                                                            {{ csrf_field() }}
                                                            <a
                                                            href="{{ route('admin.product.edit',['commerce' => $id, 'produit' => $product->id]) }}"
                                                            class="btn btn-primary btn-sm"
                                                            style="color: #fff">Modifier</a>
                                                                    @if($product->activated === 0)
                                                                    <button class="btn btn-secondary btn-sm"
                                                                    type="submit"
                                                                    name="active"
                                                                    value="{{ $product->id }}"
                                                                    >Activer</button>
                                                                    @else
                                                                    <button class="btn btn-secondary btn-sm"
                                                                    type="submit"
                                                                    name="desactive"
                                                                    value="{{ $product->id }}"
                                                                    >Désactiver</button>
                                                                    @endif
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="d-block text-center card-footer">
                                                <a href="{{ route('admin.product.index',['commerce' => $id]) }}">Voir plus de produits pour ce commerce</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-lg-6">
                                            <div class="main-card mb-3 card">
                                                <div class="card-header">Liste des catégories de produits
                                                        <div class="ml-auto"><a href="{{ route('category.product.create',['commerce' => $id]) }}">Créer une catégorie</a></div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Catégorie</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($categories as $category)
                                                        <tr>
                                                            <td class="text-muted">#
                                                            {{ $category->id }}
                                                            </td>
                                                            <td>
                                                                <div class="widget-content p-0">
                                                                    <div class="widget-content-wrapper">
                                                                        <div class="widget-content-left">
                                                                        </div>
                                                                        <div class="widget-content-left flex2">
                                                                            <div class="widget-heading">{{ $category->category }}</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <a
                                                                href="{{ route('admin.category.edit',['commerce' => $id,'categorie' => $category->id]) }}"
                                                                class="btn btn-primary btn-sm"
                                                                style="color: #fff">Modifier</a>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="d-block text-center card-footer">
                                                    <a href="{{route('admin.category.index',['commerce' => $id])}}">Voir plus de catégories pour ce commerce</a>
                                                </div>
                                            </div>
                                        </div>
                        </div>
                    </div>
                    </div>

        </div>
@endsection('content')
