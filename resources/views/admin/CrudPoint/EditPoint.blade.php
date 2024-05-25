<!-- resources/views/admin/points/edit.blade.php -->

@extends('admin.layout.layout')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Point</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('update-point', ['id' => $point->point_id]) }}">
                        @csrf
                        <div class="form-group">
                            <label for="point_name">Point Name</label>
                            <input type="text" class="form-control" id="point_name" name="point_name" value="{{ $point->point_name }}">
                        </div>
                        <div class="form-group">
                            <label class="label-control">Aktivitas Lokasi</label>
                            <div>
                                <p class="text-xs font-weight-bold mb-0" id="locationDisplay" style="display: flex;"></p>
                                <button type="button" class="btn btn-success" onclick="getLocation()">Perbarui Lokasi</button>
                                <!-- Input tersembunyi untuk menyimpan data lokasi -->
                                <input type="hidden" id="locationInput" name="location">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Point</button>
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
        var pointName = document.getElementById("point_name").value;
        var locationInput = document.getElementById("locationInput").value;

        if (pointName.trim() === "") {
            alert("Silakan isi Nama Point.");
            return false;
        }

        if (locationInput.trim() === "") {
            alert("Silakan perbarui lokasi sebelum menambahkan titik.");
            return false;
        }

        return true;
    }
</script>
@endsection
