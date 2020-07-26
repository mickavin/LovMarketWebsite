@extends('layouts.dashboard')
@section('content')
   <div class="app-main__outer">
                    <div class="app-main__inner">

                        <div>
                            <div>
                                <div class="main-card mb-3 card">
                                    <div class="card-body"><h5 class="card-title">Formulaire de modification de produit</h5>
                                        <form action="{{ action('ProductController@update',[$product]) }}" enctype="multipart/form-data" method="POST">
                                        {{ csrf_field() }}
                                        <div id="img" data-img="product" data-error="@error('img'){{ $message }}@enderror" data-image={!! $product->image !!}>
                                            </div>
                                            <div class="position-relative row form-group mb-4"><label for="nom" class="col-sm-2 col-form-label">Nom</label>
                                                <div class="col-sm-10 col-lg-6"><input value="{{ $product->name }}" name="nom" id="nom" placeholder="Nom" type="text" class="form-control  @error('nom') is-invalid @enderror">
                                                {!! $errors->first('nom', '<span class="help-block text-danger">:message</span>') !!}
                                                <small class="form-text text-muted">Exemple: Farine de blé</small>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group mb-4"><label for="description" class="col-sm-2 col-form-label">Description</label>
                                                <div class="col-sm-10 col-lg-6"><input value="{{ $product->description }}" name="description" id="description" placeholder="Description" type="text" class="form-control  @error('description') is-invalid @enderror">
                                                {!! $errors->first('description', '<span class="help-block text-danger">:message</span>') !!}
                                                <small class="form-text text-muted">Exemple: 1000g</small>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group mb-4"><label for="prix" class="col-sm-2 col-form-label">Prix</label>
                                                <div class="col-sm-10 col-lg-6"><input value="{{ $product->price}}" name="prix" id="prix" placeholder="Prix" type="text" class="form-control  @error('prix') is-invalid @enderror">
                                                {!! $errors->first('prix', '<span class="help-block text-danger">:message</span>') !!}
                                                <small class="form-text text-muted">Exemple: 1.30</small>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group mb-4"><label for="categorie" class="col-sm-2 col-form-label">Catégorie</label>
                                                <div class="col-sm-10 col-lg-6">
                                                   <select name="categorie" id="categorie" class="form-control mb-4">
                                                      @if(isset($product->category_id))
                                                      <option value="{{ $product->category->id }}">{{ $product->category->category }}</option>
                                                      @else
                                                      <option value=""></option>
                                                      @endif
                                                      @foreach($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->category }}</option>
                                                      @endforeach
                                                   </select>
                                                </div>
                                            </div>
                                            <div id="drop"
                                            data-errors="@error('nouveau_prix'){{ $message }}@enderror"
                                            data-value="{{ $product->new_price }}">
                                            </div>
                                            <div class="position-relative row form-check mt-3">
                                                <div class="col-sm-10 col-lg-6 offset-sm-2">
                                                    <button class="btn btn-primary">Modifier</button>
                                                    <button style="background:#e3342f;color:#fff;" type="submit" name="delete" value="true" class="btn mx-4">Supprimer</button>
                                                    @if($product->activated === 0)
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
                                                <div class="col-sm-10 col-lg-6 offset-sm-2">
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

