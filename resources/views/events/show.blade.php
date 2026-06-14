@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $event->title }}</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Описание:</strong></p>
                        <p>{{ $event->description ?? 'Нет описания' }}</p>

                        <p><strong>Начало:</strong> {{ $event->start_time }}</p>
                        <p><strong>Конец:</strong> {{ $event->end_time }}</p>
                        <p><strong>Создано:</strong> {{ $event->created_at->format('d.m.Y H:i') }}</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('events.index') }}" class="btn btn-secondary">Назад</a>
                        <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning">Редактировать</a>

                        <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Удалить событие?')">Удалить</button>

                            {{-- Вложения --}}
                            @if($event->attachments->count() > 0)
                                <div class="mt-4">
                                    <strong>Вложения ({{ $event->attachments->count() }}):</strong>
                                    <ul class="list-group mt-2">
                                        @foreach($event->attachments as $attachment)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <div>
                                                    <i class="bi bi-file-earmark"></i>
                                                    {{ $attachment->file_name }}
                                                    <span class="badge bg-secondary ms-2">{{ round($attachment->size / 1024) }} KB</span>
                                                </div>
                                                <div>
                                                    <a href="{{ route('attachments.download', $attachment) }}" class="btn btn-sm btn-outline-primary">
                                                        Скачать
                                                    </a>
                                                    @can('delete', $attachment)
                                                        <form action="{{ route('attachments.destroy', $attachment) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Удалить файл?')">
                                                                Удалить
                                                            </button>
                                                        </form>
                                                    @endcan
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @else
                                <div class="mt-4 text-muted">Нет прикреплённых файлов.</div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
