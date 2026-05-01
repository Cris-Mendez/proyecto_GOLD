<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GOLD CLUB</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">


</head>

<body>
    <div class="container">

        <div class="header-container">
            <div class="header-content">
                <h2 class="header-title">GOLD<br>CLUB</h2>
                <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                    @csrf
                    <button type="submit" class="logout-button">Cerrar Sesión</button>
                </form>
            </div>
        </div>

        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif

        <div id="productContainer" class="product-container">
            @foreach ($products->take(4) as $product)
                <div class="product">
                    <h3>{{ $product->nombre }}</h3>
                    <p>Referencia: {{ $product->referencia }}</p>
                    <p>Precio: ${{ $product->precio }}</p>
                    <p>Cantidad: {{ $product->cantidad }}</p>
                    <p>Descripción: {{ $product->descripcion }}</p>

                    <button class="btn-trash"onclick="showDeleteModal({{ $product->id }})">Eliminar</button>

                    <div id="confirmDeleteModal-{{ $product->id }}" class="modal" style="display: none;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4>Confirmar Eliminación</h4>
                            </div>
                            <div class="modal-body">
                                <p>¿Eliminar <strong>{{ $product->nombre }}</strong>?</p>
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                                <button onclick="closeDeleteModal({{ $product->id }})"
                                    class="btn btn-secondary">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div id="moreProductsContainer" class="product-container">
            @foreach ($products->slice(4) as $product)
                <div class="product">
                    <h3>{{ $product->nombre }}</h3>
                    <p>Referencia: {{ $product->referencia }}</p>
                    <p>Precio: ${{ $product->precio }}</p>
                    <p>Cantidad: {{ $product->cantidad }}</p>
                    <p>Descripción: {{ $product->descripcion }}</p>

                    <button class="btn-trash"onclick="showDeleteModal({{ $product->id }})">Eliminar</button>

                    <div id="confirmDeleteModal-{{ $product->id }}" class="modal" style="display: none;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4>Confirmar Eliminación</h4>
                            </div>
                            <div class="modal-body">
                                <p>¿Eliminar <strong>{{ $product->nombre }}</strong>?</p>
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                                <button onclick="closeDeleteModal({{ $product->id }})"
                                    class="btn btn-secondary">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($products->count() > 4)
            <div style="text-align: center; margin-top: 20px;">
                <button id="showMoreBtn" onclick="toggleProducts()" class="btn-show-more">
                    Mostrar más productos
                </button>
            </div>
        @endif

    </div>

    <script>
        function showDeleteModal(id) {
            document.getElementById('confirmDeleteModal-' + id).style.display = 'block';
        }

        function closeDeleteModal(id) {
            document.getElementById('confirmDeleteModal-' + id).style.display = 'none';
        }

        function toggleProducts() {
            let more = document.getElementById('moreProductsContainer');
            let btn = document.getElementById('showMoreBtn');

            // Cambiamos a 'grid' para mantener la consistencia con la clase CSS
            if (more.style.display === 'none' || more.style.display === '') {
                more.style.display = 'grid';
                btn.textContent = 'Mostrar menos productos';
            } else {
                more.style.display = 'none';
                btn.textContent = 'Mostrar más productos';
            }
        }
    </script>

</body>

</html>
