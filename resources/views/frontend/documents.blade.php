@extends('frontend.index')
@section('content')
<!-- Image Background Page Header -->
    <!-- Note: The background image is set within the business-casual.css file. -->
    <header class="business-header">
 <hr>

        <div class="container">           
        <img src="../img/microfinanzas.png" class="img-responsive" class="img">           
        </div>
    </header>
 <hr>
    <!-- Page Content -->
    <div class="container">
        <hr>
        <div class="row">
            <div class="col-sm-8" style="word-wrap: break-word; text-align: justify;">
            @if($Documents!=null)
              @foreach($Documents as $Doc) 
                <h2> <?php echo $Doc->title;  ?></h2>                
                @if($Doc->main_picture!="")
                <p>
                  <img class="img-center" src='<?php echo $Doc->main_picture; ?>' alt="">
                </p>
                @endif

                <p>    
                  <?php echo $Doc->resumen;  ?>
                </p>
                <p>    
                  <?php echo $Doc->content;  ?>
                </p>              
              @endforeach

              @else
          <br><br><br><br>
          <h2>No existe contenido en esta sección</h2>
          @endif           
            </div>
            <div class="col-sm-4" style="word-wrap: break-word; text-align: justify;">                
              <h3> Datos de Contacto</h3>
              <b>Mail: </b>contacto@valorproductivo.com.mx
				<br>              
              <b>Teléfono de atención al cliente: </b>01 962 625 3100.
              <br>
              <address style="word-wrap: break-word; text-align: justify;">
                <b>Dirección:</b> 6a Avenida Sur No.28-B, Col. Centro, Tapachula de Córdova y Ordóñez, Chiapas.
                </address>
            </div>
        </div>
<div class="row">
  {{$Documents->render()}}
</div>
 </div>
@stop