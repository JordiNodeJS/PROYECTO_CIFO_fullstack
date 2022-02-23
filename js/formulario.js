const validarRegistro = e => {
  e.preventDefault()

  const url = 'inc/modelos/modelo-admin.php'

  let usuario = document.querySelector('#usuario').value,
    password = document.querySelector('#password').value,
    tipo = document.querySelector('#tipo').value
  // console.log(usuario, password)

  if (usuario === '' || password === '') {
    // la validación se falló, uah, uah, uah
    Swal.fire({
      icon: 'error',
      title: '¡Vaya!',
      text: 'Dejaste los campos del formulario vacío',
      color: 'darkred',
      background: 'lightblue',
      iconColor: 'peru',
      confirmButtonColor: 'purple',
      confirmButtonText: 'Vale tío?',
    })
  } else {
    // -------------------------------- START
    // --------------------------------
    // debes rellenar todo, todito como buen chico
    //  datos que envío al server PHP, el cual estará esperándolos como agua de mayo.
    //  manera antigua de hacerlo
    // const datos = new FormData()
    // datos.append('usuario', usuario)
    // datos.append('password', password)
    // datos.append('accion', tipo)
    // console.log(datos.get('usuario'))
    // console.log(typeof datos)

    // const xhr = new XMLHttpRequest()
    // xhr.open('POST', url, true)

    // xhr.onload = function () {
    //   if (this.status === 200)
    //     // console.log(xhr.responseText)

    //     console.log(JSON.parse(xhr.responseText))

    // }

    // xhr.send(datos)
    // --------------------------------
    // -------------------------------- END

    // Enviar la petición: todo lo que tenga el FormData
    // refactorizar end

    // ////////////////  START
    // ////////////////

    // // datos que envío al server PHP, el cual estará esperándolos como agua de mayo.

    const formData = new FormData(document.querySelector('#formulario'))
    // FormData recoge los valors del siempre y cuando no sean valores ocultos

    // con este método, en caso de que el campo sea un valor oculto, se añade ese campo con este método
    formData.append('accion', tipo)

    // debugging
    // console.log(formData.get('usuario'));
    // console.log(formData.get('password'));
    // console.log(formData.get('accion'));

    fetch(url, {
      method: 'POST',
      body: formData,
    })
      .then(response => response.json()) // https://programmerclick.com/article/74842224217/ si da error pasar a response.text() para analizar el resulatdo
      .then(data => {
        console.log(data)
        // if data is right
        if (data.response == 'right' && data.type_action == 'crear') {
          // si es un nuevo usuario actual https://sweetalert2.github.io/
          Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Usuario creado',
            text: 'El usuario se creó corréctamente',
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true,
          })
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Something went wrong!',
            footer: '<a href="">Why do I have this issue?</a>'
          })
        }
      })
      .catch(error => console.log('Error en la llamada fetch:', error.message))

    // ////////////////
    // //////////////// END

    // Swal.fire({
    //   position: 'center',
    //   icon: 'success',
    //   title: 'Your work has been saved',
    //   showConfirmButton: false,
    //   timer: 1500,
    // })
  }
}

const eventListener = () =>
  document
    .querySelector('#formulario')
    .addEventListener('submit', validarRegistro)

eventListener()
