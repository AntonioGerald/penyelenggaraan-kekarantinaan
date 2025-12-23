<x-guest-layout>
  @section('title', 'Login')

  @if (session('status'))
    <div class="alert alert-info" role="alert">{{ session('status') }}</div>
  @endif

  <form method="POST" action="{{ route('login') }}" novalidate>
    @csrf
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required autofocus autocomplete="username">
      @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <div class="input-group">
        <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password">
        <button type="button" class="btn btn-outline-secondary" id="togglePassword" aria-label="Tampilkan password" aria-pressed="false">
          <!-- Eye (show) icon -->
          <svg id="icon-eye" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
          </svg>
          <!-- Eye-slash (hide) icon -->
          <svg id="icon-eye-off" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash d-none" viewBox="0 0 16 16">
            <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7 7 0 0 0-2.79.588l.77.771A6 6 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755q-.247.248-.517.486z"/>
            <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829"/>
            <path d="M3.35 5.47q-.27.24-.518.487A13 13 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7 7 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12z"/>
          </svg>
        </button>
        @error('password')
          <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
      </div>
    </div>

    <script>
      (function(){
        const input = document.getElementById('password');
        const btn = document.getElementById('togglePassword');
        const eye = document.getElementById('icon-eye');
        const eyeOff = document.getElementById('icon-eye-off');
        if (!input || !btn || !eye || !eyeOff) return;
        btn.addEventListener('click', function(){
          const isPwd = input.getAttribute('type') === 'password';
          input.setAttribute('type', isPwd ? 'text' : 'password');
          // Toggle icon visibility
          eye.classList.toggle('d-none', !isPwd);
          eyeOff.classList.toggle('d-none', isPwd);
          // Toggle button style and a11y
          this.classList.toggle('btn-outline-secondary', !isPwd);
          this.classList.toggle('btn-secondary', isPwd);
          this.setAttribute('aria-pressed', String(isPwd));
          this.setAttribute('aria-label', isPwd ? 'Sembunyikan password' : 'Tampilkan password');
        });
      })();
    </script>

    <div class="d-flex justify-content-between align-items-center mb-3">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
        <label class="form-check-label" for="remember_me">Ingat saya</label>
      </div>
    </div>

    <div class="d-grid">
      <button type="submit" class="btn btn-secondary-brand">Masuk</button>
    </div>
  </form>
</x-guest-layout>
