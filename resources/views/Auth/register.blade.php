<!DOCTYPE html>
<html lang="es">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Crear cuenta | SecureApp</title>
 @vite([
 'resources/css/app.css',
 'resources/js/app.js'
 ])
</head>
<body>
<main class="login-page">
 <section class="login-card">
  <div class="login-header">
   <p class="login-badge">SecureApp</p>
   <h1>Crear cuenta</h1>
   <p>Regístrese para acceder a la plataforma.</p>
  </div>

  @if ($errors->any())
  <div class="alert alert-error" role="alert">
   <strong>No fue posible completar el registro.</strong>
   <ul>
    @foreach ($errors->all() as $error)
     <li>{{ $error }}</li>
    @endforeach
   </ul>
  </div>
  @endif

  @if (session('success'))
  <div class="alert" role="alert">
   {{ session('success') }}
  </div>
  @endif

  <form method="POST" action="{{ route('register.store') }}" class="login-form">
   @csrf
   <div class="form-group">
    <label for="name">Nombre</label>
    <input id="name" type="text" name="name"
     value="{{ old('name') }}"
     autocomplete="name" required autofocus>
   </div>
   <div class="form-group">
    <label for="email">Correo electrónico</label>
    <input id="email" type="email" name="email"
     value="{{ old('email') }}"
     autocomplete="username" required>
   </div>
   <div class="form-group">
    <label for="password">Contraseña</label>
    <div class="password-wrapper">
     <input id="password" type="password" name="password"
      autocomplete="new-password" required>
    </div>
   </div>
   <div class="form-group">
    <label for="password_confirmation">Confirmar contraseña</label>
    <div class="password-wrapper">
     <input id="password_confirmation" type="password" name="password_confirmation"
      autocomplete="new-password" required>
    </div>
   </div>

   <button type="submit" class="button-primary">Registrarme</button>
  </form>
 </section>
</main>
</body>
</html>