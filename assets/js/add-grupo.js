// Función para enviar datos del grupo al servidor
const addGrupo = async (request) => {
    try {
        const response = await fetch('/views/add-grupo.php', { // Asegúrate de ajustar la ruta según tu estructura
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

// Manejo del evento de envío del formulario
document.getElementById('add-grupo-form').addEventListener('submit', (e) => {
    e.preventDefault();

    const grupo = {
        'horario_inicio': document.getElementById('horario_inicio').value,
        'horario_fin': document.getElementById('horario_fin').value,
        'id_curso': parseInt(document.getElementById('id_curso').value, 10),
        'matricula_grupo': document.getElementById('matricula_grupo').value,
        'email_docente': document.getElementById('email_docente').value,
    };

    addGrupo(grupo).then(json => {
        alert(json.message);
    }).catch(error => console.error('Error:', error));
});
