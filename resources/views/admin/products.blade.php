@extends('layouts.logged')
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
@section('content')
    <div class="container">
        <header class="mb-4">
            <h1>Products Page</h1>
        </header>
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="toggle-switch" role="switch">
                    <label class="form-check-label" for="toggle-switch">Toggle to view Collections</label>
                </div>
            </div>
            <div class="col-md-6 text-end">
                <button class="btn btn-primary me-2" id="create-product-btn">Create Product</button>
                <button class="btn btn-primary" id="create-collection-btn">Create Collection</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="products-table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Price</th>
                                <th scope="col">Collection</th>
                                <th scope="col">Inventory Count</th>
                                <th scope="col">Availability</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="products-tbody">
                            <!-- Products data will be listed here -->
                        </tbody>
                    </table>
                </div>
                <div id="collections-table" style="display: none;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Created At</th>
                            </tr>
                        </thead>
                        <tbody id="collections-tbody">
                            <!-- Collections data will be listed here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
         <!-- Product Creation Modal -->
        <div class="modal fade" id="createProductModal" tabindex="-1" aria-labelledby="createProductModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createProductModalLabel">Create Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="createProductForm">
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select class="form-select" id="category_id" name="category_id" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="product_name" name="product_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                            </div>
                            <div class="mb-3">
                                <label for="thumbnail" class="form-label">Thumbnail</label>
                                <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*" required>
                            </div>
                            <div class="mb-3">
                                <label for="product_images" class="form-label">Product Images</label>
                                <input type="file" class="form-control" id="product_images" name="product_images[]" accept="image/*" multiple>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Sizes</label>
                                <div id="sizeOptions">
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" name="sizes[]" required>
                                        <button type="button" class="btn btn-outline-secondary add-size">+</button>
                                    </div>
                                </div>
                            </div>
                            <div id="variations">
                                <!-- Variations will be dynamically added here -->
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="saveProduct">Save Product</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Collection Modal -->
        @include('layouts.partials.create_collection')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const toggleSwitch = document.getElementById('toggle-switch');
        const productsTable = document.getElementById('products-table');
        const collectionsTable = document.getElementById('collections-table');

        toggleSwitch.addEventListener('change', () => {
            if (toggleSwitch.checked) {
                productsTable.style.display = 'none';
                collectionsTable.style.display = 'block';
                getCollections();
            } else {
                productsTable.style.display = 'block';
                collectionsTable.style.display = 'none';
            }
        });
        async function getCollections() {
            try {
                const response = await fetch('/categories');
                const collections = await response.json();

                const tbody = document.getElementById('collections-tbody');
                tbody.innerHTML = '';

                collections.forEach(collection => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${collection.category_name}</td>
                        <td>${collection.description}</td>
                        <td>${collection.created_at}</td>
                        <!-- Add other columns as needed -->
                    `;
                    tbody.appendChild(row);
                });
            } catch (error) {
                console.error('Error:', error);
            }
        }
        async function getProducts() {
            try {
                const response = await fetch('/products');
                const products = await response.json();

                const tbody = document.getElementById('products-tbody');
                tbody.innerHTML = '';

                products.forEach(product => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${product.product_name}</td>
                        <td>${product.description}</td>
                        <td>${product.price}</td>
                        <td>${product.collection}</td>
                        <td>${product.inventory_count}</td>
                        <td>${product.availability}</td>
                        <td>
                            <!-- Add action buttons here -->
                        </td>
                    `;
                    tbody.appendChild(row);
                });
            } catch (error) {
                console.error('Error:', error);
            }
        }

        // Call the function on page load
        document.addEventListener('DOMContentLoaded', getProducts);

        const createProductBtn = document.getElementById('create-product-btn');
        const createProductModal = new bootstrap.Modal(document.getElementById('createProductModal'));
        const createProductForm = document.getElementById('createProductForm');

        /* create collection modal */
        const createCollectionBtn = document.getElementById('create-collection-btn');
        const createCollectionModal = new bootstrap.Modal(document.getElementById('createCollectionModal'));
        const createCollectionForm = document.getElementById('createCollectionForm');
        const saveCollectionBtn = document.getElementById('saveCollection');

        const saveProductBtn = document.getElementById('saveProduct');
        const sizeOptions = document.getElementById('sizeOptions');
        const variations = document.getElementById('variations');

        createProductBtn.addEventListener('click', () => {
            createProductModal.show();
        });

        createCollectionBtn.addEventListener('click', () => {
            createCollectionModal.show();
        });

        document.querySelector('.add-size').addEventListener('click', addSizeOption);

        function addSizeOption() {
            const newSize = document.createElement('div');
            newSize.className = 'input-group mb-2';
            newSize.innerHTML = `
                <input type="text" class="form-control" name="sizes[]" required>
                <button type="button" class="btn btn-outline-secondary remove-option">-</button>
            `;
            sizeOptions.appendChild(newSize);
            newSize.querySelector('.remove-option').addEventListener('click', removeOption);
        }

        function removeOption(e) {
            e.target.closest('.input-group').remove();
            updateVariations();
        }

        sizeOptions.addEventListener('input', updateVariations);

        function updateVariations() {
            const sizes = Array.from(sizeOptions.querySelectorAll('input')).map(input => input.value).filter(Boolean);
            
            variations.innerHTML = '';
            sizes.forEach(size => {
                const variationDiv = document.createElement('div');
                variationDiv.className = 'mb-3';
                variationDiv.innerHTML = `
                    <h6>${size}</h6>
                    <div class="input-group">
                        <input type="number" class="form-control" name="variations[${size}][quantity]" placeholder="Quantity" required>
                        <input type="number" class="form-control" name="variations[${size}][price]" placeholder="Price (optional)" step="0.01">
                    </div>
                `;
                variations.appendChild(variationDiv);
            });
        }

        saveCollectionBtn.addEventListener('click', async () => {
                const formData = new FormData(createCollectionForm);

                // Clear previous error messages
                clearErrorMessages();

                try {
                    // console.log('sending' );
                    const response = await fetch('/api/categories', {
                        method: 'POST',
                        headers: {
                            // 'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: formData
                    });

                    const responseData = await response.json();
                    console.log('response data', responseData);

                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    if (response.ok) {
                        alert('Collection created successfully');
                        createCollectionModal.hide();
                        createCollectionForm.reset();
                        // Optionally, refresh the collection list here
                    } else {
                        if (responseData.errors) {
                            displayErrors(responseData.errors);
                        } else {
                            alert(`Error: ${responseData.message || 'An error occurred while creating the collection'}`);
                        }
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('An error occurred while creating the collection');
                }
        });

            saveProductBtn.addEventListener('click', async () => {
                const formData = new FormData(createProductForm);
                const sizes = formData.getAll('sizes[]');
                
                sizes.forEach((size) => {
                    const quantityInput = document.querySelector(`input[name="variations[${size}][quantity]"]`);
                    const priceInput = document.querySelector(`input[name="variations[${size}][price]"]`);
                    if (quantityInput) {
                        formData.append(`variations[${size}][size]`, size);
                        formData.append(`variations[${size}][quantity]`, quantityInput.value);
                    }
                    if (priceInput && priceInput.value) {
                        formData.append(`variations[${size}][price]`, priceInput.value);
                    }
                });

                // Clear previous error messages
                clearErrorMessages();

                try {
                    // console.log('sending' );
                    const response = await fetch('/api/products', {
                        method: 'POST',
                        headers: {
                            // 'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: formData
                    });

                    const responseData = await response.json();
                    console.log('response data', responseData);

                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    if (response.ok) {
                        alert('Product created successfully');
                        createProductModal.hide();
                        createProductForm.reset();
                        // Optionally, refresh the product list here
                    } else {
                        if (responseData.errors) {
                            displayErrors(responseData.errors);
                        } else {
                            alert(`Error: ${responseData.message || 'An error occurred while creating the product'}`);
                        }
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('An error occurred while creating the product');
                }
        });

        function clearErrorMessages() {
            document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
            document.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
        }

        function displayErrors(errors) {
            for (const [field, messages] of Object.entries(errors)) {
                const input = document.querySelector(`[name="${field}"]`) || document.querySelector(`[name="${field}[]"]`);
                if (input) {
                    input.classList.add('is-invalid');
                    const feedbackDiv = document.createElement('div');
                    feedbackDiv.className = 'invalid-feedback';
                    feedbackDiv.textContent = messages[0]; // Display the first error message
                    input.parentNode.appendChild(feedbackDiv);
                }
            }
        }
    </script>
@endsection
