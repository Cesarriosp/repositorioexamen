@extends('layouts.app')

@section('title', 'Detalles del Producto')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-between align-center">
        <span>Detalles del Producto</span>
        <a href="{{ route('products.index') }}" class="btn btn-primary"> Volver a la Lista</a>
    </div>

    <div style="padding: 20px;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-bottom: 30px;">
            <div>
                <h3 style="color: #2c3e50; margin-bottom: 15px; font-size: 20px;">Información del Producto</h3>
                
                <div class="form-group">
                    <label style="color: #7f8c8d; font-size: 14px;">ID</label>
                    <p style="font-size: 18px; font-weight: 600; color: #2c3e50;">{{ $product->id }}</p>
                </div>

                <div class="form-group">
                    <label style="color: #7f8c8d; font-size: 14px;">Nombre</label>
                    <p style="font-size: 18px; font-weight: 600; color: #2c3e50;">{{ $product->nombre }}</p>
                </div>

                <div class="form-group">
                    <label style="color: #7f8c8d; font-size: 14px;">Precio</label>
                    <p style="font-size: 24px; font-weight: 700; color: #27ae60;">{{ number_format($product->precio, 2) }} €</p>
                </div>

                <div class="form-group">
                    <label style="color: #7f8c8d; font-size: 14px;">Stock</label>
                    <p style="font-size: 24px; font-weight: 700; 
                        @if($product->stock > 10) color: #27ae60;
                        @elseif($product->stock > 0) color: #f39c12;
                        @else color: #e74c3c;
                        @endif">
                        {{ $product->stock }} unidades
                    </p>
                    @if($product->stock == 0)
                        <span style="background: #e74c3c; color: white; padding: 4px 12px; border-radius: 4px; font-size: 12px;">SIN STOCK</span>
                    @elseif($product->stock <= 10)
                        <span style="background: #f39c12; color: white; padding: 4px 12px; border-radius: 4px; font-size: 12px;">STOCK BAJO</span>
                    @else
                        <span style="background: #27ae60; color: white; padding: 4px 12px; border-radius: 4px; font-size: 12px;">DISPONIBLE</span>
                    @endif
                </div>
            </div>

            <div>
                <h3 style="color: #2c3e50; margin-bottom: 15px; font-size: 20px;">Información de Registro</h3>
                
                <div class="form-group">
                    <label style="color: #7f8c8d; font-size: 14px;">Fecha de Creación</label>
                    <p style="font-size: 16px; color: #2c3e50;">{{ $product->created_at->format('d/m/Y H:i:s') }}</p>
                    <small class="text-muted">Hace {{ $product->created_at->diffForHumans() }}</small>
                </div>

                <div class="form-group">
                    <label style="color: #7f8c8d; font-size: 14px;">Última Actualización</label>
                    <p style="font-size: 16px; color: #2c3e50;">{{ $product->updated_at->format('d/m/Y H:i:s') }}</p>
                    <small class="text-muted">Hace {{ $product->updated_at->diffForHumans() }}</small>
                </div>
            </div>
        </div>

        <div style="border-top: 2px solid #ecf0f1; padding-top: 20px;">
            <h3 style="color: #2c3e50; margin-bottom: 15px; font-size: 20px;">Acciones</h3>
            <div style="display: flex; gap: 10px;">
                <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">✏️ Editar Producto</a>
                <form action="{{ route('products.destroy', $product) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de eliminar este producto?\n\nEsta acción no se puede deshacer.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"> Eliminar Producto</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
