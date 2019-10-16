@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"> Products <a class="btn btn-primary" href="{{ route ('new-product') }}"><i class="fas fa-plus"></i></i></a></div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($products as $product)

                            <div class="col-md-4">

                                <div class="alert alert-primary" role="alert">
                                  <h3>{{ $product->title }}</h3>
                                   <p>Category: {{ (is_object($product->category )) ? $product->category->name : '' }}</p>
                                    <p>Price: {{ $product->price }} {{ $currency_code }}</p>
                                   {{-- if exist images = Show image | elss = show '' --}}
                                   {!! (count($product->images)>0) ? '<img class="img-thumbnail card-img" src= " '. $product->images[0]->url .' ">' : '' !!}
                                   {{-- <img class="img-thumbnail card-img" src="{{ (count($product->images)>0) ? $product->images[0]->url : '' }}" alt=""> --}}

                                   <a class="btn btn-success mt-2" href="{{ route('update-product', ['id' => $product->id]) }}">Update Product</a>
                                </div>

                            </div>

                            @endforeach
                        </div>
                        {{ $products->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>


           {{-- Toast Message --}}
           @if (Session::has('message'))
           {{-- Toast --}}
               <div class="toast" style="position: absolute; top: 10%; right: 10%;">
                   <div class="toast-header">
                   <strong class="mr-auto">Products</strong>
                   {{-- <small>11 mins ago</small> --}}
                   <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                   </button>
                   </div>
                   <div class="toast-body">

                       {{ Session::get('message') }}

                   </div>
               </div>
           @endif

@endsection

@section('script')

@if (Session::has('message'))

<script>
    $(document).ready(function(){
        var $toast = $('.toast').toast({
            autohide : false ,
        });

        $toast.toast('show');
    });
</script>

@endif

@endsection
