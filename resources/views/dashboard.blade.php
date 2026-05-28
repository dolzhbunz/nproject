@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div>
                <div class="card-header">Dashboard</div>

                <div class="">
                    <h3>Добро пожаловать</h3>
                    <p>Роль: {{Auth::user()->role}}</p>

                    @if(!$hasPendingRequest)
                        <a href="{{route('role-requests.create')}}" class="btn btn-primary">
                            Подать заявку на смену роли
                        </a>
                    @elseif($latestRequest->status == 'pending')
                        <div class="text-center py-3">
                            <h4>Заявка подана, на рассмотрении</h4>
                            <p>Запрошенная роль: {{$latestRequest->requested_role}}</p>
                        </div>
                    @elseif($latestRequest->status == 'approved')
                        <div class="text-center py-3">
                            <h4>Заявка одобрена!</h4>
                            <p>Новая роль: {{$latestRequest->requested_role}}</p>
                        </div>
                    @elseif($latestRequest->status == 'rejected')
                        <div class="text-center py-3">
                            <h4>Заявка отклонена!</h4>
                            <p>Причина: </p>
                        </div>
                    @endif
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger">Выйти</button>
            </form>

        </div>

    </div>
@endsection
