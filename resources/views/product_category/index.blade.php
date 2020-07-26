@extends('layouts.dashboard')
@section('content')
<div class="app-main__outer">
                    <div class="app-main__inner">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-header">Liste des catégories de produits
                                            <form class="ml-auto" action="{{ route('category.product.indexRequest') }}" enctype="multipart/form-data" method="POST">
                                            {{ csrf_field() }}
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Rechercher une catégorie" name="category">
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
                                                    href="{{ route('category.product.edit' , ['categorie' => $category->id ]) }}"
                                                    class="btn btn-primary btn-sm"
                                                    style="color: #fff">Modifier</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-block text-center card-footer">
                                        {{ $categories->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>

        </div>
@endsection('content')
