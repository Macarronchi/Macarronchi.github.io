<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar sesión - Armonía Viva</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">     <!-- global (opcional) -->
  <link rel="stylesheet" href="css/login.css">  
  <style>
    :root {
      --primary: #450050;      
      --primary-dark: #35003d;  
      --secondary: #9b2cff;    
      --accent: #c441d9;      
      --complementary: #7a1aa0;
      --background: #f6f6f6;    
      --text-primary: #1f1f1f;  
      --text-secondary: #5a6268;
      --border-radius: 12px;
      --box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: var(--background);
      color: var(--text-primary);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      padding: 20px;
      background-image: 
        radial-gradient(circle at 90% 20%, rgba(154, 44, 255, 0.05) 0%, transparent 20%),
        radial-gradient(circle at 10% 80%, rgba(196, 65, 217, 0.05) 0%, transparent 20%);
    }

    .container-main {
      max-width: 500px;
      margin: 0 auto;
    }

    .header {
      text-align: center;
      margin-bottom: 40px;
      padding: 0 15px;
    }

    .app-title {
      font-size: 2.5rem;
      font-weight: 700;
      background: linear-gradient(45deg, var(--primary), var(--complementary));
      -webkit-background-clip: text;
      background-clip: text;
      -webkit-text-fill-color: transparent;
      margin-bottom: 8px;
      letter-spacing: -0.5px;
    }

    .app-subtitle {
      font-size: 1.15rem;
      color: var(--text-secondary);
      max-width: 600px;
      margin: 0 auto;
      line-height: 1.6;
    }

    .card {
      border: none;
      border-radius: var(--border-radius);
      box-shadow: var(--box-shadow);
      overflow: hidden;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      background: white;
      position: relative;
      overflow: visible;
    }

    .card:before {
      content: '';
      position: absolute;
      top: -10px;
      left: -10px;
      right: -10px;
      bottom: -10px;
      background: linear-gradient(45deg, var(--primary), var(--accent));
      z-index: -1;
      filter: blur(20px);
      opacity: 0.2;
      border-radius: 15px;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
    }

    .card-header {
      background: linear-gradient(45deg, var(--primary), var(--complementary));
      color: white;
      padding: 25px;
      text-align: center;
      border-bottom: none;
      position: relative;
      overflow: hidden;
    }

    .card-header:after {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(ellipse at center, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 70%);
    }

    .card-header h2 {
      font-size: 1.7rem;
      font-weight: 600;
      margin: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      z-index: 2;
    }

    .card-header h2 i {
      margin-right: 12px;
      font-size: 1.5rem;
    }

    .card-body {
      padding: 30px;
    }

    .form-control {
      border: 2px solid #e0e0e0;
      border-radius: 8px;
      padding: 12px 15px 12px 45px;
      transition: all 0.3s ease;
      font-size: 1rem;
    }

    .form-control:focus {
      border-color: var(--secondary);
      box-shadow: 0 0 0 0.25rem rgba(155, 44, 255, 0.25);
    }

    .input-group {
      position: relative;
      margin-bottom: 20px;
    }

    .input-icon {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--complementary);
      z-index: 5;
      font-size: 1.1rem;
    }

    .btn {
      border-radius: 8px;
      padding: 12px 20px;
      font-weight: 600;
      transition: all 0.3s ease;
      border: none;
      font-size: 1.05rem;
      position: relative;
      overflow: hidden;
    }

    .btn:after {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(ellipse at center, rgba(255,255,255,0.3) 0%, rgba(255,255,255,0) 70%);
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .btn:hover:after {
      opacity: 1;
    }

    .btn-primary {
      background: linear-gradient(45deg, var(--primary), var(--complementary));
      letter-spacing: 0.5px;
      color: white;
    }

    .btn-primary:hover {
      background: linear-gradient(45deg, var(--primary-dark), #6a1690);
      transform: translateY(-2px);
    }

    .btn-outline-secondary {
      border: 2px solid var(--complementary);
      color: var(--complementary);
      background: transparent;
    }

    .btn-outline-secondary:hover {
      background: var(--complementary);
      color: white;
    }

    .divider {
      display: flex;
      align-items: center;
      text-align: center;
      margin: 25px 0;
      color: var(--text-secondary);
      font-size: 0.95rem;
      position: relative;
    }

    .divider:before {
      content: '';
      position: absolute;
      top: 50%;
      left: 0;
      right: 0;
      height: 1px;
      background: linear-gradient(to right, transparent, var(--complementary), transparent);
    }

    .divider span {
      background: white;
      padding: 0 15px;
      position: relative;
      z-index: 2;
    }

    .footer-links {
      text-align: center;
      margin-top: 40px;
      font-size: 0.95rem;
      color: var(--text-secondary);
    }

    .footer-links a {
      color: var(--primary);
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .footer-links a:hover {
      color: var(--accent);
      text-decoration: underline;
    }

    .invalid-feedback {
      padding-left: 10px;
      font-size: 0.85rem;
      margin-top: 5px;
      color: var(--accent);
    }

    .password-toggle {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: var(--complementary);
      z-index: 10;
      font-size: 1.1rem;
    }

    .password-toggle:hover {
      color: var(--accent);
    }

    .form-link {
      color: var(--secondary);
      text-decoration: none;
      transition: all 0.3s ease;
      font-weight: 500;
    }

    .form-link:hover {
      color: var(--accent);
      text-decoration: underline;
    }

    .form-footer {
      text-align: center;
      margin-top: 20px;
      color: var(--text-secondary);
    }

    .floating-element {
      position: absolute;
      border-radius: 50%;
      z-index: -1;
    }

    .floating-element:nth-child(1) {
      top: 30%;
      right: 10%;
      width: 60px;
      height: 60px;
      background: radial-gradient(circle, var(--secondary), transparent);
      opacity: 0.1;
      animation: float 15s infinite ease-in-out reverse;
    }

    .floating-element:nth-child(2) {
      top: 70%;
      left: 15%;
      width: 40px;
      height: 40px;
      background: radial-gradient(circle, var(--accent), transparent);
      opacity: 0.15;
      animation: float 10s infinite ease-in-out;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0) rotate(0deg); }
      50% { transform: translateY(-20px) rotate(10deg); }
    }

    @media (max-width: 576px) {
      .card-body {
        padding: 20px 15px;
      }
      
      .app-title {
        font-size: 2rem;
      }
      
      .card-header h2 {
        font-size: 1.4rem;
      }
      
      .card-header {
        padding: 18px;

      }
      
      .floating-element {
        display: none;
      }
    }
  </style>
</head>
<body>
  <div class="floating-element"></div>
  <div class="floating-element"></div>
  <div class="floating-element"></div>
  <div class="floating-element"></div>
  <div class="floating-element"></div>
  <div class="floating-element"></div>
  <div class="floating-element"></div>
  <div class="floating-element"></div>
  <div class="floating-element"></div>
  <div class="floating-element"></div>
  <div class="floating-element"></div>
  <div class="floating-element"></div>
  <div class="floating-element"></div>
  <div class="floating-element"></div>
  <div class="floating-element"></div>
  <div class="floating-element"></div>
  <div class="floating-element"></div>
  <div class="floating-element"></div>
  <div class="floating-element"></div>
  <div class="floating-element"></div>
  <div class="floating-element"></div>
  <div class="floating-element"></div>

  <div class="container-main">
    <div class="header">
      <h1 class="app-title">Armonía Viva</h1>
      <p class="app-subtitle">Transformamos tu pasión por la música en habilidades reales con nuestros cursos especializados.</p>
    </div>

    <div class="card">
      <div class="card-header">
        <h2><i class="fas fa-sign-in-alt"></i> Iniciar sesión</h2>
      </div>
      <div class="card-body">
        <form class="needs-validation" novalidate>
          <div class="input-group">
            <i class="fas fa-user input-icon"></i>
            <input type="text" id="username-login" class="form-control" name="username" autocomplete="username" placeholder="Usuario" required>
            <div class="invalid-feedback">Por favor ingresa tu usuario</div>
          </div>
          
          <div class="input-group">
            <i class="fas fa-lock input-icon"></i>

        <input
            type="password"
            id="password-login"
            class="form-control has-toggle"
            name="password"
            autocomplete="current-password"
            placeholder="Contraseña"
            required
        >
        <button type="button"
          class="password-toggle"
          onclick="togglePassword('password-login', this)"
          aria-label="Mostrar u ocultar contraseña">
        <i class="fas fa-eye"></i>
        </button>

        <div class="invalid-feedback">Por favor ingresa tu contraseña</div>
        </div>
          
          <div class="d-flex justify-content-end mb-3">
            <a href="#" class="form-link">¿Olvidaste tu contraseña?</a>
          </div>
          
          <div class="d-grid gap-3">
            <button class="btn btn-primary" type="submit">
              <i class="fas fa-sign-in-alt me-2"></i>Ingresar
            </button>
            
            <a class="btn btn-outline-secondary" href="index.html">
              <i class="fas fa-home me-2"></i>Volver al inicio
            </a>
          </div>
        </form>
        
        <div class="form-footer">
          <p>No tienes cuenta aún? <a href="registro.html" class="form-link">Regístrate ahora</a></p>
        </div>
      </div>
    </div>
  </div>

  <div class="footer-links">
    <p>© 2025 Armonía Viva · <a href="#">Términos de uso</a> · <a href="#">Política de privacidad</a></p>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    (() => {
      'use strict';
      const forms = document.querySelectorAll('.needs-validation');
      Array.from(forms).forEach(form => {
        form.addEventListener('submit', e => {
          if (!form.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    })();
    
    function togglePassword(inputId, element) {
      const passwordInput = document.getElementById(inputId);
      const icon = element.querySelector('i');
      
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      } else {
        passwordInput.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      }
    }
    
    const floatingElements = document.querySelectorAll('.floating-element');
    floatingElements.forEach(el => {
      const duration = 10 + Math.random() * 10;
      const delay = Math.random() * 5;
      el.style.animationDuration = `${duration}s`;
      el.style.animationDelay = `${delay}s`;
    });
  </script>
</body>
</html>