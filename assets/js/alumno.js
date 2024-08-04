// Función para agregar un alumno
const addAlumno = async (request) => {
    try {
        const response = await fetch('/views/add-alumno.php', { // Cambia la ruta según la ubicación del archivo PHP
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(request),
        });

        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Error:', error);
    }
};

// Manejar el envío del formulario
document.getElementById('add-alumno-form').addEventListener('submit', (e) => {
    e.preventDefault();

    // Recopilar datos del formulario
    const alumno = {
        'nombre_persona': document.getElementById('nombre_persona').value,
        'apellidos': document.getElementById('apellidos').value,
        'matricula': document.getElementById('matricula').value,
        'password': document.getElementById('password').value,
        'id_grupo': parseInt(document.getElementById('id_grupo').value, 10),
    };

    // Llamar a la función para agregar el alumno
    addAlumno(alumno).then(json => {
        if (json.status === 'success') {
            alert(json.message);
        } else {
            alert(json.message);
        }
    }).catch(error => console.error('Error:', error));
});
