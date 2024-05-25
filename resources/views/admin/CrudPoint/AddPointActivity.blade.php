@extends('admin.layout.layout')
@section('content')
<style>
/* Style untuk overlay */
.overlay, .scanner-popup {
    display: none; /* Pastikan ini diatur seperti ini secara default */
    position: fixed; /* Contoh untuk memastikan elemen scanner muncul di atas */
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 999; /* Pastikan z-index cukup tinggi */
    background-color: rgba(0, 0, 0, 0.5); /* Overlay */
}

.scanner-popup {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%); /* Center the scanner */
    width: 300px;
    background-color: white;
    z-index: 1000;
}

.reason-link {
    color: #007bff;
    cursor: pointer;
    text-decoration: underline;
}

.reason-link:hover {
    color: #0056b3;
}

.hidden {
    display: none;
}
</style>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="text-capitalize">Form Activity</h4>
                        </div>
                        <div class="col-6 text-end">
                            {{-- <a class="btn bg-gradient-success mb-0" href="{{ route('PointDetail') }}"><i class="fas fa-sign-out"></i>&nbsp;&nbsp;Back</a> --}}
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">
                    <form action="{{ route('processActivityForm') }}" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="order_id" class="form-control-label">Order ID</label>
                                            <input class="form-control" type="text" value="{{ $order->order_id }}" name="order_id" id="order_id" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="pic_point" class="form-control-label">PIC Point</label>
                                        <input class="form-control" type="text" value="{{ $order->shipment->user->username }}" name="pic_point" id="pic_point" readonly>
                                    </div>
                                </div>
                                <div class="col-md-">
                                    <div class="form-group">
                                        <label for="point_name" class="form-control-label">Point</label>
                                        <input class="form-control" type="text" value="{{ $order->point->point_name }}" name="point_name" id="point_name" readonly>
                                    </div>
                                </div>
                                <div class="col-md-">
                                    <div class="form-group">
                                        <label for="customer_name" class="form-control-label">Customer Name</label>
                                        <input class="form-control" type="text" value="{{ $order->customer->name }}" name="customer_name" id="customer_name" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="locationDisplay" class="form-control-label">Aktivitas Lokasi</label>
                                    <div>
                                        <p class="text-xs font-weight-bold mb-0" id="locationDisplay" name="location_map" style="display: flex;"></p>
                                        <button type="button" class="btn btn-success" data-mdb-ripple-init onclick="getLocation()">Perbarui Lokasi</button>
                                        <input type="hidden" id="locationInput" name="location_map">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Scan Feeder</label>
                                    <div id="scannerButtonsContainer">
                                        @for ($i = 0; $i < $order->getTotalQuantityAttribute(); $i++)
                                        <div>
                                            <div id="overlay_feeder_{{$i}}" class="overlay"></div>
                                            <p class="text-xs font-weight-bold mb-0" id="barcode_feeder_{{$i}}"></p>
                                            <input type="hidden" name="items[{{$i}}][serial_number]" id="serial_number_{{$i}}">
                                            <button type="button" class="btn btn-success" onclick="scanFeeder({{$i}})">SCAN FEEDER</button>
                                            <div id="reader_feeder_{{$i}}" class="scanner-popup"></div>
                                        </div>
                                        <div class="form-group">
                                            <div>
                                                <div id="overlay_cobox_{{$i}}" class="overlay"></div>
                                                <p class="text-xs font-weight-bold mb-0" id="barcode_cobox_{{$i}}"></p>
                                                <input type="hidden" name="items[{{$i}}][cobox_id]" id="cobox_id_{{$i}}">
                                                <button type="button" class="btn btn-success" onclick="scanCobox({{$i}})">SCAN COBOX</button>
                                                <div id="reader_cobox_{{$i}}" class="scanner-popup"></div>
                                            </div>
                                        </div>
                                        @endfor
                                    </div>
                                </div>
                                <div class="col-md-">
                                    <label for="formFileMultiple" class="form-control-label">Foto Hasil Point</label>
                                    <input class="form-control" type="file" id="formFileMultiple" name="photo" multiple required />
                                </div>
                                <div class="form-group">
                                    <label for="reason" class="form-control-label">Resume Activities</label>
                                    <textarea class="form-control" id="reason" placeholder="Enter Your Quiz Description" rows="3" name="reason" required></textarea>
                                </div>
                                <div class="col-1 text-end">
                                    <button class="btn bg-gradient-success mb-2" type="submit">&nbsp;&nbsp;Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function getLocation() {
        console.log("Getting location...");
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            document.getElementById("locationDisplay").innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
        console.log("Position retrieved:", position);
        const latitude = position.coords.latitude;
        const longitude = position.coords.longitude;
        document.getElementById("locationDisplay").innerHTML = "<div class='geo-data'><span>Latitude: " + latitude + "</span>" +
                      "<span style='display: inline-block; margin-bottom: 20px; margin-left: 20px'>Longitude: " + longitude + "</span></div>";
        document.getElementById('locationInput').value = "Latitude: " + latitude + ", Longitude: " + longitude;
    }

    function showError(error) {
        console.log("Geolocation error:", error);
        switch(error.code) {
            case error.PERMISSION_DENIED:
                document.getElementById("locationDisplay").innerHTML = "User denied the request for Geolocation.";
                break;
            case error.POSITION_UNAVAILABLE:
                document.getElementById("locationDisplay").innerHTML = "Location information is unavailable.";
                break;
            case error.TIMEOUT:
                document.getElementById("locationDisplay").innerHTML = "The request to get user location timed out.";
                break;
            case error.UNKNOWN_ERROR:
                document.getElementById("locationDisplay").innerHTML = "An unknown error occurred.";
                break;
        }
    }

    function validateForm() {
        const orderID = document.getElementById('order_id').value;
        const picPoint = document.getElementById('pic_point').value;
        const pointName = document.getElementById('point_name').value;
        const customerName = document.getElementById('customer_name').value;
        const locationInput = document.getElementById('locationInput').value;
        const reason = document.getElementById('reason').value;
        const photo = document.getElementById('formFileMultiple').files.length;

        if (orderID.trim() === "" || picPoint.trim() === "" || pointName.trim() === "" ||
            customerName.trim() === "" || locationInput.trim() === "" || reason.trim() === "" || photo === 0) {
            alert("Semua kolom harus diisi kecuali barcode cobox ID dan serial number.");
            return false;
        }

        return true;
    }
</script>

@endsection
