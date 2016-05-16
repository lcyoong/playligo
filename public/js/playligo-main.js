$(document).ready(function () {

  $('.datepicker').datepicker({
  	dateFormat: 'dd-mm-yy',
  });

	// Clear filter form
    $('form').on('click', '.btn-clear', function (event) {
        event.preventDefault();
        $.ajax({
            url: $(this).closest('form').attr('action'),
            type: 'POST',
            dataType: 'json',
            data: {reset_form: 1, _token: $("input[name='_token']").val()},
            success: function (data) {
                setTimeout(function () { location.reload();}, 1000);
            }
        });
    });

    $('form').on('click', '.cancel-button', function(event) {
    	event.preventDefault();
    	var goto = $(this).attr('goto');
    	window.location = goto;
    });

    $('html').on('click', '.btn-modal', function (event) {
        event.preventDefault();
        var target = $(this).attr("href");

        $('#basicModal').find('.modal-content').html('');
        $('#basicModal').modal('show');
        $('#basicModal').find('.modal-content').load($(this).attr('href'));
    });

    // $("#basicModal").on('hidden.bs.modal', function () {
    $('body').on('hidden.bs.modal', '#basicModal', function () {
      // $(this).data('bs.modal', null);
      // $(".modal-body").html("");
      //  $(this).removeData('bs.modal');
      // $("#previewVideo").attr("src","");
    });

    $('html').on('submit', '.submit-ajax', function (event) {
        event.preventDefault();
        $.ajax({
            url: $(this).closest('form').attr('action'),
            type: 'POST',
            dataType: 'json',
            data: {_token: $("input[name='_token']").val()},
            success: function (data) {
                $('#basicModal').find('.modal-content').html('');
                $('#basicModal').modal('show');
                $('#basicModal').find('.modal-content').load($(this).attr('href'));
            }
        });
    });

});
