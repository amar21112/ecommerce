<div class="form-body">

    <h4 class="form-section"><i class="ft-home"></i> Manage Stock </h4>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="projectinput1">product code
                </label>
                <input type="text" id="sku"
                       class="form-control"
                       placeholder="  "
                       value="{{old('sku')}}"
                       name="sku">
                @error("sku")
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="projectinput1">follow stock
                </label>
                <select name="manage_stock" class="select2 form-control" id="manageStock">
                    <optgroup label="من فضلك أختر النوع ">
                        <option value="1">Allowed</option>
                        <option value="0" selected>Not Allowed</option>
                    </optgroup>
                </select>
                @error('manage_stock')
                <span class="text-danger"> {{$message}}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <!-- QTY  -->



        <div class="col-md-6">
            <div class="form-group">
                <label for="projectinput1">Product Availability
                </label>
                <select name="in_stock" class="select2 form-control" >
                    <optgroup label="من فضلك أختر  ">
                        <option value="1">Available</option>
                        <option value="0">Not Available</option>
                    </optgroup>
                </select>
                @error('in_stock')
                <span class="text-danger"> {{$message}}</span>
                @enderror
            </div>
        </div>


        <div class="col-md-6" style="display:none"  id="qtyDiv">
            <div class="form-group">
                <label for="projectinput1">Amount
                </label>
                <input type="number" id="amount"
                       class="form-control"
                       placeholder="  "
                       value="{{old('qty')}}"
                       name="qty">
                @error("qty")
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
    </div>

</div>
