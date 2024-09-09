@extends('layouts.logged')

@section('content')

    <div class="container">
        <header class="mb-4">
            <h1>Customers Page</h1>
        </header>
        <div class="row mb-4">
            <div class="col-md-12 text-end">
                <button class="btn btn-primary" id="create-customer-btn" data-bs-toggle="modal" data-bs-target="#createCustomerModal">
                    Create Customer
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Date Added</th>
                            <th scope="col">Email</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="customers-tbody">
                        <!-- Customers data will be listed here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Create Customer Modal -->
    <div class="modal fade" id="createCustomerModal" tabindex="-1" aria-labelledby="createCustomerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createCustomerModalLabel">Create Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="customer-name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="customer-name">
                        </div>
                        <div class="mb-3">
                            <label for="customer-email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="customer-email">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="create-customer-submit">Create</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add functionality to create customer submit button
        document.getElementById('create-customer-submit').addEventListener('click', () => {
            // Get form data
            const name = document.getElementById('customer-name').value;
            const email = document.getElementById('customer-email').value;

            // Create customer logic here

            // Close modal
            const createCustomerModal = new bootstrap.Modal(document.getElementById('createCustomerModal'));
            createCustomerModal.hide();
        });
    </script>
@endsection