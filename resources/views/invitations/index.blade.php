@extends('layouts.dashboard')
@section('content')
   <div class="app-main__outer">
                    <div class="app-main__inner">

                        <div>
                            <div>
                                <div class="main-card mb-3 card">
                                    <div class="card-body"><h5 class="card-title">Liste des invitations</h5>
                                        <div class="container">
                                            <div class="panel panel-default" style="margin-top: 20px">
                                                <div class="panel-heading">Nombre de requêtes <span class="badge">{{ count($invitations) }}</span></div>
                                                <div class="panel-body" style="padding: 0;">
                                                    @if (!empty($invitations))
                                                        <table class="table table-responsive table-striped" style="margin-bottom: 0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Email</th>
                                                                    <th>Crée à</th>
                                                                    <th>Lien de l'invitation</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($invitations as $invitation)
                                                                    <tr>
                                                                        <td><a href="mailto:{{ $invitation->email }}">{{ $invitation->email }}</a></td>
                                                                        <td>{{ $invitation->created_at }}</td>
                                                                        <td>
                                                                            <kbd>{{ $invitation->getLink() }}</kbd>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    @else
                                                        <p>No invitation requests!</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
@endsection('content')

