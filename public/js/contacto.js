document.getElementById('formContacto').addEventListener('submit', async e => {
  e.preventDefault();

  const form = e.target;
  const data = {
    nombre: form.nombre.value,
    email: form.email.value,
    asunto: form.asunto.value,
    mensaje: form.mensaje.value
  };

  const res = await fetch('../api/consulta_create.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(data)
  });

  const json = await res.json();

  document.getElementById('respuesta').textContent =
    json.ok
      ? 'Gracias, nos pondremos en contacto contigo.'
      : 'Ocurrió un error.';
  
  form.reset();
});
