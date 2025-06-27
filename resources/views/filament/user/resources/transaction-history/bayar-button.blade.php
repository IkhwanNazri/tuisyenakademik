@php $trx = $getRecord(); @endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <title>Document</title>
</head>

    @if(isset($trx->status) && $trx->status === 'pending' && !empty($trx->bill_code))
    <a href="{{ route('toyyibpay.bayar', ['bill_code' => $trx->bill_code]) }}"
       class="bg-red-500 text-white px-5 py-1 rounded-lg font-bold shadow-lg hover:bg-green-700 transition animate-pulse flex items-center gap-2"
       style="box-shadow: 0 4px 14px 0 rgba(34,197,94,0.25);"
       target="_blank">
        <span>BAYAR SEKARANG</span>
    </a>
@elseif(isset($trx->status) && $trx->status === 'pending')
    <span class="inline-block bg-yellow-400 text-white px-4 py-2 rounded-lg font-semibold">Bill belum dijana</span>
@elseif(isset($trx->status) && ($trx->status === 'berjaya' || $trx->status === 'success'))
    <div class="flex gap-2">
        <span class="inline-block bg-green-500 text-white px-4 py-2 rounded-lg font-semibold">Sudah Bayar</span>
        <a href="{{ route('transaction.pdf', ['id' => $trx->id]) }}"
           class="bg-blue-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-600 transition flex items-center gap-2"
           target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
            </svg>
            PDF
        </a>
    </div>
@else
    <span class="inline-block bg-gray-300 text-gray-600 px-4 py-2 rounded-lg font-semibold">Status: {{ ucfirst($trx->status ?? 'Unknown') }}</span>
@endif 

</html>
