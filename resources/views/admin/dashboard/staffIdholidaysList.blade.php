                        <div style="height:200px;overflow:scroll">
                            <div class="row"> 
                            <div class="col-12" style="background-color: #eff3f6">
                                <div class="col-8 pull-left">
                                    <span style="color: red">{{ trans('words.dash_name') }}</span>
                                </div>

                                <div class="col-4 pull-right">
                                    <span style="color: red">{{ trans('words.dash_total_day') }}</span>
                                </div>


                            </div> 
                            <div class="col-12">
                                <div class="col-8 pull-left">
                                    <span>{{ trans('words.jan') }}</span>
                                </div>

                                <div class="col-4 pull-right">
                                    <span>{{ $resultList[0] }}</span>
                                </div>
                               <hr>  
                            </div>

                            <div class="col-12">
                                <div class="col-8 pull-left">
                                    <span>{{ trans('words.feb') }}</span>
                                </div>

                                <div class="col-4 pull-right">
                                    <span>{{ $resultList[1] }}</span>
                                </div>
                               <hr>  
                            </div>

                            <div class="col-12">
                                <div class="col-8 pull-left">
                                    <span>{{ trans('words.mar') }}</span>
                                </div>

                                <div class="col-4 pull-right">
                                    <span>{{ $resultList[2] }}</span>
                                </div>
                               <hr>  
                            </div>
                            
                                                        
                            <div class="col-12">
                                <div class="col-8 pull-left">
                                    <span>{{ trans('words.apr') }}</span>
                                </div>

                                <div class="col-4 pull-right">
                                    <span>{{ $resultList[3] }}</span>
                                </div>
                               <hr>  
                            </div>

                            <div class="col-12">
                                <div class="col-8 pull-left">
                                    <span>{{ trans('words.may') }}</span>
                                </div>

                                <div class="col-4 pull-right">
                                    <span>{{ $resultList[4] }}</span>
                                </div>
                               <hr>  
                            </div>

                            <div class="col-12">
                                <div class="col-8 pull-left">
                                    <span>{{ trans('words.jun') }}</span>
                                </div>

                                <div class="col-4 pull-right">
                                    <span>{{ $resultList[5] }}</span>
                                </div>
                               <hr>  
                            </div>

                            
                                                        
                            <div class="col-12">
                                <div class="col-8 pull-left">
                                    <span>{{ trans('words.july') }}</span>
                                </div>

                                <div class="col-4 pull-right">
                                    <span>{{ $resultList[6] }}</span>
                                </div>
                               <hr>  
                            </div>

                            <div class="col-12">
                                <div class="col-8 pull-left">
                                    <span>{{ trans('words.aug') }}</span>
                                </div>

                                <div class="col-4 pull-right">
                                    <span>{{ $resultList[7] }}</span>
                                </div>
                               <hr>  
                            </div>

                            <div class="col-12">
                                <div class="col-8 pull-left">
                                    <span>{{ trans('words.sep') }}</span>
                                </div>

                                <div class="col-4 pull-right">
                                    <span>{{ $resultList[8] }}</span>
                                </div>
                               <hr>  
                            </div>

                                                        
                            <div class="col-12">
                                <div class="col-8 pull-left">
                                    <span>{{ trans('words.oct') }}</span>
                                </div>

                                <div class="col-4 pull-right">
                                    <span>{{ $resultList[9] }}</span>
                                </div>
                               <hr>  
                            </div>

                            <div class="col-12">
                                <div class="col-8 pull-left">
                                    <span>{{ trans('words.nov') }}</span>
                                </div>

                                <div class="col-4 pull-right">
                                    <span>{{ $resultList[10] }}</span>
                                </div>
                               <hr>  
                            </div>

                            <div class="col-12">
                                <div class="col-8 pull-left">
                                    <span>{{ trans('words.dec') }}</span>
                                </div>

                                <div class="col-4 pull-right">
                                    <span>{{ $resultList[11] }}</span>
                                </div>
                               <hr>  
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12"><br>
                            <div class="pull-right">
                                <span><b>{{ trans('words.totalDays') }} : {{ array_sum ($resultList) }}</b></span>
                            </div>
                        </div>
                    </div>
                            