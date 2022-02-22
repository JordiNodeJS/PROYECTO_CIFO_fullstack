const validarRegistro = e => {
  e.preventDefault()
  let usuario = document.querySelector('#usuario').value,
    password = document.querySelector('#password').value
  // console.log(usuario, password)
  if (usuario === '' || password === '') {
    Swal.fire({
      icon: 'error',
      title: '¡Vaya!',
      text: 'Dejaste los campos del formulario vacío',
      color: 'darkred',
      background: 'lightblue',
      iconColor: 'peru',
      confirmButtonColor: 'purple',
      confirmButtonText: 'Vale tío?'
    })
  }
}
const eventListener = () =>
  document
    .querySelector('#formulario')
    .addEventListener('submit', validarRegistro)

eventListener()
