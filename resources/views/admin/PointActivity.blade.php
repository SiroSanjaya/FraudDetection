@extends('admin.layout.layout')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <ul class="nav nav-pills nav-fill p-1" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="javascript:;" onclick="showTable('Workshop')">200<span class="ms-2">Create</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:;" onclick="showTable('tableB')">100<span class="ms-2">In Progress</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:;" onclick="showTable('Attendence')">50<span class="ms-2">Done</span></a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md- mt-">
            <div class="card h-100 mb-4">
              <div class="card-header pb-0 px-3">
                <div class="row">
                    @foreach ($orders as $order)
                  <div class="col-md- ">
                    <i class="far fa-calendar-alt me-2"></i>
                    <small> <span class="text-xs">{{ \Carbon\Carbon::parse($order->shipment->shipment_date)->format('d F Y') }}</span></small>
                  </div>
                </div>
              </div>
              <div class="card-body pt-4 p-3">
                <ul class="list-group">
                  <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                    <div class="d-flex align-items-center">
                      <button class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-arrow-down"></i></button>
                      <div class="d-flex flex-column">
                        <h6 class="mb-1 text-dark text-sm">{{ $order->order_id }}</h6>
                        <span class="text-xs">{{ $order->customer->name }}</span>

                      </div>
                    </div>

                  </li>
                  <div class="card-header pb-0 p-3">
                    <div class="row">
                      <div class="col-6 d-flex align-items-center">
                        <span class="text-xs">-</span>
                      </div>
                      <div class="col-6 text-end">
                        <a href="{{ route('PointDetail', ['orderId' => $order->order_id]) }}" class="btn btn-outline-success btn-sm">Detail</a>
                      </div>
                    </div>
                  </div>
                </ul>
              </div>
            </div>

            @endforeach
    </div>

    @if ($message = session('success'))
        <script>
            Swal.fire({
                position: 'top-mid',
                icon: 'success',
                title: '{{ $message }}',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @endif
@endsection
