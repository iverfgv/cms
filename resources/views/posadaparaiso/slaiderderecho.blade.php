<div class="col-md-6 pull-right"> 
               <div class="row">
                   <div class="col-md-3 " ></div>
                   <div class="col-md-7 " >
                           <div class="form-naranja" style="padding:18px;">
                           @include('posadaparaiso.frmreservaenlinea')
                           </div>     
                   </div>
               </div>

                <div class="row">
                   <div class="col-md-3 " ></div>
                   <div class="col-md-7 " >
                           <br>
                           <div class="form-naranja text-center"><h4>{{trans('posadapraiso/pagina_restaurant.ofertasespeciales')}}</h4></div>
                           <img src="img-posadaparaiso/ofertasespeciales.png" class="img-responsive">    
                   </div>
               </div>

               <div class="row">
                   <div class="col-md-3 " ></div>
                   <div class="col-md-7 " >
                           <br>
                           <div class="form-naranja text-center"><h4>{{trans('posadapraiso/pagina_restaurant.proximoseventos')}}</h4></div>  
                   </div>
               </div>

               <div class="row">
                   <div class="col-md-3 " ></div>
                   <div class="col-md-7 " >
                           <br>
                           <div class="form-naranja text-center "><h4>{{trans('posadapraiso/pagina_restaurant.recibirofertaspor')}} E-MAIL</h4></div>  
                   </div>
               </div>

                <div class="row">
                   <div class="col-md-3 " ></div>
                   <div class="col-md-7 " >
                           <br>
                           <div class="text-left">{{trans('posadapraiso/pagina_restaurant.mantenteinformado')}}</div> 
                           <div class="form-group">
                               {{Form::email('email',NULL,['class'=>'form-control','placeholder'=>'E-mail'])   }}
                           </div>
                   </div>
               </div>

            </div>
  </div>