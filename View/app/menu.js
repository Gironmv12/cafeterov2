// Función para obtener el saludo según la hora
function obtenerSaludo() {
    const horaActual = new Date().getHours();
    let saludo = "";

    if (horaActual >= 0 && horaActual < 12) {
        saludo = "Buenos días";
    } else if (horaActual >= 12 && horaActual < 20) {
        saludo = "Buenas tardes";
    } else {
        saludo = "Buenas noches";
    }

    return saludo;
}

// Actualizar el texto en el Navbar con el saludo
const saludoElement = document.getElementById("saludo");
saludoElement.textContent = obtenerSaludo();

/* Hora y fecha actual */

// Obtén el elemento <p> con el id "fecha"
var fechaElement = document.getElementById("fecha");

// Función para obtener y mostrar la fecha y hora actual en el formato deseado
function mostrarFechaYHoraActual() {
    var fechaActual = new Date();
    var diasSemana = ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"];
    var diaSemana = diasSemana[fechaActual.getDay()];
    var hora = fechaActual.getHours();
    var minutos = fechaActual.getMinutes();
    var ampm = hora >= 12 ? "PM" : "AM";
    var dia = fechaActual.getDate();
    var mes = fechaActual.getMonth() + 1; // Los meses comienzan en 0
    var año = fechaActual.getFullYear();

    // Formatea la hora para mostrar 12 horas en lugar de 24 horas
    if (hora > 12) {
        hora -= 12;
    }

    // Agrega ceros iniciales a los minutos si es necesario
    if (minutos < 10) {
        minutos = "0" + minutos;
    }

    // Construye la cadena de fecha y hora en el formato deseado
    var fechaHoraFormateada = "Fecha: " + diaSemana + ", " + hora + ":" + minutos + " " + ampm + " " + dia + "/" + mes + "/" + año;

    // Muestra la fecha y la hora en el elemento <p> con el id "fecha"
    fechaElement.textContent = fechaHoraFormateada;
}

// Llama a la función para mostrar la fecha y la hora actual
mostrarFechaYHoraActual();

// Actualiza la fecha y la hora cada segundo (1000 milisegundos)
setInterval(mostrarFechaYHoraActual, 1000);