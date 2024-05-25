@extends('admin.layout.layout')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-6 ">

                                <h4 class="text-capitalize">Data User</h4>
                            </div>
                            <div class="col-6 text-end">
                            </div>
                        </div>

                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">

                        </div>
                    </div>
                </div>


                            <div class="row">
                                <div class="col-md-8 mt-4">
                                  <div class="card">
                                    <div class="card-header pb-0 px-3">
                                      <h6 class="mb-0">Detail Orderan Yg Masuk</h6>
                                    </div>
                                    <div class="card-body pt-4 p-3">
                                      <ul class="list-group">
                                        <li class="list-group-item border-0 d-flex p-4 mb-2 border-radius-lg">
                                          <div class="d-flex flex-column">

                                            <div >
                                                <div style="margin-bottom: 16px;">
                                                    <span style="display: inline-block; width: 150px; ">Order ID</span>:
                                                    <span class="text-dark ms-sm-2">{{ $order->order_id }}</span>
                                                </div>
                                                <div style="margin-bottom: 16px;">
                                                    <span style="display: inline-block; width: 150px;">Customer Name</span>:
                                                    <span class="text-dark ms-sm-2">{{ $order->customer->name }}</span>
                                                </div>
                                                <div style="margin-bottom: 16px;">
                                                    <span style="display: inline-block; width: 150px;">Serial Number</span>:
                                                    @foreach ($order->items as $item)
                                                    <tr>
                                                        <td>{{ $item->serial_number }};</td>
                                                    </tr>
                                                    @endforeach

                                                </div>
                                                <div style="margin-bottom: 16px;">
                                                  <span style="display: inline-block; width: 150px;">FeederType</span>:
                                                  <tr>
                                                      <td>{{ $order->items->first()->cobox_name ?? 'No cobox' }}</td>
                                                  </tr>
                                              </div>
                                                <div style="margin-bottom: 16px;">
                                                    <span style="display: inline-block; width: 150px;">Feeder Name</span>:
                                                    @foreach ($order->items as $item)
                                                    <tr>
                                                        <td>{{ $item->cobox_id }};</td>
                                                    </tr>
                                                    @endforeach
                                                </div>
                                                <div style="margin-bottom: 16px;">
                                                    <span style="display: inline-block; width: 150px;">Order Quantity</span>:
                                                    <span class="text-dark ms-sm-2">{{ $order->getTotalQuantityAttribute() }}</span>
                                                </div>
                                            </div>

                                          </div>


                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-4 mt-4">
                                  <div class="card h-100 mb-4">
                                    <div class="card-header pb-0 px-3">
                                      <div class="row">
                                        <div class="col-md-6">
                                          <h6 class="mb-0">Ticket Detail</h6>
                                        </div>

                                      </div>
                                    </div>
                                    <div class="card-body pt-4 p-3">
                                      <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                        <div class="d-flex align-items-center">
                                          <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-arrow-up"></i></button>
                                          <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">Created At</h6>
                                            <span class="text-xs">{{ \Carbon\Carbon::parse($order->order_date)->format('d F Y') }}</span>
                                          </div>
                                        </div>
                                      </li>
                                      <ul class="list-group">
                                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                          <div class="d-flex align-items-center">
                                            <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-arrow-up"></i></button>
                                            <div class="d-flex flex-column">
                                              <h6 class="mb-1 text-dark text-sm">Activity Type</h6>
                                              <span class="text-xs">Feeder Delivery</span>

                                            </div>
                                          </div>

                                        </li>
                                    </li>
                                    <ul class="list-group">
                                      <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                        <div class="d-flex align-items-center">
                                          <button class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-arrow-down"></i></button>
                                          <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">Activity Detail</h6>
                                            @if ($order->status === 'Completed' && $fraudReport)
                                            <a href="{{ route('DetailFraud', ['orderId' => $fraudReport->order_id]) }}" class="details-btn" style="color: blue; text-decoration: underline;">
                                                Details
                                            </a>
                                        @else
                                            <span class="details-btn disabled">
                                                No Fraud Report
                                            </span>
                                        @endif

                                          </div>
                                        </div>

                                      </li>
                                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                          <div class="d-flex align-items-center">
                                            <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-arrow-up"></i></button>
                                            <div class="d-flex flex-column">
                                              <h6 class="mb-1 text-dark text-sm">Activities</h6>
                                              <span class="text-xs">{{ $order->status ?? 'Status not available' }}</span>
                                            </div>
                                          </div>
                                        </li>
                                      </ul>
                                      <ul class="list-group">
                                        <h6 class="mb-1 text-dark text-sm">Driver PIC</h6>
                                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                            <div class="d-flex align-items-center">
                                                @if($order->status === 'Pending' && is_null($order->user_id))
                                                    <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-arrow-up"></i></button>
                                                    <form action="{{ route('assign.driver') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="order_id" value="{{ $order->order_id }}">
                                                        <select class="form-select" name="assigned_user_id">
                                                            <option value="">Select a User</option>
                                                            @foreach ($users as $user)
                                                                <option value="{{ $user->user_id }}">{{ $user->username }}</option>
                                                            @endforeach
                                                        </select>
                                                        <button type="submit" class="btn btn-outline-success btn-sm mb-0"  onclick="showAcceptedConfirmation(event)">Assign Driver</button>
                                                    </form>
                                                @else
                                                    <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center" disabled><i class="fas fa-arrow-up"></i></button>
                                                    <span>{{ $order->user->username }}</span> <!-- Menampilkan nama user yang telah di-assign -->
                                                @endif
                                            </div>
                                        </li>
                                    </ul>

                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12 mt-4">
                                  <div class="card">
                                    <div class="card-header pb-0 px-3">
                                      <h6 class="mb-0">Shipment Detail</h6>
                                    </div>
                                    <div class="card-body pt-4 p-3">
                                      <ul class="list-group">
                                        <li class="list-group-item border-0 d-flex p-4 mb-2 border-radius-lg">
                                          <div class="d-flex flex-column">

                                            <div >
                                                <div style="margin-bottom: 16px;">
                                                    <span style="display: inline-block; width: 150px; ">
                                                      Receiver Name</span>:
                                                      <span class="text-dark ms-sm-2">{{ $shipment->user->username ?? 'No Username' }}</span>
                                                </div>
                                                <div style="margin-bottom: 16px;">
                                                    <span style="display: inline-block; width: 150px;">Receiver Contact</span>:
                                                    <span class="text-dark ms-sm-2 ">{{ $shipment->user->email ?? 'No Email' }}</span>
                                                </div>
                                                <div style="margin-bottom: 16px;">
                                                  <span style="display: inline-block; width: 150px;">Point</span>:
                                                  <span class="text-dark ms-sm-2 ">{{ $shipment->point->point_name ?? 'No Point Registered' }}</span>
                                              </div>
                                                <div style="margin-bottom: 16px;">
                                                    <span style="display: inline-block; width: 150px;">Shipment Address	</span>:
                                                    <span class="text-dark ms-sm-2 ">{{ $shipment->shipment_address ?? 'No Address'}}</span>
                                                </div>


                                            </div>

                                          </div>


                                    </div>
                                  </div>
                                </div>
            </div>
        </div>
    </div>


<script>
  // Fungsi untuk menampilkan tabel berdasarkan ID
  function showTable(tableId) {
    // Sembunyikan semua tabel
    var tables = document.getElementsByClassName('table-container');
    for (var i = 0; i < tables.length; i++) {
      tables[i].style.display = 'none';
    }

    // Tampilkan tabel yang sesuai
    var tableToShow = document.getElementById(tableId);
    if (tableToShow) {
      tableToShow.style.display = 'block';
    }
  }

  // Tampilkan tabel A secara otomatis
  showTable('Workshop');
</script>

<script>
    function submitFormAndDisableButton(form) {
        form.submit(); // Submit form
        form.querySelector('button[type="submit"]').disabled = true; // Disable the submit button
    }
    </script>





@endsection
