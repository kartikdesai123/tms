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
                            <li class="c-tabs__item"><a class="c-tabs__link active show" data-id="1" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Update Profile</a></li>
                            <li class="c-tabs__item"><a class="c-tabs__link" id="nav-profile-tab" data-id="2"  data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Change Password</a></li>
                        </ul>
                        <div class="c-tabs__content tab-content" id="nav-tabContent">
                            <div class="c-tabs__pane active show " id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <form name="editUserd" id="editUserd" action="{{ route('update-profile') }}" method="post">

                                    <div class="row userdetaildiv">
                                        <div class="col-lg-5">
                                            <div class="c-field u-mb-small">
                                                <label class="c-field__label" for="name">Staffnumber</label>
                                                <input class="c-input" id="staffnumber"   value="{{ $detail['staffnumber'] }}" name="staffnumber"  type="text" readonly> 
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                                                <input type="hidden" name="id" value="{{ $detail['id'] }}"  class="form-control">
                                            </div>
                                            <div class="c-field u-mb-small">
                                                <label class="c-field__label" for="name">Name</label> 
                                                 <input class="c-input" id="name" value="{{ $detail['name'] }}"  name="name"  type="text"/> 
                                            </div>
                                            <div class="c-field u-mb-small">
                                                <label class="c-field__label" for="surname">Surname</label>
                                                <input class="c-input" id="surname"  value="{{ $detail['surname'] }}" name="surname"  type="surname">
                                            </div>
                                        </div>
                                        <div class="col-lg-6"></div>
                                        <div class="">
                                            <label class="c-field__label col-lg-offset-4" for=""></label>
                                            <div class="col-lg-12 ">
                                                <div class="col u-mb-medium">
                                                    <input type="submit" id="Update" class="c-btn c-btn--info c-btn--fullwidth" value="Update">
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </form>
                                <form name="editUser" id="editUser" action="{{ route('update-change-password') }}" method="post">
                                    <div class="row changepassworddiv" style="display: none;" >
                                        <div class="col-lg-5">
                                            <div class="c-field u-mb-small">
                                                <label class="c-field__label" for="currentpassword">Old Password</label> 
                                                <input class="c-input" id="currentpassword"  name="currentpassword"  type="password"> 
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="id" value="{{ $detail['id'] }}"  class="form-control">
                                            </div>
                                            <div class="c-field u-mb-small">
                                                <label class="c-field__label" for="newpassword">New Password</label> 
                                                <input class="c-input" id="newpassword"  name="newpassword"  type="password"> 
                                            </div>
                                            <div class="c-field u-mb-small">
                                                <label class="c-field__label" for="confirmpassword">Confirm Password</label>
                                                <input class="c-input" id="confirmpassword"  name="confirmpassword"  type="password">
                                            </div>
                                        </div> 
                                        <div class="col-lg-5"></div>
                                        <div class="">
                                            <label class="c-field__label col-lg-offset-4" for=""></label>
                                            <div class="col-lg-12 ">
                                                <div class="col u-mb-medium">
                                                    <input type="submit" id="ChangePassword" class="c-btn c-btn--info c-btn--fullwidth" value="ChangePassword">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!-- // .col-12 -->
                </div>
            </div><!-- // .col-12 -->
        </div>
    </div><!-- // .container -->
    <style>
        input.has-errosr {
            border-color: red;
        }
    </style>
    @endsection
