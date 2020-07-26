@extends('layouts.dashboard')
@section('content')
   <div class="app-main__outer">
                    <div class="app-main__inner">
                        <div class="my-3">
                            <a href="{{ route('admin.intro.index', ['commerce' => $shop->id]) }}"><< Aller à la page du commerce</a>
                        </div>
                        <div>
                            <div>
                                <div class="main-card mb-3 card">
                                    <div class="card-body"><h5 class="card-title">Formulaire de modification de commerce</h5>
                                        <form action="{{ action('ShopController@update',[$shop]) }}" enctype="multipart/form-data" method="POST">
                                        {{ csrf_field() }}
                                        <div id="img" data-img="shop" data-error="@error('img'){{ $message }}@enderror" data-image={!! $shop->image !!}>
                                            </div>
                                            <div class="position-relative row form-group mb-4"><label for="name" class="col-sm-2 col-form-label">Nom</label>
                                                <div class="col-sm-10 col-lg-6"><input name="name" id="name" placeholder="Nom" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $shop->name }}">
                                                {!! $errors->first('name', '<span class="help-block text-danger">:message</span>') !!}
                                                <small class="form-text text-muted">Exemple: Boulangerie des 4 continents</small>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group mb-4"><label for="description" class="col-sm-2 col-form-label">Description</label>
                                                <div class="col-sm-10 col-lg-6"><textarea name="description" id="description" placeholder="Description" type="text" class="form-control @error('description') is-invalid @enderror">{{ $shop->description }}</textarea>
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
                                                <div class="col-sm-10 col-lg-6"><textarea name="address" id="address" placeholder="Adresse" type="text" class="form-control @error('address') is-invalid @enderror">{{ $shop->address }}</textarea>
                                                {!! $errors->first('address', '<span class="help-block text-danger">:message</span>') !!}
                                                <small class="form-text text-muted">Exemple: 15 Boulevard du Montparnasse, 75014 Paris</small>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group mb-4"><label for="latitude" class="col-sm-2 col-form-label">Latitude</label>
                                                <div class="col-sm-10 col-lg-6"><input name="latitude" id="latitude" placeholder="Latitude" type="text" class="form-control @error('latitude') is-invalid @enderror" value="{{ $shop->latitude }}">
                                                {!! $errors->first('latitude', '<span class="help-block text-danger">:message</span>') !!}
                                                <small class="form-text text-muted">Exemple: 48.8534</small>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group mb-4"><label for="longitude" class="col-sm-2 col-form-label">Longitude</label>
                                                <div class="col-sm-10 col-lg-6"><input name="longitude" id="longitude" placeholder="Longitude" type="text" class="form-control @error('longitude') is-invalid @enderror" value="{{ $shop->longitude }}">
                                                {!! $errors->first('longitude', '<span class="help-block text-danger">:message</span>') !!}
                                                <small class="form-text text-muted">Exemple: 2.3488</small>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group mb-4"><label for="category" class="col-sm-2 col-form-label">Catégorie</label>
                                                <div class="col-sm-10 col-lg-6">
                                                   <select name="category" id="category" class="form-control mb-4">
                                                        <option value="{{ $shop->category->id }}">{{ $shop->category->category }}</option>
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
                                                      <option value="{{ $shop->type }}">{{ $type[$shop->type] }}</option>
                                                      <option value="1">Commerce</option>
                                                      <option value="2">Restaurant</option>
                                                      <option value="3">Service</option>
                                                   </select>
                                                   {!! $errors->first('type', '<span class="help-block text-danger">:message</span>') !!}
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
                                                    <button style="background:#e3342f;color:#fff;" type="submit" name="delete" value="true" class="btn mx-4">Supprimer</button>
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

