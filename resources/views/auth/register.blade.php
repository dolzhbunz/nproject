@extends('layouts.app')

@section('content')
    <style>
        form{
            display:flex;
        }
    </style>
    <div class="row justify-content-center">
        <div class="card-header bd-green"> <h4>Регистрация нового пользователя</h4> </div>

        <div class="card-body">
            <form method="post" action="{{route('register.post')}}">
                @csrf

                <div class="mb-3">
                    <label>Имя:
                        <input type="text" name="name" class="form-control" value="{{old('name')}}">
                    </label>
                </div>

                <div class="mb-3">
                    <label>Email:
                        <input type="email" name="email" class="form-control" value="{{old('email')}}">
                    </label>
                </div>

                <div class="mb-3">
                    <label>Пароль:
                        <input type="password" name="password" class="form-control">
                    </label>
                </div>

                <div class="mb-3">
                    <label>Потверждение пароля:
                        <input type="password" name="password_confirmation" class="form-control">
                    </label>
                </div>

                <button type="submit" class="btn btn-primary w-200">Зарегистрироваться</button>
            </form>
        </div>

    </div>
