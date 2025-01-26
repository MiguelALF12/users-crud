<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'User Management')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <header class="bg-white shadow">
        <div class="container mx-auto p-4 flex justify-between items-center">
            <h1 class="text-xl font-bold">User Management</h1>
            @auth
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Logout</button>
            </form>
            @endauth
        </div>
    </header>
    <!-- Notification Section -->
    @if (session('notify'))
    <div
        id="notification"
        class="fixed top-5 right-5 bg-{{ session('notify')['type'] === 'success' ? 'green' : (session('notify')['type'] === 'error' ? 'red' : 'blue') }}-500 text-white px-4 py-2 rounded-lg shadow-lg flex items-center justify-between"
        style="min-width: 300px;">
        <span>{{ session('notify')['message'] }}</span>
        <button onclick="closeNotification()" class="ml-4 text-xl font-bold">&times;</button>
    </div>

    <script>
        // Auto-close notification after 5 seconds
        setTimeout(() => {
            const notification = document.getElementById('notification');
            if (notification) {
                notification.remove();
            }
        }, 5000);

        // Close notification manually
        function closeNotification() {
            const notification = document.getElementById('notification');
            if (notification) {
                notification.remove();
            }
        }
    </script>
    @endif

    <!-- Main Content Section -->
    <div class="container mx-auto p-4">
        @yield('content')
    </div>
</body>

</html>