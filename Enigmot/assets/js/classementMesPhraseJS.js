$(document).ready(function(){
	console.log("MesPhrase");
	var table = $('#table').DataTable({
		"processing":true,
		"serverSide":true,
		"language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/French.json"
        },
		"ajax": {
			"url": "ClassementPhrase/ajax_list/MesPhrase",
			"type": "POST"
		},
	});
});