<div class="removeWorkplaceContactDiv">
    <div class="c-field u-mb-small">
        <div class="row">
            <div class="col-lg-6">
                <h4>Contact </h4>
            </div>
            <div class="col-lg-6"> 
                    <i class="fa fa-minus-circle pull-right removeWorkplaceContact" style="margin-top:10px;margin-right: 15px"></i>
            </div>
        </div>
        <hr>
    </div> 

<div class="c-field u-mb-small">
    <label class="c-field__label" for="gender">{{ trans('words.gender') }}</label>
    <select class="c-input" id="type" name="Workplacegender[]">
            <option value="">{{ trans('words.pleaseSelect') }}</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
    </select>
</div>

<div class="c-field u-mb-small">
    <div class="row">
       <div class="col-lg-6"> 
            <label class="c-field__label" for="firstName">First Name</label>   
            <input class="c-input" type="text" name="WorkplacefirstName[]" id="firstName"> 
       </div>
       <div class="col-lg-6"> 
            <label class="c-field__label" for="surName">Sur Name</label>   
            <input class="c-input" type="text" name="WorkplacesurName[]" id="surName"> 
       </div>
    </div>
</div>

<div class="c-field u-mb-small">
    <div class="row">
       <div class="col-lg-6"> 
            <label class="c-field__label" for="contacttelephone">Telephone</label>   
            <input class="c-input" type="text" name="Workplacecontacttelephone[]" id="contacttelephone"> 
       </div>
       <div class="col-lg-6"> 
            <label class="c-field__label" for="contactfax">Fax</label>   
            <input class="c-input" type="text" name="Workplacecontactfax[]" id="contactfax"> 
       </div>
    </div>
</div>

<div class="c-field u-mb-small">
    <div class="row">
       <div class="col-lg-6"> 
            <label class="c-field__label" for="mobile">Mobile</label>   
            <input class="c-input" type="text" name="Workplacemobile[]" id="mobile"> 
       </div>
       <div class="col-lg-6"> 
            <label class="c-field__label" for="contactEmail">E-mail</label>   
            <input class="c-input" type="text" name="WorkplacecontactEmail[]" id="contactEmail"> 
       </div>
    </div>
</div>

<div class="c-field u-mb-small">
    <label class="c-field__label" for="contactnote">Note</label>   
    <textarea class="c-input" name="Workplacecontactnote[]" id="contactnote"></textarea>
</div> 
</div>