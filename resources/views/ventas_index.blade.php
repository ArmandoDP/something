<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>ESTA ES LA VISTA PARA MOSTRAR TODO EL LISTADO DE VENTAS</h1>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Vendedor</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Total</th>
                <th>Accion</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventas as $venta)
            <tr>
                <td>{{ $venta->producto->nombre }}</td>
                <td>{{ $venta->vendedor->nombre }}</td>
                <td>{{ $venta->cantidad }}</td>
                <td>{{ $venta->producto->precio }}</td>
                <td>{{ $venta->total }}</td>
                <td>
                    <a href="{{ route('ventas.edit', $venta->id)}}">
                        <button>Editar</button>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>