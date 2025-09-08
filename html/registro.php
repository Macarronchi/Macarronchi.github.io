<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registro - Armonía Viva</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Iconos -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <!-- Fuente Lora para que se vea como tu web -->
  <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="css/style.css">      <!-- global -->
  <link rel="stylesheet" href="css/registro.css"> 
  

  <style>
    :root{
      --primary:#450050; --primary-dark:#35003d;
      --secondary:#9b2cff; --accent:#c441d9; --complementary:#7a1aa0;
      --background:#f6f6f6; --text-primary:#1f1f1f; --text-secondary:#5a6268;
      --border-radius:12px; --box-shadow:0 8px 25px rgba(0,0,0,.08);
    }
    *{box-sizing:border-box}
    body{
      margin:0; min-height:100vh; display:flex; flex-direction:column; justify-content:center;
      background:var(--background);
      font-family:'Lora', serif;
      color:var(--text-primary);
      padding:20px;
      background-image:
        radial-gradient(circle at 10% 20%, rgba(154,44,255,.05) 0%, transparent 20%),
        radial-gradient(circle at 90% 80%, rgba(196,65,217,.05) 0%, transparent 20%);
    }
    .container-main{max-width:600px;margin:0 auto}
    .header{text-align:center;margin-bottom:40px;padding:0 15px}
    .app-title{
      font-size:2.5rem;font-weight:700;letter-spacing:-.5px;margin-bottom:8px;
      background:linear-gradient(45deg,var(--primary),var(--complementary));
      -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;
    }
    .app-subtitle{font-size:1.15rem;color:var(--text-secondary);max-width:600px;margin:0 auto;line-height:1.6}

    .card{
      border:none;border-radius:var(--border-radius);box-shadow:var(--box-shadow);
      overflow:hidden;transition:transform .3s ease, box-shadow .3s ease;background:#fff;position:relative;overflow:visible;
    }
    .card:before{
      content:'';position:absolute;inset:-10px;background:linear-gradient(45deg,var(--primary),var(--accent));
      z-index:-1;filter:blur(20px);opacity:.2;border-radius:15px;
    }
    .card:hover{transform:translateY(-5px);box-shadow:0 12px 30px rgba(0,0,0,.12)}
    .card-header{
      background:linear-gradient(45deg,var(--primary),var(--complementary));
      color:#fff;padding:25px;text-align:center;border-bottom:none;position:relative;overflow:hidden;
    }
    .card-header:after{
      content:'';position:absolute;top:-50%;left:-50%;width:200%;height:200%;
      background:radial-gradient(ellipse at center, rgba(255,255,255,.2) 0%, rgba(255,255,255,0) 70%);
    }
    .card-header h2{font-size:1.7rem;font-weight:600;margin:0;display:flex;align-items:center;justify-content:center;position:relative;z-index:2}
    .card-header h2 i{margin-right:12px;font-size:1.5rem}
    .card-body{padding:30px}

    .input-group{position:relative;margin-bottom:20px}
    .input-icon{position:absolute;left:15px;top:50%;transform:translateY(-50%);color:var(--complementary);z-index:5;font-size:1.1rem}
    .form-control{
      border:2px solid #e0e0e0;border-radius:8px;padding:12px 15px 12px 45px;transition:all .3s ease;font-size:1rem;
    }
    .form-control:focus{border-color:var(--secondary);box-shadow:0 0 0 .25rem rgba(155,44,255,.25)}
    .invalid-feedback{padding-left:10px;font-size:.85rem;margin-top:5px;color:var(--accent)}
    .password-toggle{position:absolute;right:15px;top:50%;transform:translateY(-50%);cursor:pointer;color:var(--complementary);z-index:10;font-size:1.1rem}
    .password-toggle:hover{color:var(--accent)}

    .btn{border-radius:8px;padding:12px 20px;font-weight:600;transition:all .3s ease;border:none;font-size:1.05rem;position:relative;overflow:hidden}
    .btn:after{content:'';position:absolute;top:-50%;left:-50%;width:200%;height:200%;
      background:radial-gradient(ellipse at center, rgba(255,255,255,.3) 0%, rgba(255,255,255,0) 70%);
      opacity:0;transition:opacity .3s ease}
    .btn:hover:after{opacity:1}
    .btn-primary{background:linear-gradient(45deg,var(--primary),var(--complementary));color:#fff;letter-spacing:.5px}
    .btn-primary:hover{background:linear-gradient(45deg,var(--primary-dark),#6a1690);transform:translateY(-2px)}
    .btn-outline-secondary{border:2px solid var(--complementary);color:var(--complementary);background:transparent}
    .btn-outline-secondary:hover{background:var(--complementary);color:#fff}

    .footer-links{text-align:center;margin-top:40px;font-size:.95rem;color:var(--text-secondary)}
    .footer-links a{color:var(--primary);text-decoration:none;transition:color .3s ease}
    .footer-links a:hover{color:var(--accent);text-decoration:underline}

    .floating-element{position:absolute;border-radius:50%;z-index:-1}
    .floating-element:nth-child(1){top:20%;left:10%;width:80px;height:80px;background:radial-gradient(circle,var(--secondary),transparent);opacity:.1;animation:float 15s infinite ease-in-out}
    .floating-element:nth-child(2){top:60%;right:15%;width:50px;height:50px;background:radial-gradient(circle,var(--accent),transparent);opacity:.15;animation:float 12s infinite ease-in-out reverse}
    @keyframes float{0%,100%{transform:translateY(0) rotate(0)}50%{transform:translateY(-20px) rotate(10deg)}}

    @media (max-width:576px){
      .card-body{padding:20px 15px}
      .app-title{font-size:2rem}
      .card-header h2{font-size:1.4rem}
      .card-header{padding:18px}
      .floating-element{display:none}
    }
  </style>

  <script>
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.floating-element').forEach(el => {
    const duration = 15 + Math.random() * 10;
    const delay    = Math.random() * 5;
    el.style.animationDuration = `${duration}s`;
    el.style.animationDelay    = `${delay}s`;
  });
});
</script>
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
      <p class="app-subtitle">Crea tu cuenta y comienza tu viaje musical.</p>
    </div>

    <div class="card">
      <div class="card-header">
        <h2><i class="fas fa-user-plus"></i> Crear cuenta</h2>
      </div>

      <div class="card-body">
        <form class="needs-validation" novalidate>
          <div class="input-group">
            <i class="fas fa-user input-icon"></i>
            <input type="text" id="nombre" class="form-control" name="nombre" placeholder="Nombre" required>
            <div class="invalid-feedback">Por favor ingresa tu nombre</div>
          </div>

          <div class="input-group">
            <i class="fas fa-user input-icon"></i>
            <input type="text" id="apellido" class="form-control" name="apellido" placeholder="Apellido" required>
            <div class="invalid-feedback">Por favor ingresa tu apellido</div>
          </div>

          <div class="input-group">
            <i class="fas fa-envelope input-icon"></i>
            <input type="email" id="email" class="form-control" name="email" autocomplete="email" placeholder="Email" required>
            <div class="invalid-feedback">Por favor ingresa un email válido</div>
          </div>

          <div class="input-group">
            <i class="fas fa-phone input-icon"></i>
            <!-- numérico amigable + validación HTML5 -->
            <input type="tel" id="telefono" class="form-control" name="telefono"
                   placeholder="Teléfono (opcional)" inputmode="numeric" pattern="[0-9]{7,15}">
            <div class="invalid-feedback">Solo números (7–15 dígitos)</div>
          </div>

          <div class="input-group">
            <i class="fas fa-user-circle input-icon"></i>
            <input type="text" id="username" class="form-control" name="username" autocomplete="username" placeholder="Usuario" required>
            <div class="invalid-feedback">Elige un nombre de usuario</div>
          </div>

          <div class="input-group mb-3">
            <i class="fas fa-lock input-icon"></i>
            <input type="password" id="password-register" class="form-control has-toggle" name="password" autocomplete="new-password" placeholder="Contraseña" required>
            <span class="password-toggle" onclick="togglePassword('password-register', this)">
              <i class="fas fa-eye"></i>
            </span>
            <div class="invalid-feedback">Ingresa una contraseña</div>
          </div>

            <div class="d-grid gap-2 mt-5">  
                <button class="btn btn-primary">
                    <i class="fas fa-user-plus me-2"></i> Registrarme
                </button>

                <a class="btn btn-outline-secondary" href="login.html">
                    <i class="fas fa-sign-in-alt me-2"></i> Iniciar sesión
                </a>
            </div>
        </form>
      </div>
    </div>

    <div class="footer-links">
      <p>© 2025 Armonía Viva · <a href="#">Términos de uso</a> · <a href="#">Política de privacidad</a></p>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Validación Bootstrap
    (() => {
      'use strict';
      const forms = document.querySelectorAll('.needs-validation');
      Array.from(forms).forEach(form => {
        form.addEventListener('submit', e => {
          if (!form.checkValidity()) { e.preventDefault(); e.stopPropagation(); }
          form.classList.add('was-validated');
        }, false);
      });
    })();

    // Mostrar/Ocultar contraseña
    function togglePassword(inputId, el){
      const input = document.getElementById(inputId);
      const icon  = el.querySelector('i');
      const show  = input.type === 'password';
      input.type  = show ? 'text' : 'password';
      icon.classList.toggle('fa-eye', !show);
      icon.classList.toggle('fa-eye-slash', show);
    }

    // Animación flotantes (corregido con template literals)
    document.querySelectorAll('.floating-element').forEach(el => {
      const duration = 15 + Math.random() * 10;
      const delay    = Math.random() * 5;
      el.style.animationDuration = `${duration}s`;
      el.style.animationDelay = `${delay}s`;
    });
  </script>

  <script defer>
document.addEventListener('DOMContentLoaded', () => {
  // Validación Bootstrap
  (() => {
    'use strict';
    document.querySelectorAll('.needs-validation').forEach(form => {
      form.addEventListener('submit', e => {
        if (!form.checkValidity()) {
          e.preventDefault();
          e.stopPropagation();
        }
        form.classList.add('was-validated');
      });
    });
  })();

  // Toggle de contraseña
  window.togglePassword = (inputId, el) => {
    const input = document.getElementById(inputId);
    const icon  = el.querySelector('i');
    const show  = input.type === 'password';
    input.type = show ? 'text' : 'password';
    icon.classList.toggle('fa-eye', !show);
    icon.classList.toggle('fa-eye-slash', show);
  };

  // Globos flotantes (corregido)
  const floatingElements = document.querySelectorAll('.floating-element');
  floatingElements.forEach(el => {
    const duration = 15 + Math.random() * 10;
    const delay    = Math.random() * 5;
    el.style.animationDuration = `${duration}s`;
    el.style.animationDelay    = `${delay}s`;
  });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.floating-element').forEach(el => {
  const dur   = 6 + Math.random() * 6;   // 6–12s => ~2–3x más rápido
  const delay = Math.random() * 3;       // (opcional) menor delay
  el.style.animationDuration = `${dur}s`;
  el.style.animationDelay    = `${delay}s`;

  const amp = 12 + Math.random() * 28;   // amplitud igual que antes
  el.style.setProperty('--amp', `${amp}px`);
});

  // Respeta usuarios con reduce motion
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    document.querySelectorAll('.floating-element').forEach(el => {
      el.style.animation = 'none';
    });
  }
});
</script>
</body>
</html>
