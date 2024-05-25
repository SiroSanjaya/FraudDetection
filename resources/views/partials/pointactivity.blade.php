<div class="card h-100 mb-4">
    <div class="card-header pb-0 px-3">
        <div class="row">
            <div class="col-md-12">
                <i class="far fa-calendar-alt me-2"></i>
                <span class="text-xs">{{ \Carbon\Carbon::parse($order->order_date)->format('d F Y') }}</span>
            </div>
        </div>
    </div>
    <div class="card-body pt-4 p-3">
        <ul class="list-group">
            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex align-items-center">
                    <button class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-arrow-down"></i></button>
                    <div class="d-flex flex-column">
                        <h6 class="mb-1 text-dark text-sm"> <span class="text-xs">{{ $order->order_id }}</span></h6>
                        <span class="text-xs">{{ $order->customer->name }}</span>
                    </div>
                </div>
            </li>
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        {{-- <span class="text-dark ms-sm-1 " style="font-size: smaller;">{{ $order->shipment->user->email }}</span> --}}
                    </div>
                    <div class="col-6 text-end">
                        <a href="{{ route('PointDetail', ['orderId' => $order->order_id]) }}" class="btn btn-outline-success btn-sm">Detail</a>
                    </div>
                </div>
            </div>
        </ul>
    </div>
</div>
