@extends('admin.layout.layout')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <form id="searchForm" class="mb-3">
                            <div class="input-group">
                                <input id="searchInput" type="text" class="form-control" placeholder="Search orders...">
                                <button id="searchButton" class="btn btn-primary" type="button">Search</button>
                            </div>
                        </form>
                        <ul class="nav nav-pills nav-fill p-1" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#pending-tab">
                                    Pending ({{ $pendingQuantity }})
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#shipped-tab">
                                    Shipped ({{ $shippedQuantity }})
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#delivered-tab">
                                    Delivered ({{ $deliveredQuantity }})
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="tab-content">
                            <!-- Tab for Pending Orders -->
                            <div class="tab-pane fade show active" id="pending-tab">
                                @foreach ($pendingOrders as $order)
                                    @include('partials.order', ['order' => $order])
                                @endforeach
                            </div>
                            <!-- Tab for Shipped Orders -->
                            <div class="tab-pane fade" id="shipped-tab">
                                @foreach ($shippedOrders as $order)
                                    @include('partials.order', ['order' => $order])
                                @endforeach
                            </div>
                            <!-- Tab for Delivered Orders -->
                            <div class="tab-pane fade" id="delivered-tab">
                                @foreach ($deliveredOrders as $order)
                                    @include('partials.order', ['order' => $order])
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($message = session('success'))
        <script>
            Swal.fire({
                position: 'top-mid',
                icon: 'success',
                title: '{{ $message }}',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif

    <script>
        document.getElementById('searchButton').addEventListener('click', function() {
            var query = document.getElementById('searchInput').value.toLowerCase();
            var tabs = document.querySelectorAll('.tab-pane');

            tabs.forEach(function(tab) {
                var orders = tab.querySelectorAll('.order');

                orders.forEach(function(order) {
                    var orderId = order.querySelector('.order-id').innerText.toLowerCase();
                    if (orderId.includes(query)) {
                        order.style.display = 'block';
                    } else {
                        order.style.display = 'none';
                    }
                });
            });
        });
    </script>
@endsection
