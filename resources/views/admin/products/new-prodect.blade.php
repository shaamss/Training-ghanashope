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

                                    <div class="form-group col-md-12">
                                        <b-label  for="product_unit" >Product Unit</b-label>
                                        <select class="form-control" name="product_unit" id="product_unit" required>
                                            <option >Select A Category</option>
                                            @foreach ($units as $unit)
                                                <option value="{{ $unit->id }}"
                                                    {{ (! is_null($product) && ($product->hasUnit->id === $unit->id)) ? 'selected' : '' }}
                                                    > {{ $unit->unit_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
