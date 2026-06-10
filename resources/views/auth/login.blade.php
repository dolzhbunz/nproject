@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Вход</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login.post') }}">
                        @csrf
                        <div>
                            <label>Email:</label>
                            <input type="email" name="email" required>
                        </div>
                        <div>
                            <label>Пароль:</label>
                            <input type="password" name="password" required>
                        </div>
                        <button type="submit">Войти</button>
                        @if ($errors->any())
                            <div style="color: red;">
                                {{ $errors->first() }}
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
