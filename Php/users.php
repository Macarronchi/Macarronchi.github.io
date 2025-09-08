<?php
require_once __DIR__.'/config.php';
require_once __DIR__.'/auth.php';
ensure_logged_in();
if (!has_role('admin')) { // admin y superadmin pueden entrar; user no
  http_response_code(403);
  die('Acceso denegado');
}
$u = current_user();

// Manejo de acciones (solo superadmin crea/edita/borra)
if (has_role('superadmin') && ($_SERVER['REQUEST_METHOD'] === 'POST')) {
  $action = $_POST['action'] ?? '';
  if ($action === 'create') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $role_id = (int)$_POST['role_id'];
    $status = $_POST['status'] === 'inactivo' ? 'inactivo' : 'activo';
    $password = $_POST['password'] ?? '';
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $mysqli->prepare("INSERT INTO users (name,email,password,role_id,status) VALUES (?,?,?,?,?)");
    $stmt->bind_param('sssis', $name,$email,$hash,$role_id,$status);
    $stmt->execute();
    header('Location: users.php');
    exit;
  } elseif ($action === 'update') {
    $id = (int)$_POST['id'];
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $role_id = (int)$_POST['role_id'];
    $status = $_POST['status'] === 'inactivo' ? 'inactivo' : 'activo';
    $password = $_POST['password'] ?? '';
    if ($password !== '') {
      $hash = password_hash($password, PASSWORD_DEFAULT);
      $stmt = $mysqli->prepare("UPDATE users SET name=?,email=?,password=?,role_id=?,status=? WHERE id=?");
      $stmt->bind_param('sssisi', $name,$email,$hash,$role_id,$status,$id);
    } else {
      $stmt = $mysqli->prepare("UPDATE users SET name=?,email=?,role_id=?,status=? WHERE id=?");
      $stmt->bind_param('ssisi', $name,$email,$role_id,$status,$id);
    }
    $stmt->execute();
    header('Location: users.php');
    exit;
  } elseif ($action === 'delete') {
    $id = (int)$_POST['id'];
    if ($id !== $u['id']) { // no permitir auto-borrado
      $stmt = $mysqli->prepare("DELETE FROM users WHERE id=? LIMIT 1");
      $stmt->bind_param('i', $id);
      $stmt->execute();
    }
    header('Location: users.php');
    exit;
  }
}

$roles = $mysqli->query("SELECT id,name FROM roles ORDER BY id ASC")->fetch_all(MYSQLI_ASSOC);
$users = $mysqli->query("SELECT u.id,u.name,u.email,r.name role,u.status FROM users u JOIN roles r ON r.id=u.role_id ORDER BY u.id DESC")->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Usuarios</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="index.php">Armonía Viva</a>
      <div class="d-flex align-items-center text-white">
        <span class="me-3"><?php echo htmlspecialchars($u['name']).' ('.htmlspecialchars($u['role']).')'; ?></span>
        <a class="btn btn-outline-light btn-sm" href="logout.php">Cerrar sesión</a>
      </div>
    </div>
  </nav>

  <div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h1 class="h4 mb-0">Usuarios</h1>
      <?php if (has_role('superadmin')): ?>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Crear usuario</button>
      <?php endif; ?>
    </div>

    <div class="table-responsive">
      <table class="table table-striped align-middle">
        <thead>
          <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Estado</th>
            <?php if (has_role('superadmin')): ?><th>Acciones</th><?php endif; ?>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($users as $row): ?>
            <tr>
              <td><?php echo (int)$row['id']; ?></td>
              <td><?php echo htmlspecialchars($row['name']); ?></td>
              <td><?php echo htmlspecialchars($row['email']); ?></td>
              <td><?php echo htmlspecialchars($row['role']); ?></td>
              <td><span class="badge bg-<?php echo $row['status']==='activo'?'success':'secondary'; ?>"><?php echo htmlspecialchars($row['status']); ?></span></td>
              <?php if (has_role('superadmin')): ?>
              <td>
                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?php echo (int)$row['id']; ?>" data-name="<?php echo htmlspecialchars($row['name']); ?>" data-email="<?php echo htmlspecialchars($row['email']); ?>" data-role="<?php echo htmlspecialchars($row['role']); ?>" data-status="<?php echo htmlspecialchars($row['status']); ?>">Editar</button>
                <form action="users.php" method="post" class="d-inline" onsubmit="return confirm('¿Eliminar este usuario?');">
                  <input type="hidden" name="action" value="delete">
                  <input type="hidden" name="id" value="<?php echo (int)$row['id']; ?>">
                  <button class="btn btn-sm btn-outline-danger" type="submit">Eliminar</button>
                </form>
              </td>
              <?php endif; ?>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <?php if (has_role('superadmin')): ?>
  <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header"><h5 class="modal-title">Crear usuario</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
          <form method="post" class="needs-validation" novalidate>
            <input type="hidden" name="action" value="create">
            <div class="mb-3"><label class="form-label">Nombre</label><input class="form-control" name="name" required></div>
            <div class="mb-3"><label class="form-label">Email</label><input type="email" class="form-control" name="email" required></div>
            <div class="mb-3"><label class="form-label">Contraseña</label><input type="password" class="form-control" name="password" required></div>
            <div class="mb-3"><label class="form-label">Rol</label>
              <select class="form-select" name="role_id" required>
                <?php foreach ($roles as $r): ?><option value="<?php echo (int)$r['id']; ?>"><?php echo htmlspecialchars($r['name']); ?></option><?php endforeach; ?>
              </select>
            </div>
            <div class="mb-3"><label class="form-label">Estado</label>
              <select class="form-select" name="status">
                <option value="activo" selected>activo</option>
                <option value="inactivo">inactivo</option>
              </select>
            </div>
            <div class="d-grid"><button class="btn btn-primary" type="submit">Guardar</button></div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header"><h5 class="modal-title">Editar usuario</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
          <form method="post" class="needs-validation" novalidate>
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id" id="edit-id">
            <div class="mb-3"><label class="form-label">Nombre</label><input class="form-control" name="name" id="edit-name" required></div>
            <div class="mb-3"><label class="form-label">Email</label><input type="email" class="form-control" name="email" id="edit-email" required></div>
            <div class="mb-3"><label class="form-label">Contraseña (opcional)</label><input type="password" class="form-control" name="password" placeholder="Dejar vacío para no cambiar"></div>
            <div class="mb-3"><label class="form-label">Rol</label>
              <select class="form-select" name="role_id" id="edit-role" required>
                <?php foreach ($roles as $r): ?><option value="<?php echo (int)$r['id']; ?>"><?php echo htmlspecialchars($r['name']); ?></option><?php endforeach; ?>
              </select>
            </div>
            <div class="mb-3"><label class="form-label">Estado</label>
              <select class="form-select" name="status" id="edit-status">
                <option value="activo">activo</option>
                <option value="inactivo">inactivo</option>
              </select>
            </div>
            <div class="d-grid"><button class="btn btn-primary" type="submit">Actualizar</button></div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const editModal = document.getElementById('editModal');
    if (editModal) {
      editModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');
        const name = button.getAttribute('data-name');
        const email = button.getAttribute('data-email');
        const role = button.getAttribute('data-role');
        const status = button.getAttribute('data-status');
        document.getElementById('edit-id').value = id;
        document.getElementById('edit-name').value = name;
        document.getElementById('edit-email').value = email;
        const roleSelect = document.getElementById('edit-role');
        for (const opt of roleSelect.options) {
          opt.selected = (opt.text.toLowerCase() === role.toLowerCase());
        }
        document.getElementById('edit-status').value = status;
      });
    }
  </script>
</body>
</html>


