window.onload = function() {
    $('#track-form').validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            order: {
                required: true,
                digits: true                       
            }
        },
        messages: {
            email : "El campo es obligatorio y debe tener formato de email correcto.",
            order : "El campo es obligatorio.",
        }
    });
};