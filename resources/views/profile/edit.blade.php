<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-4 text-dark m-0">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <style>
      :root{ --color-secondary:#16b3ac; --color-accent:#d2dc02; }
      .accent-bar{ height:4px; background:var(--color-accent); border-radius:2px 2px 0 0; }
    </style>

    <div class="container py-4">
      <div class="row g-4">
        <div class="col-12 col-lg-6">
          <div class="card shadow-sm">
            <div class="accent-bar"></div>
            <div class="card-body">
              @include('profile.partials.update-profile-information-form')
            </div>
          </div>
        </div>

        <div class="col-12 col-lg-6">
          <div class="card shadow-sm">
            <div class="accent-bar"></div>
            <div class="card-body">
              @include('profile.partials.update-password-form')
            </div>
          </div>
        </div>

        <div class="col-12">
          <div class="card shadow-sm">
            <div class="accent-bar"></div>
            <div class="card-body">
              @include('profile.partials.delete-user-form')
            </div>
          </div>
        </div>
      </div>
    </div>
</x-app-layout>
