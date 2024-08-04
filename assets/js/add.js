const addCalificacion = async (request) =>{
    try {
        const response = await fetch('/views/calificaciones/add.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(request)
        });

        const data = await response.json();
        return data;
    } catch (error) {
        console.error(error);
    }
};

document.getElementById('add-form').addEventListener('submit', (e) => {
    e.preventDefault();

    const calificacion = {
        'matricula': document.getElementById('matricula').value,
        'modulo': document.getElementById('modulo').value,
        'calificacion': document.getElementById('calificacion').value,
    };

    addCalificacion(calificacion).then(json => {
        alert(json.message);
    }).catch(error => console.error(error));
});