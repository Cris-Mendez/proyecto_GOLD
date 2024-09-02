<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GOLD CLUB</title>
    <link rel="stylesheet" href="{{ asset('css/productos.css') }}">
</head>
<body>
    <div class="container">
        <!-- Contenedor principal para centrar el título y colocar el botón -->
        <div class="header-container">
            <div class="header-content">
                <h2 class="header-title">GOLD<br>CLUB</h2>
                <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                    @csrf
                    <button type="submit" class="logout-button">Cerrar Sesión</button>
                </form>
            </div>
        </div>

        <!-- Mostrar mensaje de éxito si existe -->
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif

        <!-- Mostrar los primeros 4 productos -->
        <div id="productContainer" class="product-container">
            @foreach($products->take(4) as $product)
                <div class="product">
                    <h3>{{ $product->name }}</h3>
                    <p>Referencia: {{ $product->reference }}</p>
                    <p>Precio: ${{ $product->price }}</p>
                    <p>Cantidad: {{ $product->quantity }}</p>
                    <p>Descripción: {{ $product->description }}</p>
                    <button class="btn btn-danger" onclick="showDeleteModal({{ $product->id }})">Eliminar</button>

                    <!-- Modal de confirmación para cada producto -->
                    <div id="confirmDeleteModal-{{ $product->id }}" class="modal">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4>Confirmar Eliminación</h4>
                            </div>
                            <div class="modal-body">
                                <p>¿Estás seguro de que deseas eliminar este producto?</p>
                            </div>
                            <div class="modal-footer">
                                <form id="deleteProductForm-{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class=" btn-left">Eliminar</button>
                                </form>
                                <button onclick="closeDeleteModal({{ $product->id }})" class="btn btn-secondary btn-riht">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Contenedor oculto para los productos adicionales -->
        <div id="moreProductsContainer" class="product-container hidden-products">
            @foreach($products->slice(4) as $product)
                <div class="product">
                    <h3>{{ $product->name }}</h3>
                    <p>Referencia: {{ $product->reference }}</p>
                    <p>Precio: ${{ $product->price }}</p>
                    <p>Cantidad: {{ $product->quantity }}</p>
                    <p>Descripción: {{ $product->description }}</p>
                    <button class="btn btn-danger" onclick="showDeleteModal({{ $product->id }})">Eliminar</button>
                </div>
            @endforeach
        </div>

        <!-- Botón para mostrar más productos -->
        <button id="showMoreBtn" onclick="toggleProducts()">Mostrar más productos</button>

        <!-- Modal de éxito -->
        <div id="successModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Producto Eliminado</h4>
                </div>
                <div class="modal-body">
                    <p>El producto ha sido eliminado exitosamente.</p>
                </div>
                <div class="modal-footer">
                    <button onclick="closeSuccessModal()" class="btn btn-primary">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showDeleteModal(productId) {
            document.getElementById('confirmDeleteModal-' + productId).style.display = 'block';
        }

        function closeDeleteModal(productId) {
            document.getElementById('confirmDeleteModal-' + productId).style.display = 'none';
        }

        // Capturar el evento submit del formulario de eliminación
        document.querySelectorAll('form[id^="deleteProductForm-"]').forEach(form => {
            form.onsubmit = function(e) {
                e.preventDefault(); // Evitar el submit normal
                const formId = this.id.split('-')[1];
                fetch(this.action, {
                    method: 'POST',
                    body: new FormData(this)
                }).then(response => {
                    if (response.ok) {
                        document.getElementById('confirmDeleteModal-' + formId).style.display = 'none';
                        document.getElementById('successModal').style.display = 'block';
                        setTimeout(() => location.reload(), 2000); // Recargar la página después de 2 segundos
                    }
                });
            };
        });

        function closeSuccessModal() {
            document.getElementById('successModal').style.display = 'none';
            location.reload(); // Recargar la página para reflejar los cambios
        }

        function toggleProducts() {
            var moreProducts = document.getElementById('moreProductsContainer');
            var showMoreBtn = document.getElementById('showMoreBtn');

            if (moreProducts.style.display === 'none') {
                moreProducts.style.display = 'grid'; // Mostrar productos adicionales
                showMoreBtn.textContent = 'Mostrar menos productos';
            } else {
                moreProducts.style.display = 'none'; // Ocultar productos adicionales
                showMoreBtn.textContent = 'Mostrar más productos';
            }
        }
    </script>
</body>
</html>
