@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Редактирование события</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('events.update', $event->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label>Название события:</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $event->title) }}" required>
                                @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label>Описание:</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description', $event->description) }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label>Дата и время начала:</label>
                                <input type="datetime-local" name="start_time" class="form-control @error('start_time') is-invalid @enderror" value="{{ date('Y-m-d\TH:i', strtotime($event->start_time)) }}" required>
                                @error('start_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label>Дата и время окончания:</label>
                                <input type="datetime-local" name="end_time" class="form-control @error('end_time') is-invalid @enderror" value="{{ date('Y-m-d\TH:i', strtotime($event->end_time)) }}" required>
                                @error('end_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Обновить</button>
                            <a href="{{ route('events.index') }}" class="btn btn-secondary">Отмена</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
