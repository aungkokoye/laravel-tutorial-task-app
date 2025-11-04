<!DOCTYPE html>
<html>
<head>
    <title>@yield('header-title', 'Task App')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="//unpkg.com/alpinejs" defer></script>

    <style type="text/tailwindcss">
        .btn-m {
            @apply rounded-md text-center px-4 py-2 font-medium ring-1 shadow-sm;
        }

        .btn-l {
            @apply rounded-lg text-center px-4 py-2 font-medium ring-1 shadow-sm;
        }

        .btn-primary {
            @apply bg-blue-400 text-white hover:bg-blue-700;
        }

        .btn-success {
            @apply bg-green-400 text-white hover:bg-green-700;
        }

        .btn-danger {
            @apply bg-red-400 text-white hover:bg-red-700;
        }

        .btn-default {
            @apply bg-gray-400 text-white hover:bg-gray-700;
        }

        .flex-container {
            @apply flex items-center mb-4 gap-2;
        }

        .label {
            @apply block font-medium mb-2 uppercase text-sm text-gray-700;
        }

        .input, .textarea {
            @apply appearance-none border rounded-md px-3 py-2 w-full focus:ring-blue-400;
        }

        .filter-container {
            @apply mb-4 flex space-x-2 rounded-md bg-slate-100 p-2;
        }

        .filter-item {
            @apply flex w-full items-center justify-center rounded-md px-4 py-2 text-center text-sm font-medium text-slate-500;
        }
    </style>
</head>
<body>
    <div class="container mx-auto px-4 py-10 max-w-screen-xl" x-data="{ showAlert: true }">

        @if (session()->has('success'))
            <div class="relative bg-green-100 border border-green-500 text-green-700 px-4 py-3 rounded mb-6"
                 role="alert" x-show="showAlert">
                {{ session('success')}}
                <div class="absolute top-0 right-0 mr-5 cursor-pointer" @click="showAlert=false"> x </div>
            </div>
        @endif

        <h1 class="text-2xl mb-4">@yield('page-title')</h1>

        @yield('content')
   </div>
</body>
</html>
