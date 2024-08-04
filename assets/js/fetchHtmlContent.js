export const fetchHtmlContent = async (url) => {
	try{
		const response = await fetch(url, () => {
			method: 'GET',
			headers: {
				'Content-Type': 'text/html'
			}
		});

		if(!response.ok) throw new Error('Network response was not ok');

		const data = await response.text();
		console.info(data);

		return data;
	} catch(error){
		console.error('Error: ', error);
	}
}