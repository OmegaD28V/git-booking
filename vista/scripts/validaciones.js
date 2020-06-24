// Validar Imagen de Restaurante.
$("#imageRes").change(function () {
    $(".aviso").remove();
    var imagen = this.files[0];
    console.log("Imagen", imagen);
    // Validar formato de imagen.
    if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
        $("#imageRes").val("");
        $("#imageRes").parent().after('<div class="alert alert-danger"><span>Solo admite formato JPG o PNG</span></div>');
        return;
    }else if(imagen["size"] > 2000000){
    // Validar tamaño de almacenamiento de imagen.
        $("#imageRes").val("");
        $("#imageRes").parent().after('<div class="alert alert-danger"><span>Superó el peso soportado (2MB)</span></div>');
        return;
        
    }else{
        var datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);
        $(datosImagen).on("load", function(event){
            var rutaImagen = event.target.result;
            $(".prevImagen").attr("src", rutaImagen);
        })
    }
})

$('#email').change(function() {
    var email = $(this).val();
    var datos = new FormData();
    datos.append("validEmail", email);

    $.ajax({
        url: "ajax/ajax.php", 
        method: "post", 
        data: datos, 
        cache: false, 
        contentType: false, 
        processData: false, 
        dataType: "json", 
        success: function(respuesta){
            if (respuesta) {
                $("#email").val("");
                (async () => {
                    const {value: pais} = await Swal.fire({
                        showConfirmButton: false,  
                        icon: 'info', 
                        html: '<b style="font-size: 1.1rem">Ya existe un usuario con ese correo</b>', 
                        backdrop: false, 
                        toast: true, 
                        position: 'top-left', 
                        showCloseButton: true,
                        width: 300, 
                        padding: '0.5rem',
                        background: '#fdfdfd',
                        timer: 5000, 
                        timerProgressBar: true
                    });
                })()
            }
        }
    });
})

$('#area').change(function() {
    var area = $('#area').val();
    var datos = new FormData();
    datos.append("area", area);

    $.ajax({
        url: "ajax/ajax.php", 
        method: "post", 
        data: datos, 
        cache: false, 
        contentType: false, 
        processData: false,
        success: function(respuesta){
            if (respuesta) {
                $('#mesa').html(respuesta);
            }
        }
    });
})

$('#date').change(function() {
    $('.alert').remove();
    var time = $('#time').val();
    var date = $('#date').val();
    var abierto = $('#abierto').val();
    var cerrado = $('#cerrado').val();
    var input = new Date(date);
    var fechaInput = new Date(input.getFullYear(), input.getMonth(), input.getDate() + 1, input.getHours(), input.getMinutes(), input.getSeconds(), input.getMilliseconds());
    var fechaActual = new Date();
    var fechaLimite = new Date(fechaActual.getFullYear(), fechaActual.getMonth() + 6, fechaActual.getDate(), fechaActual.getHours(), fechaActual.getMinutes(), fechaActual.getSeconds(), fechaActual.getMilliseconds());
    var hAbierto = new Date(date+" "+abierto);
    var hCerrado = new Date(date+" "+cerrado);
    // $('#datetime').val(date+" "+time+":00");
    // console.log('Abierto:', hAbierto);
    // console.log('Cerrado:', hCerrado);
    // console.log('Input Límite:', fechaLimite);
    // console.log('Dias:', dias);
    if (
        fechaInput >= fechaActual && 
        fechaInput < fechaLimite
        ) {
            $('#div-time').html('<input style="display: inline-block; max-width: 200px;" type="time" class="form-control" name="time" id="time" required>');
            $('#time').change(function() {
                $('.alert').remove();
                var time = $('#time').val();
                var date = $('#date').val();
                $('#datetime').val(date+" "+time+":00");
                var rel = date+" "+time+":00:00"
                var fechaInput = new Date(rel);
                var fechaActual = new Date();
                if (fechaInput.getFullYear() == fechaActual.getFullYear() && 
                    fechaInput.getMonth() == fechaActual.getMonth() && 
                    fechaInput.getDate() == fechaActual.getDate() && 
                    (fechaInput.getHours() <= (fechaActual.getHours() + 1) || 
                    fechaInput.getHours() <= hAbierto.getHours() || 
                    fechaInput.getHours() >= hCerrado.getHours())) {
                    $('#time').val('');
                    $('#time').parent().parent().parent().after('<div class="alert alert-danger"><span>Hora inválida</span></div>');
                    $('#time').parent().parent().parent().after('<div class="alert alert-info"><span>Reservaciones dos horas después y seis meses después de la fecha actual</span></div>');
                    $('#time').focus();
                }else{
                }
            })
    }else{
        $('#date').val('');
        $('#time').remove();
        $('#date').parent().parent().after('<div class="alert alert-danger"><span>Fecha inválida</span></div>');
        $('#date').parent().parent().after('<div class="alert alert-info"><span>Reservaciones dos horas después y seis meses después de la fecha actual</span></div>');
        $('#date').focus();
    }
})

$('#password').change(function() {
    $('.alert').remove();
    $('#password').removeClass('border border-danger');
    $('#password').removeClass('border border-success');
    $('#repassword').removeClass('border border-danger');
    $('#repassword').removeClass('border border-success');
    var rePassword = $('#repassword').val();
    var password = $('#password').val();

    if (rePassword == '') {
        
    }else{
        if (rePassword != password) {
            $('#repassword').parent().after('<div class="alert alert-danger"><span>Las contraseñas no coinciden</span></div>');
            $('#password').focus();
            $('#password').addClass('border border-danger');
            $('#repassword').addClass('border border-danger');
        }else{
            $('#password').addClass('border border-success');
            $('#repassword').addClass('border border-success');
        }
    }
    
})

$('#repassword').change(function() {
    $('.alert').remove();
    $('#password').removeClass('border border-danger');
    $('#password').removeClass('border border-success');
    $('#repassword').removeClass('border border-danger');
    $('#repassword').removeClass('border border-success');
    var rePassword = $('#repassword').val();
    var password = $('#password').val();

    if (rePassword != password) {
        $('#repassword').parent().after('<div class="alert alert-danger"><span>Las contraseñas no coinciden</span></div>');
        $('#repassword').focus();
        $('#password').addClass('border border-danger');
        $('#repassword').addClass('border border-danger');
    }else{
        $('#password').addClass('border border-success');
        $('#repassword').addClass('border border-success');
    }
})

$(document).ready(function(){
    actualizarReservaciones();
    function actualizarReservaciones() {
        var fechaActual = new Date();
        var fechaRes;
        var usuario = $('#cli-nav').val();
        var datos = new FormData();
        datos.append("usuario", usuario);
        
        $.ajax({
            url: "ajax/ajax.php", 
            method: "post", 
            data: datos, 
            cache: false, 
            contentType: false, 
            processData: false, 
            dataType: "json", 
            success: function(respuesta){
                if (respuesta) {
                    $.each(respuesta, function(index, value){
                        fechaRes = new Date(respuesta[index].fecha_hora);
                        if (fechaRes <= fechaActual && respuesta[index].status == 1) {
                            console.log('Expirado');
                            var book = respuesta[index].idbook;
                            var formFecha = new FormData();
                            formFecha.append("book", book);

                            $.ajax({
                                url: "ajax/ajax.php", 
                                method: "post", 
                                data: formFecha, 
                                cache: false, 
                                contentType: false, 
                                processData: false, 
                                success: function(r){
                                    if (r) {
                                        console.log('Actualizado');
                                        console.log(r);
                                    }
                                }
                            });
                        }else if(fechaRes <= fechaActual && respuesta[index].status == 2){
                            // console.log('Expirado');
                        }else{
                            // console.log('Próximo');
                            
                        }
                    });
                }else{
                    console.log('No hay respuesta');   
                };
                
            }
        });
    }
    setInterval(function() {
        actualizarReservaciones();
    }, 10000);
})