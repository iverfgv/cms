@extends('layouts.app')
@section('content')

@if(Session::has('message'))
<div class="alert alert-success alert-dismissible" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
  {{Session::get('message')}}
</div>
@endif

@section('content')
<div class="container-fluid">
<div class="row">
	<br>
	<div class="col-md-8">
	<h3>Precios para las reservaciones en linea </h3>
	</div> <!--divide la columna en 10 y 2-->
	<div class="col-md-2 text-right">	
 	  <!-- {!! link_to('admin/menus', 'Menús',array('class'=>'btn btn-info')) !!}-->
	</div>
	<div class="col-md-2">
 	{!!Form::open()!!}
       {!! link_to('admin/prices/create', 'Registrar precio',array('class'=>'btn btn-success')) !!}
    {!!Form::close()!!}
	</div>
</div>
<div class="row text-center">
	<!--$languages->render()-->
</div>
	<div class="row">
	    <table class="table table-responsive table-hover"> 
		  <thead class="center-text">
			<th class="ColumColor">ID</th>
			<th class="ColumColor">Titulo</th>	
			<th class="ColumColor">Precio</th>
			<th class="ColumColor">Fecha de inicio</th>
			<th class="ColumColor">Fecha de finalización</th>
			<th class="ColumColor">Activo</th>
			<!--<th class="ColumColor">Status</th>-->
			<th class="ColumColor">Acciones</th>
		  </thead>
		  @if($activePrice!=null)
      
              <tr>
				<td> {{$activePrice->id}}</td>
				<td> {{$activePrice->title}}</td>
				<td> {{$activePrice->price}}</td>											
			    <td> {{$activePrice->date_start}}</td>
			    <td> {{$activePrice->date_end}}</td>
			    <td>
                    <span class=" glyphicon glyphicon-ok" style="color:blue"></span>
 			    </td>
			    
			    <td>
					{!! link_to('admin/prices/'.$activePrice->id.'/destroy', '',array('class'=>'img-responsive btn btn-danger glyphicon glyphicon-trash')) !!}
				</td> 
			</tr>
		  @else
		      <span style="color:red">No se ha etablecido un precio actual para las reservaciones </span>
		  @endif

		  @foreach($prices as $price)
			<tr>
				<td> {{$price->id}}</td>
				<td> {{$price->title}}</td>
				<td> {{$price->price}}</td>											
			    <td> {{$price->date_start}}</td>
			    <td> {{$price->date_end}}</td>
			    <td>
                      @if($price->active_price==0) <!--si no esta publicado-->
                         {!! link_to('admin/prices/'.$price->id.'/publish', '',array('class'=>'text-danger glyphicon glyphicon-ban-circle')) !!}
 			          @else
 			             <span  class="glyphicon glyphicon-ban-circle" ></span>
 			          @endif
 			    </td>
			    
			    <td>
					{!! link_to('admin/prices/'.$price->id.'/destroy', '',array('class'=>'img-responsive btn btn-danger glyphicon glyphicon-trash')) !!}
				</td> 
			</tr>
		  @endforeach
		</table>
	</div>
	<div class="row text-center">
		{{$prices->render()}}
		
	</div>
</div>
@stop