document.querySelector('form').addEventListener('submit', e => {
    e.preventDefault();

    const data = {
        'matricula': document.getElementById('matricula').value,
        'modulo': document.getElementById('modulo').value,
    };
    
    search(data).then(json => {
        document.querySelector('.alumno > p').textContent = json['nombre'];
        document.querySelector('.modulo > p').textContent = json['modulo'];
        document.querySelector('.calificacion > p').textContent = json['calificacion']; 
    }).catch(error => console.error(error));

    window.sessionStorage.setItem('matricula', data.matricula);
    window.sessionStorage.setItem('modulo', data.modulo);
});

const search = async (request) => {
    try {
        const response = await fetch('/views/calificaciones/search-only.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify(request)
        });

        const info = await response.json();

        return info;
    } catch (error) {
        console.info('Error: ', error);
    }
};