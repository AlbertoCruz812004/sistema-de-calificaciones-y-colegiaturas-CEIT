const deleteByMatricula = async (request) => {
    try {
        const response = await fetch('/views/calificaciones/delete.php', {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(request)
        });

        const data = await response.json();

        return data;
    } catch (error) {
        console.error("Error => ",error);
    }
};

document.getElementById('btn-delete').addEventListener('click', () => {
    const data = {
        'matricula': window.sessionStorage.getItem('matricula'),
        'modulo': window.sessionStorage.getItem('modulo'),
    };

    deleteByMatricula(data).then(json => {
        alert(json.message);
        document.querySelector('.alumno > p').textContent = '------';
        document.querySelector('.modulo > p').textContent = '------';
        document.querySelector('.calificacion > p').textContent = '------'; 
    }).catch(error => console.error(error));
});