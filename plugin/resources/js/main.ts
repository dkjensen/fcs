import type { Root, Data } from './main.d';

(function () {
	const codingChallenge = (function () {
		let _el: HTMLElement = null;

		const init = (el) => {
			_el = el;

			const formData = new FormData();
			formData.append('action', 'get_challenge');

			const requestOptions: RequestInit = {
				method: 'POST',
				body: formData,
				redirect: 'follow',
			};

			fetch(global.fcs.ajaxurl, requestOptions)
				.then((response) => response.text())
				.then((result) => formatTable(result))
				.catch((error) => (_el.innerHTML = error));
		};

		const formatTable = (result) => {
			result = JSON.parse(result);

			if ( ! result.success ) {
				el.innerHTML = result.data;

				return;
			}

			const root: Root = result.data;
			const data: Data = root.data;

			const table = document.createElement('table');

			const title = document.createElement('caption');
			title.innerText = root.title;

			// Header
			const thead = document.createElement('thead');
			const theadRow = document.createElement('tr');

			data.headers.forEach((header) => {
				const th = document.createElement('th');
				th.innerText = header;

				theadRow.appendChild( th );
			} );

			thead.appendChild(theadRow);

			// Body
			const tbody = document.createElement('tbody');

			data.rows.forEach((row) => {
				const tr = document.createElement('tr');

				const tdId = document.createElement('td');
				tdId.innerText = row.id.toString();

				const tdFname = document.createElement('td');
				tdFname.innerText = row.fname;

				const tdLname = document.createElement('td');
				tdLname.innerText = row.lname;

				const tdEmail = document.createElement('td');
				tdEmail.innerText = row.email;

				const date = new Date(row.date * 1000);

				const tdDate = document.createElement('td');
				tdDate.innerText = date.toDateString();

				tr.appendChild(tdId);
				tr.appendChild(tdFname);
				tr.appendChild(tdLname);
				tr.appendChild(tdEmail);
				tr.appendChild(tdDate);

				tbody.appendChild( tr );
			});

			table.appendChild(title);
			table.appendChild(thead);
			table.appendChild(tbody);

			_el.replaceChildren( table );
		};

		return {
			init,
		};
	})();

	const el = document.querySelector('.challenge-table');

	if (el) {
		codingChallenge.init(el);
	}
})();
