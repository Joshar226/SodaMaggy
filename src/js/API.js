document.addEventListener("DOMContentLoaded", function() {
    iniciarAPI()
})

const mostrar = {
    id: '',
    titulo: '',
    productos: []
}


const orden = {
    id: '',
    modo: '',
    fecha: '',
    hora: '',
    productos: []
}


function iniciarAPI() {
    if(window.location.pathname === '/admin') {
        consultarTipos()
    }
    
    if(window.location.pathname.includes('/ordenes')) {
        buscador()
    }
    
    
}

async function consultarTipos() {
    try {
        const urlTipos = '/api/tipos'
        const resultadoTipos = await fetch(urlTipos)
        const tipos = await resultadoTipos.json()
        
        consultarProductos(tipos)
    } catch (error) {
        console.log(error);
    }
}

async function consultarProductos(tipo) {
    const urlProductos = '/api/productos'
    const resultadoProductos = await fetch(urlProductos)
    const productos = await resultadoProductos.json()

    mostrarTipos(tipo, productos)
}

function mostrarTipos(tipos, productos) {

    tipos.forEach(tipo => {
        mostrar.id = tipo.id
        mostrar.titulo = tipo.titulo

        productos.forEach(producto => {
            if(tipo.id === producto.idTipo) {
                mostrar.productos.push(producto)
            }
        })

        mostrarProductos(tipo)
    })

}

function mostrarProductos(tipo) {

    const pedidoLocal = document.querySelector('#pedido-local')

    const titulo = document.createElement('H1')
    titulo.textContent = mostrar.titulo

    const pedidoLocalDiv = document.createElement('DIV')
    pedidoLocalDiv.classList.add('pedido-local')

    const tipoDiv = document.createElement('DIV')
    tipoDiv.classList.add('tipo')



    pedidoLocal.appendChild(pedidoLocalDiv)

    pedidoLocalDiv.appendChild(titulo)
    pedidoLocalDiv.appendChild(tipoDiv)

    mostrar.productos.forEach(producto => {
        if(tipo.id === producto.idTipo) {
            const cuerpoDiv = document.createElement('DIV')
            cuerpoDiv.classList.add('cuerpo-producto')
            cuerpoDiv.dataset.idProducto = producto.id
            cuerpoDiv.onclick = function() {
                seleccionarProducto(producto)
            }

            const imagenDiv = document.createElement('DIV')
            imagenDiv.classList.add('imagen')

            const imagen = document.createElement('IMG')
            imagen.src = `/imagenes/${producto.imagen}`
            imagen.alt = 'Imagen de Producto'

            const contenidoDiv = document.createElement('DIV')
            contenidoDiv.classList.add('contenido')

            const tituloProducto = document.createElement('H2')
            tituloProducto.textContent = producto.titulo

            const precioProducto = document.createElement('H3')
            precioProducto.textContent = `₡${producto.precio}`
            precioProducto.classList.add('precio')


            contenidoDiv.appendChild(tituloProducto)
            contenidoDiv.appendChild(precioProducto)

            imagenDiv.appendChild(imagen)

            cuerpoDiv.appendChild(imagenDiv)
            cuerpoDiv.appendChild(contenidoDiv)

            tipoDiv.appendChild(cuerpoDiv)
        }
    })
}



function seleccionarProducto(producto) {
    const {id} = producto
    const {productos} = orden
    const divProducto = document.querySelector(`[data-id-producto="${id}"]`)   
    const btnConfirmar = document.querySelector('#confirmar')

    btnConfirmar.onclick = function() {
        confirmarOrden();
    }
    
    if(productos.some(agregado => agregado.id === id)) {
        orden.productos = productos.filter(agregado => agregado.id !== id)
        divProducto.classList.remove('agregado')

    } else {
        orden.productos = [...productos, producto]
        divProducto.classList.add('agregado')
    }

    if(orden.productos.length > 0) {
        btnConfirmar.classList.add('mostrar')
    } else {
        btnConfirmar.classList.remove('mostrar')

    }
}


function confirmarOrden() { 
    const id = document.querySelector('#id')    
    orden.id = id.textContent

    if(orden.id === '1') {
        orden.modo = 0
        const fecha = new Date()
        orden.fecha = fecha.toLocaleDateString()
        
        let minutos = fecha.getMinutes()
        if(minutos < 9) {
            minutos = `0${minutos}`
        }

        orden.hora = fecha.getHours() + ":" + minutos
        
    } else {
        orden.modo = 1
    }

    limpiar('#pedido-local')
    mostrarResumen()    
}

function mostrarResumen() {
    const {productos} = orden
    let total = 0

    const btnConfirmarPedido = document.querySelector('#confirmar')
    btnConfirmarPedido.classList.remove('mostrar')

    const btnGuardarPedido = document.querySelector('#guardar')
    btnGuardarPedido.classList.add('mostrar')
    btnGuardarPedido.onclick = guardarOrden

    const pedidoLocalDiv = document.querySelector('#pedido-local')

    const resumenLocalDiv = document.createElement('DIV')
    resumenLocalDiv.classList.add('resumen-local')

    const tituloResumen = document.createElement('h1')
    tituloResumen.textContent = 'Resumen de Orden'

    const divFecha = document.createElement('P')
    divFecha.classList.add('tiempo')
    divFecha.textContent = `Fecha: ${orden.fecha}`

    const divHora = document.createElement('P')
    divHora.classList.add('tiempo')
    divHora.textContent = `Hora: ${orden.hora}`

    const totalProducto = document.createElement('H2')
    totalProducto.classList.add('total')


    resumenLocalDiv.appendChild(tituloResumen)
    resumenLocalDiv.appendChild(divFecha)
    resumenLocalDiv.appendChild(divHora)
    pedidoLocalDiv.appendChild(resumenLocalDiv)

    productos.forEach(producto => {
        const precio = parseInt(producto.precio)
        total += precio
        totalProducto.textContent = `Total: ₡${total}`

        const resumenDiv = document.createElement('DIV')
        resumenDiv.classList.add('resumen')

        const productoDiv = document.createElement('DIV')
        productoDiv.classList.add('producto')

        const tituloProducto = document.createElement('H3')
        tituloProducto.textContent = producto.titulo

        const precioProducto = document.createElement('H3')
        precioProducto.classList.add('precio')
        precioProducto.textContent = `₡${precio}`
        
        const btnEliminar = document.createElement('BUTTON')
        btnEliminar.classList.add('boton')
        btnEliminar.classList.add('eliminar')
        btnEliminar.textContent = 'Eliminar'
        btnEliminar.onclick = function() {
            eliminarDeResumen(producto)
        }

        productoDiv.appendChild(tituloProducto)
        productoDiv.appendChild(precioProducto)

        resumenDiv.appendChild(productoDiv)
        resumenDiv.appendChild(btnEliminar)

        resumenLocalDiv.appendChild(resumenDiv)
    })

    resumenLocalDiv.appendChild(totalProducto)
    
}

async function guardarOrden() {
    const {id, modo, fecha, hora, productos} = orden
    const productoId = productos.map(producto => producto.id)


    const datos = new FormData()
    datos.append('usuarioId', id)
    datos.append('modo', modo)
    datos.append('fecha', fecha)
    datos.append('hora', hora)
    datos.append('productos', productoId)

    Swal.fire({
        icon: "success",
        title: "Guardado Exitosamente"
    });

    setTimeout(() => {
        window.location.reload()
    }, 2000);

    try {
        const url = '/api/guardar'
        const respuesta = await fetch(url, {
            method: 'POST',
            body: datos
        })
        const resultado = await respuesta.json()
        
    } catch (error) {
        console.log(error);
        
    }

}

function eliminarDeResumen(producto) {
    const {id} = producto
    const {productos} = orden

    orden.productos = productos.filter(agregado => agregado.id !== id)

    confirmarOrden();

    if(productos.length === 1) {
        window.location.reload();
    }    
}

function limpiar(elemento) {
    const div = document.querySelector(elemento)
    
    while(div.firstChild) {
        div.removeChild(div.firstChild)
    }
}

function buscador() {
    const fechaInput = document.querySelector('#fecha')
    
    fechaInput.addEventListener('input', e => {
        const fechaSeleccionada = e.target.value
        window.location = `?fecha=${fechaSeleccionada}`
    })
}