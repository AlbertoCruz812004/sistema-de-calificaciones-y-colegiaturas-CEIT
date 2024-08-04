const deleteByMatricula = async (request) => {
    try {
        const response = await fetch('/views/colegiaturas/delete.php', {
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
        'matricula': window.sessionStorage.getItem('matricula-s'),
        'semana': window.sessionStorage.getItem('semana'),
    };

    console.info(data);

    deleteByMatricula(data).then(json => {
        alert(json.message);
        document.querySelector('.info-alumno > .matricula > p').textContent = '------';
        document.querySelector('.info-alumno > .nombre > p').textContent = '------';
        document.querySelector('.info-alumno > .pago > p').textContent = '------';
        document.querySelector('.info-alumno > .cambio > p').textContent = '------';
        document.querySelector('.info-alumno > .semana > p').textContent = '------';
        document.querySelector('.info-alumno > .fecha > p').textContent = '------';
    }).catch(error => console.error(error));
});

document.getElementById('pay-form').addEventListener('submit', e => {
    e.preventDefault();

    const data = {
        'matricula': document.getElementById('matricula').value,
        'semana': document.getElementById('semana').value,
    };

    search(data).then(json => {
        document.querySelector('.info-alumno > .matricula > p').textContent = json['matricula'];
        document.querySelector('.info-alumno > .nombre > p').textContent = json['nombre'];
        document.querySelector('.info-alumno > .pago > p').textContent = json['pago'];
        document.querySelector('.info-alumno > .cambio > p').textContent = json['cambio'];
        document.querySelector('.info-alumno > .semana > p').textContent = json['semana'];
        document.querySelector('.info-alumno > .fecha > p').textContent = json['fecha'];
    }).catch(error => console.error(error));

    window.sessionStorage.setItem('matricula-s', data.matricula);
    window.sessionStorage.setItem('semana', data.semana);
});

const search = async (request) => {
    try {
        const response = await fetch('/views/colegiaturas/search-only.php', {
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