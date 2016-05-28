$(document).ready(function () {

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

    // $('html').on('click', '.btn-modal-rad', function (event) {
    //     event.preventDefault();
    //     var target = $(this).attr("href");
    //
    //     // load the url and show modal on success
    //     $("#basicModal .modal-content").load(target, function() {
    //       $('#basicModal').modal('show');
    //     });
    // });

    $('html').on('click', '.btn-modal', function (event) {
        event.preventDefault();
        var target = $(this).attr("href");

        $('#basicModal').find('.modal-content').html('');
        $('#basicModal').modal('show');
        $('#basicModal').find('.modal-content').load($(this).attr('href'));
    });

    // $("#basicModal").on('hidden.bs.modal', function () {
    $('body').on('hidden.bs.modal', '#basicModal', function (e) {
      // $(this).data('bs.modal', null);
      // $(".modal-body").html("");
      //  $(this).removeData('bs.modal');
      $("#previewVideo").attr("src","");
    });

    $('html').on('submit', '.submit-ajax', function (event) {
        event.preventDefault();
        $.ajax({
            url: $(this).closest('form').attr('action'),
            type: 'POST',
            dataType: 'json',
            data: $(this).serialize(),
            success: function (data) {
              sweetAlert("Yay!", data.message, "success");
              setTimeout(function () {
                if (data.redirect) {
                  window.location = data.redirect;
                } else {
                  location.reload();
                }
              }, 2000);
            },
            // error: function(data){
            //   console.log(data);
            // }
            error: function(xhr, status, error) {
              console.log(xhr.responseText);
              var err = jQuery.parseJSON(xhr.responseText);
              var errStr = '';
              $.each(err, function(key, value) {
                errStr = errStr + value + "\n";
              });
              sweetAlert("Oops...", errStr, "error");
            }
        });
    });

    $('html').on('submit', '.submit-ajax-get', function (event) {
        event.preventDefault();
        $.ajax({
            url: $(this).closest('form').attr('action'),
            type: 'GET',
            dataType: 'json',
            data: $(this).serialize(),
            success: function (data) {
              if(data.message) {
                sweetAlert("Yay!", data.message, "success");
              }
              setTimeout(function () {
                if (data.redirect) {
                  window.location = data.redirect;
                } else {
                  location.reload();
                }
              }, 2000);
            },
            // error: function(data){
            //   console.log(data);
            // }
            error: function(xhr, status, error) {
              console.log(xhr.responseText);
              var err = jQuery.parseJSON(xhr.responseText);
              var errStr = '';
              $.each(err, function(key, value) {
                errStr = errStr + value + "\n";
              });
              sweetAlert("Oops...", errStr, "error");
            }
        });
    });

});
