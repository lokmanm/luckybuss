$('#Contact').on("click", '#feedback', function() {
	var url = 'api/send.php';
	var error = 0;
	var $contactpage = $(this).closest('.ui-page');
	var $contactform = $(this).closest('.contact-form');
	$('.required', $contactform).each(function (i) {
        if ($(this).val() === '') {
			error++;
        } 
	}); // each
	if (error > 0) {
			alert('Plot�soni t� gjitha informatat e duhura.');	
	} else {
		var email = $contactform.find('input[name="email"]').val();	
		var message = $contactform.find('textarea[name="message"]').val();	
		//submit the form
		$.ajax({
			type: "GET",
			url: url,
			data: {email: email, message: message},
            success: function (data) {
				if (data == 'success') {
					// show thank you 
					$contactpage.find('.contact-thankyou').show();
					$contactpage.find('.contact-form').hide();
				}  else {
					alert('Provoni p�rs�ri. Mesazhi nuk u d�rgua');
				}
			}
		}); //$.ajax
	}
	return false;
});