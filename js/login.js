$(document).ready(function() {


    $('#register-form').on('submit', function(event) {
        event.preventDefault();

        $('#container').fadeOut('slow', function() {
            $.ajax({
                url: 'login/register.php',
                type: 'POST',
                data: $('#register-form').serialize(),
                success: function(response) {
                    $('body').html(response);
                    reload
                    $('#new-container').addClass('show');
                    
                    setTimeout(function() {
                        $('#loader').fadeOut('slow', function() {
                            $('#new-container').addClass('slide-out');
                            setTimeout(function() {
                                $('#new-container').addClass('hidden'); 
                                location.reload();
                            }, 1500);
                        });
                    }, 3000);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });
    });

    $('#login-form').on('submit', function(event) {
        event.preventDefault();
    
        $('#container').fadeOut('slow', function() {
            $.ajax({
                url: 'login/login.php',
                type: 'POST',
                data: $('#login-form').serialize(),
                dataType: 'json',
                success: function(response) {
                    
                    console.log(response.type);

                    if (response.type === 'error') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                            confirmButtonText: 'Ok'
                        });

                        $('#container').show();
                        $('#password').val('');
                        
                    } else if (response.type === 'html') {
                        $('body').html(response.content);
                        $('#new-container').addClass('show');
    
                        setTimeout(function() {
                            $('#loader').fadeOut('slow', function() {
                                $('#new-container').addClass('slide-out');
                                setTimeout(function() {
                                    $('#new-container').addClass('hidden'); 
                                    location.reload();
                                }, 1500);
                            });
                        }, 3000);
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un problema con la solicitud.',
                        confirmButtonText: 'Ok'
                    });
                }
            });
        });
    });
    

});
