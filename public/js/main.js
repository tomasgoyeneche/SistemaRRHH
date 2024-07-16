/* VALIDACION FECHA LOCAL JAVASCRIPT*/





document.addEventListener("DOMContentLoaded", function() {
    var successMessage = document.querySelector('.alerta-reqsuc');
    if (successMessage) {
        var form = document.getElementById('vacacionesForm');
        if (form) {
            form.style.display = 'none';
            
        }
        

    }
});

document.addEventListener('DOMContentLoaded', function() {
    // Calcular la fecha de hoy
    var hoy = new Date();
    // Calcular la fecha de 30 días en el futuro
    var fechaMin = new Date(hoy.setDate(hoy.getDate() + 30));

    // Formatear la fecha en 'YYYY-MM-DD' para el atributo 'min'
    var fechaMinStr = fechaMin.toISOString().split('T')[0];

    // Establecer el atributo 'min' en los campos de fecha
    document.getElementById('fecha_inicio').setAttribute('min', fechaMinStr);
    document.getElementById('fecha_fin').setAttribute('min', fechaMinStr);
});
