<!DOCTYPE html>
<html lang="pt-BR" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> 

    <!-- CSS -->
    <link rel="stylesheet" href="/csslogin.css">
    <!-- End CSS -->
    <title>Login Chat Dev - OpenAI</title>
</head>
<body>
    <main class="container">
    <form action="/login" method="POST">
        @csrf
        <h1>Login DevChat</h1>
        <div class="input">
            <input placeholder="Usuário" type="email" name="email" required>
            <i class="bx bxs-user"></i>
        </div>
        <div class="input">
            <input placeholder="Senha" type="password" name="password" required>
            <i class="bx bxs-lock-alt"></i>
        </div>
        <div class="remember">
            <label>
                <input type="checkbox">
                Lembre-se de mim
            </label>
            <a href="#">Esqueci minha senha</a>
        </div>
        <button type="submit" class="login">Login</button>
    </form>

    </main>

    <script src="../js/script.js"></script>
</body>
</html>
