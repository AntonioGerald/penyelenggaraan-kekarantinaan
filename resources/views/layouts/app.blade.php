<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? $title : (View::hasSection('title') ? trim($__env->yieldContent('title')) : config('app.name', 'Aplikasi Penilaian Kinerja')) }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
    <style>
      :root{ --color-main:#ffffff; --color-secondary:#16b3ac; --color-accent:#d2dc02; --text-dark:#0b2230; }

      .btn-secondary-brand{
        background: var(--color-secondary);
        color:#fff;
        border:none;
        transition: background-color .15s ease, transform .1s ease, box-shadow .15s ease;
      }
      .btn-secondary-brand:hover{
        background: #12948e;
        color:#fff;
        box-shadow: 0 2px 6px rgba(0,0,0,.15);
        transform: translateY(-1px);
      }

      .btn-accent-brand{
        background: var(--color-accent);
        color:#000;
        border:none;
        transition: background-color .15s ease, transform .1s ease, box-shadow .15s ease;
      }
      .btn-accent-brand:hover{
        background: #c4d000; 
        color:#000;
        box-shadow: 0 2px 6px rgba(0,0,0,.15);
        transform: translateY(-1px);
      }

      .btn-outline-secondary{
        border-color: var(--color-secondary);
        color: var(--color-secondary);
        transition: background-color .15s ease, color .15s ease, transform .1s ease;
      }
      .btn-outline-secondary:hover{
        background-color: rgba(22,179,172,0.08);
        color: var(--color-secondary);
        transform: translateY(-1px);
      }

      .accent-bar{ height:4px; background: var(--color-accent); border-radius:2px 2px 0 0; }

      /* Global override Bootstrap tables: header */
      .table {
        border-radius: .5rem;
        overflow: hidden;
        background-color: #ffffff;
        box-shadow: 0 2px 6px rgba(0,0,0,.04);
      }

      .table thead th {
        background-color: var(--color-secondary) !important;
        color: #ffffff !important;
        border-bottom-width: 0;
      }

      .table tbody td,
      .table tbody th {
        border-color: rgba(0,0,0,.04);
      }

      /* Hilangkan warna hover mencolok, biarkan netral */
      .table-hover tbody tr:hover td,
      .table-hover tbody tr:hover th {
        background-color: transparent !important;
      }
    </style>
</head>
<body>
    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Page Heading -->
    @isset($header)
        <header class="bg-light shadow-sm mb-3">
            <div class="container py-3">
                {{ $header }}
            </div>
        </header>
    @endisset

    <!-- Page Content -->
    <main class="container">
        {{ $slot }}
    </main>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
