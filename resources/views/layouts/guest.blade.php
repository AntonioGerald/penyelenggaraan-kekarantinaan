<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? $title : (View::hasSection('title') ? trim($__env->yieldContent('title')) : config('app.name', 'Aplikasi Penilaian Kinerja')) }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      :root{ --color-main:#ffffff; --color-secondary:#16b3ac; --color-accent:#d2dc02; --text-dark:#0b2230; }
      body{ background:#f7f9fb; color:var(--text-dark); }
      .brand-bar{ background: var(--color-secondary); height: 6px; }
      .card-auth{ border:1px solid #eef2f6; border-radius:.75rem; box-shadow:0 8px 24px rgba(11,34,48,.08); }
      .btn-secondary-brand{ background: var(--color-secondary); color:#fff; border:none; }
      .btn-secondary-brand:hover{ filter:brightness(.95); }
      .btn-accent-brand{ background: var(--color-accent); color:#000; border:none; }
      .logo-strip img{ max-height:64px; object-fit:contain; }
      .logo-strip{ gap:24px; }
      a{ color: var(--color-secondary); }
      a:hover{ color: #129a93; }
    </style>
  </head>
  <body>
    <div class="brand-bar"></div>
    <div class="container py-5">
      <div class="d-flex justify-content-center mb-4 logo-strip">
        <img src="{{ asset('assets_images/Logo Kemenkes BKK Bengkulu.png') }}" alt="Logo Kemenkes BKK Bengkulu">  
        <img src="{{ asset('assets_images/Logo Karantina Kesehatan.png') }}" alt="Logo Karantina Kesehatan">
        <img src="{{ asset('assets_images/Logo BKK BKL.png') }}" alt="Logo BKK Bengkulu">      </div>
      <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4">
          <div class="card card-auth">
            <div class="card-body p-4">
              {{ $slot }}
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
