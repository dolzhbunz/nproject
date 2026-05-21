<!DOCTYPE html>
<html>
<head>
    <title>Вход</title>
</head>
<body>
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
</form>

@if ($errors->any())
    <div style="color: red;">
        {{ $errors->first() }}
    </div>
    @endif
    </form>
</body>
</html>
