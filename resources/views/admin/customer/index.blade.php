@extends('layouts.dashboard')
@section('content')
<div class="app-main__outer">
                    <div class="app-main__inner">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-header">Liste des clients
                                            <form class="ml-auto" action="{{ route('customer.indexRequest') }}" enctype="multipart/form-data" method="POST">
                                            {{ csrf_field() }}
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Rechercher un client" name="name">
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
                                                <th>Téléphone</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($customers as $customer)
                                            <tr>
                                                <td class="text-muted">#
                                                {{ $customer->id }}
                                                </td>
                                                <td>
                                                {{ $customer->name }}
                                                </td>
                                                <td>
                                                {{ $customer->email }}
                                                </td>
                                                <td>
                                                {{ $customer->phoneNumber }}
                                                </td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-block text-center card-footer">
                                        {{ $customers->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>

        </div>
@endsection('content')
