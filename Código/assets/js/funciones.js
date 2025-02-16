document.addEventListener("DOMContentLoaded", function () {
  var registrosTable = document.getElementById("registros_table");
  var loading = false;
 document.getElementById("exportar_excel").addEventListener("click", exportarExcel);

    function exportarExcel() {
        // Realizar una solicitud para obtener todos los registros (no se limita por la paginación)
        fetch("../controller/controlador.php?accion=mostrarRegistros")
            .then(response => response.json())
            .then(data => {
                // Verificar si se han recibido datos
                if (data && data.length > 0) {
                    // Crear un libro de trabajo para Excel
                    const workbook = XLSX.utils.book_new();
                    const worksheet = XLSX.utils.json_to_sheet(data);

                    // Agregar la hoja al libro
                    XLSX.utils.book_append_sheet(workbook, worksheet, "Registros");

                    // Descargar el archivo Excel
                    XLSX.writeFile(workbook, "todos_los_registros.xlsx");
                } else {
                    Swal.fire("Error", "No se encontraron registros para exportar", "error");
                }
            })
            .catch(error => {
                console.error("Error al exportar:", error);
                Swal.fire("Error", "Hubo un error al exportar los registros", "error");
            });
    }
  // Función para llenar la tabla con los registros recibidos
  function llenarTabla(registros) {
    const tbody = document.getElementById("registros_body");
    const thead = document.getElementById("registros_table").querySelector("thead");

    // Clear the table
    tbody.innerHTML = "";
    thead.innerHTML = "";

    if (registros.length > 0) {
        // Generate table headers dynamically based on the keys in the first record
        const headers = Object.keys(registros[0]);
        const headerRow = document.createElement("tr");
        headers.forEach(header => {
            const th = document.createElement("th");
            th.textContent = header;
            headerRow.appendChild(th);
        });
        thead.appendChild(headerRow);

        // Fill the table body with records
        registros.forEach(registro => {
            const tr = document.createElement("tr");
            headers.forEach(header => {
                const td = document.createElement("td");
                td.textContent = registro[header];
                tr.appendChild(td);
            });
            tbody.appendChild(tr);
        });
    }
}

  // Función para cargar registros por página
  function obtenerRegistros() {
    fetch("../controller/controlador.php?accion=mostrarRegistros")
        .then(response => response.json())
        .then(data => {
            llenarTabla(data);
        })
        .catch(error => {
            console.error("Error fetching records:", error);
        });
}

// llama a esta funcion para obtener los registros inicialmente
obtenerRegistros();


  // Evento de desplazamiento asociado a la tabla
  registrosTable.addEventListener("scroll", function () {
    var scrollTop = registrosTable.scrollTop;
    var scrollHeight = registrosTable.scrollHeight;
    var clientHeight = registrosTable.clientHeight;

    if (scrollTop + clientHeight >= scrollHeight - 5 && !loading) {
      loading = true;

      obtenerRegistros();
    }
  });

  // Otras funciones permanecen igual
  function formatearValor(valor) {
    if (valor == null) {
      return "";
    } else if (valor instanceof Date) {
      return valor.toLocaleDateString();
    } else if (typeof valor === "number") {
      return valor.toFixed(2);
    } else {
      return valor.toString();
    }
  }

});
