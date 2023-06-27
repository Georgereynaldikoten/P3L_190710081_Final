$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();
	
	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;                        
			});
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			});
		} 
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});
});
$('.edit-court-button').on('click', function () {
    $('#edit-court-form').attr('action', $(this).data('edit-link'));
});

$('.delete-court-button').on('click', function () {
    $('#delete-court-form').attr('action', $(this).data('delete-link'));
});