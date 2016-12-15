$(document).ready(function() {

	$(function() {
		$( '.datepicker' ).datepicker({
			changeMonth: true,
			changeYear: true,
			minDate: "-20Y", // datepicker calendar only goes back to 2006 max
			maxDate: +365
		});

		$( '#employeeTable' ).DataTable();
	});

});