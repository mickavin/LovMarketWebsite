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
                        <div>
                            <div>
                                <div class="main-card mb-3 card">
                                    <div class="card-body"><h5 class="card-title">Sélectionnez un commerce</h5>
                                        <form action="{{ route('shop.search') }}" enctype="multipart/form-data" method="POST">
                                        {{ csrf_field() }}
                                        <div id="search-shop"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
@endsection('content')

