const $listaProyectos = document.querySelector('ul#proyectos')
const $crearProyecto = document.querySelector('.crear-proyecto a')

const eventListeners = () =>
  $crearProyecto.addEventListener('click', nuevoProyecto) // añadimos el botón que nos creará el proyecto, bookmark o tarjeta

const quitaAgregarNuevoProyecto = () =>
  $crearProyecto.removeEventListener('click', nuevoProyecto)

eventListeners()

function nuevoProyecto(e) {
  e.preventDefault()
  console.log('crear nueva tarjeta', Math.ceil(Math.random() * 100))

  // creamos un nuevo input para la tarjetas
  const $nuevoProyecto = document.createElement('li')
  $nuevoProyecto.classList.add('campo')
  $nuevoProyecto.innerHTML =
    '<input class="agretar-tarea" type="text" id="nuevo-proyecto" /><br /><input id="btn-agregar-proyecto" class="boton" type="button" value="Agregar" />'
  $listaProyectos.appendChild($nuevoProyecto)
  document.querySelector('#nuevo-proyecto').focus()

  // seleccionamos el ID con la nueva tarjeta
  const $inputNuevoProyecto = document.querySelector('#nuevo-proyecto')
  const $btnAgregarProyecto = document.querySelector('#btn-agregar-proyecto')

  //   $inputNuevoProyecto.addEventListener('keypress', e => {
  //     const tecla = e.key
  //     if (tecla == 'Enter') {
  //       guardarProyectoDB($inputNuevoProyecto.value)
  //       $listaProyectos.removeChild($nuevoProyecto)
  //     }
  //   })
  $btnAgregarProyecto.addEventListener('click', e => {
    guardarProyectoDB($inputNuevoProyecto.value)
    $listaProyectos.removeChild($nuevoProyecto)
    eventListeners()
  })
  quitaAgregarNuevoProyecto()
}

function guardarProyectoDB(nombreProyecto) {
  console.log(nombreProyecto)
  const url = 'inc/modelos/moledo-proyecto.php'

  const formData = new FormData()
  formData.append('proyecto', nombreProyecto)
  formData.append('accion', 'crear')

  fetch(url, {
    method: 'POST',
    body: formData,
  })
    .then(data => {
      if (data.status == 404) console.log('no existe tal fetch: ', data.ok)
      if (data.ok == true) return data.json()
    })
    .then(respuesta => {
      let proyecto = respuesta.nombre_proyecto,
        idProyecto = respuesta.id_proyecto,
        typeAction = respuesta.type_action,
        resultado = respuesta.response
      if (resultado == 'right') {
        // fue exitoso
        if (typeAction == 'crear') {
          // se acaba de crear un nuevo proyecto
          // meto  html
          const nuevoProyecto = document.createElement('li')
          nuevoProyecto.innerHTML = `
                    <a href="index.php?id_proyecto=${idProyecto}" id="${idProyecto}">
                        ${proyecto}
                    </a>
                `
          // adding to html
          $listaProyectos.appendChild(nuevoProyecto)

          Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Proyecto',
            text: 'Proyecto creado corréctamente!',
            showConfirmButton: true,
          }).then(resultado => {
            if (resultado.value)
              window.location.href = `index.php?id_proyecto=${idProyecto}`
          })
        } else {
          //se actualizó o se eliminó.
        }
      } else {
        // hubo un error
        alert('hubo un error')
      }
    })
    .catch(e => {
      console.log(
        'mensaje de error, caray, posiblemente no estés recibiendo un objeto json ',
        e
      )
    })
}
// function guardarProyectoDB(nombreProyecto) {
//   console.log(nombreProyecto)
//   const nuevoProyecto = document.createElement('li')
//   nuevoProyecto.innerHTML = `
//     <a href="#">
//         ${nombreProyecto}
//     </a>
//   `
//   $listaProyectos.appendChild(nuevoProyecto)
// }
