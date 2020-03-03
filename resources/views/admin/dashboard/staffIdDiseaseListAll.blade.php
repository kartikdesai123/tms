        
            @if(count($countDisease) > 0)
                <div style="height:200px;overflow:scroll">
                    <div class="row appendDiv">
                    <div class="col-12" style="background-color: #eff3f6">
                        <div class="col-8 pull-left">
                            <span style="color: red">{{ trans('words.dash_name') }}</span>
                        </div>

                        <div class="col-4 pull-right">
                            <span style="color: red">{{ trans('words.dash_total_day') }}</span>
                        </div>
                    </div>
                    @foreach($countDisease as $key => $value)
                        <div class="col-12">
                            <div class="col-10 pull-left">
                                <span>{{ $value['name']." ".$value['surname']}}</span>
                            </div>

                            <div class="col-2 pull-right">
                                <span>{{ $value['total']}}</span>
                            </div>
                           <hr>  
                        </div>
                    @endforeach
                     </div>
                </div>
                @php
                $total = 0;
                    foreach($countDisease as $key => $value){
                        $total = $total + $value['total'];
                    }
                @endphp
                <div class="row">
                    <div class="col-12"><br>
                        <div class="pull-right">
                            <span><b>{{ trans('words.totalDays') }} : {{ $total }}</b></span>
                        </div>
                    </div>
                </div>
            @else
                <div style="height:100px;overflow:scroll">
                    <div class="row appendDiv">
                        <div class="col-12">
                            <center>
                                <div class="col-10 pull-left">
                                    <span class="text-danger">No Data Found</span>
                                </div>
                            </center>
                        </div> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-12"><br>
                        <div class="pull-right">
                            <span><b>{{ trans('words.totalDays') }} : 0 </b></span>
                        </div>
                    </div>
                </div>
            @endif
           
                      
            
                        