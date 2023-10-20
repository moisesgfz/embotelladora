$(function(){
    console.log('Jquery funciona');
    obtener_pedidos();
    $('#task-result').hide();
    $('#search').keyup(function(e){
        if($('#search').val()){
            let search = $('#search').val();
            $.ajax({
                url: 'busqueda.php',
                type: 'POST',
                data: {search},
                success: function(response){
                    let pedidos = JSON.parse(response);
                    let template = '';
    
                    pedidos.forEach(pedido =>{
                        template += `
                        <li>
                            ${pedido.id}
                            ${pedido.cantidad}
                            ${pedido.fecha_hora}
                        </li>`
                    });
                    $('#container').html(template);
                    $('#task-result').show();
                }
            });
        }

    })
    
    $('#task-form').submit(function(e){
        console.log('enviando');
        const postData = {
            cantidad : $('#cantidad').val(),
            descripcion : $('#descripcion').val()
        };
        $.post('add-pedido.php',postData, function(response){
            console.log(response);
            obtener_pedidos();
            $('#task-form').trigger('reset');
        });
        e.preventDefault();
    });

    function obtener_pedidos(){
        $.ajax({
            url: 'mostrar.php',
            type: 'GET',
            success: function (response){
                let pedidos = JSON.parse(response);
                let template = '';
                pedidos.forEach(pedido =>{
                    template += `
                        <tr>
                            <td>${pedido.id}</td>
                            <td>${pedido.cantidad}</td>
                            <td>${pedido.fecha_hora}</td>
                            <td>${pedido.descripcion}</td>
                        </tr>
                    `
                });
                $('#pedidos').html(template);
            }
        });
    }

    $(document).ready(function() {
        $('#download-pdf').click(function() {
          $.ajax({
            url: 'pdf.php',
            type: 'POST',
            dataType: 'json',
            success: function(response) {
              if (response.success) {
                // Generar el archivo PDF
                var doc = new jsPDF();
                doc.setFontSize(10);
                doc.text(response.data, 10, 10);
                var descripcion = $('#descripcion').val(); // Obtener el valor del campo de texto 'descripcion'
                doc.text(20, 40, descripcion);
                doc.save('reporte.pdf');
              } else {
                console.log(response.message);
              }
            },
            error: function(xhr, status, error) {
              console.log("Error en la solicitud AJAX: " + error);
            }
          });
        });
      });

});