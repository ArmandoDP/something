<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Producto;
use App\Models\Vendedor;    
use Illuminate\Http\RedirectResponse;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = Venta::all();
        return view('ventas_index', compact('ventas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::all();
        $vendedores = Vendedor::all();

        return view('crear_venta', compact('productos', 'vendedores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {
        // Venta::create($request->all());
        $request->validate([
            'producto_id' => 'required',
            'vendedor_id' => 'required',
            'cantidad' => 'required|numeric|min:1',
            // Otros campos requeridos según tus necesidades
        ]);

        // Obtener el precio del producto desde la base de datos
        $producto = Producto::findOrFail($request->producto_id);
        $precio = $producto->precio;

        // Calcular el total
        $cantidad = $request->input('cantidad');
        $total = $precio * $cantidad;

        // Guardar la venta con la cantidad y el total calculados
        Venta::create([
            'producto_id' => $request->producto_id,
            'vendedor_id' => $request->vendedor_id,
            'cantidad' => $cantidad,
            'total' => $total,
            // Otros campos de la venta
        ]);
        return redirect()->route('homes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $venta = Venta::findOrFail($id);
        $productos = Producto::all();
        $vendedores = Vendedor::all();

        return view('editar_venta', compact('venta', 'productos', 'vendedores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id):RedirectResponse
    {
        $request->validate([
            'producto_id'=> '',
            'vendedor_id'=> '',
            'precio' => '',
            'cantidad' => '',
        ]);

        $venta = Venta::findOrFail($id);

        $venta->producto_id = $request->producto_id;
        $venta->vendedor_id = $request->vendedor_id;
        $venta->producto->precio = $request->precio;
        $venta->cantidad = $request->cantidad;

        if ($request->has('cantidad')) {
            $venta->total = $venta->producto->precio * $request->cantidad;
        }

        $venta->save();
        return redirect()->route('ventas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
