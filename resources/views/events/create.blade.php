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
        <form method="post" action="{{ route('events.store') }}">
            @csrf

            <div class="mb-3">
                <label>Название события:</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Описание:</label>
                <textarea name="description" class="form-control" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label>Дата и время начала:</label>
                <input type="datetime-local" name="start_time" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Дата и время окончания:</label>
                <input type="datetime-local" name="end_time" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Создать событие</button>
        </form>
    </div>

    <div class="mb-3">
        <label for="attachments" class="form-label">Вложения</label>
        <input type="file" name="attachments[]" multiple class="form-control" accept=".jpg,.png,.pdf,.doc,.docx,.txt">
        <small class="text-muted">Максимум 5 файлов, каждый до 5MB</small>
    </div>
</main>
</body>
</html>
