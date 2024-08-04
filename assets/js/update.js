const update = async (request) => {
    try {
        const response = await fetch('/views/calificaciones/update.php', {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: request
        });

        const data = await response.json();

        return data;
    } catch (error) {
        console.error(error);
    }
};

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

document.querySelector('form').addEventListener('submit', e => {
    e.preventDefault();

    const data = {
        'matricula': document.getElementById('matricula').value,
        'modulo': document.getElementById('modulo').value,
    };
    
    search(data).then(json => {
        document.querySelector('.alumno > p').textContent = json['nombre'];
        document.querySelector('.modulo > p').textContent = json['modulo'];
        document.querySelector('.calificacion > input').value = json['calificacion']; 

        const result = {
            "nombre": json.nombre,
            "modulo": json.modulo,
            "calificacion": json.calificacion,
        };

        window.sessionStorage.setItem('result', JSON.stringify(result));
    }).catch(error => console.error(error));
});

document.getElementById('btn-update').addEventListener('click', () => {
    update(window.sessionStorage.getItem('result')).then(json => {
        alert(json.message);
    }).catch(error => console.error(error));
});