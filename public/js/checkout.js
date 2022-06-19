$(document).ready(function () {
    $('#checkout-form').validate({
        rules: {
            name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            mobile: {
                required: true,
                digits: true,
                minlength: 10                        
            }
        },
        messages: {
            name: "El campo es obligatorio.",
            email : "El campo es obligatorio y debe tener formato de email correcto.",
            mobile : "El campo Celular no contiene un formato correcto.",
        }
    });
});