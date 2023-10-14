function getUrlParameter(name) {
    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    var results = regex.exec(location.search);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
};

function send_request(user, msg) {
	// Check if user is alive
	update_info(user);
	
	$.ajax({
		'url': './php/request.php', 
		'type': 'POST',
		// 'contentType': 'application/json; charset=utf-8',
		'data': { 'user_id': user.id,
				  'user_quimata': user.quimata,
				  'msg': msg
				},
		dataType:'text',		
		'success': function(data) {
			$.notify('Resposta guardada', 'success');
			console.log(data);
		},
		'error': function(xhr, status, error) { 
			$.notify('Error! Torna-ho a intentar o contacta amb l\'Andreu: +34681236024');
			console.log(error);
			alert(error);
		}
	});
}

function check_requests(info, user) {	
	let dead = false;
	
	if (info.requested) {
		// Check for requests
		if (info.requested) dead = confirm("El teu assassí ha dit que t'ha matat, és veritat?");
		
		// Confirm/deny request
		if (dead) send_request(user, "CONF DEAD"); // confirm death
		else send_request(user, "DENY REQ"); // deny kill/death
	}	

	// Return mort
	return dead || info.mort;
}

function update_info(user) {
	$.ajax({
		url: "./ajax/userinfo.php",
		data: { id: user.id },
		dataType: 'text',
		type: 'POST',
		success: function(response, status, xhr) {
			let info = JSON.parse(response);
			
			// Check if user is dead
			if (!user.mort && !info.mort) user.mort = check_requests(info, user);
			// else window.location.href = "./dead.php";
			
			// Check if there has been a change of victim					
			if (info.quimata != user.quimata) {
				change_victim(info);
				user.quimata = info.quimata;
			}
			
			console.log("Response: " + response);
	}});	
}

function get_user_name(users, userid) {
	for (let user of users) if (user.id == userid) return user.nomcomplet;
	return "";
}
