@php $trx = $getRecord(); @endphp

<div class="flex flex-col space-y-2">
    @if(isset($trx->status) && $trx->status === 'pending' && !empty($trx->bill_code))
        <a href="{{ route('toyyibpay.bayar', ['bill_code' => $trx->bill_code]) }}"
           class="w-full bg-red-500 text-white px-3 py-2 rounded-lg font-semibold text-sm hover:bg-red-600 transition text-center"
           target="_blank">
            BAYAR SEKARANG
        </a>
    @elseif(isset($trx->status) && $trx->status === 'pending')
        <span class="w-full bg-yellow-400 text-white px-3 py-2 rounded-lg font-semibold text-sm text-center">Bill belum dijana</span>
    @elseif(isset($trx->status) && ($trx->status === 'berjaya' || $trx->status === 'success'))
        <div class="space-y-2">
            <span class="w-full bg-green-500 text-white px-3 py-2 rounded-lg font-semibold text-sm text-center block">Sudah Bayar</span>
            <a href="{{ route('transaction.pdf', ['id' => $trx->id]) }}"
               class="w-full bg-blue-500 text-white px-3 py-2 rounded-lg font-semibold text-sm hover:bg-blue-600 transition text-center block"
               target="_blank">
                📄 Lihat PDF
            </a>
        </div>
    @else
        <span class="w-full bg-gray-300 text-gray-600 px-3 py-2 rounded-lg font-semibold text-sm text-center">Status: {{ ucfirst($trx->status ?? 'Unknown') }}</span>
    @endif
</div> 