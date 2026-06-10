@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h4 class="mb-0">Панель админа</h4>
                    </div>
                    <div class="card-body">

                        <div class="row mb-4">
                            <div class="">
                                <div class="card bg">
                                    <div class="card-body text-center">
                                        <h5 class="">Заявки на рассмотрении</h5>
                                        <h2 class="display-4">{{ $stats['pending_requests'] ?? 0 }}</h2>
                                        <a href="{{ route('admin.requests.index') }}" class="btn btn-light btn-sm">
                                            Просмотреть все
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="">
                                <div class="card bg">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Всего пользователей</h5>
                                        <h2 class="display-4">{{ $stats['total_users'] ?? 0 }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="mt-5">
                            <div class="">
                                <h4>Ожидающие заявки на смену роли</h4>
                            </div>
                            <hr>

                            @if(isset($pendingRequests) && $pendingRequests->total() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle">
                                        <thead class="table-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Пользователь</th>
                                            <th>Текущая роль</th>
                                            <th>Запрашиваемая роль</th>
                                            <th>Причина</th>
                                            <th>Дата подачи</th>
                                            <th>Действия</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($pendingRequests as $request)
                                            <tr>
                                                <td>#{{ $request->id }}</td>
                                                <td>
                                                    <strong>{{ $request->user->name }}</strong><br>
                                                    <small class="text">{{ $request->user->email }}</small>
                                                </td>
                                                <td><span class="">{{ $request->user->role }}</span></td>
                                                <td><span class="">{{ $request->requested_role }}</span></td>
                                                <td>

                                                    <div class="" id="{{ $request->id }}">
                                                        <div class="">
                                                            <div class="">
                                                                <div class="">
                                                                    <h6 class="">Причина запроса от {{ $request->user->name }}</h6>

                                                                </div>
                                                                <div class="">
                                                                    <p class="mb-0">{{ $request->reason ?? 'Причина не указана' }}</p>
                                                                </div>
                                                                <div class="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $request->created_at->format('d.m.Y H:i') }}</td>
                                                <td>
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <form action="{{ route('admin.requests.approve', $request) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn btn-success" onclick="return confirm('Одобрить заявку?')">
                                                                Одобрить
                                                            </button>
                                                        </form>
                                                        <a href="{{ route('admin.requests.show', $request) }}" class="btn btn-danger">
                                                            Отклонить
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="">
                                    {{ $pendingRequests->links() }}
                                </div>
                            @else
                                <div class="alert alert-success">
                                    <i class=""></i> Нет ожидающих заявок на смену роли
                                </div>
                            @endif
                        </div>

                        <div class="mt-4">
                            <hr>
                            <div class="btn-group" role="">
                                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger">Выйти</button>
                                </form>
                            </div>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
