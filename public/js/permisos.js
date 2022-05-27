$('.ml-auto').html(
    
    '<div class="dropdown show" style="margin: 2px;">'+
        '<button class="btn dropdown-toggle" type="button" style="width: auto;" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
          '</span><img src="/user.png" class="avatar-img rounded-circle" alt="" width="40">'+  '<span style="color: black;">'+ usuario +
           
            '</button>'+
        '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width: auto;">'+
            '</a>'+'<a class="dropdown-item" href="#">'+ rol +'</a>'+  
            
            
                /*cerrar seccion */
            '<a class="dropdown-item" style="background: #353232; color: white;" href="http://127.0.0.1:8000/logout">Cerrar Sesión</a>'+
        '</div>'+
    '</div>'
);

let ver_usuario = false;

$('#dropdownMenuButton').click(function(){

    if(ver_usuario)
    {
        $('.dropdown-menu').hide();

        ver_usuario = false;
    }
    else
    {
        $('.dropdown-menu').show();

        ver_usuario = true;
    }
});

//Análisis de datos
$('#analisis_datos').hide();

//personal  
$('#personal').hide();
$('#personal_estudiantes').hide();
$('#personal_docentes').hide();

//académico
$('#academico').hide();
$('#academico_periodo').hide();
$('#academico_asignacion').hide();
$('#academico_matricula').hide();
$('#academico_plan').hide();
$('#academico_evaluacion').hide();

//académico
$('#gestion').hide();
$('#gestion_aula').hide();
$('#gestion_seccion').hide();
$('#gestion_materia').hide();
$('#gestion_curso').hide();

//reporte
$('#reporte').hide();
$('#reporte_matricula').hide();
$('#reporte_registro_notas').hide();
$('#reporte_mis_notas').hide();
$('#reporte_curso').hide();
$('#reporte_configuration_footer').hide();
$('#reporte_aptitud_docente').hide();
$('#reporte_aptitud_alumno').hide();
$('#reporte_docente_matricula').hide();

//miscelaneo
$('#miscelaneo').hide();
$('#miscelaneo_reparto').hide();
$('#miscelaneo_especialidad').hide();
$('#miscelaneo_grado').hide();
$('#miscelaneo_tipo_curso').hide();
$('#miscelaneo_eje_curso').hide();
$('#miscelaneo_tipo_sangre').hide();
 
//seguridad
$('#usuario').hide();

//porcentaje de notas
$('#porcentaje_notas').hide();

//reportes
$('#reporte_matricula').hide();

//obtención de roles
let roles = rol.split(',');

//Rol Doocente
if(roles.includes('Administrador') || roles.includes('Docente'))
{
    //académico
    $('#academico').show();
    $('#academico_plan').show();
    $('#academico_evaluacion').show();

    //reporte
    $('#reporte').show();
    $('#reporte_registro_notas').show();
    $('#reporte_aptitud_docente').show();
}

//Rol Estudiante
if(roles.includes('Estudiante'))
{
    $('#reporte_mis_notas').show();
}

if(roles.includes('Administrador') || roles.includes('Estudiante'))
{
    $('#reporte').show();
    $('#reporte_aptitud_alumno').show();
}

//Rol Técnico
if(roles.includes('Administrador') || roles.includes('Técnico'))
{
    //análisis
    $('#analisis_datos').show();
    //personal

    $('#personal').show();
    $('#personal_estudiantes').show();
    $('#personal_docentes').show();

    //académico
    $('#academico').show();
    $('#academico_periodo').show();
    $('#academico_asignacion').show();
    $('#academico_matricula').show();

    //gestión
    $('#gestion').show();
    $('#gestion_aula').show();
    $('#gestion_seccion').show();
    $('#gestion_materia').show();
    $('#gestion_curso').show();

    //reporte
    $('#reporte').show();
    $('#reporte_matricula').show();
    $('#reporte_registro_notas').show();

    //miscelaneo
    $('#miscelaneo').show();
    $('#miscelaneo_reparto').show();
    $('#miscelaneo_especialidad').show();
    $('#miscelaneo_grado').show();
    $('#miscelaneo_tipo_curso').show();
    $('#miscelaneo_eje_curso').show();
    $('#miscelaneo_tipo_sangre').show();

    //porcentajes
    $('#porcentaje_notas').show();

    //reportes
    $('#reporte_matricula').show();
    $('#reporte_curso').show();
    $('#reporte_configuration_footer').show();
}

if(roles.includes('Administrador'))
{
    //seguridad
    $('#usuario').show();
}

$(document).ready(function(){

    $('#loader').hide();
});
//$('#loader').hide();