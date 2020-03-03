@extends('layouts.app')
@section('content')
@include('layouts.include.body_header')
<div class="container-fluid">
    <div class="row u-mb-large">
        <div class="col-12">
            <div class="c-tabs">
                <div class="c-tabs__content tab-content" id="nav-tabContent">
                    <div class="c-tabs__pane active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <form name="add-worker" id="addWorker" action="{{ route('worker-add') }}" method="post">
                            <div class="row">
                                <div class="col-lg-6">
                                    @php
                                    $count = 1;
                                    $oldstaffnumber = 0;
                                    @endphp
                                    @for($i = 0 ;$i < count($arrUser);$i++,$count++)
                                    <td class="c-table__cell">
                                        <input type="hidden" id="cstaffnumber" name="cstaffnumber" value="{{ $oldstaffnumber  = $arrUser[$i]->staffnumber  + 1}}" /></td>
                                    @endfor
                                    
                                    <div class="c-field u-mb-small">
                                        <h4>Working Details</h4>
                                    </div> 
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="staffnumber">{{ trans('words.staff-number') }}</label>   
                                        <input class="c-input" type="text" name="staffnumber" id="staffnumber" value="{{ $oldstaffnumber }}" placeholder="Enter Staffnumber" > 
                                    </div>  
                                    

                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="select3">{{ trans('words.Workplaces') }}</label>
                                         @php
                                        $count = 1;
                                        @endphp
                                        <!-- Select2 jquery plugin is used -->
                                        <select class="c-select c-select--multiple" id="select3" name="workplaces[]">
                                             @for($i = 0 ;$i < count($arrWorkplaces);$i++,$count++)
                                                <option value="{{ $arrWorkplaces[$i]->company }}">{{    $arrWorkplaces[$i]->company }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">{{ trans('words.position') }}</label>
                                        <select class="c-input" id="type" name="position">
                                                <option value="">Select worker's position</option>
                                                <option value="office">{{ trans('words.office') }}</option>
                                                <option value="cleaner">{{ trans('words.cleaner') }}</option>
                                                <option value="glasss">{{ trans('words.glasss') }}</option>
                                                <option value="intern">{{ trans('words.intern') }}</option>
                                        </select>
                                    </div>
                                    
                                    
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="weekHours">Weeks of hours</label>   
                                        <input class="c-input" type="text" name="weekHours" id="weekHours" placeholder="Enter Weeks of hours" > 
                                    </div>  
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="weekHours">Hourly wage</label>   
                                        <input class="c-input" type="text" name="hourlyWage" id="hourlyWage" placeholder="Enter Hourly wage" > 
                                    </div> 
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="weekHours">Fixed salary</label>   
                                        <input class="c-input" type="text" name="fixedSalary" id="fixedSalary" placeholder="Enter Fixed salary" > 
                                    </div> <br>
                                    <div class="c-field u-mb-small">
                                        <h4>Worker Details</h4>
                                    </div> 
                                    
                                    
                                    <div class="c-field u-mb-small">
                                        
                                    </div>
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="placeofBirth">Place of Birth</label>   
                                        <input class="c-input" type="text" name="placeofBirth" id="datepicker_search1" placeholder="Enter worker's place of birth" > 
                                    </div>
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="workPermitUp">Work permit up</label>   
                                        <input class="c-input" type="text" name="workPermitUp" id="datepicker_search2" placeholder="Enter worker's work permit up" > 
                                    </div>
                                    
                                    
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="mobile">Mobile</label>   
                                        <input class="c-input" type="text" name="mobile" id="mobile" placeholder="Enter worker's mobile" > 
                                    </div>
                                    
                                    <div class="c-field u-mb-small">
                                        
                                    </div>
                                     <br>
                                    <div class="c-field u-mb-small">
                                        <h4>Payment Details</h4>
                                    </div> 
                                     
                                     
                                </div>

                                <div class="col-lg-6">
                                    <div class="c-field u-mb-small">&nbsp;</div> 
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="weekHours">Hourly wage</label>   
                                        <input class="c-input" type="text" name="hourlyWage" id="hourlyWage" placeholder="Enter Hourly wage" > 
                                    </div> 
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="weekHours">Hourly wage</label>   
                                        <input class="c-input" type="text" name="hourlyWage" id="hourlyWage" placeholder="Enter Hourly wage" > 
                                    </div> 
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="weekHours">Holidays total days </label>   
                                        <input class="c-input" type="text" name="totalHolidays" id="totalHolidays" placeholder="Enter Holidays total days" > 
                                    </div> 
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="weekHours">Cancel to (date select) </label>   
                                        <input class="c-input" type="text" name="cancelDate" id="datepicker_search4" placeholder="Enter cancel date" > 
                                    </div> 
                                    <br>
                                    <div class="c-field u-mb-small">&nbsp;</div> 
                                    
                                    <div class="c-field u-mb-small">
                                        
                                    </div>
                                    
                                    <div class="c-field u-mb-small">
                                        
                                    </div>
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="nationality">Nationality</label>   
                                        <input class="c-input" type="text" name="nationality" id="nationality" placeholder="Enter worker's nationality" > 
                                    </div>
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="residencePermit">Residence permit</label>   
                                        <input class="c-input" type="text" name="residencePermit" id="residencePermit" placeholder="Enter worker's residence permit" > 
                                    </div>
                                    
                                    
                                    
                                     
                                    
                                    <div class="c-field u-mb-small">
                                        
                                    </div>
                                     <div class="c-field u-mb-small">&nbsp;</div> 
                                        <br> <br>
                                        
                                    <div class="c-field u-mb-small">&nbsp;</div> <div class="c-field u-mb-small">&nbsp;</div> 
                                    
                                    
                                    
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="col u-mb-medium">
                                        <input type="submit" class="c-btn c-btn--info c-btn--fullwidth" value="{{ trans('words.add') }}">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- // .col-12 -->
    </div>
</div><!-- // .container -->
<style>
    input.has-error {
        border-color: red;
    }
    
    select.has-error {
        border-color: red;
    }
</style>
@endsection
