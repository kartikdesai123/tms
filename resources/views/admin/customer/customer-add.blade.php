@extends('layouts.app')
@section('content')
@include('layouts.include.body_header')
<div class="container">
    <div class="row u-mb-large">
        <div class="col-12">
            <div class="row u-mb-large">
                    <div class="col-12">
                        <div class="c-tabs">
                        
                            <ul class="c-tabs__list c-tabs__list--splitted nav nav-tabs" id="myTab" role="tablist">
                                <li class="c-tabs__item"><a class="c-tabs__link active show" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Company Profile</a></li>

                                <li class="c-tabs__item"><a class="c-tabs__link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">BillInfo</a></li>
                                <li class="c-tabs__item"><a class="c-tabs__link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Invoice</a></li>
                                <li class="c-tabs__item"><a class="c-tabs__link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Calls</a></li>
                                <li class="c-tabs__item"><a class="c-tabs__link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">EOC</a></li>
                                <li class="c-tabs__item"><a class="c-tabs__link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Status</a></li>
                                <!--<li class="c-tabs__item"><a class="c-tabs__link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">StatusPlanner</a></li>-->
                                <!--<li class="c-tabs__item"><a class="c-tabs__link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Addbook</a></li>-->
                                <li class="c-tabs__item"><a class="c-tabs__link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Ticket</a></li>
                            </ul>

                            <div class="c-tabs__content tab-content" id="nav-tabContent">
                                <div class="c-tabs__pane active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="row">
                                        <div class="col-lg-2 u-text-center">
                                            <div class="c-avatar c-avatar--xlarge u-inline-block">
                                                <img class="c-avatar__img" src="{{ url('img/avatar-200.jpg') }}" alt="Avatar">
                                            </div>

                                            <a class="u-block u-color-primary" href="#">Edit Avatar</a>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="c-field u-mb-small">
                                                <label class="c-field__label" for="firstName">Customer number</label> 
                                                <input class="c-input" id="firstName" placeholder="Jason" type="text"> 
                                            </div>

                                            <div class="c-field u-mb-small">
                                                <label class="c-field__label" for="lastName">First Name</label> 
                                                <input class="c-input" id="lastName" placeholder="Clark" type="text"> 
                                            </div>

                                            

                                            <div class="c-field u-mb-small">
                                                <label class="c-field__label" for="email">E-mail Address</label>
                                                <input class="c-input" id="email" placeholder="jason@clark.com" type="email">
                                            </div>
                                            
                                            <div class="c-field u-mb-small">
                                                <label class="c-field__label" for="select1">Packet</label>

                                                <!-- Select2 jquery plugin is used -->
                                                <select class="c-select" id="select1">
                                                    <option>First</option>
                                                    <option>Second</option>
                                                    <option>Third</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-5">
                                            <div class="c-field u-mb-small">
                                                <label class="c-field__label" for="companyName">Company Name</label>
                                                <input class="c-input" id="companyName" placeholder="Dashboard Ltd." type="text">
                                            </div>

                                            <div class="c-field u-mb-small">
                                                <label class="c-field__label" for="website">Last Name</label>
                                                <input class="c-input" id="website" placeholder="zawiastudio.com" type="text">
                                            </div>  
                                            
                                            <div class="c-field u-mb-small">
                                                <label class="c-field__label" for="website">Telefon</label>
                                                <input class="c-input" id="website" placeholder="zawiastudio.com" type="text">
                                            </div>  
                                             
                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="c-tabs__pane" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <div class="row">
                                        <div class="col-lg-2 u-text-center">
                                            <div class="c-avatar c-avatar--xlarge u-inline-block">
                                                <img class="c-avatar__img" src="{{ url('img/avatar-200.jpg') }}" alt="Avatar">
                                            </div>
                                            <a class="u-block u-color-primary" href="#">Edit Avatar</a>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="c-field u-mb-small">
                                                <label class="c-field__label" for="firstNameOther">First Name</label> 
                                                <input class="c-input" id="firstNameOther" placeholder="Jason" type="text"> 
                                            </div>

                                            <div class="c-field u-mb-small">
                                                <label class="c-field__label" for="lastNameOther">Last Name</label> 
                                                <input class="c-input" id="lastNameOther" placeholder="Clark" type="text"> 
                                            </div>

                                            <div class="c-field u-mb-small">
                                                <label class="c-field__label" for="bioOther">Bio</label>
                                                <textarea class="c-input" id="bioOther">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem dignissimos, et qui, dolorem aspernatur quos vitae delectus libero quam inventore.</textarea>
                                            </div>

                                            <div class="c-field u-mb-small">
                                                <label class="c-field__label" for="emailOther">E-mail Address</label>
                                                <input class="c-input" id="emailOther" placeholder="jason@clark.com" type="email">
                                            </div>
                                        </div>

                                        <div class="col-lg-5">
                                            <div class="c-field u-mb-small">
                                                <label class="c-field__label" for="companyNameOther">Company Name</label>
                                                <input class="c-input" id="companyNameOther" placeholder="Dashboard Ltd." type="text">
                                            </div>

                                            <div class="c-field u-mb-small">
                                                <label class="c-field__label" for="websiteOther">Website</label>
                                                <input class="c-input" id="websiteOther" placeholder="zawiastudio.com" type="text">
                                            </div>  

                                            <label class="c-field__label" for="socialProfileOther">Social Profiles</label>

                                            <div class="c-field has-addon-left u-mb-small">
                                                <span class="c-field__addon u-bg-twitter">
                                                    <i class="fa fa-twitter u-color-white"></i>
                                                </span>
                                                <input class="c-input" id="socialProfileOther" placeholder="Clark" type="text">
                                            </div>

                                            <div class="c-field has-addon-left">
                                                <span class="c-field__addon u-bg-facebook">
                                                    <i class="fa fa-facebook u-color-white"></i>
                                                </span>
                                                <input class="c-input" placeholder="Clark" type="text">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div><!-- // .col-12 -->
                </div>
        </div><!-- // .col-12 -->
    </div>
</div><!-- // .container -->
<style>
    input.has-error {
        border-color: red;
    }
</style>
@endsection
