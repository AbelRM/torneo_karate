$(document).ready(function () {
  $(".deleteBtn1").on("click", function () {
    $("#agregar_user").modal("show");
    // Get the table row data.
    $tr = $(this).closest("tr");

    var data = $tr
      .children("td")
      .map(function () {
        return $(this).text();
      })
      .get();

    console.log(data);
    $("#idsolicitud").val(data[0]);
    $("#iddetalle_torneo").val(data[1]);
    $("#nombre_club").val(data[2]);
    $("#correo").val(data[3]);
    $("#numero").val(data[4]);
    $("#fech_soli").val(data[5]);
    $('#estado_soli').val(data[6].trim());
  });
});
