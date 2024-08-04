document.getElementById('search-pay').addEventListener('submit', e => {
    e.preventDefault();

    const data = {
        'matricula': document.getElementById('matricula').value,
        'semana': document.getElementById('semana').value,
    };

    search(data).then(json => {
        if (json.status == 'success') {
            const table = document.getElementById('table-row').innerHTML =
            `
            <tr>
                <td>${json['matricula']}</td>
                <td>${json['nombre']}</td>
                <td>${json['pago']}</td>
                <td>${json['cambio']}</td>
                <td>${json['semana']}</td>
                <td>${json['fecha']}</td>
            </tr>
            `;
        } else {
            alert(json.message);
        }
    }).catch(error => console.error(error));
});

const search = async (request) => {
    try {
        const response = await fetch('/views/colegiaturas/search-only.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(request)
        });

        const info = await response.json();
        console.info(info);
        return info;
    } catch (error) {
        console.info('Error: ', error);
    }
};