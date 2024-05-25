<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="/images/logo.png">
    <link rel="icon" type="image/png" href="/images/logo.png">
    <title>
        Dashboard eFishery Learning
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link rel="stylesheet" href="/path/to/font-awesome/css/font-awesome.min.css">
    <link href="/template/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="/template/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <!-- Tambahkan di bagian <head> dari dokumen HTML Anda -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.2/dist/js/bootstrap.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="/template/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="/template/assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <link rel="stylesheet" href="/css/bootstrap-datetimepicker.min.css">
    <link href="/css/custom.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />

    {{-- Sweet Alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- JS --}}
    <script src="/js/jquery.min.js"></script>
    <script src="./node_modules/html5-qrcode/html5-qrcode.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.4/html5-qrcode.min.js" integrity="sha512-k/KAe4Yff9EUdYI5/IAHlwUswqeipP+Cp5qnrsUjTPCgl51La2/JhyyjNciztD7mWNKLSXci48m7cctATKfLlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body class="g-sidenav-show   bg-gray-100">
    <div class="min-height-300  position-absolute w-100"></div>
    @include('admin.layout.aside')
    <main class="main-content position-relative border-radius-lg ">
        <!-- Navbar -->
        @include('admin.layout.navbar')
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            @yield('content')
            @include('admin.layout.footer')
        </div>
    </main>
    @include('admin.layout.plugin')

    <!--   Core JS Files   -->
    <!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="/template/assets/js/core/popper.min.js"></script>
    <script src="/template/assets/js/core/bootstrap.min.js"></script>
    <script src="/template/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="/template/assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="/template/assets/js/plugins/chartjs.min.js"></script>
    <script src="https://kit.fontawesome.com/ed9e9e0b29.js" crossorigin="anonymous"></script>
    <script>
        var ctx1 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
        gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
        new Chart(ctx1, {
            type: "bar",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Mobile apps",
                    tension: 0.4,
                    borderWidth: 20,
                    pointRadius: 50,
                    borderColor: "#4DC7A2",
                    backgroundColor: gradientStroke1,
                    borderWidth: 3,
                    fill: true,
                    data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#black',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#ccc',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
  <!-- Html5QrcodeScanne -->
  <script>
   let scannerInstance = null; // Definisikan scannerInstance di ruang lingkup global

   function startScanner(targetId, overlayId, barcodeId, inputId, type) {
    console.log(`Starting scanner for ${targetId}, overlay ${overlayId}, barcode ${barcodeId}, type ${type}`);
    if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
        console.log("Browser does not support necessary media devices.");
        alert("This browser does not support the necessary media devices.");
        return;
    }

    navigator.mediaDevices.getUserMedia({ video: true })
        .then(function(stream) {
            console.log("Media stream obtained, showing scanner interface");
            document.getElementById(targetId).style.display = 'block';
            document.getElementById(overlayId).style.display = 'block';

            // Selalu buat instance baru
            console.log("Initializing new scanner...");
            if (scannerInstance) {
                scannerInstance.clear().catch(err => console.error("Failed to clear old scanner instance: ", err));
            }
            initializeScanner(targetId, barcodeId, inputId, type);
        })
        .catch(function(err) {
            console.error("Error accessing the camera: ", err);
            alert("Error accessing the camera: " + err.message);
        });
}

function initializeScanner(targetId, barcodeId, inputId, type) {
    console.log("Initializing scanner for target: " + targetId);
    scannerInstance = new Html5QrcodeScanner(targetId, { fps: 10, qrbox: 250 }, true);
    scannerInstance.render((result) => success(result, barcodeId, inputId, type), handleScanError);
}

function scanFeeder(index) {
    console.log("Scanner Feeder Button Clicked");
    startScanner(`reader_feeder_${index}`, `overlay_feeder_${index}`, `barcode_feeder_${index}`, `serial_number_${index}`, 'feeder');
}

function scanCobox(index) {
    console.log("Scanner Cobox Button Clicked");
    startScanner(`reader_cobox_${index}`, `overlay_cobox_${index}`, `barcode_cobox_${index}`, `cobox_id_${index}`, 'cobox');
}

function success(result, barcodeId, inputId, type) {
    console.log(`Scanned barcode: ${result}, expected type: ${type}`);
    if ((type === 'feeder' && result.length !== 19) || (type === 'cobox' && result.length !== 22)) {
        alert(`Invalid barcode length for ${type}. Please scan a valid ${type} barcode.`);
        return;
    }

    document.getElementById(barcodeId).innerHTML = `<p><a href="${result}">${result}</a></p>`;
    document.getElementById(inputId).value = result;
    closeScanner();
}

function handleScanError(err) {
    console.error('Scanning Error:', err);
}

function closeScanner() {
    console.log("Closing scanner...");
    document.querySelectorAll('.scanner-popup').forEach(el => el.style.display = 'none');
    document.querySelectorAll('.overlay').forEach(el => el.style.display = 'none');
    if (scannerInstance) {
        scannerInstance.clear().catch(err => {
            console.error("Failed to clear the scanner: ", err);
        });
    }
}


    </script>



    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="/template/assets/js/argon-dashboard.min.js?v=2.0.4"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>

    {{-- Custom JS --}}
    <script src="/js/script.js"></script>
    <script src="/js/rome.js"></script>
    <script src="/js/moment-with-locales.min.js"></script>
    <script src="/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/js/main.js"></script>


</body>

</html>
