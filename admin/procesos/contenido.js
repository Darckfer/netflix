// |----------------------|
// |  Mostrar peticiones  |
// |----------------------|

peticiones('');

function peticiones() {
    var peticiones = document.getElementById('peticiones');
    var formdata = new FormData();
    var ajax = new XMLHttpRequest();

    ajax.open('POST', './procesos/peticiones.php');
    ajax.onload = function () {
        if (ajax.status === 200) {
            var json = JSON.parse(ajax.responseText);
            var tabla = '';
            json.forEach(function (item) {
                var str = "<tr>";
                str += "<td>" + item.id_user + "</td>";
                str += "<td>" + item.nom + "</td>";
                str += "<td>" + item.email + "</td>";
                str += "<td>" + item.nom_rol + "</td>";
                str += "<td><button type='button' class='btn btn-success' onclick='aceptar(" + item.id_user + ", \"" + item.nom + "\")'>Aceptar</button>";
                str += " <button type='button' class='btn btn-danger' onclick='eliminar(" + item.id_user + ", \"" + item.nom + "\")'>Rechazar</button>";
                str += '</td></tr>';
                tabla += str;
            });
            peticiones.innerHTML = tabla;
        } else {
            peticiones.innerText = 'Error al cargar las peticiones, estamos trabajando en ello';
        }
    };

    ajax.send(formdata);
}

// |-------------------------|
// |    aceptar peticion    |
// |-------------------------|

function aceptar(id_user, nom) {
    Swal.fire({
        title: 'Esta seguro de aceptar a ' + nom + '?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'NO'
    }).then((result) => {
        if (result.isConfirmed) {
            var formdata = new FormData();
            formdata.append('id', id_user);
            var ajax = new XMLHttpRequest();
            ajax.open('POST', './procesos/aceptar.php');
            ajax.onload = function () {
                if (ajax.status === 200) {
                    if (ajax.responseText == "ok") {
                        peticiones('');
                        usuarios('');
                        peliculas('');
                        Swal.fire({
                            icon: 'success',
                            title: 'Aceptado',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                }
            }
            ajax.send(formdata);
        }
    })
}

// |------------------------------------|
// |    Eliminar petiocion y usuario    |
// |------------------------------------|

function eliminar(id_user, nom) {
    Swal.fire({
        title: 'Esta seguro de eliminar a ' + nom + '?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'NO'
    }).then((result) => {
        if (result.isConfirmed) {
            var formdata = new FormData();
            formdata.append('id', id_user);
            var ajax = new XMLHttpRequest();
            ajax.open('POST', 'eliminar.php');
            ajax.onload = function () {
                if (ajax.status === 200) {
                    if (ajax.responseText == "ok") {
                        peticiones('');
                        usuarios('');
                        peliculas('');
                        Swal.fire({
                            icon: 'success',
                            title: 'Eliminado',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                }
            }
            ajax.send(formdata);
        }
    })
}
















// |----------------------|
// |   Mostrar usuarios   |
// |----------------------|

usuarios('');

function usuarios() {
    var peticiones = document.getElementById('usuarios');
    var formdata = new FormData();
    var ajax = new XMLHttpRequest();

    ajax.open('POST', './procesos/usuarios.php');
    ajax.onload = function () {
        if (ajax.status === 200) {
            var json = JSON.parse(ajax.responseText);
            var tabla = '';
            json.forEach(function (item) {
                var str = "<tr>";
                str += "<td>" + item.id_user + "</td>";
                str += "<td>" + item.nom + "</td>";
                str += "<td>" + item.email + "</td>";
                str += "<td>" + item.nom_rol + "</td>";
                str += "<td><button type='button' class='btn btn-success' onclick='Editar(" + item.id_user + ")'>Editar</button>";
                str += " <button type='button' class='btn btn-danger' onclick='eliminar(" + item.id_user + ", \"" + item.nom + "\")'>Eliminar</button>";
                str += '</td></tr>';
                tabla += str;
            });
            peticiones.innerHTML = tabla;
        } else {
            peticiones.innerText = 'Error al cargar los usuarios, estamos trabajando en ello';
        }
    };

    ajax.send(formdata);
}


// |--------------------------------------------------|
// |    Mostrar datos del usuario en el formulario    |
// |--------------------------------------------------|

function Editar(id_user) {
    var formdata = new FormData();
    formdata.append('id', id_user);
    var ajax = new XMLHttpRequest();
    ajax.open('POST', './procesos/editarusu.php');
    ajax.onload = function () {
        if (ajax.status === 200) {
            var json = JSON.parse(ajax.responseText);
            console.log(json.id_user);
            document.getElementById('idp').value = json.id_user;
            document.getElementById('nom').value = json.nom;
            document.getElementById('email').value = json.email;
            document.getElementById('rol').value = json.rol;
            document.getElementById('activo').value = json.activo;
        } else {
            console.error("Error al obtener datos para la edición");
        }
    };
    ajax.send(formdata);
}

// ----------------------
// ACTUALIZAR USUARIO 
// ----------------------

editarusu.addEventListener("click", () => {
    var form = document.getElementById('editusu');
    var formdata = new FormData(form);
    var ajax = new XMLHttpRequest();
    ajax.open('POST', './procesos/updateusu.php');
    ajax.onload = function () {
        if (ajax.status === 200) {
            if (ajax.responseText === "ok") {
                Swal.fire({
                    icon: 'success',
                    title: 'Editado',
                    showConfirmButton: false,
                    timer: 1500
                });
                form.reset();
                peticiones('');
                usuarios('');
                peliculas('');
            }
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un error al realizar la operación.',
            });
        }
    }
    ajax.send(formdata);
});












// |----------------------|
// | Filtros de búsqueda  |
// |----------------------|

const buscar = document.getElementById("buscar");
const buscar2 = document.getElementById("genero");

buscar.addEventListener("input", () => {
    const valor = buscar.value;
    const valor2 = buscar2.value;
    actualizarPeliculas(valor, valor2);
});

buscar2.addEventListener("change", () => {
    const valor = buscar.value;
    const valor2 = buscar2.value;
    actualizarPeliculas(valor, valor2);
});

function actualizarPeliculas(valor, valor2) {
    if (valor === "") {
        peliculas("", valor2);
    } else {
        peliculas(valor, valor2);
    }
}

// |-----------------------|
// |   Mostrar peliculas   |
// |-----------------------|

peliculas("", "");

function peliculas(valor, valor2) {
    var peticiones = document.getElementById('peliculas');
    const formdata = new FormData();
    formdata.append("busqueda", valor);
    formdata.append("genero", valor2);
    const ajax = new XMLHttpRequest();

    ajax.open('POST', './procesos/peliculas.php');
    ajax.onload = function () {
        if (ajax.status === 200) {
            var json = JSON.parse(ajax.responseText);
            var tabla = '';

            json.forEach(function (item) {
                var str = "<tr>";
                str += "<td>" + item.id_cont + "</td>";
                str += "<td>" + item.titulo + "</td>";
                str += "<td>" + item.desc_cont + "</td>";
                str += "<td>" + item.url_video + "</td>";
                str += "<td>" + item.fecha_estreno + "</td>";
                str += "<td>" + item.nom_gen + "</td>";
                str += "<td>" + item.portada + "</td>";
                str += "<td><button type='button' class='btn btn-success' onclick='Editarvideo(" + item.id_cont + ")'>Editar</button>";
                str += " <button type='button' class='btn btn-danger' onclick='eliminarvideo(" + item.id_cont + ")'>Eliminar</button>";
                tabla += str;
            });

            peticiones.innerHTML = tabla;
        } else {
            peticiones.innerText = 'Error al cargar los amigos, estamos trabajando en ello';
        }
    };

    ajax.send(formdata);
}

// |----------------------|
// |    Editar Video      |
// |----------------------|

function Editarvideo(id_cont) {
    var formdata = new FormData();
    formdata.append('id', id_cont);
    var ajax = new XMLHttpRequest();
    ajax.open('POST', './procesos/editarcont.php');
    ajax.onload = function () {
        if (ajax.status === 200) {
            var json = JSON.parse(ajax.responseText);
            // console.log(json.id_cont);
            document.getElementById('idcont').value = json.id_cont;
            document.getElementById('titulo').value = json.titulo;
            document.getElementById('Descripcion').value = json.desc_cont;
            document.getElementById('url_video').value = json.url_video;
            document.getElementById('fecha_subida').value = json.fecha_estreno;
            document.getElementById('genero').value = json.genero;
            document.getElementById('editarpeli').value = "Confirmar";
        } else {
            console.error("Error al obtener datos para la edición");
        }
    };
    ajax.send(formdata);
}

// ----------------------
// REGISTRAR/ACTUALIZAR NUEVO ELEMENTO (BOTÓN DEL FORMULARIO DE REGISTRO)
// ----------------------

editarpeli.addEventListener("click", () => {
    var form = document.getElementById('frmpeli');
    var formdata = new FormData(form);
    var ajax = new XMLHttpRequest();
    ajax.open('POST', './procesos/updatepeli.php');
    ajax.onload = function () {
        if (ajax.status === 200) {
            if (ajax.responseText === "ok") {
                Swal.fire({
                    icon: 'success',
                    title: 'Editado',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    form.reset();
                    document.getElementById('idcont').value = "";
                    peticiones('');
                    usuarios('');
                    peliculas('');
                });
            } else if (ajax.responseText === "new") {
                Swal.fire({
                    icon: 'success',
                    title: 'Añadido',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    form.reset();
                    document.getElementById('idcont').value = "";
                    peticiones('');
                    usuarios('');
                    peliculas('');
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un error al realizar la operación.',
                });
            }
        }
    };
    ajax.send(formdata);
});



// |---------------------------|
// |    Eliminar contenido     |
// |---------------------------|

function eliminarvideo(id_cont, titulo) {
    Swal.fire({
        title: 'Esta seguro de eliminar a ' + titulo + '?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'NO'
    }).then((result) => {
        if (result.isConfirmed) {
            var formdata = new FormData();
            formdata.append('id', id_cont);
            var ajax = new XMLHttpRequest();
            ajax.open('POST', './procesos/eliminarvideo.php');
            ajax.onload = function () {
                if (ajax.status === 200) {
                    if (ajax.responseText == "ok") {
                        peticiones('');
                        usuarios('');
                        peliculas('');
                        Swal.fire({
                            icon: 'success',
                            title: 'Eliminado',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                }
            }
            ajax.send(formdata);
        }
    })
}