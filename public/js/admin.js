async function checkAuth() {
  const res = await fetch('../api/check_auth.php', {
    credentials: 'include'
  });

  if (!res.ok) {
    window.location.href = 'login.html';
  }
}

checkAuth();

async function cargar() {
  const res = await fetch('../api/consulta_list.php', {
    credentials: 'include'
  });

  if (!res.ok) {
    console.error('No autorizado o error al cargar');
    return;
  }

  const data = await res.json();

  const tbody = document.querySelector('#tabla tbody');
  tbody.innerHTML = '';

    data.forEach(c => {
      tbody.innerHTML += `
        <tr>
          <td>${c.consulta_id}</td>
          <td>${c.nombre_remitente}</td>
          <td>${c.email_remitente}</td>
          <td>${c.asunto}</td>
          <td class="estado ${c.estado}">${c.estado}</td>
        </tr>
      `;
    });

}

document.getElementById('btnLogout').addEventListener('click', async () => {
  const res = await fetch('../api/logout.php', {
    method: 'POST',
    credentials: 'include'
  });

  if (res.ok) {
    window.location.href = 'index.html';
  }
});


cargar();
