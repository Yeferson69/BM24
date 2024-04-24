var candidataGuardada = localStorage.getItem('candidataSeleccionada');
        if (candidataGuardada) {
            var candidata = JSON.parse(candidataGuardada);
            document.getElementById('fotoCandidata').src = candidata.foto;
            document.getElementById('nombreCandidata').textContent = candidata.nombre;
            document.getElementById('descripcionCandidata').textContent = candidata.descripcion;
            document.getElementById('nameSel').textContent = candidata.nombre;
            document.getElementById('desSel').textContent = candidata.descripcion;
            document.getElementById('Categoria').textContent = candidata.categoria;
        } else {
            print('No hay ninguna Candidata Seleccionada')
        }


