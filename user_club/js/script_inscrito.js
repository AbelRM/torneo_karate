$(document).ready(function () {
  $(".deleteBtn1").on("click", function () {
    $("#eliminar_parti").modal("show");
    // Get the table row data.
    $tr = $(this).closest("tr");

    var data = $tr
      .children("td")
      .map(function () {
        return $(this).text();
      })
      .get();

    console.log(data);
    $("#id4").val(data[0]);
    $("#iddetalle_torneo").val(data[1]);
  });
});



//MODAL INGRESAR
function opcion_kumite(sel) {
  if (sel.value == "1") {
    div_nivel_estudio_tecnico = document.getElementById("agregar_kumite");
    div_nivel_estudio_tecnico.style.display = "none";
  } else if (sel.value == "Participar") {
    div_nivel_estudio_tecnico = document.getElementById("agregar_kumite");
    div_nivel_estudio_tecnico.style.display = "block";
  } 
}

function opcion_kata(sel) {
  if (sel.value == "1") {
    div_nivel_estudio_tecnico = document.getElementById("agregar_kata");
    div_nivel_estudio_tecnico.style.display = "none";
  } else if (sel.value == "Participar") {
    div_nivel_estudio_tecnico = document.getElementById("agregar_kata");
    div_nivel_estudio_tecnico.style.display = "block";
  } 
}

//PAGINA EDITAR
$(function() {
  $("#update_tipo_comprobante").on('change', function() {
    var selectValue = $(this).val();
    switch (selectValue) {
      case "Contrato":
        $("#div_tipo_constancia_update").hide();
        $("#div_nro_contrato_update").show();
        break;
      case "Resolucion (Nombrado)":
        $("#div_tipo_constancia_update").hide();
        $("#div_nro_contrato_update").hide();
        break;
     
    }
  }).change();
});

