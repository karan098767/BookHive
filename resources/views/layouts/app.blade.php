<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>BookHive - @yield('title', 'Library')</title>

  <!-- Poppins font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

  <!-- Tailwind Play CDN (for quick dev) -->
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    body { font-family: 'Poppins', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial; }
  </style>
</head>
<body class="bg-gray-50 min-h-screen">
  <nav class="bg-white shadow">
    <div class="container mx-auto px-4 py-3 flex items-center justify-between">
      <a href="{{ url('/') }}" class="text-2xl font-semibold text-indigo-600">BookHive</a>
      <div class="flex items-center space-x-4">
        <a href="{{ route('books.index') }}" class="text-sm">Books</a>
        <a href="{{ route('authors.index') }}" class="text-sm">Authors</a>
        <a href="{{ route('members.index') }}" class="text-sm">Members</a>
        <a href="{{ route('borrow.index') }}" class="text-sm">Borrow</a>
        <a href="{{ route('admin.login') }}" class="text-sm text-red-600">Admin</a>
      </div>
    </div>
  </nav>

  <main class="container mx-auto px-4 py-8">
    @if(session('success'))
      <div class="mb-4 p-3 bg-green-100 border border-green-200 text-green-800 rounded">
        {{ session('success') }}
      </div>
    @endif

    @yield('content')
  </main>

  <footer class="text-center text-sm py-6 text-gray-500">
    © {{ date('Y') }} BookHive
  </footer>
</body>
</html>
