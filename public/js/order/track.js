window.onload = function() {
    $('#track-form').validate({
        rules: {
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            email : "El campo es obligatorio y debe tener formato de email correcto.",
        }
    });
};