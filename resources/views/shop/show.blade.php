@extends('layouts.dashboard')
@section('content')
   <div class="app-main__outer">
                    <div class="app-main__inner">

                        <div>
                            <div>
                                <div class="main-card mb-3 card">
                                    <div class="card-body"><h5 class="card-title mb-4">Informations du commerce</h5>
                                        <form action="{{ action('ShopController@updateShop',[$shop]) }}" enctype="multipart/form-data" method="POST">
                                            {{ csrf_field() }}
                                                <div class="position-relative row form-group mb-4"><label for="image" class="col-sm-2 col-form-label">Image</label>
                                                    <div class="col-sm-10 col-lg-6">
                                                        <img src="{{ $shop->image }}" style="height: 150px"/>
                                                    </div>
                                                </div>
                                                <div class="position-relative row form-group mb-4"><label for="name" class="col-sm-2">Nom</label>
                                                    <div class="col-sm-10 col-lg-6">
                                                        {{ $shop->name }}
                                                    </div>
                                                </div>
                                                <div class="position-relative row form-group mb-4"><label for="description" class="col-sm-2 col-form-label">Description</label>
                                                    <div class="col-sm-10 col-lg-6"><textarea name="description" id="description" placeholder="Description" type="text" class="form-control @error('description') is-invalid @enderror">{{ $shop->description }}</textarea>
                                                    {!! $errors->first('description', '<span class="help-block text-danger">:message</span>') !!}
                                                    </div>
                                                </div>
                                                <div class="position-relative row form-group mb-4"><label for="address" class="col-sm-2">Adresse</label>
                                                    <div class="col-sm-10 col-lg-6">
                                                        {{ $shop->address }}
                                                    </div>
                                                </div>
                                                <div class="position-relative row form-group mb-4"><label for="category" class="col-sm-2">Catégorie</label>
                                                    <div class="col-sm-10 col-lg-6">
                                                        {{ $shop->category->category }}
                                                    </div>
                                                </div>
                                                <div class="position-relative row form-group mb-4"><label for="type" class="col-sm-2">Type</label>
                                                    <div class="col-sm-10 col-lg-6">
                                                        {{ $type[$shop->type] }}
                                                    </div>
                                                </div>
                                                <div class="position-relative row form-group mb-4"><label for="activated" class="col-sm-2">Activé</label>
                                                    <div class="col-sm-10 col-lg-6">
                                                        @if($shop->activated === 0)
                                                        Non
                                                        @else
                                                        Oui
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="position-relative row form-check mt-3">
                                                    <div class="col-sm-10 col-lg-6 offset-sm-2">
                                                        <button class="btn btn-primary">Modifier</button>
                                                        @if($shop->activated === 0)
                                                        <button class="btn btn-secondary"
                                                        type="submit"
                                                        name="active"
                                                        value="true"
                                                        class="btn mx-4">Activer</button>
                                                        @else
                                                        <button class="btn btn-secondary"
                                                        type="submit"
                                                        name="desactive"
                                                        value="true"
                                                        class="btn mx-4">Désactiver</button>
                                                        @endif
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

