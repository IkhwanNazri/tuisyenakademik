<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Pelajar</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-md mx-auto bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4">
                <h1 class="text-2xl font-bold text-center mb-6">QR Code Pelajar</h1>
                
                <div class="mb-4">
                    <div class="text-gray-700"><span class="font-semibold">ID:</span> {{ $pelajar->id }}</div>
                    <div class="text-gray-700"><span class="font-semibold">Nama:</span> {{ $pelajar->nama }}</div>
                    <div class="text-gray-700"><span class="font-semibold">Kelas:</span> {{ $pelajar->kelas }}</div>
                </div>
                
                <div class="flex justify-center my-6">
                    <div id="qrcode" class="border p-4 bg-white"></div>
                </div>
                
                <div class="text-center text-sm text-gray-500">
                    Sila tunjukkan QR code ini semasa pengimbasan kehadiran
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const qrcode = new QRCode(document.getElementById("qrcode"), {
                text: '{{ $pelajar->id }}',
                width: 200,
                height: 200,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
        });
    </script>
</body>
</html>