@extends('layouts.app')
@section('content')
@include('layouts.include.body_header')
<div class="container">
    <div class="row u-mb-large">
        <div class="col-12">
            <article class="c-stage">
                            <div class="c-stage__header o-media u-justify-start">
                                <div class="c-stage__icon o-media__img">
                                    <i class="fa fa-plus"></i>
                                </div>
                                <div class="c-stage__header-title o-media__body">
                                    <h6 class="u-mb-zero">Add new System User</h6>
                                    <!--<p class="u-text-xsmall u-text-mute">Started 3 days ago  |  Expected time: 14 days</p>-->
                                </div>
                            </div>
                            <form name="add-user" id="addUser" action="{{ route('add-user') }}" method="post">
                            <div class="c-stage__panel u-p-medium">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="c-field u-mb-small">
                                            <label class="c-field__label" for="firstName">First Name</label> 
                                            <input class="c-input" name="first_name" id="firstName" placeholder="Jason" type="text"> 
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="c-field u-mb-small">
                                            <label class="c-field__label" for="firstName">Last Name</label> 
                                            <input class="c-input" id="firstName" placeholder="Jason" type="text"> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="c-field u-mb-small">
                                            <label class="c-field__label" for="firstName">Inopla username</label> 
                                            <input class="c-input" id="firstName" placeholder="Jason" type="text"> 
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="c-field u-mb-small">
                                            <label class="c-field__label" for="firstName">Password</label> 
                                            <input class="c-input" id="firstName" placeholder="Jason" type="text"> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="c-field u-mb-small">
                                            <label class="c-field__label" for="firstName">Extension number</label> 
                                            <input class="c-input" id="firstName" placeholder="Jason" type="text"> 
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="c-field u-mb-small">
                                            <label class="c-field__label" for="firstName">Language selection</label> 
                                            <input class="c-input" id="firstName" placeholder="Jason" type="text"> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="c-field u-mb-small">
                                            <label class="c-field__label" for="firstName">Permissions</label> 
                                            <div class="row">
                                                <div class="c-choice c-choice--checkbox col-lg-3">
                                                    <input class="c-choice__input" id="checkbox1" name="checkboxes" type="checkbox">
                                                    <label class="c-choice__label" for="checkbox1">Agent</label>
                                                </div>
                                                <div class="c-choice c-choice--checkbox col-lg-3">
                                                    <input class="c-choice__input" id="checkbox2" name="checkboxes" type="checkbox">
                                                    <label class="c-choice__label" for="checkbox2">Employees </label>
                                                </div>
                                                <div class="c-choice c-choice--checkbox col-lg-3">
                                                    <input class="c-choice__input" id="checkbox2" name="checkboxes" type="checkbox">
                                                    <label class="c-choice__label" for="checkbox2">Test Call</label>
                                                </div>
                                                <div class="c-choice c-choice--checkbox col-lg-3">
                                                    <input class="c-choice__input" id="checkbox2" name="checkboxes" type="checkbox">
                                                    <label class="c-choice__label" for="checkbox2">Orders</label>
                                                </div>
                                            </div>   
                                            <div class="row">
                                                <div class="c-choice c-choice--checkbox col-lg-3">
                                                    <input class="c-choice__input" id="checkbox1" name="checkboxes" type="checkbox">
                                                    <label class="c-choice__label" for="checkbox1">Calls</label>
                                                </div>
                                                <div class="c-choice c-choice--checkbox col-lg-3">
                                                    <input class="c-choice__input" id="checkbox2" name="checkboxes" type="checkbox">
                                                    <label class="c-choice__label" for="checkbox2">Translate</label>
                                                </div>
                                                <div class="c-choice c-choice--checkbox col-lg-3">
                                                    <input class="c-choice__input" id="checkbox2" name="checkboxes" type="checkbox">
                                                    <label class="c-choice__label" for="checkbox2">Invoices</label>
                                                </div>
                                                <div class="c-choice c-choice--checkbox col-lg-3">
                                                    <input class="c-choice__input" id="checkbox2" name="checkboxes" type="checkbox">
                                                    <label class="c-choice__label" for="checkbox2">Addressbook</label>
                                                </div>
                                            </div>   
                                            <div class="row">
                                                <div class="c-choice c-choice--checkbox col-lg-3">
                                                    <input class="c-choice__input" id="checkbox1" name="checkboxes" type="checkbox">
                                                    <label class="c-choice__label" for="checkbox1">SEPA</label>
                                                </div>
                                                <div class="c-choice c-choice--checkbox col-lg-3">
                                                    <input class="c-choice__input" id="checkbox2" name="checkboxes" type="checkbox">
                                                    <label class="c-choice__label" for="checkbox2">System Mails</label>
                                                </div>
                                                <div class="c-choice c-choice--checkbox col-lg-3">
                                                    <input class="c-choice__input" id="checkbox2" name="checkboxes" type="checkbox">
                                                    <label class="c-choice__label" for="checkbox2">Status</label>
                                                </div>
                                                <div class="c-choice c-choice--checkbox col-lg-3">
                                                    <input class="c-choice__input" id="checkbox2" name="checkboxes" type="checkbox">
                                                    <label class="c-choice__label" for="checkbox2">Supports</label>
                                                </div>
                                            </div>   
                                            <div class="row">
                                                <div class="c-choice c-choice--checkbox col-lg-3">
                                                    <input class="c-choice__input" id="checkbox1" name="checkboxes" type="checkbox">
                                                    <label class="c-choice__label" for="checkbox1">Administrater</label>
                                                </div>
                                                <div class="c-choice c-choice--checkbox col-lg-3">
                                                    <input class="c-choice__input" id="checkbox2" name="checkboxes" type="checkbox">
                                                    <label class="c-choice__label" for="checkbox2">Status Bar</label>
                                                </div>
                                                <div class="c-choice c-choice--checkbox col-lg-3">
                                                    <input class="c-choice__input" id="checkbox2" name="checkboxes" type="checkbox">
                                                    <label class="c-choice__label" for="checkbox2">System User</label>
                                                </div>
                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <input class="c-btn c-btn--info c-btn--fullwidth" value="Add" type="submit">
                                                </div>
                                            </div>
                                              

                                             
                                        </div>
                                    </div>
                                    
                                </div>
                            </div><!-- // .c-stage__panel -->
                            </form>
                           
                        </article>
        </div><!-- // .col-12 -->
    </div>
</div><!-- // .container -->
<style>
    input.has-error {
        border-color: red;
    }
</style>
@endsection
