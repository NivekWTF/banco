<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sucursal #1</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">SUCURSAL #1</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if (session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif
        <form action="{{ route('abrir-caja') }}" method="POST">
            @csrf
            
            <div class="text-center">
                <button type="submit" class="btn btn-primary my-2">Abrir caja</button>
            </div>
        </form>
        <form action="{{ route('entregar-billetes') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="importe">Importe:</label>
                <input type="number" class="form-control" id="importe" name="importe" placeholder="Ingrese el importe">
            </div>
            <div class="alert alert-warning" role="alert">
                Detalle de los billetes a entregar
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-secondary my-2">Entregar billetes</button>
            </div>
        </form>
        @isset($billetesEntregados)
            <div class="mt-4">
                <h2 class="text-center">Billetes Entregados</h2>
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
            </div>
        @endisset
        <div class="text-center">
            <form action="{{ route('agregar-billetes') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-success my-2">Agregar billetes</button>
            </form>
            <button action type="button" class="btn btn-danger my-2">Corte de caja</button>
            <a href="/prueba">Regreso</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>