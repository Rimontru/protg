<script type="text/javascript" charset="utf-8">
    var asInitVals = new Array();
$(document).ready(function() {
	$('#example').dataTable( {
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "includes/ajax/Sistema/Usuario/ProcesarHistorial.php",
                "bJQueryUI": true,
                "sPaginationType": "full_numbers",
                "sDom": 'T C lfrtip',
                "oTableTools": {
                "sSwfPath": "js/DataTables/TableTools/media/swf/copy_csv_xls_pdf.swf",
                "aButtons": [
                "xls",
                    "pdf",
                    {
                    "sExtends": "print",
                    "sButtonText": "Imprimir",
                    "sInfo": "<br><center><h1>PRESIONAR ESCAPE AL TERMINAR</h1></center>",
                    "sMessage": "<center><h2><b>TITULO!</b></h2></center>",
                    "sTitle": "Historial",
                    }
                    ],
                    },
                    "fnInitComplete": function () {
                        var
                            that = this,
                            nTrs = this.fnGetNodes();
                        $('td', nTrs).click( function () {
                            that.fnFilter( this.innerHTML );
                        } );
                    },
                    "oLanguage": {
"oPaginate": {
"sPrevious": "Anterior",
"sNext": "Siguiente",
"sLast": "Ultima",
"sFirst": "Primera"
},      
"sLengthMenu": 'Mostrar <select>'+
'<option value="10">10</option>'+
'<option value="20">20</option>'+
'<option value="30">30</option>'+
'<option value="40">40</option>'+
'<option value="50">50</option>'+
'<option value="-1">Todos</option>'+
'</select> registros',

"sInfo": "Mostrando del _START_ a _END_ (Total: _TOTAL_ resultados)",

"sInfoFiltered": " - filtrados de _MAX_ registros",

"sInfoEmpty": "No hay resultados de búsqueda",

"sZeroRecords": "No hay registros a mostrar",

"sProcessing": "Espere, por favor...",

"sSearch": "Buscar:",

}
                });   
             

         $("tfoot input").keyup( function () {
        /* Filter on the column (the index) of this element */
        oTable.fnFilter( this.value, $("tfoot input").index(this) );
    } );


    /*
     * Support functions to provide a little bit of 'user friendlyness' to the textboxes in
     * the footer
     */
    $("tfoot input").each( function (i) {
        asInitVals[i] = this.value;
    } );

    $("tfoot input").focus( function () {
        if ( this.className == "search_init" )
        {
            this.className = "";
            this.value = "";
        }
    } );

    $("tfoot input").blur( function (i) {
        if ( this.value == "" )
        {
            this.className = "search_init";
            this.value = asInitVals[$("tfoot input").index(this)];
        }
    } );
            });  // Termina document.ready    
</script>
<style>
   .data_table {
        font-family: helvetica;
        font-size: 1px;
    }
    
    
  /*   #top_of_page {
        position: absolute;
    }
*/    

#main_table_area {
/*        position: absolute;
        top: 20px;
        height: 540px;
        width: 800px;*/
        overflow: auto;
    }
</style>



<div id="Form_Auto">


            <div id="demo">
<font size=1>
<div id="main_table_area">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" class="data_table">
    <thead>
        <tr>
        <th>Departamento</th>
        <th>Nombre</th>
        <th>Apellido_Paterno</th>
        <th>Apellido_Materno</th>
        <th>Usuario</th>
        <th>Fecha</th>
        <th>Hora</th>
        <th>Ip</th>
        <th>Cat_o_Mod</th>
        <th>Registro</th>
        </tr>
    </thead>
    <tbody>

        </tbody>
</table>
</div>
</font>
            </div>
            <div class="spacer"></div>
            
</div>