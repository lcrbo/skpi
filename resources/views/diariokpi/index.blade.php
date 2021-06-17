<x-master-layout> 


    <x-slot name="slot">

    <!-- TITULO -->

    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-3">
            <div class="col-sm-6" >
              <ol class="breadcrumb float-sm-left">
              <li ><h1 class="m-0">{{$kpi->nombre}}  </h1></li>
                <li ><small class="small-box-footer">&nbsp;&nbsp;&nbsp;  [ Última Actualización {{ date("d-m-Y", strtotime($ultimoFecha)) }}  {{ date("H:i A", strtotime($ultimoHora)) }} ] </small></li> 
              </ol>
           </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">{{$kpi->nombre}} </li>  
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    

<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Detalle {{$kpi->nombre}} {{$lformato}} del dia {{ date("d-m-Y", strtotime($ultimoFecha)) }}  a las {{ date("H:i", strtotime($ultimoHora)) }} hrs.  </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">



              <div class="float-right">

              <div class="row">
                <div class="col-lg-6">
                  <form action="{{ route('diariokpis.index',[ 'kpiid'=>$kpi->id , 'formato'=>$kpi->formato]) }}" method="GET" class="navbar-form navbar-left" role="search">
                  <div class="input-group small">
                      <input class="form-check-input input-sm" style="display:none;"  type="radio" name="formato" checked
                            <?php if (isset($formato) && $formato=="{{$lformato}}") echo "checked";?>
                            value="{{$lformato}}">
                            <input name="umbralCritico" style="display:none;" class="form-check-input input-sm" value="{{$kpi->umbral2}}" type="checkbox" checked >
                            <input name="umbralMedio" style="display:none;"  class="form-check-input input-sm" value="{{$kpi->umbral3}}" type="checkbox"  checked >
                            <input name="umbralBajo" style="display:none;"  class="form-check-input input-sm" value="{{$kpi->umbral3}}" type="checkbox" checked >
                      <input name="local" type="text" class="form-control input-sm" placeholder="busqueda"> 
                      <!-- <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                      <i class="fas fa-search"></i>
                      </button> -->
                      <div class="input-group-append">
                                <button type="submit" class="btn btn-default btn-sm">
                                    <i class="fa fa-search"></i>
                                </button>
                      </div>
                    </div>
                    
                  </form>
                </div>  
                <div class="col-lg-6 ">
                  <a class="btn btn-success btn-sm" href="{{ route('kpi',$kpi->id) }}" role="button">
                  <i class="fas fa-arrow-left"></i>
                  Volver</a>
                </div>
              </div>

              </div>
                <table id="diariocontrolxxxx" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    
                    <th>Tienda</th>
                    <th>KPi (Último)</th>
       
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($diariokpis as $diariokpi)
                    <tr>
                    @if ( $diariokpi->valor   < $kpi->umbral2 )
                        
                        <td>
                        <a href="{{ route('diariokpis.modal', [ 'kpiid'=>$diariokpi->indicadorkpi_id , 'formato'=>$diariokpi->formato , 'local'=>$diariokpi->local ] ) }}" > {{ $diariokpi->local }} </a>
                        </td>
                        <td>
                          <span class="badge badge-danger">{{ $diariokpi->valor }} {{ $kpi->formato }}</span>
                          <div class="progress progress-sm" style="height:5px">
                            <div class="progress-bar bg-danger" style="width: {{ $diariokpi->valor }}{{ $kpi->formato }}"></div>
                          </div>
                        </td> 
                        
                        
                    @elseif (( $diariokpi->valor  >= $kpi->umbral2) && ( $diariokpi->valor   < $kpi->umbral3))
                        
                        
                        <td >
                        <a href="{{ route('diariokpis.modal', [ 'kpiid'=>$diariokpi->indicadorkpi_id , 'formato'=>$diariokpi->formato , 'local'=>$diariokpi->local ] ) }}" > {{ $diariokpi->local }} </a>
                        </td>
                        <td>
                          <span class=" bg-warning">{{ $diariokpi->valor }} {{ $kpi->formato }}</span>
                          <div class="progress progress-xs" style="height:5px">
                            <div class="progress-bar bg-warning" style="width: {{ $diariokpi->valor }}{{ $kpi->formato }}"></div>
                          </div>
                        </td> 
                        

                    @elseif ( $diariokpi->valor  >= $kpi->umbral3)
                        
                        
                        <td >
                        <a href="{{ route('diariokpis.modal', [ 'kpiid'=>$diariokpi->indicadorkpi_id , 'formato'=>$diariokpi->formato , 'local'=>$diariokpi->local ] ) }}" > {{ $diariokpi->local }} </a>
                        </td>
                        <td>
                          <span class=" bg-success">{{ $diariokpi->valor }} {{ $kpi->formato }}</span>
                          <div class="progress progress-xs" style="height:5px">
                            <div class="progress-bar bg-success" style="width: {{ $diariokpi->valor }}{{ $kpi->formato }}"></div>
                          </div>
                        </td>  
                           
                    @endif
                    </tr>
                @endforeach
                  

                  </tbody>
                  <tfoot>

                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            
            <!-- /.card -->
          </div>
          {!! $diariokpis->appends(request()->all())->links('pagination') !!}
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->

 

    </section>
    <!-- /.content -->





  </x-slot> 
</x-master-layout>

