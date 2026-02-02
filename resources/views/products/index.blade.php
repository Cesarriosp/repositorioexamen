@extends('layouts.app')

@section('title', 'Lista de Productos')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-between align-center">
        <span>Productos</span>
        <a href="{{ route('products.create') }}" class="btn btn-success">+ Nuevo Producto</a>
    </div>

    @if($products->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Fecha Creación</th>
                    <th style="text-align: center;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->nombre }}</td>
                        <td>{{ number_format($product->precio, 2) }} €</td>
                        <td>
                            @if($product->stock > 10)
                                <span style="color: #27ae60; font-weight: 600;">{{ $product->stock }}</span>
                            @elseif($product->stock > 0)
                                <span style="color: #f39c12; font-weight: 600;">{{ $product->stock }}</span>
                            @else
                                <span style="color: #e74c3c; font-weight: 600;">{{ $product->stock }}</span>
                            @endif
                        </td>
                        <td>{{ $product->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <div style="display: flex; gap: 5px; justify-content: center;">
                                <a href="{{ route('products.show', $product) }}" class="btn btn-primary btn-sm">Ver</a>
                                <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de eliminar este producto?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination" style="margin-top: 20px;">
            {{ $products->links() }}
        </div>
    @else
        <div style="text-align: center; padding: 40px; color: #7f8c8d;">
            <p style="font-size: 18px; margin-bottom: 20px;">No hay productos registrados</p>
            <a href="{{ route('products.create') }}" class="btn btn-success">Crear el primer producto</a>
        </div>
    @endif
</div>
@endsection
