const btn1 = async () => {
	const response = await fetch("/includes/option-action-calificaciones.php", {
		method: "GET",
		headers: {
			"Content-Type": "text/html"
		}
	});

	const data = await response.text();

	document.getElementById("panel").innerHTML = data;
}

document.getElementById("btn-1").addEventListener("click", () => btn1());

const btn2 = async () => {
	const response = await fetch("/includes/option-action-pagos.php", {
		method: "GET",
		headers: {
			"Content-Type": "text/html"
		}
	});

	const data = await response.text();

	document.getElementById("panel").innerHTML = data;
}

document.getElementById("btn-2").addEventListener("click", () => btn2());

const btn_menu = async () => {
	const response = await fetch("/includes/option-card.php", {
		method: "GET",
		headers: {
			"Content-Type": "text/html"
		}
	});

	const data = await response.text();
	console.log(data);

	document.getElementById("panel").innerHTML = data;
}