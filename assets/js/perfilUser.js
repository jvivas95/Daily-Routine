// Selecciona todos los botones con la clase 'boton'
const botones = document.querySelectorAll(".boton");

// Itera sobre cada botón y agrega los event listeners
botones.forEach((boton) => {
  boton.addEventListener("mouseenter", function () {
    // Agrega la clase 'cambiarColor' al botón
    this.classList.add("cambiarColor");
  });

  boton.addEventListener("mouseleave", function () {
    // Remueve la clase 'cambiarColor' del botón después de 0.1 segundos (100 milisegundos)
    const boton = this;
    setTimeout(function () {
      boton.classList.remove("cambiarColor");
    }, 100);
  });
});

function confirmarAccion(mensaje) {
  return confirm(mensaje);
}

// Agrega el evento de confirmación a los botones
document.getElementById("botonBorrar").addEventListener("click", function (e) {
  if (!confirmarAccion("¿Estás seguro de que deseas borrar esta rutina?")) {
    e.preventDefault(); // Evita que el formulario se envíe si el usuario cancela
  }
});

document
  .getElementById("botonModificar")
  .addEventListener("click", function (e) {
    if (
      !confirmarAccion("¿Estás seguro de que deseas modificar esta rutina?")
    ) {
      e.preventDefault(); // Evita que el formulario se envíe si el usuario cancela
    }
  });
