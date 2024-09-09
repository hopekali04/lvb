@extends('layouts.logged')

@section('content')   
    <div class="container">
        <header class="mb-4">
            <h1>Categories Page</h1>
        </header>
        <div class="row mb-4">
            <div class="col-md-12 text-end">
                <button class="btn btn-primary" id="create-category-btn" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
                    Create Category
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="categories-tbody">
                        <!-- Categories data will be listed here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Create Category Modal -->
    <div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createCategoryModalLabel">Create Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="category-name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="category-name">
                        </div>
                        <div class="mb-3">
                            <label for="category-description" class="form-label">Description</label>
                            <textarea class="form-control" id="category-description"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="create-category-submit">Create</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add functionality to create category submit button
        document.getElementById('create-category-submit').addEventListener('click', () => {
            // Get form data
            const name = document.getElementById('category-name').value;
            const description = document.getElementById('category-description').value;

            // Create category logic here

            // Close modal
            const createCategoryModal = new bootstrap.Modal(document.getElementById('createCategoryModal'));
            createCategoryModal.hide();
        });
    </script>
@endsection
