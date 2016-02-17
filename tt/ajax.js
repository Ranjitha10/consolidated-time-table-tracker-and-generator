function loadTable(form,url){
	var data = $( form).serialize();
	if(!url)
		url=location.href;
	$.post(url,data,
		function(resp,status){
			if(status=='success'){
				var start=resp.indexOf('<x>');
				var end=resp.indexOf('</x>',start);
				if(start==-1 || end == -1){
					alert("Couldnt parse ajax response");
				}
				else{
					$('#response').html(resp.substring(start+'<x>'.length,end));
					if($('#sheet0 img').length)
						$('#sheet0 img').attr('src','assets/img/rvce-logo.jpg');
					if($('.table').length)
						new Tablesort(document.querySelector(".table")); 
				}
			}
		}); 
		

	
}
