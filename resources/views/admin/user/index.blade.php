@extends('layouts.dashboard')
@section('content')
<div class="app-main__outer">
                    <div class="app-main__inner">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-header">Liste des utilisateurs
                                            <form class="ml-auto" action="{{ route('user.indexRequest') }}" enctype="multipart/form-data" method="POST">
                                            {{ csrf_field() }}
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Rechercher un utilisateur" name="name">
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
                                                <th>E-mail</th>
                                                <th>Commerce lié</th>
                                                <th>Rôle</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($users as $user)
                                            <tr>
                                                <td class="text-muted">#
                                                {{ $user->id }}
                                                </td>
                                                <td>
                                                        <div class="widget-content p-0">
                                                            <div class="widget-content-wrapper">
                                                                @if($user->is_admin == 0)
                                                                    @if(isset($user->image) && isset($user->shopId))
                                                                    <div class="widget-content-left mr-3">
                                                                        <div class="widget-content-left">
                                                                            <img width="40" src="{{$user->shop->image}}" alt="{{ $shop->name }}">
                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                                @endif
                                                                <div class="widget-content-left flex2">
                                                                    <div class="widget-heading">{{ $user->name }}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>
                                                    @if(isset($user->shopId))
                                                    {{ $user->shop->name }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($user->is_admin == 0)
                                                    <div class="badge badge-success">Commerçant</div>
                                                    @elseif($user->is_admin == 1)
                                                    <div class="badge badge-danger">Administrateur</div>
                                                    @elseif($user->is_admin == 2)
                                                    <div class="badge badge-info">Client</div>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-block text-center card-footer">
                                        {{ $users->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>

        </div>
@endsection('content')
