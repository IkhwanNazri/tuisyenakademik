<div>
    <div id="qrcode-{{ $getRecord()->id }}" class="qr-code"></div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            generateQRCode('{{ $getRecord()->id }}', 'qrcode-{{ $getRecord()->id }}');
        });
    </script>
</div>