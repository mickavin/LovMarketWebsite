@extends('layouts.dashboard')
@section('content')
   <div class="app-main__outer">
                    <div class="app-main__inner">

                        <div>
                            <div>
                                <div class="main-card mb-3 card">
                                    <div class="card-body"><h5 class="card-title">Formulaire d'ajout de commerce</h5>
                                        <form action="{{ route('shop.postcreate') }}" enctype="multipart/form-data" method="POST">
                                        {{ csrf_field() }}
                                        <div id="img" data-img="shop" data-error="@error('img'){{ $message }}@enderror">
                                            </div>
                                            <div class="position-relative row form-group mb-4"><label for="name" class="col-sm-2 col-form-label">Nom</label>
                                                <div class="col-sm-10 col-lg-6"><input name="name" id="name" placeholder="Nom" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                                                {!! $errors->first('name', '<span class="help-block text-danger">:message</span>') !!}
                                                <small class="form-text text-muted">Exemple: Boulangerie des 4 continents</small>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group mb-4"><label for="description" class="col-sm-2 col-form-label">Description</label>
                                                <div class="col-sm-10 col-lg-6"><textarea name="description" id="description" placeholder="Description" type="text" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}"></textarea>
                                                {!! $errors->first('description', '<span class="help-block text-danger">:message</span>') !!}
                                                <small class="form-text text-muted">Exemple: La plus belle boulangerie de France</small>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group mb-4"><label for="phone" class="col-sm-2 col-form-label">Téléphone</label>
                                                <div class="col-sm-10 col-lg-6"><input name="phone" id="phone" placeholder="Téléphone" type="text" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                                                {!! $errors->first('phone', '<span class="help-block text-danger">:message</span>') !!}
                                                <small class="form-text text-muted">Exemple: +33123456789</small>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group mb-4"><label for="address" class="col-sm-2 col-form-label">Adresse</label>
                                                <div class="col-sm-10 col-lg-6"><textarea name="address" id="address" placeholder="Adresse" type="text" class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                                                {!! $errors->first('address', '<span class="help-block text-danger">:message</span>') !!}
                                                <small class="form-text text-muted">Exemple: 15 Boulevard du Montparnasse, 75014 Paris</small>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group mb-4"><label for="latitude" class="col-sm-2 col-form-label">Latitude</label>
                                                <div class="col-sm-10 col-lg-6"><input name="latitude" id="latitude" placeholder="Latitude" type="text" class="form-control @error('latitude') is-invalid @enderror" value="{{ old('latitude') }}">
                                                {!! $errors->first('latitude', '<span class="help-block text-danger">:message</span>') !!}
                                                <small class="form-text text-muted">Exemple: 48.8534</small>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group mb-4"><label for="longitude" class="col-sm-2 col-form-label">Longitude</label>
                                                <div class="col-sm-10 col-lg-6"><input name="longitude" id="longitude" placeholder="Longitude" type="text" class="form-control @error('longitude') is-invalid @enderror" value="{{ old('longitude') }}">
                                                {!! $errors->first('longitude', '<span class="help-block text-danger">:message</span>') !!}
                                                <small class="form-text text-muted">Exemple: 2.3488</small>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group mb-4"><label for="category" class="col-sm-2 col-form-label">Catégorie</label>
                                                <div class="col-sm-10 col-lg-6">
                                                   <select name="category" id="category" class="form-control mb-4">
                                                        <option value=""></option>
                                                        @foreach($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->category }}</option>
                                                        @endforeach
                                                   </select>
                                                   {!! $errors->first('category', '<span class="help-block text-danger">:message</span>') !!}
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group mb-4"><label for="type" class="col-sm-2 col-form-label">Type</label>
                                                <div class="col-sm-10 col-lg-6">
                                                   <select name="type" id="type" class="form-control mb-4">
                                                      <option value=""></option>
                                                      <option value="1">Commerce</option>
                                                      <option value="2">Restaurant</option>
                                                      <option value="3">Service</option>
                                                   </select>
                                                   {!! $errors->first('type', '<span class="help-block text-danger">:message</span>') !!}
                                                </div>
                                            </div>
                                            <div class="position-relative row form-check mt-3">
                                                <div class="col-sm-10 col-lg-6 offset-sm-2">
                                                    <button class="btn btn-primary">Ajouter</button>
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

