@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2>События</h2>
                    <a href="{{ route('events.create') }}" class="btn btn-primary">Создать событие</a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if($events->count() > 0)
                    <div class="row">
                        @foreach($events as $event)
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $event->title }}</h5>
                                        <p class="card-text">{{ Str::limit($event->description, 100) }}</p>
                                        <p class="text-muted">
                                            <small>Начало: {{ $event->start_time }}</small><br>
                                            <small>Конец: {{ $event->end_time }}</small>
                                        </p>
                                        <a href="{{ route('events.show', $event->id) }}" class="btn btn-sm btn-info">Просмотр</a>
                                        <a href="{{ route('events.edit', $event->id) }}" class="btn btn-sm btn-warning">Редактировать</a>
                                        <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Удалить событие?')">Удалить</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $events->links() }}
                    </div>
                @else
                    <div class="alert alert-info">Нет событий. Создайте первое!</div>
                @endif
            </div>
        </div>
    </div>
@endsection
