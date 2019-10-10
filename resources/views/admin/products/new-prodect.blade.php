@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {!! !is_null($product) ? 'Update Product <span class="product-head-title" >[ ' . $product->title . ' ] </span>': 'New Product ' !!}
                    </div>
                    <div class="card-body">

                        <form  action="{{ 'new-product' }}" method="POST">
                            @csrf
                            @if (! is_null($product))
                            <input type="hidden" name="_method" value="put" />
                            <input type="hidden" name="product_id" value="{{ $product->id }}" />
                            @endif

                            <div class="form-group col-md-12">
                                    <label for="product_title">Product Title</label>
                                    <input type="text" class="form-control" id="product_title" name="product_title" placeholder="Product Title" required
                                    value="{{ (! is_null($product) ) ? $product->title : '' }}">
                                </div>

                                <div class="form-group col-md-12">
                                        <label for="product_description">Product Description</label>
                                        <textarea required class="form-control" id="product_description"  name="product_description" cols="30"
                                         rows="3">{{ (! is_null($product) ) ? $product->description : '' }}</textarea>

                                    </div>

                                    {{--  Categories  --}}
                                    <div class="form-group col-md-12">
                                            <b-label  for="product_category" >Product Category</b-label>
                                            <select class="form-control" name="product_category" id="product_category" required>
                                                <option >Select A Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ (! is_null($product) && ($product->category->id === $category->id)) ? 'selected' : '' }}
                                                        > {{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                    </div>

                                    {{--  Units  --}}
                                    <div class="form-group col-md-12">
                                        <b-label  for="product_unit" >Product Unit</b-label>
                                        <select class="form-control" name="product_unit" id="product_unit" required>
                                            <option >Select A Unit</option>
                                            @foreach ($units as $unit)
                                                <option value="{{ $unit->id }}"
                                                    {{ (! is_null($product) && ($product->hasUnit->id === $unit->id)) ? 'selected' : '' }}
                                                    > {{ $unit->unit_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{--  total  --}}
                                    <div class="form-group col-md-6">
                                            <label for="product_price">Product Price</label>
                                            <input type="number" class="form-control" id="product_price" name="product_price" placeholder="Product Price" required
                                            value="{{ (! is_null($product) ) ? $product->price : '' }}">
                                    </div>
                                    {{--  Total  --}}
                                    <div class="form-group col-md-6">
                                            <label for="product_total">Product Total</label>
                                            <input type="number" class="form-control" id="product_total" name="product_total" placeholder="Product Total" required
                                            value="{{ (! is_null($product) ) ? $product->total : '' }}">
                                    </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
