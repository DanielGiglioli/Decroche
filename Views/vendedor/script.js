function swalerror(text) {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: text,
        position: 'top',
        toast: true,
        showConfirmButton: false,
        timer: 3000
    });
}

function swalsuccess(text) {
    Swal.fire({
        icon: 'success',
        title: 'respuesta exitosa',
        position: 'top',
        toast: true,
        timer: 2300,
        showConfirmButton: false,
    });
}

function editarProducto(id_pro) {
    // Realizar solicitud AJAX para obtener detalles del usuario por su ID
    fetch('../../Controllers/Administrador/obtener_producto.php?id_pro=' + id_pro)
        .then(response => response.json())
        .then(data => {
            document.getElementById('id_pro').value =data.id_pro;
            document.getElementById('nombre').value = data.nombre;
            document.getElementById('estado').value = data.estado;
            document.getElementById('categoria').value = data.categoria;
            document.getElementById('precio').value = data.precio;
            document.getElementById('proveedor').value = data.proveedor;
            document.getElementById('stock').value = data.stock;
        })
        .catch(error => console.error('Error al obtener producto por ID:', error));
        console.log(id_pro);
}



document.getElementById('form_editar_servicios').addEventListener('submit', function (event) {
    event.preventDefault();
    const id_pro = document.getElementById("id_pro").value;
    const nombre = document.getElementById("nombre").value;
    const estado = document.getElementById("estado").value;
    const categoria = document.getElementById("categoria").value;
    const precio = document.getElementById("precio").value;
    const stock = document.getElementById("stock").value;
    const proveedor = document.getElementById("proveedor").value;


    console.log(id_pro, estado);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../../Controllers/Vendedor/editar_producto.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {

        const responseLog = xhr.responseText;
        console.log(responseLog);
        
        if(responseLog === "fallo"){
        swalerror("Algo esta mal al enviar los datos");
        }else if(responseLog === "exito") {
        swalsuccess("Respuesta cargada");
        setTimeout(() => {
            location.href="./verProduct.php";
        }, 1500);
        }else {
        swalerror("Error en el registro, Hubo un problema al registrar los datos");
        }
    };
    
    // Enviar los datos del formulario al servidor
    xhr.send(`id_pro=${id_pro}&nombre=${nombre}&estado=${estado}&categoria=${categoria}&precio=${precio}&proveedor=${proveedor}&stock=${stock}`);

});