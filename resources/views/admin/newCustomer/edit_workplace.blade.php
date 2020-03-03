<form name="edit-customer" id="editCustomer" action="{{ route('edit_workplacedetails') }}" method="post">
    <input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"> 
    
    <div class="row">
        <div class="col-lg-6"> 
            <div class="c-field u-mb-small">
                <label class="c-field__label" for="companyName">Workplace Name</label>   
                <input class="c-input" type="text" name="workplaceName" id="workplaceName" value="{{ $workplace_customer[0]->workplaceName }}"> 

                <input class="c-input" type="hidden" name="workplace_id" id="workplace_id" value="{{ $workplace_customer[0]->id }}">

            </div>

            <div class="c-field u-mb-small">
                <div class="row">
                    <div class="col-lg-6"> 
                        <label class="c-field__label" for="address">{{ trans('customer.address') }}</label>   
                        <input class="c-input" type="text" name="address" id="address" value="{{ $workplace_customer[0]->address }}"> 
                    </div>
                    <div class="col-lg-6"> 
                        <label class="c-field__label" for="state">{{ trans('customer.plzstate') }}</label>   
                        <input class="c-input" type="text" name="state" id="state" value="{{ $workplace_customer[0]->state }}"> 
                    </div>
                </div>
            </div>

            <div class="c-field u-mb-small">
                <div class="row">
                    <div class="col-lg-6"> 
                        <label class="c-field__label" for="telephone">{{ trans('customer.telephone') }}</label>   
                        <input class="c-input" type="text" name="telephone" id="telephone" value="{{ $workplace_customer[0]->telephone }}"> 
                    </div>
                    <div class="col-lg-6"> 
                        <label class="c-field__label" for="fax">{{ trans('customer.fax') }}</label>   
                        <input class="c-input" type="text" name="fax" id="fax" value="{{ $workplace_customer[0]->fax }}"> 
                    </div>
                </div>
            </div>

            <div class="c-field u-mb-small">
                <div class="row">
                    <div class="col-lg-6"> 
                        <label class="c-field__label" for="email">{{ trans('customer.email') }}</label>   
                        <input class="c-input" type="text" name="email" id="email" value="{{ $workplace_customer[0]->email }}"> 
                    </div>
                    <div class="col-lg-6"> 
                        <label class="c-field__label" for="web">{{ trans('customer.web') }}</label>   
                        <input class="c-input" type="text" name="web" id="web" value="{{ $workplace_customer[0]->web }}"> 
                    </div>
                </div>
            </div>

            <div class="c-field u-mb-small">
                <label class="c-field__label" for="taxNumber">{{ trans('customer.responsibleworker') }}</label>   

                <select class="c-select c-select--multiple" id="select3" name="responsibleWorker[]">
                    <option value="Worker1">Worker1</option>
                    <option value="Worker2">Worker2</option>
                    <option value="Worker3">Worker3</option>
                    <option value="Worker4">Worker4</option>
                    <option value="Worker5">Worker5</option>
                </select>
            </div>  

            <div class="c-field u-mb-small">
                <label class="c-field__label" for="note">{{ trans('customer.note') }}</label>   
                <textarea class="c-input" name="note" id="note"> {{ $workplace_customer[0]->note }}</textarea>
            </div> 

            <br> 
        </div>


        <div class="col-lg-6">
            <div class="row">
                <div class="appendContact">
        @for($i = 0 ; $i < count($workplace_contact) ; $i++)

                <div class="col-lg-12 {{ ($i == 0 ? '' : 'remove') }}"> 
                    <div class="c-field u-mb-small">
                        <div class="row">
                            <div class="col-lg-6">
                                <h4>{{ trans('customer.contact') }} </h4>
                            </div>
                            <div class="col-lg-6"> 
                                @if($i == 0)
                                    <i class="fa fa-plus-circle pull-right addContact" style="margin-top:10px;margin-right: 15px"></i>
                                @else
                                    <i class="fa fa-minus-circle pull-right removeContact" style="margin-top:10px;margin-right: 15px"></i>
                                @endif

                            </div>
                        </div>
                        <hr>
                    </div> 

                <div class="c-field u-mb-small">
                    <label class="c-field__label" for="gender">{{ trans('words.gender') }}</label>
                    <select class="c-input wp_gender" id="type" name="gender[]">
                            <option value="">{{ trans('customer.pleaseselect') }}</option>
                            <option value="Male" {{ ($workplace_contact[$i]->gender == 'Male' ? 'selected="selected"' : '') }}>{{ trans('customer.male') }}</option>
                            <option value="Female" {{ ($workplace_contact[$i]->gender == 'Female' ? 'selected="selected"' : '') }}>{{ trans('customer.female') }}</option>
                    </select>
                </div>

                <div class="c-field u-mb-small">
                    <div class="row">
                       <div class="col-lg-6"> 
                            <label class="c-field__label " for="firstName">{{ trans('customer.firstname') }}</label>   
                            <input class="c-input wp_firstname" type="text" name="firstName[]" id="firstName" value="{{ $workplace_contact[$i]->firstName }}"> 
                       </div>
                       <div class="col-lg-6"> 
                            <label class="c-field__label" for="surName">{{ trans('customer.surname') }}</label>   
                            <input class="c-input wp_surname" type="text" name="surName[]" id="surName" value="{{ $workplace_contact[$i]->lastName }}"> 
                       </div>
                    </div>
                </div>

                <div class="c-field u-mb-small">
                    <div class="row">
                       <div class="col-lg-6"> 
                            <label class="c-field__label" for="contacttelephone">{{ trans('customer.telephone') }}</label>   
                            <input class="c-input wp_telephone" type="text" name="contacttelephone[]" id="contacttelephone" value="{{ $workplace_contact[$i]->telephone }}"> 
                       </div>
                       <div class="col-lg-6"> 
                            <label class="c-field__label" for="contactfax">{{ trans('customer.fax') }}</label>   
                            <input class="c-input wp_fax" type="text" name="contactfax[]" id="contactfax" value="{{ $workplace_contact[$i]->fax }}"> 
                       </div>
                    </div>
                </div>

                <div class="c-field u-mb-small">
                    <div class="row">
                       <div class="col-lg-6"> 
                            <label class="c-field__label" for="mobile">{{ trans('customer.mobile') }}</label>   
                            <input class="c-input wp_mobile" type="text" name="mobile[]" id="mobile" value="{{ $workplace_contact[$i]->mobile }}"> 
                       </div>
                       <div class="col-lg-6"> 
                            <label class="c-field__label" for="contactEmail">{{ trans('customer.email') }}</label>   
                            <input class="c-input wp_email" type="text" name="contactEmail[]" id="contactEmail" value="{{ $workplace_contact[$i]->email }}"> 
                       </div>
                    </div>
                </div>

                <div class="c-field u-mb-small">
                    <label class="c-field__label" for="contactnote">{{ trans('customer.note') }}</label>   
                    <textarea class="c-input" name="contactnote[]" id="contactnote">{{ $workplace_contact[$i]->note }}</textarea>
                </div> 
                </div>

        @endfor
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="col u-mb-medium">
            <label class="c-field__label" for="type">&nbsp;</label>
            <input type="submit" class="c-btn c-btn--info c-btn--fullwidth" value="{{ trans('words.save') }}">
        </div>
    </div>
</form>