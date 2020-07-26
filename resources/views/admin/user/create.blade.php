@extends('layouts.dashboard')
@section('content')
   <div class="app-main__outer">
                    <div class="app-main__inner">

                        <div>
                            <div>
                                <div class="main-card mb-3 card">
                                    <div class="card-body"><h5 class="card-title">Formulaire d'ajout d'utilisateurs</h5>
                                        <form action="{{ route('user.postcreate') }}" enctype="multipart/form-data" method="POST">
                                        {{ csrf_field() }}
                                            <div class="position-relative row form-group mb-4"><label for="nom" class="col-sm-2 col-form-label">Nom</label>
                                                <div class="col-sm-6"><input name="nom" id="nom" placeholder="Nom" type="text" class="form-control @error('nom') is-invalid @enderror">
                                                {!! $errors->first('nom', '<span class="help-block text-danger">:message</span>') !!}
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group mb-4"><label for="email" class="col-sm-2 col-form-label">E-Mail</label>
                                                <div class="col-sm-6"><input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required>
                                                {!! $errors->first('email', '<span class="help-block text-danger">:message</span>') !!}
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group mb-4"><label for="prix" class="col-sm-2 col-form-label">Mot de passe</label>
                                                <div class="col-sm-6"><input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                                    {!! $errors->first('email', '<span class="help-block text-danger">:message</span>') !!}
                                                </div>
                                                {!! $errors->first('password', '<span class="help-block text-danger">:message</span>') !!}
                                            </div>
                                            <div class="position-relative row form-group mb-4"><label for="shop" class="col-sm-2 col-form-label">Commerce lié</label>
                                                <div class="col-sm-6">
                                                   <select name="shop" id="shop" class="form-control mb-4">
                                                      <option value=""></option>
                                                   </select>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="position-relative row form-check mt-3">
                                                <div class="col-sm-6 offset-sm-2">
                                                    <button class="btn btn-primary">Créer</button>
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

