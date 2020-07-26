<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Tableau de bord</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="msapplication-tap-highlight" content="no">
    <!--
    =========================================================
    * ArchitectUI HTML Theme Dashboard - v1.0.0
    =========================================================
    * Product Page: https://dashboardpack.com
    * Copyright 2019 DashboardPack (https://dashboardpack.com)
    * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
    =========================================================
    * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
    -->
<link href="{{ asset('css/main.css') }}" rel="stylesheet"/>
@yield('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/solid.min.css" rel="stylesheet"/>
</head>
<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <div class="logo-src"></div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>    <div class="app-header__content">
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">
                                        {{ Auth::user()->name }}
                                    </div>
                                    @if(isset(Auth::user()->shopId))
                                    <div class="widget-subheading">
                                        {{ Auth::user()->shop->name }}
                                    </div>
                                    @endif
                                </div>
                                <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Déconnexion') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>        </div>
            </div>
        </div>
        <div class="app-main">
                <div class="app-sidebar sidebar-shadow">
                    <div class="app-header__logo">
                        <div class="logo-src"></div>
                        <div class="header__pane ml-auto">
                            <div>
                                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="app-header__mobile-menu">
                        <div>
                            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="app-header__menu">
                        <span>
                            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                                <span class="btn-icon-wrapper">
                                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                                </span>
                            </button>
                        </span>
                    </div>    <div class="scrollbar-container" style="width:100%">
                        <div class="app-sidebar__inner">
                            <ul class="vertical-nav-menu">
                                    @if(Auth::user()->is_admin === 0 && isset(Auth::user()->shopId))
                                    <li class="app-sidebar__heading">Mon commerce</i></li>
                                    <li>
                                        <a href="{{ route('shop.show')}}">
                                                <i class="metismenu-icon fas fa-store-alt"></i>
                                                Informations du commerce
                                        </a>
                                    </li>
                                    @endif
                                    @if(Auth::user()->isAdmin())
                                    <li class="app-sidebar__heading">Utilisateurs</i></li>
                                    <li>
                                        <a href="{{ route('requestInvitation')}}">
                                          <i class="metismenu-icon fas fa-envelope-open-text"></i>
                                            Envoyer une invitation
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('showInvitations')}}">
                                          <i class="metismenu-icon fas fa-envelope"></i>
                                            Liste des invitations
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('user.index')}}">
                                            <i class="metismenu-icon fas fa-users"></i>
                                            Liste des utilisateurs
                                        </a>
                                    </li>
                                    <li class="app-sidebar__heading">Clients</i></li>
                                    <li>
                                        <a href="{{ route('customer.index')}}">
                                          <i class="metismenu-icon fas fa-users"></i>
                                            Liste des clients
                                        </a>
                                    </li>
                                    <li class="app-sidebar__heading">Commerces</i></li>
                                    <li>
                                        <a href="{{ route('shop.create') }}">
                                            <i class="metismenu-icon fas fa-plus"></i>
                                            Ajout de commerce
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('shop.index') }}">
                                            <i class="metismenu-icon fas fa-store-alt"></i>
                                            Liste des commerces
                                        </a>
                                    </li>
                                    <li>
                                            <a href="{{ route('shop.search.get') }}">
                                                <i class="metismenu-icon fas fa-search"></i>
                                                Rechercher un commerce
                                            </a>
                                        </li>
                                    <li class="app-sidebar__heading">Catégories des commerces</i></li>
                                    <li>
                                        <a href="{{route('category.shop.create')}}">
                                            <i class="metismenu-icon fas fa-plus"></i>
                                            Ajout de catégorie
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('category.shop.index') }}">
                                            <i class="metismenu-icon fas fa-tags"></i>
                                            Liste des catégories
                                        </a>
                                    </li>
                                    <li class="app-sidebar__heading">Commandes</i></li>
                                    <li>
                                        <a href="{{ route('admin.order.index')}}">
                                          <i class="metismenu-icon fas fa-receipt"></i>
                                            Liste des commandes
                                        </a>
                                    </li>
                                    @endif
                                @if(Auth::user()->is_admin === 0 && isset(Auth::user()->shopId))
                                <li class="app-sidebar__heading">Produits</i></li>
                                <li>
                                    <a href="{{ route('product.create') }}">
                                      <i class="metismenu-icon fas fa-plus"></i>
                                        Ajout de produit
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('product.index') }}">
                                      <i class="metismenu-icon fas fa-list-alt"></i>
                                        Liste des produits
                                    </a>
                                </li>
                                <li class="app-sidebar__heading">Catégories des produits</i></li>
                                <li>
                                    <a href="{{ route('category.create') }}">
                                        <i class="metismenu-icon fas fa-plus"></i>
                                        Ajout de catégorie
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('category.product.index') }}">
                                        <i class="metismenu-icon fas fa-tags"></i>
                                        Liste des catégories
                                    </a>
                                </li>
                                <li class="app-sidebar__heading">Commandes</i></li>
                                    <li>
                                        <a href="{{ route('order.index')}}">
                                          <i class="metismenu-icon fas fa-receipt"></i>
                                            Liste des commandes
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                @yield('content')
    </div>
<script type="text/javascript" src="{{ asset('assets/scripts/main.js') }}"></script>
<script type="text/javascript" src="{!! asset('js/app.js') !!}"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/js/solid.min.js"></script>
</body>
</html>
