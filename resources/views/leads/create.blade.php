@extends('admin.layout.layout')

@section('content')
<div class="container">
    <h1>Add New Lead</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('leads.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="ktp_image">Upload KTP Image: @isRequired('ktp_image')</label>
            <input type="file" class="form-control" id="ktp_image" name="ktp_image" accept="image/*" required onchange="uploadAndExtractKtp()">
            <div class="row">
                <div class="col" id="ktp_preview"></div>
                <div class="col" id="ktp_data" style="margin-top: 20px;"></div>
            </div>
        </div>
        <div class="form-group">
            <label for="email">Email: @isRequired('email')</label>
            <input type="email" name="email" id="email" class="form-control" required>
            <button type="button" id="verifyEmailButton" class="btn btn-primary mt-2">Verify Email</button>
            <span id="emailStatus" class="ml-2"></span>
        </div>

        <div class="form-group">
            <label for="phone_number">Phone Number: @isRequired('phone_number')</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" required>
            <button type="button" id="verifyPhoneNumberButton" class="btn btn-primary mt-2">Verify Phone Number</button>
            <span id="phoneNumberStatus" class="ml-2"></span>
        </div>

        <div class="form-group">
            <label for="salutation">Salutation:  @isRequired('salutation')</label>
            <select name="salutation" class="form-control">
                <option value="Bapak">Bapak</option>
                <option value="Ibu">Ibu</option>
                <option value="-" selected>-</option>
            </select>
        </div>

        <div class="form-group">
            <label for="fishery-address">Fishery Address:  @isRequired('fishery_address')</label>
            <input type="text" class="form-control" id="fishery-address" name="fishery_address" placeholder="Enter fishery address">
            <button type="button" class="btn btn-primary mt-2" onclick="showMapByAddress()">Show on Map by Address</button>
            <button type="button" class="btn btn-secondary mt-2" onclick="getLatLng()">Get Lat/Lng from Address</button>
        </div>
        <div class="form-group">
            <label for="latitude">Fishery Latitude: @isRequired('fishery_lat')</label>
            <input type="text" class="form-control" id="fishery_lat" name="fishery_lat" placeholder="Enter latitude">
        </div>
        <div class="form-group">
            <label for="longitude">Fishery Longitude:  @isRequired('fishery_lng')</label>
            <input type="text" class="form-control" id="fishery_lng" name="fishery_lng" placeholder="Enter longitude">
            <button type="button" class="btn btn-primary mt-2" onclick="showMapByLatLng()">Show on Map by Lat/Lng</button>
            <button type="button" class="btn btn-secondary mt-2" onclick="getAddress()">Get Address from Lat/Lng</button>
        </div>
        <div id="map" style="height: 400px; width: 100%; margin-top: 20px;"></div>
    

        <div class="form-group">
            <label for="first_name">First Name: @isRequired('first_name')</label>
            <input type="text" class="form-control" name="first_name" id="first_name" required>
        </div>
        <div class="form-group">
            <label for="last_name">Last Name: @isRequired('last_name')</label>
            <input type="text" class="form-control" name="last_name" id="last_name" required>
        </div>

        <div class="form-group">
            <label for="kota">Kota: @isRequired('kota')</label>
            <input type="text" class="form-control" id="kota" name="kota">
        </div>
        <div class="form-group">
            <label for="provinsi">Provinsi: @isRequired('provinsi')</label>
            <input type="text" class="form-control" id="provinsi" name="provinsi">
        </div>
        <div class="form-group">
            <label for="address">Address: @isRequired('address')</label>
            <textarea class="form-control" name="address" id="address"></textarea>
        </div>
        <div class="form-group">
            <label for="NIK">NIK: @isRequired('NIK')</label>
            <input type="text" class="form-control" name="NIK" id="NIK">
        </div>
        <div class="form-group">
            <label for="NPWP">NPWP: @isRequired('NPWP')</label>
            <input type="text" class="form-control" name="NPWP"id="NPWP">
        </div>
        <div class="form-group">
            <label for="status">Status: @isRequired('status')</label>
            <select name="status" class="form-control">
                <option value="open" selected>Open</option>
                <option value="contacted">Contacted</option>
                <option value="qualified">Qualified</option>
                <option value="unqualified">Unqualified</option> 
            </select>
        </div>
        <div class="form-group">
            <label for="source">Source: @isRequired('status')</label>
            <select name="source" class="form-control">
                <option value="Advertisement">Advertisement</option>
                <option value="Web" selected>Web</option>
                <option value="Word of Mouth">Word of Mouth</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <div class="form-group">
            <label for="survey_description">Survey Description: @isRequired('survey_description')</label>
            <textarea class="form-control" name="survey_description"></textarea>
        </div>

        <div class="form-group">
            <label for="survey_images">Survey Images: @isRequired('survey_images.*')</label>
            <input type="file" class="form-control" id="survey_images" name="survey_images[]" accept="image/*" multiple onchange="previewSurveyImages()">
        </div>
        <div id="imagePreview" class="row"></div>

        <button type="submit" class="btn btn-primary">Add Lead</button>
    </form>
</div>
<script>
      
function previewSurveyImages() {
    var files = document.getElementById('survey_images').files;
    var previewContainer = document.getElementById('imagePreview');
    previewContainer.innerHTML = ''; // Clear any existing previews

    if (files) {
        Array.from(files).forEach(file => {
            if (file.type.match('image.*')) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.maxWidth = '100%';
                    img.style.margin = '10px';
                    previewContainer.appendChild(img);
                }
                reader.readAsDataURL(file);
            }
        });
    }
}
function splitName(fullName) {
    const parts = fullName.split(' ');
    const firstName = parts.slice(0, -1).join(' ');
    const lastName = parts.slice(-1).join(' ');
    return { firstName, lastName };
}
function previewKTP() {
    var file = document.getElementById('ktp_image').files[0];
    var previewContainer = document.getElementById('ktp_preview');
    previewContainer.innerHTML = ''; // Clear any existing previews

    if (file && file.type.match('image.*')) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var img = document.createElement('img');
            img.src = e.target.result;
            img.style.maxWidth = '400px';
            img.style.margin = '10px';
            img.style.padding = '20px';
            previewContainer.appendChild(img);
        }
        reader.readAsDataURL(file);
    }
}
function uploadAndExtractKtp() {
    var file = document.getElementById('ktp_image').files[0];
    var previewContainer = document.getElementById('ktp_preview');
    var ktpDataContainer = document.getElementById('ktp_data');
    previewContainer.innerHTML = ''; // Clear any existing previews
    ktpDataContainer.innerHTML = ''; // Clear any existing data

    if (file && file.type.match('image.*')) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var img = document.createElement('img');
            img.src = e.target.result;
            img.style.maxWidth = '400px';
            img.style.margin = '10px';
            img.style.padding = '20px';
            previewContainer.appendChild(img);

            // Create form data
            var formData = new FormData();
            formData.append('ktp_image', file);

            // Send the file to the server
            fetch('{{ route('leads.ocr-ktp') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log(data); // Debugging line
                // Display the KTP data and autofill the form
                if (data && data.data) {
                    var ktpInfo = data.data;
                    const { firstName, lastName } = splitName(ktpInfo.name);
                    document.getElementById('first_name').value = firstName;
                    document.getElementById('last_name').value = lastName;
                    document.getElementById('NIK').value = ktpInfo.idNumber;
                    document.getElementById('provinsi').value = ktpInfo.province;
                    document.getElementById('kota').value = ktpInfo.city;
                    document.getElementById('address').value = ktpInfo.province +' / '+
                                                               ktpInfo.city +' / '+
                                                               ktpInfo.district +' / '+ 
                                                               ktpInfo.village +' / '+
                                                               ktpInfo.address +' / '+ 
                                                               ' RT/RW ' + ktpInfo.rtrw;
                    ktpDataContainer.innerHTML = `
                    <h3>KTP Data</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Field</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td>${ktpInfo.name}</td>
                            </tr>
                            <tr>
                                <td>Tempat Tanggal Lahir</td>
                                <td>${ktpInfo.birthPlaceBirthday}</td>
                            </tr>
                            <tr>
                                <td>NIK</td>
                                <td>${ktpInfo.idNumber}</td>
                            </tr>
                            <tr>
                                <td>Provinsi</td>
                                <td>${ktpInfo.province}</td>
                            </tr>
                            <tr>
                                <td>Kota</td>
                                <td>${ktpInfo.city}</td>
                            </tr>
                            <tr>
                                <td>Kecamatan</td>
                                <td>${ktpInfo.district}</td>
                            </tr>
                            <tr>
                                <td>Kel/Desa</td>
                                <td>${ktpInfo.village}</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>${ktpInfo.address}</td>
                            </tr>
                            <tr>
                                <td>RT/RW</td>
                                <td>${ktpInfo.rtrw}</td>
                            </tr>
                        </tbody>
                    </table>
                    `;
                } else {
                    ktpDataContainer.innerHTML = '<p>Error extracting KTP data.</p>';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                ktpDataContainer.innerHTML = '<p>Error uploading or processing KTP image.</p>';
            });
        }
        reader.readAsDataURL(file);
    }
}

// EMAIL VERIFICATION SCRIPT
document.getElementById('verifyEmailButton').addEventListener('click', function() {
    var email = document.getElementById('email').value;
    var emailStatus = document.getElementById('emailStatus');
    var csrfToken = '{{ csrf_token() }}';

    if (!email) {
        emailStatus.textContent = 'Please enter an email address.';
        emailStatus.classList.remove('text-success', 'text-danger');
        emailStatus.classList.add('text-warning');
        return;
    }

    emailStatus.textContent = 'Verifying...';
    emailStatus.classList.remove('text-success', 'text-danger', 'text-warning');
    emailStatus.classList.add('text-info');

    fetch("{{ route('leads.verifyEmail') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ email: email })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'valid') {
            emailStatus.textContent = 'This is a Valid Email Address.';
            emailStatus.classList.remove('text-info', 'text-danger');
            emailStatus.classList.add('text-success');
        } else {
            emailStatus.textContent = 'This is an Invalid Email Address.';
            emailStatus.classList.remove('text-info', 'text-success');
            emailStatus.classList.add('text-danger');
        }
    })
    .catch(error => {
        emailStatus.textContent = 'Error verifying email.';
        emailStatus.classList.remove('text-info', 'text-success');
        emailStatus.classList.add('text-danger');
    });
});

// PHONE NUMBER VERIFICATION SCRIPT
document.getElementById('verifyPhoneNumberButton').addEventListener('click', function() {
    var phoneNumber = document.getElementById('phone_number').value;
    var phoneNumberStatus = document.getElementById('phoneNumberStatus');
    var csrfToken = '{{ csrf_token() }}';

    if (!phoneNumber) {
        phoneNumberStatus.textContent = 'Please enter a phone number.';
        phoneNumberStatus.classList.remove('text-success', 'text-danger');
        phoneNumberStatus.classList.add('text-warning');
        return;
    }

    phoneNumberStatus.textContent = 'Verifying...';
    phoneNumberStatus.classList.remove('text-success', 'text-danger', 'text-warning');
    phoneNumberStatus.classList.add('text-info');

    fetch("{{ route('leads.verifyPhoneNumber') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ phone_number: phoneNumber })
    })
    .then(response => response.json())
    .then(data => {
        if (data.valid) {
            phoneNumberStatus.textContent = 'Phone number is valid.';
            phoneNumberStatus.classList.remove('text-info', 'text-danger');
            phoneNumberStatus.classList.add('text-success');
        } else {
            phoneNumberStatus.textContent = 'Phone number is not valid.';
            phoneNumberStatus.classList.remove('text-info', 'text-success');
            phoneNumberStatus.classList.add('text-danger');
        }
    })
    .catch(error => {
        phoneNumberStatus.textContent = 'Error verifying phone number.';
        phoneNumberStatus.classList.remove('text-info', 'text-success');
        phoneNumberStatus.classList.add('text-danger');
    });
});
</script>

<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap&libraries=places&v=weekly" async defer></script>
<script>
    
// GOOGLE MAPS SCRIPT

let map, geocoder;

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: -6.9174639, lng: 107.6191228},
        zoom: 8
    });
    geocoder = new google.maps.Geocoder();
}

function showMapByAddress() {
    const address = document.getElementById('fishery-address').value;
    geocodeAddress(geocoder, map, address);
}

function showMapByLatLng() {
    const lat = parseFloat(document.getElementById('fishery_lat').value);
    const lng = parseFloat(document.getElementById('fishery_lng').value);
    if (!isNaN(lat) && !isNaN(lng)) {
        const location = {lat: lat, lng: lng};
        map.setCenter(location);
        map.setZoom(12); // Set custom zoom level here
        new google.maps.Marker({
            map: map,
            position: location
        });
    } else {
        alert('Please enter valid latitude and longitude values.');
    }
}

function getLatLng() {
    const address = document.getElementById('fishery-address').value;
    geocodeAddressToLatLng(geocoder, address);
}

function getAddress() {
    const lat = parseFloat(document.getElementById('fishery_lat').value);
    const lng = parseFloat(document.getElementById('fishery_lng').value);
    if (!isNaN(lat) && !isNaN(lng)) {
        const location = {lat: lat, lng: lng};
        geocodeLatLngToAddress(geocoder, location);
    } else {
        alert('Please enter valid latitude and longitude values.');
    }
}

function geocodeAddress(geocoder, resultsMap, address) {
    geocoder.geocode({'address': address}, function(results, status) {
        if (status === 'OK') {
            resultsMap.setCenter(results[0].geometry.location);
            new google.maps.Marker({
                map: resultsMap,
                position: results[0].geometry.location
            });
        } else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
    });
}

function geocodeAddressToLatLng(geocoder, address) {
    geocoder.geocode({'address': address}, function(results, status) {
        if (status === 'OK') {
            const location = results[0].geometry.location;
            document.getElementById('fishery_lat').value = location.lat();
            document.getElementById('fishery_lng').value = location.lng();
        } else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
    });
}

function geocodeLatLngToAddress(geocoder, location) {
    geocoder.geocode({'location': location}, function(results, status) {
        if (status === 'OK') {
            if (results[0]) {
                document.getElementById('fishery-address').value = results[0].formatted_address;
            } else {
                alert('No results found');
            }
        } else {
            alert('Geocoder failed due to: ' + status);
        }
    });
}

document.addEventListener('DOMContentLoaded', function () {
    console.log('JS Loaded...');
});


</script>
@endsection

