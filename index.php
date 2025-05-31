<?php
include('funciones/conecta.php');

// Puedes probar la conexión si quieres
$conexion = conecta();
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Encuesta - Sushi Kyoday</title>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <style>
  body {
    font-family: Arial, sans-serif;
    background-image: url('fondo.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    padding: 20px;
    max-width: 600px;
    margin: auto;
    backdrop-filter: brightness(0.95); /* Opcional para oscurecer ligeramente el fondo */
  }
  h1 {
    text-align: center;
    color:rgb(255, 255, 255);
  }
  .logo {
    display: block;
    margin: 0 auto 20px;
    max-width: 150px;
    height: auto;
    border-radius: 50%;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  }
  form {
    background-color: rgba(255, 255, 255, 0.9); /* Ligera transparencia */
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
  }
  label {
    display: block;
    margin-top: 15px;
    font-weight: bold;
  }
  input, select, textarea, button {
    width: 100%;
    margin-top: 5px;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
    box-sizing: border-box;
  }
  button {
    background-color: #d32f2f;
    color: white;
    font-weight: bold;
    margin-top: 20px;
    cursor: pointer;
  }
  button:hover {
    background-color:rgb(199, 17, 17);
  }
  .thank-you {
    text-align: center;
    font-size: 1.2em;
    color: white;
    margin-top: 20px;
  }
</style>


</head>
<body>

<img src="logo.png" alt="Logo Sushi Kyoday" class="logo" />

<h1>Encuesta</h1>

<form id="encuestaForm">
  <label for="mesero">¿Qué mesero los atendió?</label>
    <select name="mesero" id="mesero" required>
      <option value="">Selecciona una opción</option>
      <option value="Lennon">Lennon</option>
      <option value="Raúl">Raúl</option>
      <option value="Alin">Alin</option>
      <option value="Lesly">Lesly</option>
    </select>

    <label for="comentarios_mesero">Comentarios adicionales del mesero:</label>
    <textarea name="comentarios_mesero" id="comentarios_mesero" rows="4"></textarea>

    <label for="calidad_comida">¿Cómo calificarías la calidad de la comida?</label>
    <select name="calidad_comida" id="calidad_comida" required>
      <option value="">Selecciona una opción</option>
      <option>Excelente</option>
      <option>Buena</option>
      <option>Regular</option>
      <option>Mala</option>
    </select>

    <label for="atencion_personal">¿Cómo calificarías la atención del personal?</label>
    <select name="atencion_personal" id="atencion_personal" required>
      <option value="">Selecciona una opción</option>
      <option>Excelente</option>
      <option>Buena</option>
      <option>Regular</option>
      <option>Mala</option>
    </select>

    <label for="bebidas_tiempo">¿Cómo calificarías las bebidas y su tiempo de espera?</label>
    <select name="bebidas_tiempo" id="bebidas_tiempo" required>
      <option value="">Selecciona una opción</option>
      <option>Excelente</option>
      <option>Buena</option>
      <option>Regular</option>
      <option>Mala</option>
    </select>

    <label for="tiempo_comida">¿Cómo calificarías el tiempo de espera de la comida?</label>
    <select name="tiempo_comida" id="tiempo_comida" required>
      <option value="">Selecciona una opción</option>
      <option>Excelente</option>
      <option>Buena</option>
      <option>Regular</option>
      <option>Mala</option>
    </select>

    <label for="limpieza_lugar">¿Cómo calificarías la limpieza del lugar?</label>
    <select name="limpieza_lugar" id="limpieza_lugar" required>
      <option value="">Selecciona una opción</option>
      <option>Excelente</option>
      <option>Buena</option>
      <option>Regular</option>
      <option>Mala</option>
    </select>

    <label for="recomendacion">¿Recomendarías Sushi Kyoday?</label>
    <select name="recomendacion" id="recomendacion" required>
      <option value="">Selecciona una opción</option>
      <option>Sí</option>
      <option>No</option>
    </select>

    <label for="comentarios_adicionales">Comentarios adicionales:</label>
    <textarea name="comentarios_adicionales" id="comentarios_adicionales" rows="4"></textarea>

    <button type="submit">Enviar encuesta</button>
</form>

<div class="thank-you" id="mensajeGracias" style="display: none;">
  <h4>¡Gracias por tu opinión!</h4>
</div>

<script>
document.getElementById("encuestaForm").addEventListener("submit", function(event) {
  event.preventDefault();

  const datos = {
    mesero: document.getElementById("mesero").value,
    comentarios_mesero: document.getElementById("comentarios_mesero").value,
    calidad_comida: document.getElementById("calidad_comida").value,
    atencion_personal: document.getElementById("atencion_personal").value,
    bebidas_tiempo: document.getElementById("bebidas_tiempo").value,
    tiempo_comida: document.getElementById("tiempo_comida").value,
    limpieza_lugar: document.getElementById("limpieza_lugar").value,
    recomendacion: document.getElementById("recomendacion").value,
    comentarios_adicionales: document.getElementById("comentarios_adicionales").value
  };

  fetch("guardar_encuesta.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded"
    },
    body: new URLSearchParams(datos).toString()
  })
  .then(response => response.text())
  .then(data => {
    if (data.trim() === "ok") {
      document.getElementById("encuestaForm").style.display = "none";
      document.getElementById("mensajeGracias").style.display = "block";
    } else {
      alert("Error al guardar: " + data);
    }
  })
  .catch(error => {
    alert("Error de conexión: " + error.message);
  });
});
</script>

</body>
</html>
