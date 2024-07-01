<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de Reservación de Habitación</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #0056b3;
            text-align: center;
        }
        p {
            margin-bottom: 15px;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        ul li {
            margin-bottom: 10px;
        }
        ul li ul {
            margin-top: 5px;
            margin-left: 20px;
        }
        .signature {
            margin-top: 20px;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Solicitud de Reservación de Habitación</h1>
        <p>Estimado/a <strong>"Equipo de Reservaciones del Hotel San Antonio"</strong>:</p>

        <p>Espero que este mensaje le encuentre bien. Me dirijo a ustedes para solicitar la reservación de una habitación en su prestigioso hotel. A continuación, detallo la información necesaria para la reserva:</p>

        <ul>
            <li><strong>Nombre:</strong>{{ session('nombre') }} {{ session('apellido') }} </li>
            <li><strong>Fechas de Estancia: {{ $data['fecha_i'] }} al {{ $data['fecha_f'] }} </strong>
                <ul>
                    <li>Fecha de llegada: {{ $data['fecha_i'] }}</li>
                    <li>Fecha de salida: {{ $data['fecha_f'] }}</li>
                </ul>
            </li>
            <li><strong>Tipo de Habitación:</strong>{{ $data['tipo'] }}</li>
        </ul>

        <p>Agradecería me pudieran confirmar la disponibilidad de la habitación solicitada y el procedimiento a seguir para completar la reserva. Si es necesario, puedo proporcionar cualquier información adicional que requieran.</p>

        <p>Muchas gracias por su atención y quedo a la espera de su pronta respuesta.</p>

        <p class="signature">Atentamente,<br>
            {{ session('nombre') }} {{ session('apellido') }} <br>
        {{ session('telefono') }}<br>
        {{ session('correo') }}</p>
    </div>
</body>
</html>
