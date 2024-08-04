document.getElementById('pay-form').addEventListener('submit', e => {
    e.preventDefault();

    const data = {
        'matricula': document.getElementById('matricula').value,
        'semana': document.getElementById('semana').value,
    };
    search(data).then(json => {
        if (json.status == 'success') {
            document.querySelector('.info-alumno > .matricula > input').value = json['matricula'];
            document.querySelector('.info-alumno > .nombre > p').textContent = json['nombre'];
            document.querySelector('.info-alumno > .pago > input').value = json['pago'];
            document.querySelector('.info-alumno > .cambio > input').value = json['cambio'];
            document.querySelector('.info-alumno > .semana > input').value = json['semana'];
            document.querySelector('.info-alumno > .fecha > input').value = json['fecha'];
        } else {
            alert(json.message);
        }
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

const update = async (request) => {
    try {
        const response = await fetch('/views/colegiaturas/update.php', {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(request)
        });

        const data = await response.json();

        return data;
    } catch (error) {
        console.error(error);
    }
};


document.getElementById('btn-update').addEventListener('click', () => {
    const matricula = document.querySelector('.info-alumno > .matricula > input');
    const pago = document.querySelector('.info-alumno > .pago > input');
    const cambio = document.querySelector('.info-alumno > .cambio > input');
    const semana = document.querySelector('.info-alumno > .semana > input');
    const fecha = document.querySelector('.info-alumno > .fecha > input');

    const result = {
        "matricula": matricula.value,
        "pago": pago.value,
        "cambio": cambio.value,
        "semana": semana.value,
        "fecha": fecha.value,
    }

    console.info(result);

    update(result).then(json => {
        alert(json.message);
    }).catch(error => console.error(error));
});