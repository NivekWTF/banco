<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billetes Entregados</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Billetes Entregados</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Denominación</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($billetesEntregados as $billete)
                    <tr>
                        <td>{{ $billete['denominacion'] }}</td>
                        <td>{{ $billete['cantidad'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-center">
            <a href="{{ url()->previous() }}" class="btn btn-primary">Volver</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>