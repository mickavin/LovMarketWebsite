@extends('layouts.dashboard')
@section('content')
   <div class="app-main__outer">
                    <div class="app-main__inner">
                            <div class="my-3">
                                <a href="{{ route('admin.order.index') }}"><< Retour à la liste des commandes</a>
                            </div>
                        <div>
                            <div>
                                <div class="main-card mb-3 card">
                                    <div class="card-header">
                                        <h5 class="card-title">Commande n° {{ $id }}</h5>
                                    </div>
                                    <div class="card-body align-items-center">
                                        <div
                                        id="ShowOrder"
                                        data-orderId="{{ $id }}">
                                        </div>
                                        @if($order == null)
                                        <div>
                                            <form action="{{ route('admin.order.validate', ['commande' => $id]) }}" enctype="multipart/form-data" method="POST">
                                                {{ csrf_field() }}
                                                <button class="btn btn-primary mt-3" type="submit"  name="validate" value="{{ $id }}">
                                                    Afficher comme prête
                                                </button>
                                            </form>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
@endsection('content')

