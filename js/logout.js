
 function logout() {
    $.ajax({
        url: 'login/logout.php',
        type: 'POST',
        success: function(response) {
            $('.main-grid').remove();
            $('body').html(response);
            location.reload();
            let container = document.getElementById('container')
            toggle = () => {
            	container.classList.toggle('sign-in')
            	container.classList.toggle('sign-up')
            }
            setTimeout(() => {
            	container.classList.add('sign-in')
            }, 200)
        },
        error: function(xhr, status, error) {
            console.error('Error al cerrar sesión:', error);
        }
    });
}
