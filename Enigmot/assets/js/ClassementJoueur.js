	$(document).ready(function(){ 
		var table = $('#table').DataTable({
			"processing":true,
			"serverSide":true,
			"order":[],
			"ajax": {
				"url": "ClassementJ/ajax_list",
				"type": "POST"
			},
		});
	});