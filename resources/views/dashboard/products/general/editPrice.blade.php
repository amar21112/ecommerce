@extends('layouts.admin')

@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('settings/categories.home')}}  </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('admin.products')}}"> {{__('settings/categories.main_categories')}} </a>
                                </li>
                                <li class="breadcrumb-item active">edit - {{$product -> name}}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form">{{__('settings/categories.edit_main_category')}}</h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                @include('dashboard.includes.alerts.success')
                                @include('dashboard.includes.alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form"
                                              action="{{route('admin.products.general.updatePrice',$product->id)}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf

                                            <input name="id" value="{{$product -> id}}" type="hidden">

                                            <div class="row" >

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput1">Price
                                                        </label>

                                                        <input type="number" name="price" id="pro_price" value="{{$product->price}}" class="form-control" min="0" max="1000000" step="0.01">
                                                        @error('price')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput1">Special Price Type
                                                        </label>
                                                        <select name="special_price_type"  class="select2 form-control" multiple>
                                                            <optgroup label="special price">
                                                                <option value="1" @if($product->special_price_type == 1) selected @endif>fixed</option>
                                                                <option value="2" @if($product->special_price_type == 2) selected @endif>percentage</option>
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
                                                        <input type="number" name="special_price" id="spec_price"  value="{{$product->special_price}}"  class="form-control" min="0" max="1000000" step="0.01">
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
                                                        <input type="date" id="spec_price_end"
                                                               value="{{ $product->special_price_start ? \Carbon\Carbon::parse($product->special_price_start)->format('Y-m-d') : '' }}"
                                                               name="special_price_end" class="form-control">
                                                        @error('special_price_start')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="spec_price_start" class="date-label">special price end date</label>
                                                        <input type="date" id="spec_price_end"
                                                               value="{{ $product->special_price_end ? \Carbon\Carbon::parse($product->special_price_end)->format('Y-m-d') : '' }}"
                                                               name="special_price_end" class="form-control">
                                                        @error('special_price_end')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> Back
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> Save
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>

@endsection
