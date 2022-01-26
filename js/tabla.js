$(document).ready(function() {    
     $('#tablaAdministrador').DataTable({        
         language: {
                 "lengthMenu": "Mostrar _MENU_ registros",
                 "zeroRecords": "No se encontraron resultados",
                 "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                 "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                 "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                 "sSearch": "Buscar:",
                 "oPaginate": {
                     "sFirst": "Primero",
                     "sLast":"Último",
                     "sNext":"Siguiente",
                     "sPrevious": "Anterior"
                     },
                     "sProcessing":"Procesando...",
             },
         //para usar los botones   
         responsive: "true",
         dom: 'Bfrtilp',
         buttons:{
              dom: {
                   button:{
                        className: 'btn'
                   }
              },
              buttons:[ 
               {
                   extend: "excel",
                   text:'Exportar a Excel',
                   titleAttr: 'Exportar a Excel',
                   className:'btn btn-outline-success m-3 rounded'
               },
               {
                    extend:    'pdfHtml5',
                    text:      'Exportar a PDF',
                    titleAttr: 'Exportar a PDF',
                    className: 'btn btn-outline-danger m-3 rounded'
               },
               {
                    extend:    'print',
                    text:      'Imprimir',
                    titleAttr: 'Imprimir',
                    className: 'btn btn-outline-secondary m-3 rounded'
               },
          ]
         },       	        
     });     
 });