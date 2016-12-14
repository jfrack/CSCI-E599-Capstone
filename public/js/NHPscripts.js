$(document).ready(function() {

	$(function() {
		$( '.datepicker' ).datepicker({
			changeMonth: true,
			changeYear: true
		});

		$( '#employeeTable' ).DataTable();
	});

});