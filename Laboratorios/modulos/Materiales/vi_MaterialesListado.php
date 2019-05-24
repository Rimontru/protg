<script>
    $(function() {
        $.ajax({
            url: pathMateriales + 'lista_DatosMaterialesEliminar.php',
            type: 'post',
            data: "ListaSinodales=ListaSinodales",
            success: function(data) {
                if (data != "") {
                    $("#Lista").html(data);
                }
            }

        });//fin ajax 



    });


</script>  

<div class="row">      	
    <div class="span12">           		
        <div class="widget stacked ">      			
            <div class="widget-header">
                <i class="icon-pencil"></i>
                <h3>Materiales: Listado.</h3>
            </div> <!-- /widget-header -->

            <div class="widget-content">					
                <br />					
                <section id="buttons">
                    
                   
                    
                    
                 <div id="Lista"></div>
 
                                         
                                         
                </section>
            </div> <!-- /widget-content -->

        </div> <!-- /widget -->

    </div> <!-- /span12 -->

</div> <!-- /row -->