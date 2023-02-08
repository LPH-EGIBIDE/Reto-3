<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Creación de cuenta</title>
</head>
<body>
    <p>Hola {{$data->nombre}}, tu cuenta se ha creado correctamente. Para iniciar sesión, introduce la contraseña y cámbiala en el siguiente inicio de sesión.</p>
    <p>Usuario: {{$data->email}}</p>
    <p>Contraseña: {{$data->password}}</p>
</body>
</html>
