<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear Venta</title>
</head>

<body>
    <section>
        <form method="POST" action="{{ route('ventas.store') }}">
            @csrf

            <label for="producto_id">Producto:</label>
            <select name="producto_id" id="producto_id" onchange="actualizarPrecio()">
                @foreach($productos as $producto)
                <option value="{{ $producto->id }}" data-precio="{{ $producto->precio }}">{{ $producto->nombre }}
                </option>
                @endforeach
            </select>

            <label for="vendedor_id">Vendedor:</label>
            <select name="vendedor_id" id="vendedor_id">
                @foreach($vendedores as $vendedor)
                <option value="{{ $vendedor->id }}">{{ $vendedor->nombre }}</option>
                @endforeach
            </select>

            <label for="cantidad">Cantidad:</label>
            <input type="number" name="cantidad" id="cantidad" oninput="calcularTotal()">

            <label for="precio">Precio:</label>
            <input type="text" name="precio" id="precio" readonly>

            <label for="total">Total:</label>
            <input type="number" name="total" id="total" readonly>

            <button type="submit">Guardar</button>
        </form>

        <script>
            const actualizarPrecio = () => {
                let selectProducto = document.getElementById('producto_id');
                let precioSeleccionado = selectProducto.options[selectProducto.selectedIndex].getAttribute('data-precio');
                document.getElementById('precio').value = precioSeleccionado;
                calcularTotal();
            }
        
            const calcularTotal = () => {
                let precio = parseFloat(document.getElementById('precio').value);
                let cantidad = parseInt(document.getElementById('cantidad').value);
                let total = isNaN(precio) || isNaN(cantidad) ? 0 : precio * cantidad;
                document.getElementById('total').value = total;
            }
        
            window.onload = actualizarPrecio();
            
        </script>
    </section>
</body>

</html>