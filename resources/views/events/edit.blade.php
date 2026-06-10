<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<header>
    <h1 class=""> Создание нового события</h1>
    <p class=""></p>
</header>

<main class="main">
    <div >
        <form class="" method="post" action="{{ route('events.update', $event->id) }}">
            @method('PUT')
            @csrf

            <label> Имя события:
                <input type="text" name="title" placeholder="Тема события" value="{{$event->title}}">
            </label>

            <label> Описание события:
                <input type="text" name="description" placeholder="Введи описание события" value="{{$event->description}}">
            </label>

            <label> Начальное время события:
                <input type="" name="start_time" placeholder="" value="{{$event->start_time}}">
            </label>

            <label> Конец события:
                <input type="" name="end_time" placeholder="" value="{{$event->end_time}}">
            </label>
        </form>
    </div>
</main>
</body>
</html>
