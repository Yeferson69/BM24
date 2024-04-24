var nombreCandidata = document.getElementById("nombreCandidata");
var fotoCandidata = document.getElementById("fotoCandidata");
var descripcionCandidata = document.getElementById("descripcionCandidata");
var Categoria = document.getElementById("categoria")
function mostrarModal(nombre, foto, descripcion, categoria) {
    var modal = document.getElementById("modal");

    nombreCandidata.textContent = nombre;
    fotoCandidata.src = foto;
    descripcionCandidata.textContent = descripcion;
    Categoria.textContent = categoria
    

    modal.style.display = "block";
    
        
}

function cerrarModal() {
    var modal = document.getElementById("modal");
    modal.style.display = "none";
}

// Cierra el modal si el usuario hace clic fuera de él
window.onclick = function(event) {
    var modal = document.getElementById("modal");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

function guardarCandidata(){
        var candidata = {
            nombre: nombreCandidata.textContent,
            foto: fotoCandidata.src,
            descripcion: descripcionCandidata.textContent,
            categoria: Categoria.textContent,
        };
        localStorage.setItem('candidataSeleccionada', JSON.stringify(candidata));
        window.location.href = 'pago.php';
    }