<h4 class="form-section"><i class="ft-home"></i> product price info </h4>
<div class="row" >

    <div class="col-md-4">
        <div class="form-group">
            <label for="projectinput1">Price
            </label>

            <input type="number" name="price" id="pro_price" class="form-control" min="0" max="1000000" step="0.01">
            @error('price')
            <span class="text-danger"> {{$message}}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="projectinput1">Special Price Type
            </label>
            <select name="special_price_type" class="select2 form-control" multiple>
                <optgroup label="special price">
                    <option value="1">fixed</option>
                    <option value="2">percentage</option>
                </optgroup>
            </select>
            @error('special_price_type')
            <span class="text-danger"> {{$message}}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="projectinput1"> Special Price
            </label>
            <input type="number" name="special_price" id="spec_price" class="form-control" min="0" max="1000000" step="0.01">
            @error('special_price')
            <span class="text-danger"> {{$message}}</span>
            @enderror
        </div>
    </div>


</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
                <label for="spec_price_start" class="date-label">special price start date</label>
                <input type="date" id="spec_price_start" name="special_price_start" class="form-control">
                @error('special_price_start')
                <span class="text-danger"> {{$message}}</span>
                @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="spec_price_start" class="date-label">special price end date</label>
            <input type="date" id="spec_price_start" name="special_price_end" class="form-control">
            @error('special_price_end')
            <span class="text-danger"> {{$message}}</span>
            @enderror
        </div>
    </div>

</div>
