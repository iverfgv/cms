<!DOCTYPE HTML>
<html>
	<head>
		<title>Posada paraiso</title>
            <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    {!!Html::style('css/posadaparaiso/style.css')!!}
  

	   <!-- Bootstrap Core CSS -->
    {!!Html::style('css/bootstrap.min.css')!!}    
	{!!Html::style('css/slider.css')!!}

    {!!Html::style('css/posadaparaiso/ligthBoxGallery/css/lightbox.css')!!}
    <!-- Custom CSS -->
    <script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
    </script>

	</head>
	<body>
    <header>
    <!-- <img src="../img-cresolido/paraisonaranja-22.png"  class="img-responsive logocre">-->
    </header>
 <!-- Navigation -->
    <nav class="navbar navbar-inverse" role="navigation" id="menu">
        <div class="container-fluid main-menu">
            <div class="container ">                
                <!-- Brand and toggle get grouped for better mobile display -->          
                <div class="navbar-header ">
                
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">

                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                          
                      <div class="icon-logo-empresa  hidden-xs " > <a href="/">  <img src="../img-posadaparaiso/paraisonaranja-22.png" class="img-responsive " ></a> </div> 
                      <div class="icon-logo-empresa  visible-xs  " > <a href="/">  <img src="../img-posadaparaiso/paraisonaranja-22.png" class="img-responsive " style="width:100px"></a> </div>        
                </div>            
                <div class="collapse navbar-collapse pull-right" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav " id="menu-main">                  
                      @include('posadaparaiso.mainmenu')
                      </ul>
                </div>
            </div>
        </div>         
    </nav>
        	@yield('maincontent') 	
    <div class="container-fluid footer-menu sombrainterior-naranja">
        
        	 @include('posadaparaiso.footermenu')	 		
 
    </div> 
  
    <!--ligthBox-->
    
    {!! Html::script('css/posadaparaiso/ligthBoxGallery/js/lightbox-plus-jquery.js') !!}  

    <!-- jQuery -->
    {!! Html::script('js/jquery.js') !!}  

    <!-- Bootstrap Core JavaScript -->    
    {!! Html::script('js/bootstrap.min.js') !!}    
    <!-- sdjasdjjkd-->
    {!! Html::script('js/jquery.nivo.slider.js') !!} 
	</body>
     <script>
    $('.carousel').carousel({
        interval: 3000 //changes the speed
    })

    
    /*Cambia el color del item seleccionado*/
     var pathname = window.location.pathname;
     var itema_ctive = pathname.split('/');
     itema_ctive=itema_ctive[itema_ctive.length-1];
     //alert(itema_ctive);
     //var item_seleccionado='Hotel';
     item=$("#"+itema_ctive);
     item.addClass('itema-active');
     item.addClass('disabled');
     


     /*Efecto de deslizamiento haci abajo*/
      
      var URLhash = window.location.hash;
      if(URLhash!="")
        URLhash=URLhash.substr(1);//quito el #
      $("#menu-main li a").each(function (index)//recorreo todos lo li y asignamos un identificador unico a cada li
       {
              link_item=$(this).attr('id');
              //alert('item'+URLhash);
             if('item'+URLhash==link_item)
             {
             $("#itemContacto a").click(function(e){
             e.preventDefault();
             $("html, body #itemContacto").animate({
                scrollTop: 0
                }, 1000); 
                alert('entr');
             });


             }
              
       });

     


    </script>
  
</html>

