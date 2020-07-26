@extends('layouts.dashboard')
@section('content')
<div class="app-main__outer">
                    <div class="app-main__inner">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-header">Liste des commerces
                                            <form class="ml-auto" action="{{ route('shop.indexRequest') }}" enctype="multipart/form-data" method="POST">
                                            {{ csrf_field() }}
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Rechercher un commerce" name="name">
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
                                                <th>Téléphone</th>
                                                <th>Description</th>
                                                <th>Catégorie</th>
                                                <th>Type</th>
                                                <th>En ligne</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($shops as $shop)
                                            <tr>
                                                <td class="text-muted">#
                                                {{ $shop->id }}
                                                </td>
                                                <td>
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                <div class="widget-content-left">
                                                                    <img width="40" src="{{$shop->image}}" alt="{{ $shop->name }}">
                                                                </div>
                                                            </div>
                                                            <div class="widget-content-left flex2">
                                                                <div class="widget-heading">{{ $shop->name }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $shop->phoneNumber}}</td>
                                                <td>{{ substr($shop->description,0,30) }}</td>
                                                <td>
                                                    {{ $shop->category->category }}
                                                </td>
                                                @if($shop->type == 1)
                                                <td>
                                                    <div class="badge badge-danger">Commerce</div>
                                                </td>
                                                @elseif($shop->type == 2)
                                                <td>
                                                    <div class="badge badge-success">Restaurant</div>
                                                </td>
                                                @else
                                                <td>
                                                    <div class="badge badge-info">Service</div>
                                                </td>
                                                @endif
                                                <td>
                                                    @if($shop->activated == 0)
                                                    <div class="badge badge-danger">Désactivé</div>
                                                    @else
                                                    <div class="badge badge-success">Activé</div>
                                                    @endif
                                                </td>
                                                <td class="row">
                                                    <a href="{{ route('shop.edit', ['commerce' => $shop->id]) }}" class="btn btn-primary btn-sm" style="color: #fff">Modifier</a>
                                                    <a href="{{ route('admin.intro.index', ['commerce' => $shop->id]) }}" class="btn btn-primary btn-sm ml-lg-2" style="color: #fff">Plus</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-block text-center card-footer">
                                        {{ $shops->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>

        </div>
@endsection('content')
