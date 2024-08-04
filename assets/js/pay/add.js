const addCalificacion = async (request) => {
    try {
        const response = await fetch('/views/colegiaturas/add.php', {
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

    const matricula = document.getElementById('matricula').value;
    const pago = document.getElementById('pago').value;
    const cambio = document.getElementById('cambio').textContent;
    const semana = document.getElementById('semana').value;
    const fecha = document.getElementById('fecha').value;

    const formData = {
        'matricula': matricula,
        'pago': parseFloat(pago), 
        'cambio': parseFloat(cambio),
        'semana': parseInt(semana, 10),
        'fecha': fecha
    };

    addCalificacion(formData).then(json => {
        alert(json.message);
    }).catch(error => console.error(error));
});