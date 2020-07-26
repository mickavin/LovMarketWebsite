@extends('layouts.dashboard')
@section('content')
<div class="app-main__outer">
                    <div class="app-main__inner">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-header">Liste de produits
                                            <form class="ml-auto" action="{{ route('product.indexRequest') }}" enctype="multipart/form-data" method="POST">
                                            {{ csrf_field() }}
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Rechercher un produit" name="name">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary">Rechercher</button>
                                                </div>
                                            </div>
                                            </form>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nom</th>
                                                <th>Description</th>
                                                <th>Catégorie</th>
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
                                                <td>{{ $product->description }}</td>
                                                <td>
                                                    @isset($product->category)
                                                    {{ $product->category->category }}
                                                    @endisset
                                                </td>
                                                <td>
                                                    @if($product->activated == 0)
                                                    <div class="badge badge-danger">Désactivé</div>
                                                    @else
                                                    <div class="badge badge-success">Activé</div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <form action="{{ route('product.active') }}" enctype="multipart/form-data" method="POST">
                                                    {{ csrf_field() }}
                                                    <a
                                                    href="{{ route('product.edit', ['produit' => $product->id]) }}"
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
                                        {{ $products->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>

        </div>
@endsection('content')
