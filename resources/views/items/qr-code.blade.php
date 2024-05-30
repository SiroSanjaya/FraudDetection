<!-- resources/views/items/qr-code.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .center {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
            text-align: center;
        }
        .qr-code-container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="center">
        <div class="qr-code-container">
            <h2>Serial Number:</h2>
            <img src="data:image/svg+xml;base64,{{ $serialNumberQrCode }}" alt="Serial Number QR Code">
        </div>
        <div class="qr-code-container">
            <h2>Cobox ID:</h2>
            <img src="data:image/svg+xml;base64,{{ $coboxIdQrCode }}" alt="Cobox ID QR Code">
        </div>
    </div>
</body>
</html>
