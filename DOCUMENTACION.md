#  Gestión de Productos - CRUD Laravel

## 📋 Descripción del Proyecto

Aplicación web completa en Laravel para gestionar productos con operaciones CRUD (Crear, Leer, Actualizar, Eliminar), validaciones robustas, mensajes flash y protección contra ataques comunes.

---

## ✨ Características Implementadas

### 1. **Modelo de Producto**
Cada producto contiene:
- **ID**: Identificador único (auto-incremental)
- **Nombre**: Nombre del producto (string, obligatorio)
- **Precio**: Precio en euros (decimal, debe ser positivo)
- **Stock**: Cantidad disponible (entero, no negativo)
- **Timestamps**: Fechas de creación y actualización

### 2. **Operaciones CRUD Completas**

#### ✅ **CREATE (Crear)**
- Formulario para crear nuevos productos
- Ruta: `GET /products/create`
- Acción: `POST /products`

#### 📖 **READ (Leer)**
- Listado paginado de productos con 10 items por página
- Vista detallada de cada producto
- Rutas: 
  - `GET /products` (listado)
  - `GET /products/{id}` (detalle)

#### ✏️ **UPDATE (Actualizar)**
- Formulario para editar productos existentes
- Rutas:
  - `GET /products/{id}/edit` (formulario)
  - `PUT /products/{id}` (actualización)

#### 🗑️ **DELETE (Eliminar)**
- Eliminación con confirmación JavaScript
- Ruta: `DELETE /products/{id}`

### 3. **Sistema de Validaciones**

#### Validaciones Implementadas:

```php
'nombre' => 'required|string|max:255'    // Nombre obligatorio, máximo 255 caracteres
'precio' => 'required|numeric|min:0.01'  // Precio obligatorio, numérico, positivo (> 0)
'stock' => 'required|integer|min:0'      // Stock obligatorio, entero, no negativo
```

#### Mensajes Personalizados:
- Mensajes en español para cada tipo de error
- Visualización clara en el formulario
- Indicadores visuales de campos con error

### 4. **Mensajes Flash en Sesión**

#### Tipos de Mensajes:
- ✅ **Success (Verde)**: Operaciones exitosas
  - "Producto creado exitosamente"
  - "Producto actualizado exitosamente"
  - "Producto eliminado exitosamente"

- ❌ **Error (Rojo)**: Errores de validación
  - Listado de todos los errores encontrados
  - Mensajes específicos por campo

- ⚠️ **Warning (Amarillo)**: Advertencias (preparado para uso futuro)

#### Características de los Mensajes:
- Animación de entrada suave
- Desaparecen después de la siguiente petición
- Ubicados en la parte superior de cada página

---

## 🔒 Protección contra Ataques Comunes

### 1. **Protección CSRF (Cross-Site Request Forgery)**

Laravel incluye protección CSRF por defecto:

```blade
@csrf  // Token CSRF en todos los formularios
```

**Cómo funciona:**
- Cada formulario incluye un token único
- El middleware `VerifyCsrfToken` valida el token en cada petición POST/PUT/DELETE
- Sin token válido, la petición es rechazada con error 419

**Archivo de configuración:** `app/Http/Middleware/VerifyCsrfToken.php`

### 2. **Protección contra SQL Injection**

Laravel Eloquent ORM previene SQL injection automáticamente:

```php
// ✅ SEGURO - Usa prepared statements
Product::create($validated);
Product::where('id', $id)->update($data);

// ❌ INSEGURO - Raw queries sin binding (NO usado en este proyecto)
// DB::statement("DELETE FROM products WHERE id = $id");
```

**Características de seguridad:**
- Uso de **Eloquent ORM** en todo el código
- Prepared statements automáticos
- Escape automático de parámetros
- Mass assignment protection con `$fillable`

### 3. **Protección Mass Assignment**

Protección configurada en el modelo:

```php
protected $fillable = ['nombre', 'precio', 'stock'];
```

Solo los campos especificados pueden ser asignados masivamente, previniendo:
- Modificación no autorizada de campos sensibles
- Inyección de datos maliciosos

### 4. **Validación de Entrada**

Todas las entradas son validadas antes de procesarse:

```php
$validated = $request->validate([...]);
```

**Beneficios:**
- Previene XSS (Cross-Site Scripting)
- Asegura tipos de datos correctos
- Rechaza datos malformados

### 5. **Protección XSS (Cross-Site Scripting)**

Blade escapa automáticamente las variables:

```blade
{{ $product->nombre }}  // Escapado automático
```

### 6. **Route Model Binding**

Uso de Route Model Binding para evitar consultas inseguras:

```php
public function show(Product $product)  // Laravel valida automáticamente que existe
```

---

## 📁 Estructura de Archivos

```
app/
├── Http/
│   └── Controllers/
│       └── ProductController.php      # Controlador CRUD con validaciones
├── Models/
│   └── Product.php                    # Modelo con $fillable y $casts

database/
├── migrations/
│   └── 2026_02_02_000000_create_products_table.php
└── seeders/
    ├── DatabaseSeeder.php
    └── ProductSeeder.php               # Datos de ejemplo

resources/
└── views/
    ├── layouts/
    │   └── app.blade.php               # Layout principal con mensajes flash
    └── products/
        ├── index.blade.php             # Listado de productos
        ├── create.blade.php            # Formulario de creación
        ├── edit.blade.php              # Formulario de edición
        └── show.blade.php              # Vista detallada

routes/
└── web.php                             # Rutas (Resource Controller)
```

---

## 🚀 Instalación y Configuración

### 1. **Requisitos Previos**
- PHP >= 8.1
- Composer
- MySQL/MariaDB o SQLite
- Node.js y NPM (opcional para assets)

### 2. **Configuración de Base de Datos**

Edita el archivo `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

### 3. **Instalar Dependencias**

```bash
composer install
```

### 4. **Ejecutar Migraciones**

```bash
php artisan migrate
```

### 5. **Poblar Base de Datos (Opcional)**

```bash
php artisan db:seed --class=ProductSeeder
```

Esto creará 8 productos de ejemplo con diferentes niveles de stock.

### 6. **Iniciar Servidor**

```bash
php artisan serve
```

Accede a: `http://localhost:8000/products`

---

## 🎨 Características de la Interfaz

### Indicadores Visuales de Stock:
- 🟢 **Verde**: Stock > 10 (DISPONIBLE)
- 🟡 **Amarillo**: Stock 1-10 (STOCK BAJO)
- 🔴 **Rojo**: Stock = 0 (SIN STOCK)

### Diseño Responsivo:
- Cards con sombras y esquinas redondeadas
- Botones con efectos hover
- Tablas con filas alternadas
- Formularios con validación visual

### Confirmaciones de Seguridad:
- Confirmación JavaScript antes de eliminar
- Mensajes claros de las acciones realizadas

---

## 📊 Rutas Disponibles

| Método | URI | Acción | Descripción |
|--------|-----|--------|-------------|
| GET | /products | index | Lista todos los productos |
| GET | /products/create | create | Muestra formulario de creación |
| POST | /products | store | Guarda nuevo producto |
| GET | /products/{id} | show | Muestra un producto |
| GET | /products/{id}/edit | edit | Muestra formulario de edición |
| PUT/PATCH | /products/{id} | update | Actualiza un producto |
| DELETE | /products/{id} | destroy | Elimina un producto |

---

## 🧪 Ejemplos de Uso

### Crear un Producto Manualmente

```bash
# Acceder al formulario
http://localhost:8000/products/create

# Datos de ejemplo:
Nombre: "Laptop Gaming"
Precio: 1299.99
Stock: 15
```

### Validaciones que se Aplicarán:
- ❌ Precio negativo → Error: "El precio debe ser positivo"
- ❌ Stock decimal → Error: "El stock debe ser un número entero"
- ❌ Nombre vacío → Error: "El nombre es obligatorio"

---

## 🔐 Checklist de Seguridad

- ✅ Protección CSRF en todos los formularios
- ✅ Uso exclusivo de Eloquent ORM (previene SQL Injection)
- ✅ Mass Assignment Protection con $fillable
- ✅ Validación de entrada en todas las operaciones
- ✅ Blade auto-escaping (previene XSS)
- ✅ Route Model Binding para validación de existencia
- ✅ Prepared statements automáticos
- ✅ Confirmación en operaciones destructivas

---

## 📝 Notas Adicionales

### Paginación
- El listado muestra 10 productos por página
- Enlaces de navegación generados automáticamente

### Mensajes Flash
- Se muestran solo una vez
- Desaparecen tras la siguiente petición
- Ubicación consistente en todas las vistas

### Validación del Lado del Cliente
- HTML5 validation (`required`, `min`, `step`)
- JavaScript confirmation para eliminar
- No sustituye la validación del servidor

---

## 🎓 Conceptos Aplicados

1. **MVC Pattern**: Modelo-Vista-Controlador
2. **RESTful Routes**: Rutas siguiendo convenciones REST
3. **Eloquent ORM**: Mapeo objeto-relacional
4. **Blade Templates**: Motor de plantillas de Laravel
5. **Request Validation**: Validación centralizada
6. **Session Flash**: Mensajes temporales en sesión
7. **Route Model Binding**: Inyección automática de modelos
8. **Mass Assignment Protection**: Seguridad en asignación masiva
9. **CSRF Protection**: Prevención de ataques CSRF
10. **Query Builder Security**: Queries seguras con Eloquent

---

## 👨‍💻 Autor

Aplicación desarrollada como ejercicio práctico de Laravel CRUD con validaciones y seguridad.

**Fecha:** 2 de febrero de 2026

---

## 📄 Licencia

Este proyecto es de código abierto y está disponible para fines educativos.
