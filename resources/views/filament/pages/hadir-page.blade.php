<x-filament-panels::page>
    <!-- Add Tailwind CSS CDN -->
    @push('scripts')
        <script src="https://cdn.tailwindcss.com"></script>
    @endpush
    

    
    <div class="mb-6 text-black ">
        <!-- QR Code Scanner Section -->
        <div class="bg-white rounded-lg shadow-md p-4 mb-6 max-w-lg mx-auto">
            <h2 class="text-xl font-bold mb-4">Imbas QR Code</h2>
            
            <div id="reader" class="w-full" style="max-width: 500px; margin: 0 auto;"></div>
            
            <div id="result" class="mt-4 p-4 bg-gray-50 rounded-lg hidden">
                <div class="text-xl font-semibold mb-4">Maklumat Pelajar</div>
                <div class="space-y-2">
                    <div><span class="font-semibold">ID:</span> <span id="pelajar-id"></span></div>
                    <div><span class="font-semibold">Nama:</span> <span id="pelajar-nama"></span></div>
                    <div><span class="font-semibold">Kelas:</span> <span id="pelajar-kelas"></span></div>
                    <div><span class="font-semibold">Tarikh:</span> <span id="pelajar-tarikh"></span></div>
                    <div><span class="font-semibold">Masa:</span> <span id="pelajar-masa"></span></div>
                </div>
            </div>
            
            <div id="error" class="mt-4 p-4 bg-red-50 text-red-700 rounded-lg hidden">
                <div class="font-semibold">Error:</div>
                <div id="error-message"></div>
            </div>
            
            <div class="mt-4 text-center">
                <button id="reset-button" class="px-4 py-2 bg-blue-500 text-white rounded hidden">
                    Imbas Semula
                </button>
            </div>
        </div>
        <div class="table">
            <h1 class="text-2xl font-bold mb-4 text-white">Rekod Kedatangan</h1>
    
        </div>
        <!-- Attendance Table - Using Filament's table component -->
        {{ $this->table }}
    </div>
    
    <!-- Include necessary scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.4/html5-qrcode.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const html5QrCode = new Html5Qrcode("reader");
            const resultContainer = document.getElementById('result');
            const errorContainer = document.getElementById('error');
            const resetButton = document.getElementById('reset-button');
            
            const qrCodeSuccessCallback = (decodedText, decodedResult) => {
                html5QrCode.stop();
                
                // Get CSRF token
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                
                // Make AJAX request to get pelajar data
                fetch('{{ route("get.pelajar") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({
                        id: decodedText
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        showError(data.error);
                    } else {
                        showResult(data);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showError('Error connecting to server');
                });
            };
            
            const config = { fps: 10, qrbox: { width: 250, height: 250 } };

            // Start scanning
            function startScanning() {
                html5QrCode.start({ facingMode: "environment" }, config, qrCodeSuccessCallback)
                    .catch(err => {
                        console.error('Failed to start scanner:', err);
                        showError('Failed to start camera. Please make sure you have given camera permission.');
                    });
            }
            
            // Start scanning when page loads
            startScanning();
            
            function showResult(data) {
                document.getElementById('pelajar-id').textContent = data.id;
                document.getElementById('pelajar-nama').textContent = data.nama;
                document.getElementById('pelajar-kelas').textContent = data.kelas;
                document.getElementById('pelajar-tarikh').textContent = data.tarikh;
                document.getElementById('pelajar-masa').textContent = data.masa;
                
                resultContainer.classList.remove('hidden');
                resetButton.classList.remove('hidden');
                errorContainer.classList.add('hidden');
            }
            
            function showError(message) {
                document.getElementById('error-message').textContent = message;
                errorContainer.classList.remove('hidden');
                resetButton.classList.remove('hidden');
                resultContainer.classList.add('hidden');
            }
            
            resetButton.addEventListener('click', function() {
                resultContainer.classList.add('hidden');
                errorContainer.classList.add('hidden');
                resetButton.classList.add('hidden');
                
                startScanning();
            });
        });
    </script>
</x-filament-panels::page>