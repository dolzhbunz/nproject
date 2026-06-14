@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Создание нового события</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label>Название события:</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" required>
                                @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label>Описание:</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3"></textarea>
                                @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label>Дата и время начала:</label>
                                <input type="datetime-local" name="start_time" class="form-control @error('start_time') is-invalid @enderror" required>
                                @error('start_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label>Дата и время окончания:</label>
                                <input type="datetime-local" name="end_time" class="form-control @error('end_time') is-invalid @enderror" required>
                                @error('end_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="attachments" class="form-label">Вложения (максимум 5 файлов, каждый до 5MB):</label>
                                <input type="file" name="attachments[]" multiple class="form-control" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.txt">
                                <small class="text-muted">Поддерживаются: jpg, jpeg, png, pdf, doc, docx, txt</small>
                            </div>

                            <button type="submit" class="btn btn-primary">Создать событие</button>
                            <a href="{{ route('events.index') }}" class="btn btn-secondary">Отмена</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
