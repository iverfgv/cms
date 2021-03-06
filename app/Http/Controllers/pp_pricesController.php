<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Carbon\Carbon;

class pp_pricesController extends Controller
{
    public $fechaActaul;
    public function __construct()
    {
         $this->middleware('auth');
         $this->fechaActaul=date('Y-m-d');
         
         //$this->fechaActaul="2016-05-03";
         /*$this->fechaAnterior="2016-04-10";
        $this->fechaAnterior=;

         $date=new Carbon();
         $date=$date->format('Y-m-d');

         if($date > $this->fechaAnterior)
            echo "<script>alert('".$date."')</script>";
         else
            echo "<script>alert('".$this->fechaAnterior."')</script>";*/
    }  
    
  public function index()
  {
         
         $flag='1'; 
         $id_activePrice="";
         $activePrice=null;
         $activePrice=$this->getObjectPriceActive();/*Obtengo el precio activo*/

         if($activePrice!="") 
         	 $id_activePrice=$activePrice->id;

         $prices =  DB::table('pp_prices')/*Obtengo la lista de precios */
         ->where('active','=', $flag)//exepto las eliminadas
         ->where('id','!=',$id_activePrice)//(exepto la activa)
         ->orderBy('date_start','DESC')->paginate(20);

         return view('prices/index',['prices'=>$prices,'activePrice'=>$activePrice ]);
  }

  
  public function create(){
    return view('prices/pricesform');
  }


  public function store(Request $request){
        $active='1';
        $ChekPubli='0';
        if($request ['ChekPublicar']== 'on')
        {
        	//if($this->aprovNewPriceActive()==true)
            //   { 
                $ChekPubli='1';
               // Session::flash('message','Registro Guardado Correctamente');    
            //   }
            // else {
            // 	Session::flash('message','Registro Guardado,Pero no se puede establecer como precio actual');    
            // }

        }
        else{
        	 //Session::flash('message','Registro Guardado Correctamente'); 
        }
      
      if($request['date_start']>=$this->fechaActaul)
      { \App\pp_prices::create([
      'title'=>$request['title'],
      'price'=>$request['price'],
      'date_start'=>$request['date_start'],
      'date_end'=>$request['date_end'],
      'active'=>$active,
      'active_price'=>$ChekPubli,
      ]);
      Session::flash('message','Registro Guardado Correctamente'); 
      }
      else
        Session::flash('message','Error.No se ha podido guardar porque la Fecha de inicio ya ha pasado.'); 

      return redirect('/admin/prices');

  }

  public function edit($id){
      $language = \App\cms_prices::find($id);
      return view('prices/pricesform')->with('price',$price);
      }

  public function update($id,Request $request){
    $menu = \App\pp_prices::find($id);
    $menu->fill($request->all());   
    $menu->save();   
    return redirect('/admin/prices')->with('message','Precio Actualizado Correctamente');
  }

  public function destroy($id){
    $language = \App\pp_prices::find($id);
    $language->active=0;
    $language->save(); 
    return redirect('/admin/prices')->with('message','Precio Eliminado');
  }
   
  public function getObjectPriceActive(){
     $flag='1'; 

     $activePrice=null;
          $activePrice=DB::table('pp_prices')
         ->where('active','=', $flag)
         ->where('date_start','<=',$this->fechaActaul)
         ->where('date_end','>=',$this->fechaActaul)
         ->where('active_price','=',1)
         ->orderBy('id','DESC')
         ->first();
         if($activePrice!=null) 
           {
            $activePrice; 
           }
          else {
            $activePrice="";
          }
  
     return $activePrice; 
    }

   public function getPriceActive(){
     $prices=0;
     $activePrice=$this->getObjectPriceActive();

         if($activePrice!="") 
            $price= $activePrice->price; 
          else 
            $price=0;
          
     return $price;
     }
    
    public function getIdPriceActive(){
     $id_activePrice=0;
     $activePrice=$this->getObjectPriceActive();

      if($activePrice!="") 
        $id_activePrice= $activePrice->id;
      else 
          $id_activePrice=0;

     return $id_activePrice; 
    }


    public function publish($id){

       $price = \App\pp_prices::find($id);
      

          if($price->active_price==0)//Si no esta publicado.
            { 

              if($this->aprovNewPriceActive($price->date_start,$price->date_end)==true)
                  {
                  $objPriceActive= $this->getObjectPriceActive();
                  if($objPriceActive!=null); //si hay un precio activo
                     {if($this->checkPriceHasChildInReservation($objPriceActive->id)==false)//si no han habido ventas
                        {$price->active_price=1;//Se cambia a publicado para que lo tome en cuenta el metodo getObjectPriceActive().
                        $price->save();
                        Session::flash('message','Publicado correctamente.');
                        }
                      else
                         Session::flash('message','No se puede cambiar el precio actual(Ya han habido ventas).'); 
                     }
                 }
            }
           
            else//Si ya esta publicado
            {
               Session::flash('message','Ya esta publicado.'); 
            }
       
            
       
       return redirect('/admin/prices');      
    }

    public function checkPriceHasChildInReservation($id_price){//solo para actualizar
       $num_rows=DB::table('pp_reservation')->where('id_price','=',$id_price)->count();
       if($num_rows>0)
         return  true;
       else
        return false;
    }

    public function aprovNewPriceActive($dateStart,$dateEnd){
         
         //valida que todavia no haya llegado la fecha de finalizcion
        if($dateEnd >= $this->fechaActaul)
           {
            //aprobar que no haya una fecha mayor
           $objPriceActive= $this->getObjectPriceActive();
           if($objPriceActive!=null);
               {
                if($objPriceActive->date_end > $dateStart)
                  {
                  Session::flash('message','Esta fecha no ha llegado aún.El sistema la activara automaticamente.');
                  }
                else
                   {return false; }
               }
           }

        else
           { 
           Session::flash('message','la fecha de finalización ya ha pasado.'); 
           return false;
           }
  
         return true;
  }
}
