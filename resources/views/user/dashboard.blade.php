@extends('layouts.app')

@section('content')
    <div class="col-,d-4">
        <div class="card-body text-center">
            <h3>{{$user->name}}</h3>
            <p class="text-muted">{{$user->email}}</p>
            <span class="bg-primary mb-3 fs-6">Позиция в системе: {{strtoupper($user->role)}}</span>
            <hr>
            <form action="{{route('logout')}}" method="POST">
                @csrf
                <button class="btn bnt-outline-danger w-100" type="submit">Выход из системы</button>
            </form>
        </div>
    </div>
