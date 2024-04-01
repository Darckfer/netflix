// |----------------------|
// |   Filtros de búsqueda   |
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

// |------------------------|
// |    Like al contenido   |
// |------------------------|

function like(id_cont) {
    var formdata = new FormData();
    formdata.append("id", id_cont);

    var ajax = new XMLHttpRequest();
    ajax.open("POST", "./procesos/like.php");
    ajax.onload = function() {
        if (ajax.status === 200) {
            if (ajax.responseText === "new") {
                console.log("asd");
                top5();
            }
        }
    };
    ajax.send(formdata);
}

// |----------------------|
// |   Mostrar películas  |
// |----------------------|

window.onload = function() {
    peliculas("", "");
    top5();
}

// peliculas("", "");

function actualizarPeliculas(valor, valor2) {
    if (valor === "") {
        peliculas("", valor2);
    } else {
        peliculas(valor, valor2);
    }
}

function peliculas(valor, valor2) {
    const pelis = document.getElementById("pelis");
    const error = document.getElementById("error");
    const formdata = new FormData();
    formdata.append("busqueda", valor);
    formdata.append("genero", valor2);
    const ajax = new XMLHttpRequest();

    ajax.open("POST", "./procesos/pelis.php");
    ajax.onload = function() {
        if (ajax.status === 200) {
            const json = JSON.parse(ajax.responseText);
            let str = "";
            json.forEach(function(contenido) {
                str += "<div class='pelis'>";
                str += "<img class='zoom' src='./portadas/" + contenido.portada + "' alt='Imagen' onclick='informacion(" + contenido.id_cont + ")'></img>";
                str += "<p><button onclick='like(" + contenido.id_cont + ")'>🖤</button> " + contenido.titulo + "</p>";
                str += "</div>";
            });
            pelis.innerHTML = str;
        } else {
            error.innerText = "Error al cargar las películas, estamos trabajando en ello";
        }
    };
    ajax.send(formdata);
}

// |----------------------------|
// |   Mostrar Top 5 películas  |
// |----------------------------|

// top5();

function top5() {
    const top5 = document.getElementById("top5");
    const error = document.getElementById("error");
    const formdata = new FormData();
    const ajax = new XMLHttpRequest();

    ajax.open("POST", "./procesos/top5.php");
    ajax.onload = function() {
        if (ajax.status === 200) {
            const json = JSON.parse(ajax.responseText);
            let str = "";
            json.forEach(function(contenido) {
                str += "<div class='pelis'>";
                str += "<img class='zoom' src='./portadas/" + contenido.portada + "' alt='Imagen' onclick='informacion(" + contenido.id_cont + ")'></img>";
                str += " <p><button onclick='like(" + contenido.id_cont + ")'>🖤</button>" + contenido.titulo + "</p>";
                str += "</div>";
            });
            top5.innerHTML = str;
        } else {
            error.innerText = "Error al cargar las películas, estamos trabajando en ello";
        }
    };
    ajax.send(formdata);
}

// |------------------------|
// |   Mostrar información  |
// |------------------------|

function informacion(id) {
    const divPeliInfo = document.getElementById("peliinfo");
    divPeliInfo.style.display = "block";
    const formdata = new FormData();
    formdata.append("id", id);

    const ajax = new XMLHttpRequest();
    ajax.open("POST", "./procesos/info.php");

    ajax.onload = function() {
        if (ajax.status === 200) {
            const json = JSON.parse(ajax.responseText);
            const peliinfo = document.getElementById("peliinfo");
            const errorinfo = document.getElementById("errorinfo");
            let str = "";
            json.forEach(function(contenido) {
                str += " <h1 class='titulo'>" + contenido.titulo + "</h1>";
                str += " <iframe id='video' width='100%' height='50%' src='./trailers/" + contenido.url_video + "' frameborder='0' allowfullscreen autoplay></iframe>";
                str += "<p class='texto'> " + contenido.desc_cont + "</p>";
            });
            peliinfo.innerHTML = str;
        } else {
            errorinfo.innerText = "Error al cargar las películas, estamos trabajando en ello";
        }
    };

    ajax.send(formdata);
}

// |------------------------|
// |   Ocultar información  |
// |------------------------|

document.addEventListener("click", function(event) {
    const divPeliInfo = document.getElementById("peliinfo");
    const video = document.getElementById("video");
    const targetElement = event.target;

    if (targetElement.closest("#peliinfo") || targetElement.closest(".zoom")) {
        // El clic se realizó dentro del div peliinfo o en la imagen que lo muestra, no hacemos nada
        return;
    } else {
        // Si el clic se realizó fuera del div peliinfo, ocultamos el div
        divPeliInfo.style.display = "none";
        // Detener el video si está cargado
    }
});