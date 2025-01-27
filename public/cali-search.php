<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/generic.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <title>Document</title>
</head>

<body>
    <header>
        <div id="content">
            <img src="../assets/images/CEIT.png">
            <p>CEIT</p>
        </div>
        <nav>
            <p id="name-user"></p>
            <a href="">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" viewBox="0 0 512 512">
                    <path fill="#ffffff" d="M399 384.2C376.9 345.8 335.4 320 288 320l-64 0c-47.4 0-88.9 25.8-111 64.2c35.2 39.2 86.2 63.8 143 63.8s107.8-24.7 143-63.8zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm256 16a72 72 0 1 0 0-144 72 72 0 1 0 0 144z" />
                </svg>
            </a>
            <a href="">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" viewBox="0 0 512 512">
                    <path fill="#ffffff" d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z" />
                </svg>
            </a>
        </nav>
    </header>
    <main>
        <section class="panel">
            <button onclick="window.location.href='calificaciones.php'" id="back-btn">
                <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 512 512">
                    <path fill="#223f84" d="M177.5 414c-8.8 3.8-19 2-26-4.6l-144-136C2.7 268.9 0 262.6 0 256s2.7-12.9 7.5-17.4l144-136c7-6.6 17.2-8.4 26-4.6s14.5 12.5 14.5 22l0 72 288 0c17.7 0 32 14.3 32 32l0 64c0 17.7-14.3 32-32 32l-288 0 0 72c0 9.6-5.7 18.2-14.5 22z" />
                </svg>
                regresar
            </button>
            <figure>
                <h1>Calificaciones</h1>
                <img src="../assets/svg/Approval 4 (1).svg" alt="">
            </figure>
        </section>
        <form id="form" action="">
            <input type="text" placeholder="matricula" name="matricula">
            <input type="text" placeholder="modulo" name="modulo">
            <input type="submit" value="buscar">
        </form>
        <table>
            <thead>
                <tr>
                    <th>Alumno</th>
                    <th>Curso</th>
                    <th>Nota 1</th>
                    <th>Nota 2</th>
                    <th>Nota 3</th>
                    <th>Promedio</th>
                </tr>
            </thead>
        </table>
    </main>
</body>
<script>
    const nameUser = document.getElementById('name-user');
    nameUser.textContent = window.sessionStorage.getItem('name');
</script>
<script>
    const form = document.getElementById('form');
    form.preventDefault();
    document.querySelector('table').addEventListener('click', e => {


        const data = {
            matricula: document.querySelector('input[name="matricula]').value,
            modulo: document.querySelector('input[name="modulo]').value,
        };

        // Enviar solicitud POST
        fetch('/views/calificaciones/search-only.php', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json()) // Parsear la respuesta JSON
            .then(data => {
                // Manejar la respuesta JSON
                console.log(data);
                alert(`Nombre: ${data.nombre}, Modulo: ${data.modulo}, Calificacion: ${data.calificacion}`);
            })
            .catch(error => console.error('Error:', error));
    });
</script>

</html>