<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Portal Admin &mdash; Kenanga Motor</title>

  <!-- Google Fonts: Plus Jakarta Sans -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- Bootstrap 5.3 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- FontAwesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  
  <style>
    :root {
        --showroom-primary: #1e40af;
        --showroom-primary-hover: #1d4ed8;
        --showroom-dark: #0f172a;
        --showroom-slate: #1e293b;
        --showroom-light: #f8fafc;
        --showroom-card-border: #e2e8f0;
    }

    body {
        font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
        background-color: var(--showroom-light);
        color: #334155;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .login-container {
        width: 100%;
        max-width: 420px;
    }

    .login-brand {
        text-align: center;
        margin-bottom: 2rem;
    }

    .login-brand i {
        font-size: 3rem;
        color: var(--showroom-primary);
        margin-bottom: 1rem;
    }

    .login-brand h4 {
        font-weight: 700;
        color: var(--showroom-dark);
        margin: 0;
    }

    .login-card {
        background: #ffffff;
        border: 1px solid var(--showroom-card-border);
        border-radius: 16px;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
        padding: 2.5rem 2rem;
        transition: transform 0.3s ease;
    }

    .form-control {
        padding: 0.75rem 1rem;
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        transition: all 0.2s;
    }
    
    /* Perbaikan input group biar rapi */
    .input-group > .form-control {
        border-radius: 0 8px 8px 0;
    }
    .input-group > .input-group-text {
        border-radius: 8px 0 0 8px;
        border: 1px solid #cbd5e1;
    }

    .form-control:focus {
        border-color: var(--showroom-primary);
        box-shadow: none;
    }
    
    .input-group:focus-within .input-group-text,
    .input-group:focus-within .form-control {
        border-color: var(--showroom-primary);
    }
    .input-group:focus-within .form-control {
        box-shadow: 0 0 0 4px rgba(30, 64, 175, 0.1);
    }

    .form-label {
        font-weight: 600;
        color: var(--showroom-slate);
        font-size: 0.9rem;
    }

    .btn-primary {
        background-color: var(--showroom-primary);
        border-color: var(--showroom-primary);
        font-weight: 600;
        padding: 0.75rem;
        border-radius: 8px;
        transition: all 0.2s;
    }

    .btn-primary:hover {
        background-color: var(--showroom-primary-hover);
        border-color: var(--showroom-primary-hover);
        transform: translateY(-1px);
    }

    .btn-outline-secondary {
        border-radius: 8px;
        padding: 0.6rem;
        font-weight: 500;
        border-color: #cbd5e1;
        color: #64748b;
        transition: all 0.2s;
    }

    .btn-outline-secondary:hover {
        background-color: #f1f5f9;
        color: var(--showroom-slate);
        border-color: #cbd5e1;
    }

    /* Animation */
    .fade-in-up {
        animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        opacity: 0;
        transform: translateY(20px);
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
  </style>
</head>

<body>
  <div class="login-container fade-in-up">
    <div class="login-brand">
      <i class="fas fa-motorcycle"></i>
      <h4>Portal Admin</h4>
      <p class="text-muted small mt-1">Sistem Informasi Kenanga Motor</p>
    </div>

    <div class="login-card">
      <!-- Menampilkan pesan error jika login gagal -->
      @if(session('error'))
          <div class="alert alert-danger text-center small rounded-3 border-0 py-2 mb-4 shadow-sm">
              <i class="fas fa-exclamation-circle me-1"></i> {{ session('error') }}
          </div>
      @endif

      <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <div class="mb-4">
          <label for="email" class="form-label">Email</label>
          <div class="input-group">
            <span class="input-group-text bg-light border-end-0 text-muted">
                <i class="fas fa-envelope"></i>
            </span>
            <input id="email" type="email" class="form-control border-start-0 ps-0 bg-transparent" name="email" tabindex="1" required autofocus placeholder="Masukkan email...">
          </div>
        </div>

        <div class="mb-4">
          <label for="password" class="form-label">Password</label>
          <div class="input-group">
            <span class="input-group-text bg-light border-end-0 text-muted">
                <i class="fas fa-lock"></i>
            </span>
            <input id="password" type="password" class="form-control border-start-0 ps-0 bg-transparent" name="password" tabindex="2" required placeholder="Masukkan password...">
          </div>
        </div>

        <div class="d-grid mb-4 mt-2">
          <button type="submit" class="btn btn-primary" tabindex="4">
            <i class="fas fa-sign-in-alt me-1"></i> Login Admin
          </button>
        </div>
        
        <!-- Tombol Kembali ke Halaman Publik -->
        <div class="text-center mt-2 border-top pt-4">
            <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm w-100" tabindex="5">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Halaman Depan
            </a>
        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap 5 Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>