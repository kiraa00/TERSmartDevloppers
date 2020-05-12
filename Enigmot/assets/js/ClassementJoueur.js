$(document).ready(function(){ 
	var table = $('#table').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/French.json"
        },
		"ajax": {
			"url": "ClassementJ/ajax_list",
			"type": "POST"
		},
	});
});