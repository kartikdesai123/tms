@extends('layouts.app')
@section('content')
@include('layouts.include.body_header')
@php
$arrayCountry = ['ägyptisch','äquatorialguineisch','äthiopisch','afghanisch','albanisch','algerisch','andorranisch','angolanisch','antiguanisch','argentinisch','armenisch','aserbaidschanisch','australisch','bahamaisch','bahrainisch','bangladeschisch','barbadisch','belgisch','belizisch','beninisch','bhutanisch','bolivianisch','bosnisch-herzegowinisch','botsuanisch','brasilianisch','bruneiisch','bulgarisch','burkinisch','burundisch','cabo-verdisch','chilenisch','neuseeländisch','costa-ricanisch','ivorisch','dänisch','deutsch','dominicanisch','dschibutisch','ecuadorianisch','salvadorianisch','eritreisch','estnisch','fidschianisch','finnisch','französisch','gabunisch','gambisch','georgisch','ghanaisch','grenadisch','griechisch','guatemaltekisch','guineisch','guinea-bissauisch','guyanisch','haitianisch','honduranisch','indisch','indonesisch','irakisch','iranisch','irisch','isländisch','israelisch','italienisch','jamaikanisch','japanisch','jemenitisch','jordanisch','jugoslawisch','kambodschanisch','kamerunisch','kanadisch','kasachisch','katarisch','kenianisch','kirgisisch','kiribatisch','kolumbianisch','komorisch','kongolesisch','kosovarisch','kroatisch','kubanisch','kuwaitisch','laotisch','lesothisch','lettisch','libanesisch','liberianisch','libysch','liechtensteinisch','litauisch','luxemburgisch','madagassisch','malawisch','malaysisch','maledivisch','malisch','maltesisch','marokkanisch','marshallisch','mauretanisch','mauritisch','mazedonisch','mexikanisch','mikronesisch','moldauisch','monegassisch','mongolisch','montenegrinisch','mosambikanisch','myanmarisch','namibisch','nauruisch','nepalesisch','neuseeländisch','nicaraguanisch','niederländisch','nigrisch','nigerianisch','norwegisch','österreichisch','omanisch','pakistanisch','palauisch','panamaisch','papua-neuguineisch','paraguayisch','peruanisch','philippinisch','polnisch','portugiesisch','ruandisch','rumänisch','russisch','salomonisch','sambisch','samoanisch','san-marinesisch','santomeisch','saudi-arabisch','schwedisch','schweizerisch','senegalesisch','serbisch','serbisch-montenegrinisch','seychellisch','sierra-leonisch','simbabwisch','singapurisch','slowakisch','slowenisch','somalisch','sowjetisch','spanisch','sri-lankisch','lucianisch','vincentisch','südafrikanisch','sudanesisch','südsudanesisch','surinamisch','swasiländisch','syrisch','tadschikisch','taiwanisch','tansanisch','thailändisch','togoisch','tongaisch','tschadisch','tschechisch','tschechoslowakisch','türkisch','tunesisch','turkmenisch','tuvaluisch','ugandisch','ukrainisch','ungarisch','uruguayisch','usbekisch','vanuatuisch','vatikanisch','venezolanisch','amerikanisch','britisch','vietnamesisch','weißrussisch','zentralafrikanisch','zyprisch'];
@endphp
<div class="container-fluid">
    <div class="row u-mb-large">
        <div class="col-12">
            <div class="c-tabs">
                <div class="c-tabs__content tab-content" id="nav-tabContent">
                    <div class="c-tabs__pane active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <form name="edit-worker" id="editWorker"  method="post">
                            <div class="row">
                                <div class="col-lg-6">
                                    @php
                                    $count = 1;
                                    $oldstaffnumber = 0;
                                    @endphp
                                   <input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"> 
                                   <input class="c-input" type="hidden" name="id" id="id" value="{{ $workerDetail[0]->userId }}"> 
                                   <input class="c-input" type="hidden" name="staffnumber" id="staffnumber" value="{{ $workerDetail[0]->userstaffnumber }}"> 
                                    <div class="c-field u-mb-small">
                                        <h4>{{ trans('words.workerData') }}</h4>
                                        <hr>
                                    </div> 
                                     <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="staffnumber">{{ trans('words.staff-number') }}</label>   
                                        <input class="c-input" type="text" name="staffnumber_edit" id="staffnumber" value="{{ $workerDetail[0]->userstaffnumber }}"  disabled> 
                                    </div>  
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">{{ trans('words.member') }}</label>
                                        <select class="c-input" id="type" name="type">
                                                <option value="">Select user type</option>
                                                <option @if($workerDetail[0]['usertype'] == 'WORKER') selected="selected" @endif value="WORKER">{{ trans('words.wo-worker') }}</option>
                                                <option @if($workerDetail[0]['usertype'] == 'ADMIN') selected="selected" @endif  value="ADMIN">{{ trans('words.administrator') }}</option>
                                                <option @if($workerDetail[0]['usertype'] == 'SUPERVISOR') selected="selected" @endif value="SUPERVISOR">{{ trans('words.supervisior') }}</option>
                                        </select>
                                        
                                    </div>
                                    

                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="select3">{{ trans('words.Workplaces') }}</label>
                                        @php
                                        $count = 1;
                                        @endphp

                                        @php
                                        $array_workplaces = array();
                                        $array_workplaces = explode(',',$workerDetail[0]['userworkplaces']);
                                        @endphp

                                        <!-- Select2 jquery plugin is used -->

                                        <select class="c-select c-select--multiple" multiple="multiple" name="workplaces[]" id="places">
                                            @foreach($arrWorkplaces as $place)
                                                <option value="{{$place->company}}" @foreach($array_workplaces as $p) @if($place->company == $p)selected="selected"@endif @endforeach>{{$place->company}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <br>
                                    <div class="c-field u-mb-small">
                                        <h4>{{ trans('words.contract') }}</h4>
                                        <hr>
                                    </div>
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">{{ trans('words.position') }}</label>
                                        <select class="c-input" id="type" name="position">
                                                <option value="">{{ trans('words.pleaseSelect') }}</option>
                                                <option value="office" {{ ($workerDetail[0]['position'] == 'office' ? 'selected="selected"' : '') }}>{{ trans('words.office') }}</option>
                                                <option value="cleaner" {{ ($workerDetail[0]['position'] == 'cleaner' ? 'selected="selected"' : '') }}>{{ trans('words.cleaner') }}</option>
                                                <option value="glasss" {{ ($workerDetail[0]['position'] == 'glasss' ? 'selected="selected"' : '') }}>{{ trans('words.glasss') }}</option>
                                                <option value="intern" {{ ($workerDetail[0]['position'] == 'intern' ? 'selected="selected"' : '') }}>{{ trans('words.intern') }}</option>
                                        </select>
                                    </div>
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">{{ trans('words.employment') }}</label>
                                        <select class="c-input" id="type" name="employment">
                                                <option value="">{{ trans('words.pleaseSelect') }}</option>
                                                <option value="minijob" {{ ($workerDetail[0]['employment'] == 'minijob' ? 'selected="selected"' : '') }}>{{ trans('words.minijob') }}</option>
                                                <option value="part" {{ ($workerDetail[0]['employment'] == 'part' ? 'selected="selected"' : '') }}>{{ trans('words.part') }}</option>
                                                <option value="full" {{ ($workerDetail[0]['employment'] == 'full' ? 'selected="selected"' : '') }}>{{ trans('words.full') }}</option>
                                        </select>
                                    </div>
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="startContract">{{ trans('words.startOfContract') }}</label>   
                                        <input class="c-input" type="text" name="startContract" id="startContract_edit"  value="{{ date("d.m.Y",strtotime($workerDetail[0]->startContract)) }}"  > 
                                    </div>  
                                    
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="staffnumber">{{ trans('words.endOfContract') }}</label>   
                                        <input class="c-input" type="text" name="endContract" id="endContract_edit"  value="{{ date("d.m.Y",strtotime($workerDetail[0]->endContract)) }}"> 
                                    </div>
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="weekHours">{{ trans('words.weekOfHours') }}</label>   
                                        <input class="c-input" type="text" name="weekHours" id="weekHours"  value="{{ $workerDetail[0]->weekHours }}"> 
                                    </div> 
                                    
                                    <div class="c-field u-mb-small">
                                        <div class="row">
                                            <div class="col-6">
                                                <input type="radio" name="workType" value="hourly" {{ ($workerDetail[0]['workType'] == 'hourly' ? 'checked' : '') }}>{{ trans('words.hourlyWage') }}
                                                 <input class="c-input" type="text" name="hourly" id="hourly"  value="{{ ($workerDetail[0]['workType'] == 'hourly' ? $workerDetail[0]['wage'] : '') }}"> 
                                            </div>
                                            
                                            <div class="col-6">
                                                <input type="radio" name="workType" value="fixed" {{ ($workerDetail[0]['workType'] == 'fixed' ? 'checked' : '') }}> {{ trans('words.fixedSalary') }}
                                                <input class="c-input" type="text" name="fixed" id="fixed"   value="{{ ($workerDetail[0]['workType'] == 'fixed' ? $workerDetail[0]['wage'] : '') }}"> 
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="weekHours">{{ trans('words.totalHolidyas') }} </label>   
                                        <input class="c-input" type="text" name="totalHolidays" id="totalHolidays"  value="{{ $workerDetail[0]['totalHolidays']}}"> 
                                    </div> 
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="weekHours">{{ trans('words.cancelContral') }} </label>   
                                        <input class="c-input" type="text" name="cancelDate" id="cancelDate_edit"  value="{{ date("d.m.Y",strtotime($workerDetail[0]->cancelDate)) }}"> 
                                    </div> 
                                </div>
                               
                                <div class="col-lg-6">
                                    <div class="c-field u-mb-small">
                                        <h4>{{ trans('words.personalData') }}</h4>
                                        <hr>
                                    </div> 
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="gender">{{ trans('words.gender') }}</label>
                                        <select class="c-input" id="type" name="gender">
                                                <option value="">{{ trans('words.pleaseSelect') }}</option>
                                                <option value="Male" {{ ($workerDetail[0]['gender'] == 'Male' ? 'selected="selected"' : '') }}>Male</option>
                                                <option value="Female" {{ ($workerDetail[0]['gender'] == 'Female' ? 'selected="selected"' : '') }}>Female</option>
                                        </select>
                                    </div>
                                    <div class="c-field u-mb-small">
                                       <div class="row">
                                           <div class="col-6">
                                               <label class="c-field__label" for="firstName">{{ trans('words.firstName') }}</label>   
                                               <input class="c-input" type="text" name="firstName" id="firstName"  value="{{ $workerDetail[0]['name']}}"> 
                                           </div>

                                           <div class="col-6">
                                               <label class="c-field__label" for="surname">{{ trans('words.surName') }}</label>   
                                               <input class="c-input" type="text" name="surname" id="surname"  value="{{ $workerDetail[0]['surname']}}"> 
                                           </div>

                                       </div>
                                    </div>
                                    
                                    <div class="c-field u-mb-small">
                                        <div class="row">
                                            <div class="col-6">
                                                <label class="c-field__label" for="dateofBirth">{{ trans('words.dob') }}</label>   
                                                <input class="c-input" type="text" name="dateofBirth" id="dateofBirth"  value="{{ date("d.m.Y",strtotime($workerDetail[0]->dateofBirth)) }}"> 
                                            </div>
                                            
                                            <div class="col-6">
                                                <label class="c-field__label" for="placeofBirth">{{ trans('words.placeOfBirth') }}</label>   
                                                <input class="c-input" type="text" name="placeofBirth" id="placeofBirth"  value="{{ $workerDetail[0]['placeofBirth']}}"> 
                                            </div>
                                            
                                        </div>
                                     </div>
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="nationality">{{ trans('words.nationality') }}</label>
                                        <select class="c-input" id="type" name="nationality">
                                            <option value="">{{ trans('words.pleaseSelect') }}</option>
                                            
                                                @for($i = 0 ;$i < count($arrayCountry) ; $i++)
                                                    <option value="{{ $arrayCountry[$i] }}"  {{ ($workerDetail[0]['nationality'] == $arrayCountry[$i] ? 'selected="selected"' : '') }}>{{ $arrayCountry[$i] }}</option>
                                                @endfor
                                        </select>
                                    </div>    
                                    <div class="c-field u-mb-small">
                                        <div class="row">
                                            <div class="col-6">
                                                <label class="c-field__label" for="workPermit">{{ trans('words.workpermit') }}</label>   
                                                <input class="c-input" type="text" name="workPermit" id="workPermit_edit"  value="{{ date("d.m.Y",strtotime($workerDetail[0]->workPermit)) }}"> 
                                            </div>
                                            
                                            <div class="col-6">
                                                <label class="c-field__label" for="residencePermit">{{ trans('words.resideancePermit') }}</label>   
                                                <input class="c-input" type="text" name="residencePermit" id="residencePermit_edit"  value="{{ date("d.m.Y",strtotime($workerDetail[0]->residencePermit)) }}"> 
                                            </div>
                                            
                                        </div>
                                     </div>
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="workPermitUp">{{ trans('words.taxIdNumber') }}</label>   
                                        <input class="c-input" type="text" name="taxId" id="taxId"  value="{{ $workerDetail[0]['taxId']}}"> 
                                    </div>
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="socialSecurityNumber">{{ trans('words.socialSecurityNumber') }}</label>   
                                        <input class="c-input" type="text" name="socialSecurityNumber" id="socialSecurityNumber"  value="{{ $workerDetail[0]['socialSecurityNumber']}}"> 
                                    </div>
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="email">{{ trans('words.email') }}</label>   
                                        <input class="c-input" type="text" name="email" id="email"  value="{{ $workerDetail[0]['email']}}"> 
                                    </div>
                                    
                                    
                                    
                                    <div class="c-field u-mb-small">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="c-field u-mb-small">
                                                    <label class="c-field__label" for="phoneNumber">{{ trans('words.phoneNumber') }}</label>   
                                                    <input class="c-input" type="text" name="phoneNumber" id="phoneNumber"  value="{{ $workerDetail[0]['phoneNumber']}}"> 
                                                </div>
                                            </div>
                                            
                                            <div class="col-6">
                                                <label class="c-field__label" for="mobile">{{ trans('words.mobile') }}</label>   
                                                <input class="c-input" type="text" name="mobile" id="mobile"  value="{{ $workerDetail[0]['mobile']}}"> 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="c-field u-mb-small">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="c-field u-mb-small">
                                                    <label class="c-field__label" for="adresses">{{ trans('words.addresses') }}</label>   
                                                    <input class="c-input" type="text" name="adresses" id="adresses"  value="{{ $workerDetail[0]['adresses']}}"> 
                                                </div>
                                            </div>
                                            
                                            <div class="col-6">
                                                <label class="c-field__label" for="postcodeCity">{{ trans('words.postCode') }}</label>   
                                                <input class="c-input" type="text" name="postcodeCity" id="postcodeCity"  value="{{ $workerDetail[0]['postcodeCity']}}"> 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="c-field u-mb-small">
                                        <h4>{{ trans('words.paymentDetails') }}</h4>
                                        <hr>
                                    </div> 
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="name">{{ trans('words.name') }}</label>   
                                        <input class="c-input" type="text" name="name" id="name"  value="{{ $workerDetail[0]['holderName']}}" > 
                                    </div>
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="bankName">{{ trans('words.bankName') }}</label>   
                                        <input class="c-input" type="text" name="bankName" id="bankName"   value="{{ $workerDetail[0]['bankName']}}"> 
                                    </div>
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="iban">{{ trans('words.IBAN') }}</label>   
                                        <input class="c-input" type="text" name="iban" id="iban"   value="{{ $workerDetail[0]['iban']}}"> 
                                    </div>
                                    
                                    
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="note">{{ trans('words.note') }}</label>   
                                        <input class="c-input" type="text" name="note" id="note"   value="{{ $workerDetail[0]['note']}}"> 
                                    </div>
                                    
                                    <div class="c-field u-mb-small">
                                        <input type="submit" class="c-btn c-btn--info c-btn--fullwidth" value="{{ trans('words.edit') }}">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="col u-mb-medium">
                                        
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
