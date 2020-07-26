@extends('layouts.dashboard')
@section('content')
   <div class="app-main__outer">
                    <div class="app-main__inner">

                        <div>
                            <div>
                                <div class="main-card mb-3 card">
                                    <div class="card-body"><h5 class="card-title">Formulaire d'ajout de catégorie</h5>
                                        <form action="{{ route('category.postcreate') }}" enctype="multipart/form-data" method="POST">
                                        {{ csrf_field() }}
                                            <div class="position-relative row form-group mb-4"><label for="categorie" class="col-sm-2 col-form-label">Catégorie</label>
                                                <div class="col-sm-10 col-lg-6"><input name="categorie" id="categorie" placeholder="Catégorie" type="text" class="form-control @error('categorie') is-invalid @enderror" value="{{ old('categorie') }}">
                                                {!! $errors->first('categorie', '<span class="help-block text-danger">:message</span>') !!}
                                                <small class="form-text text-muted">Exemple: Pâtisserie</small>
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

