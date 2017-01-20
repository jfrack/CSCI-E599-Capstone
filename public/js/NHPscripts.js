$(document).ready(function() {

	$(function() {
		$( '.datepicker' ).datepicker({
			changeMonth: true,
			changeYear: true,
			yearRange: "-100:+1",
			maxDate: +365
		});

		// Add column sorting on tables
		$( '#employeeTable' ).DataTable();
		$( '#employeeChecklistsTable' ).DataTable();
		$( '#employeeChecklistsManagerTable' ).DataTable();
		$( '#employeeFormsTable' ).DataTable();
		$( '#employeeFormsManagerTable' ).DataTable();
	});

});