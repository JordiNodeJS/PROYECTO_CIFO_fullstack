const $listaProyectos = document.querySelector('ul#proyectos')
const $crearProyecto = document.querySelector('.crear-proyecto a')
const $nuevaTarea = document.querySelector('.nueva-tarea')
const $projectTrash = document.querySelector('#proyectos')

const eventListeners = () => {
  $crearProyecto.addEventListener('click', nuevoProyecto) // añadimos el botón que nos creará el proyecto, bookmark o tarjeta
  // agregar tarea
  if ($nuevaTarea !== null)
     $nuevaTarea.addEventListener('click', addingTask)
  // btn checked and trash
  document
    .querySelector('.listado-pendientes')
    .addEventListener('click', actionTask)

  // proyecto to trash

  $projectTrash.addEventListener('click', projectTrash)
}

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
  const URL = 'inc/modelos/moledo-proyecto.php'

  const formData = new FormData()
  formData.append('proyecto', nombreProyecto)
  formData.append('accion', 'crear')

  fetch(URL, {
    method: 'POST',
    body: formData,
  })
    .then(data => {
      if (data.status == 404) console.log('no existe tal fetch: ', data.ok)
      if (data.ok == true) return data.json()
    })
    .then(respuesta => {
      const proyecto   = respuesta.nombre_proyecto,
            idProyecto = respuesta.id_proyecto,
            typeAction = respuesta.type_action,
            resultado  = respuesta.response
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
    .catch(e => console.log('Mensaje de error, caray! Posiblemente no estés recibiendo un objeto json😪', e) )
}

// adding task

function addingTask(e) {
  e.preventDefault()
  const $nombreTarea = document.querySelector('.nombre-tarea').value

  if ($nombreTarea === '') {
    alert('Rellena el bookmark con algo. Un bookmark no puede ir vacío. Porque tú me dirás si no para qué lo creas.')
  } else {
    // insert into tareas
    const URL = 'inc/modelos/molelo-tareas.php'
    const formData = new FormData()
    formData.append('tarea', $nombreTarea)
    formData.append('type_action', 'crear')
    formData.append('id_proyecto', document.querySelector('#id_proyecto').value)

    fetch(URL, {
      method: 'POST',
      body: formData,
    })
      .then(res => res.json())
      .then(data => {
        console.log(data);
        const { response, id_inserted, type_action, tarea } = data
        // console.log( `${response}, ${id_inserted}, ${type_action}, ${tarea}`)
        if (response == 'right') {
          if (type_action == 'crear') {
            alert('alerta creada')
            // crear el html de tareas
            const newTask = document.createElement('li')

            newTask.id = 'tarea_' + id_inserted
            newTask.classList.add('tarea')

            newTask.innerHTML = `
              <p>${tarea}</p>
              <div class="acciones">
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-trash"></i>
              </div>
            `
            const listado = document.querySelector('.listado-pendientes ul')
            listado.appendChild(newTask)

            // resteando la formulario o input
            document.querySelector('.agregar-tarea').reset()
          }
        } else alert('otro error!')
      })
      .catch(e => console.log('error !! ', e))
  }
}

// it changes tasks' state or deletes them
// delegation method on addEventListener
function actionTask(e) {
  e.preventDefault()
  // console.log(e.target);
  if (e.target.classList.contains('fa-check-circle')) {
    if (e.target.classList.contains('checked')) {
      e.target.classList.remove('checked')
      changeTaskstatus(e.target, 0)
    } else {
      e.target.classList.add('checked')
      changeTaskstatus(e.target, 1)
    }
  }
  if (e.target.classList.contains('fa-trash')) {
    // if (confirm('estás a punto de borrarlo')) {
      const deleteTask = e.target.parentElement.parentElement
      deleteTask.remove()
      deleteTaskDB(deleteTask)

    // }
  }
}
// enviando el proyecto al garete
// delegation method
function projectTrash(e){
  const URL = 'inc/modelos/modelo-proyecto-sayonara-baby.php'
  if(e.target.classList.contains('fa-trash')){

    Swal.fire({
      title: 'Estás seguro?',
      text: "Se borrará del todo y no volverás a saber nunca más de tu proyecto!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí, quiero liberarme del proyecto'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire(
          'Adios proyecto',
          'Te has quedado sin él para siempre. Te lo dije.',
          'success'
        )



        e.target.parentElement.remove()

        const projectId = e.target.id.split('_')
        console.log(projectId[1])

        const formData = new FormData()
        formData.append('id', projectId[1])
        formData.append('type', 'delete')

        fetch(URL, {
          method:'POST',
          body: formData
        })
        .then(res => res.json())
        .then(data => {
          e.target.parentElement.remove()
          console.log(data)
        })
        .catch(e => console.log('hubo un error en el fetch', e))


      }
    })



}
}


// step 4: eliminando las tareas de la base de datos, tro lo ló
function deleteTaskDB(task){
  const idTask = task.id.split('_')
  // console.log(idTask[1]);
  const URL = 'inc/modelos/modelo-delete.php'

  const formData = new FormData()
  formData.append('id', idTask[1])
  formData.append('type', 'delete')


  fetch(URL, {
    method: 'POST',
    body: formData,
  })
    .then(res => res.json())
    .then(data => console.log(data))
    .catch(e => console.log('hubo un error en el fetch', e))

}



function changeTaskstatus(task, state) {
  const idTask = task.parentElement.parentElement.id.split('_')
  // console.log(idTask[1]);
  const URL = 'inc/modelos/modelo-update-state.php'

  const formData = new FormData()
  formData.append('id', idTask[1])
  formData.append('type', 'update')
  formData.append('state', state)

  fetch(URL, {
    method: 'POST',
    body: formData,
  })
    .then(res => res.json())
    .then(data => console.log(data))
    .catch(e => console.log('hubo un error en el fetch', e))
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
