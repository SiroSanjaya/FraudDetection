@extends('admin.layout.layout')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="row">
                            <ul class="nav nav-pills nav-fill p-1" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#pending">Pending</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#shipped">Shipped</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#delivered">Delivered</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="tab-content">
                            <!-- Tab for Pending Orders -->
                            <div class="tab-pane active" id="pending">
                                @foreach ($pendingOrders as $order)
                                    @include('partials.order', ['order' => $order])
                                @endforeach
                            </div>
                            <!-- Tab for Shipped Orders -->
                            <div class="tab-pane" id="shipped">
                                @foreach ($shippedOrders as $order)
                                    @include('partials.order', ['order' => $order])
                                @endforeach
                            </div>
                            <!-- Tab for Delivered Orders -->
                            <div class="tab-pane" id="delivered">
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
@endsection
