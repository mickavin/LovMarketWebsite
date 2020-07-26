@extends('layouts.dashboard')
@section('content')
   <div class="app-main__outer">
                    <div class="app-main__inner">

                        <div>
                            <div>
                                <div class="main-card mb-3 card">
                                    <div class="card-body"><h5 class="card-title">Formulaire d'ajout de produit</h5>
                                        <form action="{{ route('product.postcreate') }}" enctype="multipart/form-data" method="POST">
                                        {{ csrf_field() }}
                                        <div id="img" data-img="product" data-error="@error('img'){{ $message }}@enderror">
                                            </div>
                                            <div class="position-relative row form-group mb-4"><label for="nom" class="col-sm-2 col-form-label">Nom</label>
                                                <div class="col-sm-10 col-lg-6"><input name="nom" id="nom" placeholder="Nom" type="text" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom') }}">
                                                {!! $errors->first('nom', '<span class="help-block text-danger">:message</span>') !!}
                                                <small class="form-text text-muted">Exemple: Farine de blé</small>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group mb-4"><label for="description" class="col-sm-2 col-form-label">Description</label>
                                                <div class="col-sm-10 col-lg-6"><input name="description" id="description" placeholder="Description" type="text" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}">
                                                {!! $errors->first('description', '<span class="help-block text-danger">:message</span>') !!}
                                                <small class="form-text text-muted">Exemple: 1000g</small>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group mb-4"><label for="prix" class="col-sm-2 col-form-label">Prix</label>
                                                <div class="col-sm-10 col-lg-6"><input name="prix" id="prix" placeholder="Prix" type="text" class="form-control @error('prix') is-invalid @enderror" value="{{ old('prix') }}">
                                                {!! $errors->first('prix', '<span class="help-block text-danger">:message</span>') !!}
                                                <small class="form-text text-muted">Exemple: 1.30</small>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group mb-4"><label for="categorie" class="col-sm-2 col-form-label @error('categorie') is-invalid  @enderror">Catégorie</label>
                                                <div class="col-sm-10 col-lg-6">
                                                   <select name="categorie" id="categorie" class="form-control mb-4">
                                                      <option value=""></option>
                                                      @foreach($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->category }}</option>
                                                      @endforeach
                                                    </select>
                                                    {!! $errors->first('categorie', '<span class="help-block text-danger">:message</span>') !!}
                                                </div>
                                            </div>
                                            <div id="drop"
                                            data-errors="@error('nouveau_prix'){{ $message }}@enderror"
                                            data-value="{{old('nouveau_prix')}}">
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

