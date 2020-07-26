@section('styles')
<link href="{{ asset('css/style.css') }}" rel="stylesheet"/>
@endsection
@extends('layouts.dashboard')
@section('content')
   <div class="app-main__outer">
                    <div class="app-main__inner">
                            @if (session('error'))
                            <div class="alert alert-danger">
                                <p class="my-auto">{{ session('error') }}</p>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">
                                <p class="my-auto">{{ session('success') }}</p>
                            </div>
                        @endif
                        <div>
                            <div>
                                <div class="main-card mb-3 card">
                                    <div class="card-body"><h5 class="card-title">Formulaire d'invitation</h5>
                                        <form action="{{ route('storeInvitation') }}" enctype="multipart/form-data" method="POST">
                                        {{ csrf_field() }}
                                            <div class="position-relative row form-group mb-4"><label for="email" class="col-sm-2 col-form-label">E-Mail</label>
                                                <div class="col-sm-10 col-lg-6"><input id="email" type="email" class="form-control @error('categorie') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                                                {!! $errors->first('email', '<span class="help-block text-danger">:message</span>') !!}
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group mb-4"><label for="shop" class="col-sm-2 col-form-label">Commerce lié</label>
                                                <div class="col-sm-10 col-lg-6"><div id="select-shop"></div>
                                                {!! $errors->first('shop', '<span class="help-block text-danger">:message</span>') !!}
                                                </div>
                                            </div>
                                            <div class="position-relative row form-check mt-3">
                                                    <div class="col-sm-10 col-lg-6 offset-sm-2">
                                                        <button class="btn btn-primary">Envoyer</button>
                                                    </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
@endsection('content')
