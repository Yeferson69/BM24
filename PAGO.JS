var candidataGuardada = localStorage.getItem('candidataSeleccionada');
        if (candidataGuardada) {
            var candidata = JSON.parse(candidataGuardada);
            document.getElementById('fotoCandidata').src = candidata.foto;
            document.getElementById('nombreCandidata').textContent = candidata.nombre;
            document.getElementById('descripcionCandidata').textContent = candidata.descripcion;
            document.getElementById('nameSel').value = candidata.nombre;
            document.getElementById('desSel').value = candidata.descripcion;
            document.getElementById('Categoria').value = candidata.categoria;
        } else {
            print('No hay ninguna Candidata Seleccionada')
        }

        function logFormData() {
            var nameSeleccionada = document.getElementById('nameSel').value;
            var descripcionSeleccionada = document.getElementById('desSel').value;
            var categoria = document.getElementById('Categoria').value;
            var userName = document.getElementById('name').value;
            var userEmail = document.getElementById('correo').value;
            var userPhone = document.getElementById('celular').value;
    
            console.log("Datos del formulario:");
            console.log("nameSeleccionada:", nameSeleccionada);
            console.log("descripcionSeleccionada:", descripcionSeleccionada);
            console.log("categoria:", categoria);
            console.log("user_name:", userName);
            console.log("user_correo:", userEmail);
            console.log("user_phone:", userPhone);
        }
