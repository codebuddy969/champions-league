<!DOCTYPE html>
<html>
<head>
    <title>Insider Champions League</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/js/app.js'])
</head>
<body class="container mx-auto py-4 max-w-4xl px-4">

<h1 class="text-3xl font-bold text-gray-800 mb-6">Insider Champions League</h1>

<div class="flex space-x-4 mb-6">
    <form action="{{ route('simulate.all') }}" method="POST" class="inline">
        @csrf
        <button class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
            Play All Weeks
        </button>
    </form>
    <form action="{{ route('simulate.reset') }}" method="POST" class="inline">
        @csrf
        <button class="px-4 py-2 bg-amber-500 text-white rounded-md hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 transition-colors">
            Reset League
        </button>
    </form>
</div>

<div id="app">
    <league-dashboard
        :standings='@json($standings)'
        :weekly-results='@json($weeklyResults)'
        :predictions='@json($predictions)'>
    </league-dashboard>
</div>

</body>
</html>
