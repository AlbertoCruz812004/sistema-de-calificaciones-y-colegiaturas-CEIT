const addDocente = async (request) => {
    try {
        const response = await fetch('/views/add-docente.php', { // Asegúrate de ajustar la ruta según tu estructura
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

document.getElementById('add-docente-form').addEventListener('submit', (e) => {
    e.preventDefault();

    const docente = {
        'nombre_persona': document.getElementById('nombre_persona').value,
        'apellidos': document.getElementById('apellidos').value,
        'password': document.getElementById('password').value,
        'email': document.getElementById('email').value,
        'id_curso': parseInt(document.getElementById('id_curso').value, 10),
    };

    addDocente(docente).then(json => {
        alert(json.message);
    }).catch(error => console.error('Error:', error));
});
