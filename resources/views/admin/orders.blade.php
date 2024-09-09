@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@extends('layouts.logged')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="">
            <header class="mb-4">
                <h1>Orders Page</h1>
            </header>
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">OrderID</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Order Date</th>
                    <th scope="col">Total Amount</th>
                    <th scope="col">Order Status</th>
                    <th scope="col">Is Shipped</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                      <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->email }}</td>
                        <td>{{ $order->order_date }}</td>
                        <td>Mwk {{ number_format($order->total_amount, 2) }}</td>
                        <td>{{ $order->status }}</td>
                        <td>{{ $order->is_shipped ? 'YES' : 'NO' }}</td>
                        <td>
                          <a href="{{ route('view.order', $order->id) }}" class="btn btn-primary btn-sm">View</a>
                          @if($order->is_shipped !== 1)
                              <form action="{{ route('confirm.order', $order->id) }}" method="POST" style="display: inline;" onsubmit="return confirmOrder(event)">
                                  @csrf
                                  <button type="submit" class="btn btn-success btn-sm">Confirm Shipping</button>
                              </form>
                          @endif
                        </td>
                      </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- View Modal -->
  <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="viewModalLabel">View Order</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- Display order information here -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
  </div>
  
  <!-- Confirm Modal -->
  <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmModalLabel">Confirm Order</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Display order information here -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Confirm</button>
        </div>
      </div>
    </div>
  </div>
        </div>
        
    </div>
</div>
<script>
  function confirmOrder(event) {
    event.preventDefault();
    if (confirm('Are you sure you want to confirm this order? This Action Is Irrevesible')) {
        event.target.submit();
    }
    return false;
  }
</script>
@endsection
