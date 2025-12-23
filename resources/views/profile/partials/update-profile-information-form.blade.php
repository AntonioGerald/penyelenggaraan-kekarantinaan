<section>
  <header class="mb-2">
    <h2 class="h5 mb-1">{{ __('Profile Information') }}</h2>
    <p class="text-muted small mb-0">{{ __("Update your account's profile information and email address.") }}</p>
  </header>

  <form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
  </form>

  <form method="post" action="{{ route('profile.update') }}" class="row g-3 mt-1">
    @csrf
    @method('patch')

    <div class="col-md-6">
      <label for="name" class="form-label">{{ __('Name') }}</label>
      <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" class="form-control @error('name') is-invalid @enderror" required autocomplete="name" autofocus>
      @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
      <label for="email" class="form-label">{{ __('Email') }}</label>
      <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" class="form-control @error('email') is-invalid @enderror" required autocomplete="username">
      @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror

      @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
        <div class="form-text mt-1">
          {{ __('Your email address is unverified.') }}
          <button form="send-verification" class="btn btn-link p-0 align-baseline">{{ __('Click here to re-send the verification email.') }}</button>
        </div>
        @if (session('status') === 'verification-link-sent')
          <div class="text-success small mt-1">{{ __('A new verification link has been sent to your email address.') }}</div>
        @endif
      @endif
    </div>

    <div class="col-12 d-flex justify-content-end gap-2 mt-2">
      <button class="btn btn-secondary">{{ __('Save') }}</button>
      @if (session('status') === 'profile-updated')
        <span class="text-muted small align-self-center">{{ __('Saved.') }}</span>
      @endif
    </div>
  </form>
</section>
