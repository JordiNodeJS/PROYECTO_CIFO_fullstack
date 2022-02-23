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
    // datos que envío al server PHP, el cual estará esperándolos como agua de mayo.

    // const formData = new FormData(document.querySelector('#formulario'))

    // fetch(url, {
    //   method: 'POST',
    //   body: formData,
    // })
    //   .then(response => response.json())
    //   .then(data => {
    //     console.log(data)
    //   })
    //   .catch(err => console.log('Error en la llamada fetch'))
    // //////////////////////////////////////////////////////////////////

    const formData = new FormData(document.querySelector('#formulario'))
    const request = async () => {
      try {
        const options = {
          method: 'POST',
          body: formData,
        }

        const response = await fetch(url, options)
        if (response.ok) {
          return await response.json()
        } else {
          throw new Error(response.statusText)
        }
      } catch (err) {
        console.log('Error al realizar la petición AJAX: ' + err.message)
      }
    }
    request().then(data => console.log(data))

    Swal.fire({
      position: 'center',
      icon: 'success',
      title: 'Your work has been saved',
      showConfirmButton: false,
      timer: 1500,
    })
  }
}

const eventListener = () =>
  document
    .querySelector('#formulario')
    .addEventListener('submit', validarRegistro)

eventListener()
