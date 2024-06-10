$(document).ready(function() {
    $('#cod_persona').on('input', function() {
        var cod_persona = $(this).val();

        if (cod_persona.length >= 8) { // Asumimos que el cod_persona tiene al menos 8 caracteres
            $.ajax({
                type: 'GET',
                url: 'get_persona.php',
                data: { cod_persona: cod_persona },
                dataType: 'json',
                success: function(data) {
                    if (data.success) {
                        $('#nombres').val(data.nombres);
                        $('#apellidos').val(data.apellidos);
                    } else {
                        $('#nombres').val('');
                        $('#apellidos').val('');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                }
            });
        } else {
            $('#nombres').val('');
            $('#apellidos').val('');
        }
    });
});