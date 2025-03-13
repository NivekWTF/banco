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
        <form>
            <div class="form-group">
                <label for="importe">Importe</label>
                <input type="number" class="form-control" id="importe" placeholder="Ingrese el importe">
            </div>
            <div class="alert alert-warning" role="alert">
                Detalle de los billetes a entregar
            </div>
            <div class="text-center">
                <button type="button" class="btn btn-primary m-2">Abrir caja</button>
                <button type="button" class="btn btn-secondary m-2">Cambiar cheque</button>
                <button type="button" class="btn btn-success m-2">Agregar billetes</button>
                <button type="button" class="btn btn-danger m-2">Corte de caja</button>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>