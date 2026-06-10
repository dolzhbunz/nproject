@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Заявка #{{ $roleRequest->id }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong>Пользователь:</strong>
                            <a href="{{ route('admin.users.show', $roleRequest->user) }}">
                                {{ $roleRequest->user->name }} ({{ $roleRequest->user->email }})
                            </a>
                        </div>

                        <div class="mb-3">
                            <strong>Текущая роль:</strong>
                            <span class="badge bg-secondary">{{ $roleRequest->user->role }}</span>
                        </div>

                        <div class="mb-3">
                            <strong>Запрашиваемая роль:</strong>
                            <span class="badge bg-primary">{{ $roleRequest->requested_role }}</span>
                        </div>

                        <div class="mb-3">
                            <strong>Причина:</strong>
                            <div class="p-3 bg-light rounded">
                                {{ $roleRequest->reason }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <strong>Статус:</strong>
                            @if($roleRequest->status == 'pending')
                                <span class="badge bg-warning">На рассмотрении</span>
                            @elseif($roleRequest->status == 'approved')
                                <span class="badge bg-success">Одобрена</span>
                            @else
                                <span class="badge bg-danger">Отклонена</span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <strong>Дата подачи:</strong>
                            {{ $roleRequest->created_at->format('d.m.Y H:i') }}
                        </div>
                    </div>
                </div>

                {{-- Комментарии --}}
                <div class="card mt-3">
                    <div class="card-header">
                        <h5>Комментарии администратора</h5>
                    </div>
                    <div class="card-body">
                        @if($roleRequest->logs->count() > 0)
                            @foreach($roleRequest->logs as $log)
                                <div class="mb-2 pb-2 border-bottom">
                                    <strong>{{ $log->admin->name }}</strong>
                                    <small class="text-muted">{{ $log->created_at->format('d.m.Y H:i') }}</small>
                                    <p class="mb-0">{{ $log->comment }}</p>
                                </div>
                            @endforeach
                        @else
                            <p class="text-muted">Нет комментариев</p>
                        @endif

                        {{-- Форма для комментария при обработке --}}
                        @if($roleRequest->status == 'pending')
                            <hr>
                            <h6>Обработать заявку:</h6>

                            <form action="{{ route('admin.requests.approve', $roleRequest) }}" method="POST" class="mb-2">
                                @csrf
                                @method('PUT')
                                <div class="mb-2">
                                    <textarea name="comment" class="form-control" rows="2" placeholder="Комментарий для пользователя..."></textarea>
                                </div>
                                <button type="submit" class="btn btn-success" onclick="return confirm('Одобрить заявку?')">
                                    Одобрить
                                </button>
                            </form>

                            <form action="{{ route('admin.requests.reject', $roleRequest) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-2">
                                    <textarea name="comment" class="form-control" rows="2" placeholder="Причина отклонения..." required></textarea>
                                </div>
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Отклонить заявку?')">
                                    Отклонить
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Информация о пользователе</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Имя:</strong> {{ $roleRequest->user->name }}</p>
                        <p><strong>Email:</strong> {{ $roleRequest->user->email }}</p>
                        <p><strong>Роль:</strong> {{ $roleRequest->user->role }}</p>
                        <p><strong>Всего заявок:</strong> {{ $roleRequest->user->requests->count() }}</p>
                        <a href="{{ route('admin.users.show', $roleRequest->user) }}" class="btn btn-info btn-sm">
                            Подробнее о пользователе
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
