// fondo_dinamico.js

function establecerFondoDinamico() {
    const inicio = document.getElementById('inicio'); // Obtener el elemento de inicio
    const horaActual = new Date().getHours(); // Obtener la hora actual
  
    // Verificar si es de día, tarde o noche
    //Si es de 6 am a 12 del medio dia
    if (horaActual >= 6 && horaActual <= 12) {
        inicio.classList.add('fondo-manana'); // Aplicar fondo de la mañana
        inicio.classList.remove('fondo-tarde', 'fondo-noche'); // Remover otros fondos
       // console.log(horaActual);
       //Si es de 1 a 6 pm
      } else if (horaActual >= 12 && horaActual <= 18) {
        inicio.classList.add('fondo-tarde'); // Aplicar fondo de la tarde
        inicio.classList.remove('fondo-manana', 'fondo-noche'); // Remover otros fondos
        console.log(horaActual);
        //De lo contrario de 6pm a 6am
      } else {
        inicio.classList.add('fondo-noche'); // Aplicar fondo de la noche
        inicio.classList.remove('fondo-manana', 'fondo-tarde'); // Remover otros fondos
        console.log(horaActual);
      }
  }
  