@extends('layouts.app')

@section('title', 'Editar Producto')

@section('content')
<div class="card">
    <div class="card-header">
        Editar Producto: {{ $product->nombre }}
    </div>

    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="nombre">Nombre del Producto *</label>
            <input 
                type="text" 
                name="nombre" 
                id="nombre" 
                class="form-control @error('nombre') is-invalid @enderror" 
                value="{{ old('nombre', $product->nombre) }}"
                placeholder="Ingrese el nombre del producto"
                required
            >
            @error('nombre')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="precio">Precio (€) *</label>
            <input 
                type="number" 
                name="precio" 
                id="precio" 
                class="form-control @error('precio') is-invalid @enderror" 
                value="{{ old('precio', $product->precio) }}"
                step="0.01"
                min="0.01"
                placeholder="0.00"
                required
            >
            <small class="text-muted">El precio debe ser un valor positivo</small>
            @error('precio')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="stock">Stock *</label>
            <input 
                type="number" 
                name="stock" 
                id="stock" 
                class="form-control @error('stock') is-invalid @enderror" 
                value="{{ old('stock', $product->stock) }}"
                min="0"
                placeholder="0"
                required
            >
            <small class="text-muted">El stock debe ser un número entero</small>
            @error('stock')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div style="display: flex; gap: 10px; margin-top: 25px;">
            <button type="submit" class="btn btn-success"> Actualizar Producto</button>
            <a href="{{ route('products.index') }}" class="btn btn-warning"> Cancelar</a>
            <a href="{{ route('products.show', $product) }}" class="btn btn-primary"> Ver Detalles</a>
        </div>
    </form>
</div>
@endsection
