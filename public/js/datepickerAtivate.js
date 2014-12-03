if (datefield.type!="date"){
	jQuery(function($){ 
		$.datepicker.formatDate('dd/mm/yyyy');
		$('#birth_date').datepicker();
	})
}