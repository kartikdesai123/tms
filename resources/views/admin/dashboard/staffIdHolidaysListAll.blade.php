        
            @if(count($countDisease) > 0)
                <div style="height:200px;overflow:scroll">
                    <div class="row appendDiv">
                      <div class="col-12" style="background-color: #eff3f6">
                            <div class="col-6 pull-left">
                                <span style="color: red">{{ trans('words.dash_name') }}</span>
                            </div>

                            <div class="col-2 pull-right">
                                <span style="color: red">{{ trans('words.dash_taken') }}</span>
                            </div>

                            <div class="col-2 pull-right">
                                <span style="color: red">{{ trans('words.dash_remained') }}</span>
                            </div>

                            <div class="col-2 pull-right">
                                <span style="color: red">{{ trans('words.dash_total_day') }}</span>
                            </div>

                        </div>   
                    @foreach($countDisease as $key => $value)
                        <div class="col-12">
                                        <div class="col-6 pull-left">
                                            <span>{{ $value['name']." ".$value['surname']}}</span>
                                        </div>

                                        <div class="col-2 pull-right">
                                            @if($value['totalHolidays'] == NULL || $value['totalHolidays'] == '')
                                                <span>0</span>
                                            @else
                                                <span>{{ $value['totalHolidays'] }}</span>
                                            @endif
                                        </div>
                                        
                                        <div class="col-2 pull-right">
                                            <span>{{ $value['totalHolidays'] - $value['total']}}</span>
                                        </div>
                                        
                                        <div class="col-2 pull-right">
                                            <span>{{ $value['total']}}</span>
                                        </div>
                                       <hr>  
                                    </div>
                    @endforeach
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
           