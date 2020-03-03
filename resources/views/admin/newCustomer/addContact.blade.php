
<div class="col-lg-12 removediv">
    <div class="row">
        <div class="col-lg-12">
            <div class="c-field u-mb-small">
                <h4>{{ trans('customer.newcustomer') }} / {{ trans('customer.interested') }}</h4>
                <hr>
            </div> 
        </div>
    </div>
    <div class="row"> 
    <div class="col-lg-6"> 
        <div class="c-field u-mb-small">
            <label class="c-field__label" for="customerNumber">{{ trans('customer.customernumber') }}</label>   
            <input class="c-input customerNumber" type="text" value="{{ $details }}"name="customerNumber[]" id="customerNumber"  readonly> 
        </div>  
        <div class="c-field u-mb-small">
            <label class="c-field__label" for="timeline">Customer Type</label>   
            <select class="c-input customerType" id="timeline" name="customerType[]">
                <option value="">Select Customer type</option>
                <option value="corporate_customer">Corporate Customer</option>
                <option value="private_customer">Private Customer</option>
            </select>
        </div> 
<!--        <div class="c-field u-mb-small">
            <div class="row">
                <div class="col-lg-6"> 
                    <input type="radio" style="color:red" name='customerType[]' value="corporate_customer" checked="checked">Corporate Customer
                </div>
                <div class="col-lg-6"> 
                    <input type="radio" name='customerType[]' value="private_customer">Private Customer
                </div>
            </div>
        </div>-->



        <div class="c-field u-mb-small">
            <label class="c-field__label" for="companyName">{{ trans('customer.companyname') }}</label>   
            <input class="c-input companyName" type="text" name="companyName[]" id="companyName"> 
        </div>

        <div class="c-field u-mb-small">
            <div class="row">
                <div class="col-lg-6"> 
                    <label class="c-field__label" for="address">{{ trans('customer.address') }}</label>   
                    <input class="c-input address" type="text" name="address[]" id="address"> 
                </div>
                <div class="col-lg-6"> 
                    <label class="c-field__label" for="state">{{ trans('customer.plzstate') }}</label>   
                    <input class="c-input state" type="text" name="state[]" id="state"> 
                </div>
            </div>
        </div>

        <div class="c-field u-mb-small">
            <div class="row">
                <div class="col-lg-6"> 
                    <label class="c-field__label" for="telephone">{{ trans('customer.telephone') }}</label>   
                    <input class="c-input telephone" type="text" name="telephone[]" id="telephone"> 
                </div>
                <div class="col-lg-6"> 
                    <label class="c-field__label" for="fax">{{ trans('customer.fax') }}</label>   
                    <input class="c-input fax" type="text" name="fax[]" id="fax"> 
                </div>
            </div>
        </div>

        <div class="c-field u-mb-small">
            <div class="row">
                <div class="col-lg-6"> 
                    <label class="c-field__label" for="email">{{ trans('customer.email') }}</label>   
                    <input class="c-input cust_email" type="text" name="email[]" id="email"> 
                </div>
                <div class="col-lg-6"> 
                    <label class="c-field__label" for="web">{{ trans('customer.web') }}</label>   
                    <input class="c-input web" type="text" name="web[]" id="web"> 
                </div>
            </div>
        </div>

        <div class="c-field u-mb-small">
            <label class="c-field__label" for="taxNumber">{{ trans('customer.taxnumber') }}</label>   
            <input class="c-input taxNumber" type="text" name="taxNumber[]" id="taxNumber"> 
        </div>  

        <div class="c-field u-mb-small">
            <label class="c-field__label" for="note">{{ trans('customer.note') }}</label>   
            <textarea class="c-input note" name="note[]" id="note"></textarea>
        </div> 

        <br> 
    </div>

    <div class="col-lg-6">
        <div class="appendContact">
            <input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"> 
            <div class="c-field u-mb-small">
                <div class="row">
                    <div class="col-lg-6">
                        <h4>{{ trans('customer.contact') }} </h4>
                    </div>
                    <div class="col-lg-6">  
                         <i class="fa fa-minus-circle pull-right removeContact" style="margin-top:10px;margin-right: 15px"></i>
                    </div>
                </div>
                <hr>
            </div> 

            <div class="c-field u-mb-small">
                <label class="c-field__label" for="gender">{{ trans('words.gender') }}</label>
                <select class="c-input contactGender" id="type" name="gender[]">
                    <option value="">{{ trans('words.pleaseSelect') }}</option>
                    <option value="Male">{{ trans('customer.male') }}</option>
                    <option value="Female">{{ trans('customer.female') }}</option>
                </select>
            </div>

            <div class="c-field u-mb-small">
                <div class="row">
                    <div class="col-lg-6"> 
                        <label class="c-field__label" for="firstName">{{ trans('customer.firstname') }}</label>   
                        <input class="c-input contactFirstName" type="text" name="firstName[]" id="firstName"> 
                    </div>
                    <div class="col-lg-6"> 
                        <label class="c-field__label" for="surName">{{ trans('customer.surname') }}</label>   
                        <input class="c-input contactSurName" type="text" name="surName[]" id="surName"> 
                    </div>
                </div>
            </div>

            <div class="c-field u-mb-small">
                <div class="row">
                    <div class="col-lg-6"> 
                        <label class="c-field__label" for="contacttelephone">{{ trans('customer.telephone') }}</label>   
                        <input class="c-input contactTelephone" type="text" name="contacttelephone[]" id="contacttelephone"> 
                    </div>
                    <div class="col-lg-6"> 
                        <label class="c-field__label" for="contactfax">{{ trans('customer.fax') }}</label>   
                        <input class="c-input contactFax" type="text" name="contactfax[]" id="contactfax"> 
                    </div>
                </div>
            </div>

            <div class="c-field u-mb-small">
                <div class="row">
                    <div class="col-lg-6"> 
                        <label class="c-field__label" for="mobile">{{ trans('customer.mobile') }}</label>   
                        <input class="c-input contactMobile" type="text" name="mobile[]" id="mobile"> 
                    </div>
                    <div class="col-lg-6"> 
                        <label class="c-field__label" for="contactEmail">{{ trans('customer.email') }}</label>   
                        <input class="c-input contactEmail" type="text" name="contactEmail[]" id="contactEmail"> 
                    </div>
                </div>
            </div>

            <div class="c-field u-mb-small">
                <label class="c-field__label" for="contactnote">{{ trans('customer.note') }}</label>   
                <textarea class="c-input" name="contactnote[]" id="contactnote"></textarea>
            </div> 
            <br>
        </div>
    </div>
    </div>
</div>