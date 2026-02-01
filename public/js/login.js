document.getElementById('loginForm').addEventListener('submit', async e => {
  e.preventDefault();

  const data = {
    username: e.target.username.value,
    clave: e.target.clave.value
  };

  const res = await fetch('../api/login.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    credentials: 'include',
    body: JSON.stringify(data)
  });

  const json = await res.json();

  if (json.ok) {
    window.location.href = 'admin.html';
  } else {
    document.getElementById('error').textContent =
      'Usuario o contraseña incorrectos';
  }
});
