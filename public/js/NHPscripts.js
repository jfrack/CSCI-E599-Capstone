$(document).ready(function() {

	$(function() {
		$( '.datepicker' ).datepicker({
			changeMonth: true,
			changeYear: true,
			yearRange: "-100:+1",
			maxDate: +365
		});

		$( '#employeeTable' ).DataTable();
	});

});