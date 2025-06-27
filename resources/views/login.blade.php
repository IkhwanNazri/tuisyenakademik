<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-100 via-white to-pink-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md p-8 bg-white rounded-2xl shadow-2xl border border-blue-200">
        <div class="flex flex-col items-center mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-500 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0-1.104-.896-2-2-2s-2 .896-2 2 .896 2 2 2 2-.896 2-2zm0 0c0 1.104.896 2 2 2s2-.896 2-2-.896-2-2-2-2 .896-2 2zm0 0v2m0 4h.01" /></svg>
            <h1 class="text-3xl font-extrabold text-blue-700 mb-1 text-center">Pusat Tuisyen Akademik Terbilang </h1>
            <p class="text-gray-500 text-sm">Sila login untuk akses dashboard</p>
        </div>
        @if(session('error'))
            <div class="mb-4 p-3 rounded bg-red-100 text-red-800 border border-red-200 text-center">
                {{ session('error') }}
            </div>
        @endif
        <form action="/login" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block mb-1 font-semibold text-gray-700" for="email">Email</label>
                <input type="email" id="email" name="email" class="w-full border border-blue-200 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required autofocus>
            </div>
            <div>
                <label class="block mb-1 font-semibold text-gray-700" for="password">Password</label>
                <input type="password" id="password" name="password" class="w-full border border-blue-200 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg font-bold hover:bg-blue-700 transition">Login</button>
        </form>
        <a href="/daftar" class="block text-center mt-6 text-blue-600 hover:underline font-semibold">New Registration</a>
    </div>
</body>
</html> 