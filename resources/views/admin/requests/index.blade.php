@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <h2>Ожидающие заявки на смену роли</h2>
                <p class="text-muted">Всего заявок: {{ $pendingRequests->total() }}</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('info'))
            <div class="alert alert-info">{{ session('info') }}</div>
        @endif

        <div class="row">
            @forelse($pendingRequests as $request)
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header bg-warning">
                            <strong>Заявка #{{ $request->id }}</strong>
                            <span class="badge bg-dark float-end">{{ $request->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $request->user->name }}</h5>
                            <p class="text-muted">{{ $request->user->email }}</p>

                            <div class="mb-2">
                                <strong>Текущая роль:</strong>
                                <span class="badge bg-secondary">{{ $request->user->role }}</span>
                            </div>

                            <div class="mb-2">
                                <strong>Запрашиваемая роль:</strong>
                                <span class="badge bg-primary">{{ $request->requested_role }}</span>
                            </div>

                            <div class="mb-3">
                                <strong>Причина:</strong>
                                <p class="mt-1 p-2 bg-light rounded">{{ $request->reason }}</p>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.requests.show', $request) }}"
                               class="btn btn-primary w-100">
                                Рассмотреть заявку
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-success">
                        <h4 class="alert-heading">Нет ожидающих заявок!</h4>
                        <p>Все заявки обработаны. Отличная работа!</p>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="row">
            <div class="col-12">
                {{ $pendingRequests->links() }}
            </div>
        </div>
    </div>
@endsection
