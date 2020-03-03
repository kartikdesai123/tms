   <div class="col-xl-12">
      
            <article class="c-stage" id="stages">
                <a class="c-stage__header u-flex u-justify-between collapsed" data-toggle="collapse" href="#stage-work" aria-expanded="false" aria-controls="stage-panel1">
                    <div class="o-media">
                   
                        <div class="c-stage__header-title o-media__body">
                            <h6 class="u-mb-zero">{{ trans('customer.workplacedetail') }}</h6>
                            
                        </div>
                    </div>

                    <i class="fa fa-angle-down u-text-mute"></i>
                </a>

                <div class="c-stage__panel c-stage__panel--mute collapse" id="stage-work" >
                    <div class="u-p-medium">
                      
                        @foreach($workplace_customer as $value)
                        <p class="u-text-mute u-text-uppercase u-text-small u-mb-xsmall">{{ trans('customer.workplacedetail') }}</p>
                        <div class="row">
                            <div class="col-md-7">
                                <ul>
                                    <li class="u-mb-xsmall u-text-small u-color-primary">
                                        <i class="fa fa-check u-color-info u-text-mute u-mr-xsmall"></i>Workplace Name :- {{$value->workplaceName}}  
                                    </li>
                                   
                                    <li class="u-mb-xsmall u-text-small u-color-primary">
                                        <i class="fa fa-check u-color-info u-text-mute u-mr-xsmall"></i>{{ trans('customer.address') }}:-  {{$value->address}} 
                                    </li>
                                    <li class="u-mb-xsmall u-text-small u-color-primary">
                                        <i class="fa fa-check u-color-info u-text-mute u-mr-xsmall"></i>{{ trans('customer.state') }} :-  {{$value->state}} 
                                    </li>
                                    <li class="u-mb-xsmall u-text-small u-color-primary">
                                        <i class="fa fa-check u-color-info u-text-mute u-mr-xsmall"></i>{{ trans('customer.telephone') }} :-  {{$value->telephone}} 
                                    </li>
                                    <li class="u-mb-xsmall u-text-small u-color-primary">
                                        <i class="fa fa-check u-color-info u-text-mute u-mr-xsmall"></i>{{ trans('customer.fax') }} :-  {{$value->fax}} 
                                    </li>
                                    <li class="u-mb-xsmall u-text-small u-color-primary">
                                        <i class="fa fa-check u-color-info u-text-mute u-mr-xsmall"></i>{{ trans('customer.email') }} :-  {{$value->email}} 
                                    </li>
                                 
                                    <li class="u-mb-xsmall u-text-small u-color-primary">
                                        <i class="fa fa-check u-color-info u-text-mute u-mr-xsmall"></i>{{ trans('customer.responsibleworker') }}:-  {{$value->responsibleWorker}} 
                                    </li>
                                    <li class="u-mb-xsmall u-text-small u-color-primary">
                                        <i class="fa fa-check u-color-info u-text-mute u-mr-xsmall"></i>{{ trans('customer.note') }} :-  {{$value->note}} 
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
                @endforeach
                
                @php $i=1; @endphp
                @foreach($workplace_contact as $value)
              
                    <a class="c-stage__header u-flex u-justify-between" data-toggle="collapse" href="#stage-work-{{ $i }}" aria-expanded="false" aria-controls="stage-panel2">
                        <h6 class="u-text-mute u-text-uppercase u-text-small u-mb-zero">{{ trans('customer.contact') }}  @php echo $i;  @endphp</h6>

                        <i class="fa fa-angle-down u-text-mute"></i>
                    </a>

                    <div class="c-stage__panel c-stage__panel--mute collapse" id="stage-work-{{ $i }}">
                    <div class="u-p-medium">
                      <div class="col-md-7">
                                <ul>
                                    <li class="u-mb-xsmall u-text-small u-color-primary">
                                        <i class="fa fa-check u-color-info u-text-mute u-mr-xsmall"></i>{{ trans('customer.customername') }} :- {{$value->firstName}}  {{$value->lastName}} 
                                    </li>
                                    <li class="u-mb-xsmall u-text-small u-color-primary">
                                        <i class="fa fa-check u-color-info u-text-mute u-mr-xsmall"></i>{{ trans('customer.gender') }}:-  {{$value->gender}} 
                                    </li>
                                    <li class="u-mb-xsmall u-text-small u-color-primary">
                                        <i class="fa fa-check u-color-info u-text-mute u-mr-xsmall"></i>{{ trans('customer.telephone') }} :-  {{$value->telephone}} 
                                    </li>
                                 
                                    <li class="u-mb-xsmall u-text-small u-color-primary">
                                        <i class="fa fa-check u-color-info u-text-mute u-mr-xsmall"></i>{{ trans('customer.mobile') }} :-  {{$value->mobile}} 
                                    </li>
                                   
                                    <li class="u-mb-xsmall u-text-small u-color-primary">
                                        <i class="fa fa-check u-color-info u-text-mute u-mr-xsmall"></i>{{ trans('customer.fax') }} :-  {{$value->fax}} 
                                    </li>
                                    <li class="u-mb-xsmall u-text-small u-color-primary">
                                        <i class="fa fa-check u-color-info u-text-mute u-mr-xsmall"></i>{{ trans('customer.email') }} :-  {{$value->email}} 
                                    </li>
                                    
                                  
                                    <li class="u-mb-xsmall u-text-small u-color-primary">
                                        <i class="fa fa-check u-color-info u-text-mute u-mr-xsmall"></i>{{ trans('customer.note') }} :-  {{$value->note}} 
                                    </li>

                                </ul>
                            </div>


                    </div>   
                </div>
                @php $i++; @endphp
                @endforeach
               
             
            </article>


        </div>