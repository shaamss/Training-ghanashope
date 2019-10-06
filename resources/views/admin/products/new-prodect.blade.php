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
                                        <textarea class="form-control" id="product_description"  name="product_description" cols="30"
                                         rows="3">{{ (! is_null($product) ) ? $product->description : '' }}</textarea>

                                    </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
