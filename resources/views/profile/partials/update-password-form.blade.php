<section>
  <header class="mb-2">
    <h2 class="h5 mb-1">{{ __('Update Password') }}</h2>
    <p class="text-muted small mb-0">{{ __('Ensure your account is using a long, random password to stay secure.') }}</p>
  </header>

  <form method="post" action="{{ route('password.update') }}" class="row g-3 mt-1">
    @csrf
    @method('put')

    <div class="col-md-6">
      <label for="update_password_current_password" class="form-label">{{ __('Current Password') }}</label>
      <input id="update_password_current_password" name="current_password" type="password" class="form-control @error('current_password','updatePassword') is-invalid @enderror" autocomplete="current-password">
      @error('current_password','updatePassword')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6"></div>

    <div class="col-md-6">
      <label for="update_password_password" class="form-label">{{ __('New Password') }}</label>
      <input id="update_password_password" name="password" type="password" class="form-control @error('password','updatePassword') is-invalid @enderror" autocomplete="new-password">
      @error('password','updatePassword')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
      <label for="update_password_password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
      <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control @error('password_confirmation','updatePassword') is-invalid @enderror" autocomplete="new-password">
      @error('password_confirmation','updatePassword')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-12 d-flex justify-content-end gap-2 mt-2">
      <button class="btn btn-secondary-brand">{{ __('Save') }}</button>
      @if (session('status') === 'password-updated')
        <span class="text-muted small align-self-center">{{ __('Saved.') }}</span>
      @endif
    </div>
  </form>
</section>
