let isUpdate = false; // Bandera para saber si es actualización
$("#registro").click(function () {
  var formData = new FormData(document.getElementById("formulario_registro"));

  const action = isUpdate ? "actualizarTicket" : "registroTicket";
  formData.append("action", action);

  $.ajax({
    method: "POST",
    url: "../controller/registro.php",
    data: formData,
    processData: false,
    contentType: false,
    beforeSend: function () {
      $("#load").show();
    },
    success: function (res) {
      $("#load").hide();

      if (res.error) {
        swal("Error", res.error, "error");
      } else {
        swal({
          title: "Éxito",
          text: isUpdate
            ? "Registro actualizado exitosamente"
            : "Registro creado exitosamente",
          type: "success",
          showConfirmButton: false,
        });
        setTimeout(function () {
          window.location.href = res.redirect || "../index.php";
        }, 2000);
      }
    },
    error: function () {
      swal("Error", "Ocurrió un error inesperado", "error");
    },
  });
});

$("#papeleta").click(function () {
  var formData = new FormData();

  // Recopilar datos de los campos habilitados
  $("#formulario_registro")
    .find("input, select, textarea")
    .each(function () {
      if (!$(this).prop("disabled")) {
        formData.append($(this).attr("name"), $(this).val());
      }
    });

  // Recopilar datos de los campos deshabilitados manualmente
  $("#formulario_registro")
    .find("input:disabled, select:disabled, textarea:disabled")
    .each(function () {
      formData.append($(this).attr("name"), $(this).val());
    });

  formData.append("action", "generarPDF");

  $.ajax({
    method: "POST",
    url: "../controller/registro.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = JSON.parse(response);
      if (res.error) {
        swal("Error", res.error, "error");
      } else if (res.pdfData) {
        var pdfUrl = "data:application/pdf;base64," + res.pdfData;
        $("#pdfViewer").attr("src", pdfUrl);
        $("#modalPDF").modal("show");
      }
    },
    error: function () {
      swal("Error", "No se pudo generar el PDF.", "error");
    },
  });
});

// Habilitar escritura en select
document.querySelectorAll("select").forEach(function (select) {
  // Añadir evento para manejar la entrada del usuario
  select.addEventListener("keydown", function (e) {
    // Detectar si el usuario está escribiendo algo que no está en la lista
    if (e.key.length === 1 || e.key === "Backspace" || e.key === "Delete") {
      e.preventDefault();

      // Si no existe ya un input en el select, crearlo
      if (!this.querySelector("input")) {
        const input = document.createElement("input");
        input.type = "text";
        input.className = "editable-option";
        input.style.border = "none";
        input.style.background = "transparent";
        input.style.width = "100%";
        input.style.fontSize = "inherit";
        input.style.color = "inherit";
        input.value = this.options[this.selectedIndex]?.text || ""; // Usar texto del select actual

        this.style.display = "none"; // Ocultar el select temporalmente
        this.parentNode.appendChild(input); // Agregar el input al DOM

        // Cuando termine de escribir, guardar el valor y mostrar el select nuevamente
        input.addEventListener("blur", () => {
          const newValue = input.value.trim();
          if (newValue) {
            // Crear una nueva opción si no existe
            const newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            this.appendChild(newOption);
            this.value = newValue; // Seleccionar el nuevo valor
          }
          input.remove(); // Eliminar el input
          this.style.display = ""; // Mostrar el select
        });

        input.focus(); // Enfocar el input
      }
    }
  });
});

$("#corregir").click(function () {
  isUpdate = true; // Editar registro
  $("input, select, textarea").prop("disabled", false);
  $("#FOLIO_DIISE").prop("disabled", false);

  $("#FOLIO_DIISE").prop("disabled", false);
  $("#registro").attr("disabled", false);
});

//obtener estatus
$(document).ready(function () {
  $.ajax({
    method: "POST",
    url: "../controller/registro.php",
    data: { action: "obtenerEstatus" },
    dataType: "json",
    success: function (res) {
      if (res.length > 0) {
        let options = '<option value="">Seleccione...</option>';
        res.forEach(function (item) {
          options += `<option value="${item.ESTATUS_FOLIO}">${item.ESTATUS_FOLIO}</option>`;
        });
        $("#ESTATUS_FOLIO").html(options);
      } else {
        swal("Atención", "No se encontraron estatus disponibles.", "info");
      }
    },
    error: function () {
      swal("Error", "Ocurrió un problema al cargar los estatus.", "error");
    },
  });
});

//obtener expedientes
$(document).ready(function () {
  $.ajax({
    method: "POST",
    url: "../controller/registro.php",
    data: { action: "obtenerExpedientes" },
    dataType: "json",
    success: function (res) {
      if (res.length > 0) {
        let options = '<option value="">Seleccione...</option>';
        res.forEach(function (item) {
          options += `<option value="${item.EXPEDIENTE}">${item.EXPEDIENTE}</option>`;
        });
        $("#EXPEDIENTE").html(options);
      } else {
        swal("Atención", "No se encontraron expedientes disponibles.", "info");
      }
    },
    error: function () {
      swal("Error", "Ocurrió un problema al cargar los expedientes.", "error");
    },
  });
});

//obtener tipos folios
$(document).ready(function () {
  $.ajax({
    method: "POST",
    url: "../controller/registro.php",
    data: { action: "obtenerTipoFolio" },
    dataType: "json",
    success: function (res) {
      if (res.length > 0) {
        let options = '<option value="">Seleccione...</option>';
        res.forEach(function (item) {
          options += `<option value="${item.TIPO_FOLIO}">${item.TIPO_FOLIO}</option>`;
        });
        $("#TIPO_FOLIO").html(options);
      } else {
        swal(
          "Atención",
          "No se encontraron tipos de folio disponibles.",
          "info"
        );
      }
    },
    error: function () {
      swal(
        "Error",
        "Ocurrió un problema al cargar los tipos de folio.",
        "error"
      );
    },
  });
});

//obtener legajos
$(document).ready(function () {
  $.ajax({
    method: "POST",
    url: "../controller/registro.php",
    data: { action: "obtenerLegajos" },
    dataType: "json",
    success: function (res) {
      if (res.length > 0) {
        let options = '<option value="">Seleccione...</option>';
        res.forEach(function (item) {
          options += `<option value="${item.LEGAJO}">${item.LEGAJO}</option>`;
        });
        $("#LEGAJO").html(options);
      } else {
        swal("Atención", "No se encontraron los legajos disponibles.", "info");
      }
    },
    error: function () {
      swal("Error", "Ocurrió un problema al cargar los legajos.", "error");
    },
  });
});

//obtener categorias
$(document).ready(function () {
  $.ajax({
    method: "POST",
    url: "../controller/registro.php",
    data: { action: "obtenerCategorias" },
    dataType: "json",
    success: function (res) {
      if (res.length > 0) {
        let options = '<option value="">Seleccione...</option>';
        res.forEach(function (item) {
          options += `<option value="${item.CATEGORIA}">${item.CATEGORIA}</option>`;
        });
        $("#CATEGORIA").html(options);
      } else {
        swal("Atención", "No se encontraron categorias disponibles.", "info");
      }
    },
    error: function () {
      swal("Error", "Ocurrió un problema al cargar las categorias.", "error");
    },
  });
});

//obtener turnados
$(document).ready(function () {
  $.ajax({
    method: "POST",
    url: "../controller/registro.php",
    data: { action: "obtenerTurnados" },
    dataType: "json",
    success: function (res) {
      if (res.length > 0) {
        let options = '<option value="">Seleccione...</option>';
        res.forEach(function (item) {
          options += `<option value="${item.TURNADO}">${item.TURNADO}</option>`;
        });
        $("#TURNADO").html(options);
      } else {
        swal("Atención", "No se encontraron turnados disponibles.", "info");
      }
    },
    error: function () {
      swal("Error", "Ocurrió un problema al cargar los turnados.", "error");
    },
  });
});

//obtener respuestas
$(document).ready(function () {
  $.ajax({
    method: "POST",
    url: "../controller/registro.php",
    data: { action: "obtenerRespuestas" },
    dataType: "json",
    success: function (res) {
      if (res.length > 0) {
        let options = '<option value="">Seleccione...</option>';
        res.forEach(function (item) {
          options += `<option value="${item.REQUIERE_RESPUESTA}">${item.REQUIERE_RESPUESTA}</option>`;
        });
        $("#REQUIERE_RESPUESTA").html(options);
      } else {
        swal("Atención", "No se encontraron respuestas disponibles.", "info");
      }
    },
    error: function () {
      swal("Error", "Ocurrió un problema al cargar las respuestas.", "error");
    },
  });
});

//obtener copias
$(document).ready(function () {
  $.ajax({
    method: "POST",
    url: "../controller/registro.php",
    data: { action: "obtenerCopias" },
    dataType: "json",
    success: function (res) {
      if (res.length > 0) {
        let options = '<option value="">Seleccione...</option>';
        res.forEach(function (item) {
          options += `<option value="${item.COPIA_A}">${item.COPIA_A}</option>`;
        });
        $("#COPIA_A").html(options);
      } else {
        swal("Atención", "No se encontraron copias disponibles.", "info");
      }
    },
    error: function () {
      swal("Error", "Ocurrió un problema al cargar las copias.", "error");
    },
  });
});

//obtener tipos
$(document).ready(function () {
  $.ajax({
    method: "POST",
    url: "../controller/registro.php",
    data: { action: "obtenerTipos" },
    dataType: "json",
    success: function (res) {
      if (res.length > 0) {
        let options = '<option value="">Seleccione...</option>';
        res.forEach(function (item) {
          options += `<option value="${item.TIPO}">${item.TIPO}</option>`;
        });
        $("#TIPO").html(options);
      } else {
        swal("Atención", "No se encontraron tipos disponibles.", "info");
      }
    },
    error: function () {
      swal("Error", "Ocurrió un problema al cargar los tipos.", "error");
    },
  });
});

//obtener fuentes
$(document).ready(function () {
  $.ajax({
    method: "POST",
    url: "../controller/registro.php",
    data: { action: "obtenerFuentes" },
    dataType: "json",
    success: function (res) {
      if (res.length > 0) {
        let options = '<option value="">Seleccione...</option>';
        res.forEach(function (item) {
          options += `<option value="${item.FUENTE}">${item.FUENTE}</option>`;
        });
        $("#FUENTE").html(options);
      } else {
        swal("Atención", "No se encontraron fuentes disponibles.", "info");
      }
    },
    error: function () {
      swal("Error", "Ocurrió un problema al cargar las fuentes.", "error");
    },
  });
});

//obtener areas
$(document).ready(function () {
  $.ajax({
    method: "POST",
    url: "../controller/registro.php",
    data: { action: "obtenerAreas" },
    dataType: "json",
    success: function (res) {
      if (res.length > 0) {
        let options = '<option value="">Seleccione...</option>';
        res.forEach(function (item) {
          options += `<option value="${item.AREA_REMITENTE}">${item.AREA_REMITENTE}</option>`;
        });
        $("#AREA_REMITENTE").html(options);
      } else {
        swal("Atención", "No se encontraron areas disponibles.", "info");
      }
    },
    error: function () {
      swal("Error", "Ocurrió un problema al cargar las areas.", "error");
    },
  });
});

//Obtener ID_COEES
$(document).ready(function () {
  $.ajax({
    method: "POST",
    url: "../controller/registro.php",
    data: { action: "obtenerCoees" },
    dataType: "json",
    success: function (res) {
      if (res.length > 0) {
        let options = '<option value="S/N">S/N</option>';
        res.forEach(function (item) {
          //options += `<option value="${item.ID_COEES}">${item.ID_COEES}</option>`;
          options += `<option value="${item.ID_COEES.replace("_2024", "")}">${
            item.ID_COEES
          }</option>`;
        });
        $("#ID_COEES").html(options);
      } else {
        swal("Atención", "No se encontraron ID_COEES disponibles.", "info");
      }
    },
    error: function () {
      swal("Error", "Ocurrió un problema al cargar los ID_COEES.", "error");
    },
  });
});

$(document).on("change", "#ID_COEES", function () {
  //const idCoees = $(this).val();
  const idCoees = $(this).find("option:selected").text();
  console.log(idCoees);

  if (idCoees) {
    $.ajax({
      method: "POST",
      url: "../controller/registro.php",
      data: { action: "obtenerDatosCoees", ID_COEES: idCoees },
      dataType: "json",
      success: function (res) {
        if (res) {
          // Rellena los campos con los datos obtenidos
          $("#FECHA_RECEPCION").val(res.FECHA_RECEPCION || "");
          $("#FOLIOS_RELACIONADOS").val(res.FOLIOS_RELACIONADOS || "");
          $("#TIPO").val(res.TIPO || "");
          $("#FUENTE").val(res.FUENTE || "");
          $("#NUMERO").val(res.NUMERO || "");
          $("#AREA_REMITENTE").val(res.AREA_REMITENTE || "");
          $("#ASUNTO").val(res.ASUNTO || "");
          $("#FECHA_RESPUESTA_1").val(res.FECHA_RESP_1 || "");
          $("#TIPO_RESPUESTA_1").val(res.TIPO_RESP_1 || "");
          $("#NUMERO_RESPUESTA_1").val(res.NUMERO_RESP_1 || "");
          $("#FECHA_RESPUESTA_2").val(res.FECHA_RESP_2 || "");
          $("#TIPO_RESPUESTA_2").val(res.TIPO_RESP_2 || "");
          $("#NUMERO_RESPUESTA_2").val(res.NUMERO_RESP_2 || "");
          $("#FECHA_RESPUESTA_3").val(res.FECHA_RESP_3 || "");
          $("#TIPO_RESPUESTA_3").val(res.TIPO_RESP_3 || "");
          $("#NUMERO_RESPUESTA_3").val(res.NUMERO_RESP_3 || "");
          $("#FECHA_RESPUESTA_4").val(res.FECHA_RESP_4 || "");
          $("#TIPO_RESPUESTA_4").val(res.TIPO_RESP_4 || "");
          $("#NUMERO_RESPUESTA_4").val(res.NUMERO_RESP_4 || "");
          $("#FECHA_RESPUESTA_5").val(res.FECHA_RESP_5 || "");
          $("#TIPO_RESPUESTA_5").val(res.TIPO_RESP_5 || "");
          $("#NUMERO_RESPUESTA_5").val(res.NUMERO_RESP_5 || "");
          $("#FECHA_RESPUESTA_6").val(res.FECHA_RESP_6 || "");
          $("#TIPO_RESPUESTA_6").val(res.TIPO_RESP_6 || "");
          $("#NUMERO_RESPUESTA_6").val(res.NUMERO_RESP_6 || "");
        } else {
          swal(
            "Atención",
            "No se encontraron datos para el ID seleccionado.",
            "info"
          );
        }
      },
      error: function () {
        swal(
          "Error",
          "Ocurrió un problema al cargar los datos del ID_COEES.",
          "error"
        );
      },
    });
  } else {
    // Limpia los campos si no hay selección
    $("#FECHA_RECEPCION, #FOLIOS_RELACIONADOS").val("");
    $("#TIPO, #FUENTE").val("");
  }
});

$(document).ready(function () {
  $("#nuevo").click(function () {
    isUpdate = false; // Nuevo registro
    // Habilitar formulario
    $("input, select, textarea").prop("disabled", false);
    $("button:contains('Guardar')")
      .removeAttr("disabled")
      .removeClass("btn-secondary")
      .addClass("btn-primary");
    $("#corregir").attr("disabled", true);
    $("#FOLIO_DIISE").prop("disabled", false);

    // Limpiar todos los campos
    $("#formulario_registro")[0].reset();

    // Obtener el siguiente FOLIO_DIISE
    $.ajax({
      url: "../controller/registro.php",
      method: "POST",
      data: { action: "obtenerSiguienteFolio" },
      success: function (response) {
        var data = JSON.parse(response);
        if (data.siguienteFolio) {
          $("#FOLIO_DIISE").val(data.siguienteFolio);
        } else {
          alert("Error al obtener el siguiente folio");
        }
      },
      error: function () {
        alert("Error en la petición para obtener el folio.");
      },
    });
  });
});

let indiceActual = 0;
let totalRegistros = 0;

// Obtener el total de registros al cargar la página
$(document).ready(function () {
  // Obtener el total de registros para manejar límites en los botones
  $.post(
    "../controller/registros.php",
    { accion: "totalRegistros" },
    function (res) {
      if (res.total) {
        totalRegistros = parseInt(res.total);
        indiceActual = 0; // Inicializa en el primer registro

        // Carga el primer registro automáticamente
        actualizarFormulario(indiceActual);
      } else {
        console.error("No se pudo obtener el total de registros");
      }
    },
    "json"
  );
});

// Función para actualizar el formulario
function actualizarFormulario(indice) {
  $.post(
    "../controller/registros.php",
    { accion: "obtenerRegistro", indice: indice },
    function (res) {
      if (res) {
        // Actualiza los campos con los datos del registro
        $("#FOLIO_DIISE").val(res.FOLIO_DIISE);
        $("#FECHA_CARGA").val(res.FECHA_CARGA);
        $("#EXPEDIENTE").val(res.EXPEDIENTE);
        $("#LEGAJO").val(res.LEGAJO);
        $("#TIPO_FOLIO").val(res.TIPO_FOLIO);
        $("#CATEGORIA").val(res.CATEGORIA);
        $("#TURNADO").val(res.TURNADO);
        $("#COPIA_A").val(res.COPIA_A);
        $("#REQUIERE_RESPUESTA").val(res.REQUIERE_RESPUESTA);
        $("#OBSERVACION_FOLIO").val(res.OBSERVACION_FOLIO);
        $("#OBSERVACION_RESPUESTA").val(res.OBSERVACION_RESPUESTA);
        $("#ESTATUS_FOLIO").val(res.ESTATUS_FOLIO);
        $("#FECHA_LIMITE_RESPUESTA").val(res.FECHA_LIMITE_RESPUESTA);
        $("#FECHA_CONCLUSION_FOLIO").val(res.FECHA_CONCLUSION_FOLIO);
        $("#ID_COEES").val(res.ID_COEES.replace("_2024", ""));
        $("#FECHA_RECEPCION").val(res.FECHA_RECEPCION);
        $("#FOLIOS_RELACIONADOS").val(res.FOLIOS_RELACIONADOS);
        $("#TIPO").val(res.TIPO);
        $("#FUENTE").val(res.FUENTE);
        $("#NUMERO").val(res.NUMERO);
        $("#AREA_REMITENTE").val(res.AREA_REMITENTE);
        $("#ASUNTO").val(res.ASUNTO);
        $("#FECHA_RESPUESTA_1").val(res.FECHA_RESPUESTA_1);
        $("#TIPO_RESPUESTA_1").val(res.TIPO_RESPUESTA_1);
        $("#NUMERO_RESPUESTA_1").val(res.NUMERO_RESPUESTA_1);
        $("#FECHA_RESPUESTA_2").val(res.FECHA_RESPUESTA_2);
        $("#TIPO_RESPUESTA_2").val(res.TIPO_RESPUESTA_2);
        $("#NUMERO_RESPUESTA_2").val(res.NUMERO_RESPUESTA_2);
        $("#FECHA_RESPUESTA_3").val(res.FECHA_RESPUESTA_3);
        $("#TIPO_RESPUESTA_3").val(res.TIPO_RESPUESTA_3);
        $("#NUMERO_RESPUESTA_3").val(res.NUMERO_RESPUESTA_3);
        $("#FECHA_RESPUESTA_4").val(res.FECHA_RESPUESTA_4);
        $("#TIPO_RESPUESTA_4").val(res.TIPO_RESPUESTA_4);
        $("#NUMERO_RESPUESTA_4").val(res.NUMERO_RESPUESTA_4);
        $("#FECHA_RESPUESTA_5").val(res.FECHA_RESPUESTA_5);
        $("#TIPO_RESPUESTA_5").val(res.TIPO_RESPUESTA_5);
        $("#NUMERO_RESPUESTA_5").val(res.NUMERO_RESPUESTA_5);
        $("#FECHA_RESPUESTA_6").val(res.FECHA_RESPUESTA_6);
        $("#TIPO_RESPUESTA_6").val(res.TIPO_RESPUESTA_6);
        $("#NUMERO_RESPUESTA_6").val(res.NUMERO_RESPUESTA_6);

        // Deshabilitar todos los campos del formulario
        $("input, select, textarea").prop("disabled", true);
        $("#FOLIO_DIISE").prop("disabled", false);
      }
    },
    "json"
  );
}

// Botón "Atrás"
$("#atras").click(function () {
  if (indiceActual > 0) {
    indiceActual--;
    actualizarFormulario(indiceActual);
    $("#registro").attr("disabled", true);
    $("#corregir").removeAttr("disabled", false);
  }
});

// Botón "Adelante"
$("#adelante").click(function () {
  if (indiceActual < totalRegistros - 1) {
    indiceActual++;
    actualizarFormulario(indiceActual);
    $("#registro").attr("disabled", true);
    $("#corregir").removeAttr("disabled", false);
  }
});

// Botón "Inicio"
$("#inicio").click(function () {
  if (indiceActual !== 0) {
    indiceActual = 0; // Ir al primer registro
    actualizarFormulario(indiceActual);
    $("#registro").attr("disabled", true);
    $("#corregir").removeAttr("disabled", false);
  }
});

// Botón "Final"
$("#final").click(function () {
  if (indiceActual !== totalRegistros - 1) {
    indiceActual = totalRegistros - 1; // Ir al último registro
    actualizarFormulario(indiceActual);
    $("#registro").attr("disabled", true);
    $("#corregir").removeAttr("disabled", false);
  }
});

document
  .getElementById("exportar_excel")
  .addEventListener("click", exportarExcel);

function exportarExcel() {
  fetch("../controller/registro.php", {
    method: "POST",
    body: new URLSearchParams({ action: "exportarExcel" }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.error) {
        Swal.fire("Error", data.error, "error");
      } else if (data.length > 0) {
        // Crear un libro de Excel y agregar datos
        const workbook = XLSX.utils.book_new();
        const worksheet = XLSX.utils.json_to_sheet(data);

        XLSX.utils.book_append_sheet(workbook, worksheet, "Registros");

        // Descargar archivo
        XLSX.writeFile(workbook, "registros.xlsx");
      } else {
        Swal.fire("Atención", "No hay registros para exportar.", "info");
      }
    })
    .catch((error) => {
      console.error("Error:", error);
      Swal.fire("Error", "Hubo un error al exportar los registros.", "error");
    });
}

document.addEventListener("keydown", function (event) {
  if (event.key === "Escape") {
    // Cancelar edición: deshabilitar todos los campos
    $("input, select, textarea").prop("disabled", true);
    $("#registro").prop("disabled", true);
    $("#corregir").removeAttr("disabled");

    // Restaurar el estado inicial del formulario
    const inputEditable = document.querySelector(
      "select input.editable-option"
    );
    if (inputEditable) {
      const select = inputEditable.parentNode.querySelector("select");
      if (select) {
        inputEditable.remove();
        select.style.display = "";
      }
    }
  }
});
// Seleccionar todos los inputs de tipo date y activar el calendario al hacer clic
document.querySelectorAll('input[type="date"]').forEach((input) => {
  input.addEventListener("click", function () {
    this.showPicker(); // Mostrar el calendario
  });
});
