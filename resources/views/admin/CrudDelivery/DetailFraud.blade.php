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
                        <div class="table-responsive p-0"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mt-4">
                        <div class="card">
                            <div class="card-header pb-0 px-2">
                                <h6 class="mb-0">Order Detail</h6>
                            </div>
                            <div class="card-body pt-4 p-">
                                <ul class="list-group">
                                    <li class="list-group-item border-0 d-flex p-4 mb-2 border-radius-lg">
                                        <div class="d-flex flex-column">
                                            <div>
                                                <div style="margin-bottom: 16px;">
                                                    <span style="display: inline-block; width: 150px;">Order ID</span>:
                                                    <span class="text-dark ms-sm-2">{{ $order->order_id }}</span>
                                                </div>
                                                <div style="margin-bottom: 16px;">
                                                    <span style="display: inline-block; width: 150px;">Point PIC</span>:
                                                    <span class="text-dark ms-sm-2">{{ $order->shipment->user->username }}</span>
                                                </div>
                                                <div style="margin-bottom: 16px;">
                                                    <span style="display: inline-block; width: 150px;">Point Name</span>:
                                                    <span class="text-dark ms-sm-2">{{ $order->point->point_name }}</span>
                                                </div>
                                                @if ($fraudReports->isNotEmpty())
                                                <div style="margin-bottom: 16px;">
                                                    <span style="display: inline-block; width: 150px;">Location Map</span>:
                                                    <span class="text-dark ms-sm-2">{{ $fraudReports->first()->location_map }}</span>
                                                </div>
                                            @else
                                                <div>No fraud reports found for this order.</div>
                                            @endif



                                                <div style="margin-bottom: 16px;">
                                                    <span style="display: inline-block; width: 150px;">Customer Name</span>:
                                                    <span class="text-dark ms-sm-2">{{ $order->customer->name }}</span>
                                                </div>
                                                <div style="margin-bottom: 16px;">
                                                    <span style="display: inline-block; width: 150px;">FeederType</span>:
                                                    <span class="text-dark ms-sm-2">{{ $order->items->first()->cobox_name ?? 'No cobox' }}</span>
                                                </div>
                                                <div style="margin-bottom: 16px;">
                                                    <span style="display: inline-block; width: 150px;">Feeder Name</span>:
                                                    @foreach ($fraudReportItems as $item)
                                                        <span class="text-dark ms-sm-2">{{ $item->serial_number }};</span>
                                                    @endforeach
                                                </div>
                                                <div style="margin-bottom: 16px;">
                                                    <span style="display: inline-block; width: 150px;">Feeder Name</span>:
                                                    @foreach ($fraudReportItems as $item)
                                                        <span class="text-dark ms-sm-2">{{ $item->cobox_id }};</span>
                                                    @endforeach
                                                </div>
                                                <div style="margin-bottom: 16px;">
                                                    <span style="display: inline-block; width: 150px;">Order Quantity</span>:
                                                    <span class="text-dark ms-sm-2">{{ $order->getTotalQuantityAttribute() }}</span>
                                                </div>
                                                <div style="margin-bottom: 16px;">
                                                    <span style="display: inline-block; width: 150px;">Reason</span>:
                                                    <span class="text-dark ms-sm-2">{{ $fraudReports->first()->reason ?? 'Reason not available' }}</span>
                                                </div>
                                                @if ($fraudReports->isNotEmpty() && $fraudReports->first()->photo_path)
                                                <div style="margin-bottom: 16px;">
                                                    <span style="display: inline-block; width: 150px;">Photo</span>:
                                                    <img src="{{ asset('storage/' . $fraudReports->first()->photo_path) }}" alt="Fraud Report Photo" class="img-fluid">
                                                </div>
                                            @else
                                                <div>No photo available for this fraud report.</div>
                                            @endif

                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
