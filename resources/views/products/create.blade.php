@extends('layouts.app')

@section('title', 'Crear Producto')

@section('content')
<div class="card">
    <div class="card-header">
        Crear Nuevo Producto
    </div>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="nombre">Nombre del Producto *</label>
            <input 
                type="text" 
                name="nombre" 
                id="nombre" 
                class="form-control @error('nombre') is-invalid @enderror" 
                value="{{ old('nombre') }}"
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
                value="{{ old('precio') }}"
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
                value="{{ old('stock', 0) }}"
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
            <button type="submit" class="btn btn-success"> Guardar Producto</button>
            <a href="{{ route('products.index') }}" class="btn btn-warning"> Cancelar</a>
        </div>
    </form>
</div>
@endsection
