var tickets = {};
setInterval(function() {
	fetch('/tickets')
		.then(function(response) {
			return response.json();
		})
		.then(function(json) {
			if (tickets !== json) {
				tickets = json;
				console.log(tickets);
				let ticketsEl = document.querySelector('#tickets');
				ticketsEl.innerHTML = '';
				if (tickets.length > 0) {
					for (let i = 0; i < tickets.length; i++) {
						let ticket = tickets[i];
						let card = document.createElement('div');
						card.className = 'card';
						if (i !== tickets.length - 1) {
							card.className += ' mb-3';
						}
						let header = document.createElement('div');
						header.className = 'card-header d-flex justify-content-between text-primary';
						let created_at = document.createElement('div');
						created_at.className = 'text-secondary';
						created_at.textContent = ticket.created_at;
						header.append(created_at);
						card.append(header);
						let body = document.createElement('div');
						body.className = 'card-body';
						let list = document.createElement('ul');
						let name = document.createElement('li');
						name.textContent = 'Имя: ' + ticket.full_name;
						list.append(name);
						let email = document.createElement('li');
						email.textContent = 'Email: ' + ticket.email;
						list.append(email);
						let phone = document.createElement('li');
						phone.textContent = 'Номер: ' + ticket.phone_num;
						list.append(phone);
						let category = document.createElement('li');
						category.textContent = 'Категория: ' + ticket.category.name;
						list.append(category);
						let status = document.createElement('li');
						switch(ticket.status.id) {
							case 1:
								status.className = 'text-primary';
								break;
							case 2:
								status.className = 'text-info';
								break;
							case 3:
								status.className = 'text-danger';
								break;
							case 4:
								status.className = 'text-success';
								break;
							case 5:
								status.className = 'text-muted';
								break;
						}
						status.textContent = 'Статус: ' + ticket.status.name;
						list.append(status);
						if (ticket.admin_id !== null) {
							let admin = document.createElement('li');
							admin.textContent = 'Админ: ' + ticket.admin.name;
							list.append(admin);
						}
						body.append(list);
						let p = document.createElement('p');
						p.textContent = 'Описание';
						body.append(p);
						let description = document.createElement('p');
						description.textContent = ticket.description;
						body.append(description);
						let a = document.createElement('a');
						a.className = 'btn btn-primary';
						a.href = '/ticket/' + ticket.hash;
						a.textContent = 'Посмотреть';
						body.append(a);
						card.append(body);
						ticketsEl.append(card);
					}
				} else {
					let empty = document.createElement('div');
					empty.textContent = 'Пусто :(';
					ticketsEl.append(empty);
				}
			}
		});
}, 5000);