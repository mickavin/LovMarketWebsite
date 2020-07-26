@extends('layouts.dashboard')
@section('content')
   <div class="app-main__outer">
                    <div class="app-main__inner">

                        <div>
                            <div>
                                    <div class="container">
                                            <div class="row justify-content-center">
                                                <div class="col-md-8">
                                                    <div class="card">
                                                        <div class="card-header">Tableau de bord</div>

                                                        <div class="card-body">
                                                            @if (session('status'))
                                                                <div class="alert alert-success" role="alert">
                                                                    {{ session('status') }}
                                                                </div>
                                                            @endif
                                                            @if (session('error'))
                                                                <div class="alert alert-danger" role="alert">
                                                                    {{ session('error') }}
                                                                </div>
                                                            @else
                                                            Vous êtes connectés!
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            </div>
                        </div>
                    </div>
                  </div>
@endsection('content')
