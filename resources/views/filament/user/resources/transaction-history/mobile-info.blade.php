<div class="space-y-2">
    <div class="flex justify-between items-start">
        <div class="flex-1">
            <div class="font-semibold text-gray-900">{{ $transaction->kelas }}</div>
            <div class="text-sm text-gray-600">RM {{ number_format($transaction->harga_kelas, 2) }}</div>
        </div>
        <div class="ml-2">
            @if($transaction->status === 'berjaya')
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    Berjaya
                </span>
            @elseif($transaction->status === 'pending')
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                    Pending
                </span>
            @else
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                    {{ ucfirst($transaction->status) }}
                </span>
            @endif
        </div>
    </div>
    
    <div class="text-xs text-gray-500">
        {{ $transaction->tarikh ? $transaction->tarikh->format('d/m/Y H:i') : 'N/A' }}
    </div>
    
    @if($transaction->bill_code)
        <div class="text-xs text-gray-500">
            Bill: {{ $transaction->bill_code }}
        </div>
    @endif
</div> 