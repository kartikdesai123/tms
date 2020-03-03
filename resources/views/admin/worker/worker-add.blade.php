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
                        <form name="add-worker" id="addWorker" action="{{ route('worker-add') }}" method="post">
                            <div class="row">
                                <div class="col-lg-6">
                                    @php
                                    $count = 1;
                                    $oldstaffnumber = 0;
                                    @endphp
                                    @for($i = 0 ;$i < count($arrUser);$i++,$count++)
                                        <input type="hidden" id="cstaffnumber" name="cstaffnumber" value="{{ $oldstaffnumber  = $arrUser[$i]->staffnumber  + 1}}" />
                                    @endfor
                                    <div class="c-field u-mb-small">
                                        <h4>{{ trans('words.workerData') }}</h4>
                                        <hr>
                                    </div> 
                                     <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="staffnumber">{{ trans('words.workerNumber') }}</label>   
                                        <input class="c-input" type="text" name="staffnumber" id="staffnumber" value="{{ $oldstaffnumber }}"  > 
                                    </div>  
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">{{ trans('words.member') }}</label>
                                        <select class="c-input" id="type" name="type">
                                                <option value="">{{ trans('words.pleaseSelect') }}</option>
                                                <option value="WORKER">{{ trans('words.wo-worker') }}</option>
                                                <option value="ADMIN">{{ trans('words.administrator') }}</option>
                                                <option value="SUPERVISOR">{{ trans('words.supervisior') }}</option>
                                        </select>
                                        <input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"> 
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
                                    <br>
                                    <div class="c-field u-mb-small">
                                        <h4>{{ trans('words.contract') }}</h4>
                                        <hr>
                                    </div>
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">{{ trans('words.position') }}</label>
                                        <select class="c-input" id="type" name="position">
                                                <option value="">{{ trans('words.pleaseSelect') }}</option>
                                                <option value="office">{{ trans('words.office') }}</option>
                                                <option value="cleaner">{{ trans('words.cleaner') }}</option>
                                                <option value="glasss">{{ trans('words.glasss') }}</option>
                                                <option value="intern">{{ trans('words.intern') }}</option>
                                        </select>
                                    </div>
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">{{ trans('words.employment') }}</label>
                                        <select class="c-input" id="type" name="employment">
                                                <option value="">{{ trans('words.pleaseSelect') }}</option>
                                                <option value="minijob">{{ trans('words.minijob') }}</option>
                                                <option value="part">{{ trans('words.part') }}</option>
                                                <option value="full">{{ trans('words.full') }}</option>
                                        </select>
                                    </div>
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="startContract">{{ trans('words.startOfContract') }}</label>   
                                        <input class="c-input" type="text" name="startContract" id="startContract"  > 
                                    </div>  
                                    
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="staffnumber">{{ trans('words.endOfContract') }}</label>   
                                        <input class="c-input" type="text" name="endContract" id="endContract"   > 
                                    </div>
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="weekHours">{{ trans('words.weekOfHours') }}</label>   
                                        <input class="c-input" type="text" name="weekHours" id="weekHours"  > 
                                    </div> 
                                    
                                    <div class="c-field u-mb-small">
                                        <div class="row">
                                            <div class="col-6">
                                                <input type="radio" name="workType" value="hourly" checked>{{ trans('words.hourlyWage') }}
                                                 <input class="c-input" type="text" name="hourly" id="hourly" > 
                                            </div>
                                            
                                            <div class="col-6">
                                                <input type="radio" name="workType" value="fixed"> {{ trans('words.fixedSalary') }}
                                                <input class="c-input" type="text" name="fixed" id="fixed"  > 
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="weekHours">{{ trans('words.totalHolidyas') }}</label>   
                                        <input class="c-input" type="text" name="totalHolidays" id="totalHolidays"  > 
                                    </div> 
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="weekHours">{{ trans('words.cancelContral') }}</label>   
                                        <input class="c-input" type="text" name="cancelDate" id="cancelDate"  > 
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
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="c-field u-mb-small">
                                       <div class="row">
                                           <div class="col-6">
                                               <label class="c-field__label" for="firstName">{{ trans('words.firstName') }}</label>   
                                               <input class="c-input" type="text" name="firstName" id="firstName"  > 
                                           </div>

                                           <div class="col-6">
                                               <label class="c-field__label" for="surname">{{ trans('words.surName') }}</label>   
                                               <input class="c-input" type="text" name="surname" id="surname"  > 
                                           </div>

                                       </div>
                                    </div>
                                    
                                    <div class="c-field u-mb-small">
                                        <div class="row">
                                            <div class="col-6">
                                                <label class="c-field__label" for="dateofBirth">{{ trans('words.dob') }}</label>   
                                                <input class="c-input" type="text" name="dateofBirth" id="dateofBirth"  > 
                                            </div>
                                            
                                            <div class="col-6">
                                                <label class="c-field__label" for="placeofBirth">{{ trans('words.placeOfBirth') }}</label>   
                                                <input class="c-input" type="text" name="placeofBirth" id="placeofBirth"  > 
                                            </div>
                                            
                                        </div>
                                     </div>
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="nationality">{{ trans('words.nationality') }}</label>
                                        <select class="c-input" id="type" name="nationality">
                                            <option value="">{{ trans('words.pleaseSelect') }}</option>
                                            @for($i = 0 ;$i < count($arrayCountry) ; $i++)
                                                 <option value="{{ $arrayCountry[$i] }}">{{ $arrayCountry[$i] }}</option>
                                            
                                            @endfor
                                           
                                           
                                        </select>
                                    </div>    
                                    <div class="c-field u-mb-small">
                                        <div class="row">
                                            <div class="col-6">
                                                <label class="c-field__label" for="workPermit">{{ trans('words.workpermit') }}</label>   
                                                <input class="c-input" type="text" name="workPermit" id="workPermit"  > 
                                            </div>
                                            
                                            <div class="col-6">
                                                <label class="c-field__label" for="residencePermit">{{ trans('words.resideancePermit') }}</label>   
                                                <input class="c-input" type="text" name="residencePermit" id="residencePermit"  > 
                                            </div>
                                            
                                        </div>
                                     </div>
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="workPermitUp">{{ trans('words.taxIdNumber') }}</label>   
                                        <input class="c-input" type="text" name="taxId" id="taxId"  > 
                                    </div>
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="socialSecurityNumber">{{ trans('words.socialSecurityNumber') }}</label>   
                                        <input class="c-input" type="text" name="socialSecurityNumber" id="socialSecurityNumber"  > 
                                    </div>
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="email">{{ trans('words.email') }}</label>   
                                        <input class="c-input" type="text" name="email" id="email"  > 
                                    </div>
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="email">{{ trans('words.password') }}</label>   
                                        <input class="c-input" type="password" name="password" id="password"  > 
                                    </div>
                                    
                                    <div class="c-field u-mb-small">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="c-field u-mb-small">
                                                    <label class="c-field__label" for="phoneNumber">{{ trans('words.phoneNumber') }}</label>   
                                                    <input class="c-input" type="text" name="phoneNumber" id="phoneNumber"  > 
                                                </div>
                                            </div>
                                            
                                            <div class="col-6">
                                                <label class="c-field__label" for="mobile">{{ trans('words.mobile') }}</label>   
                                                <input class="c-input" type="text" name="mobile" id="mobile"  > 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="c-field u-mb-small">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="c-field u-mb-small">
                                                    <label class="c-field__label" for="adresses">{{ trans('words.addresses') }}</label>   
                                                    <input class="c-input" type="text" name="adresses" id="adresses"  > 
                                                </div>
                                            </div>
                                            
                                            <div class="col-6">
                                                <label class="c-field__label" for="postcodeCity">{{ trans('words.postCode') }}</label>   
                                                <input class="c-input" type="text" name="postcodeCity" id="postcodeCity"  > 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="c-field u-mb-small">
                                        <h4>{{ trans('words.paymentDetails') }}</h4>
                                        <hr>
                                    </div> 
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="name">{{ trans('words.name') }}</label>   
                                        <input class="c-input" type="text" name="name" id="name"  > 
                                    </div>
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="bankName">{{ trans('words.bankName') }}</label>   
                                        <input class="c-input" type="text" name="bankName" id="bankName"  > 
                                    </div>
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="iban">{{ trans('words.IBAN') }}</label>   
                                        <input class="c-input" type="text" name="iban" id="iban"  > 
                                    </div>
                                    
                                    
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="note">{{ trans('words.note') }}</label>   
                                        <input class="c-input" type="text" name="note" id="note"  > 
                                    </div>
                                    
                                    <div class="c-field u-mb-small">
                                        <input type="submit" class="c-btn c-btn--info c-btn--fullwidth" value="{{ trans('words.create') }}">
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
