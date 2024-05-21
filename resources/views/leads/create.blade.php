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
            <label for="salutation">Salutation</label>
            <select name="salutation" class="form-control">
                <option value="Bapak">Bapak</option>
                <option value="Ibu">Ibu</option>
                <option value="-" selected>-</option>
            </select>
        </div>

        <div class="form-group">
            <label for="ktp_image">Upload KTP Image:</label>
            <input type="file" class="form-control" id="ktp_image" name="ktp_image" accept="image/*" required onchange="uploadAndExtractKtp()">
            <div class="row">
                <div class="col" id="ktp_preview"></div>
                <div class="col" id="ktp_data" style="margin-top: 20px;"></div>
            </div>
        </div>

        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" class="form-control" name="first_name" id="first_name" required>
        </div>
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control" name="last_name" id="last_name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" required>
        </div>
        <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input type="text" class="form-control" id="phone_number"name="phone_number">
        </div>
        <div class="form-group">
            <label for="kota">Kota</label>
            <input type="text" class="form-control" id="kota" name="kota">
        </div>
        <div class="form-group">
            <label for="provinsi">Provinsi</label>
            <input type="text" class="form-control" id="provinsi" name="provinsi">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <textarea class="form-control" name="address" id="address"></textarea>
        </div>
        <div class="form-group">
            <label for="NIK">NIK</label>
            <input type="text" class="form-control" name="NIK" id="NIK">
        </div>
        <div class="form-group">
            <label for="NPWP">NPWP</label>
            <input type="text" class="form-control" name="NPWP"id="NPWP">
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control">
                <option value="open" selected>Open</option>
                <option value="contacted">Contacted</option>
                <option value="qualified">Qualified</option>
                <option value="unqualified">Unqualified</option> 
            </select>
        </div>
        <div class="form-group">
            <label for="source">Source</label>
            <select name="source" class="form-control">
                <option value="Advertisement">Advertisement</option>
                <option value="Web" selected>Web</option>
                <option value="Word of Mouth">Word of Mouth</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <div class="form-group">
            <label for="survey_description">Survey Description</label>
            <textarea class="form-control" name="survey_description"></textarea>
        </div>

        <div class="form-group">
            <label for="survey_images">Survey Images</label>
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

</script>
@endsection

