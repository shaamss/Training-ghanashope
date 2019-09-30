@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"> Categories </div>
                    <div class="card-body">

                            <form method="post" action="{{ 'categories' }}" class="row">
                                    @csrf

                                        <div class="form-group col-md-6">
                                            <label for="category_name">Category Name</label>
                                            <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Category Name" required >
                                        </div>

                                        <div class="form-group col-md-12">
                                            <button type="submit" class="btn btn-primary">Save New Category</button>
                                        </div>

                                </form>

                        <div class="row">
                            @foreach ($categories as $category)
                                <div class="col-md-3">

                                    <div class="alert alert-primary" role="alert">
                                        <p>{{ $category->name }}</p>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                        {{-- {{ $categories->links() }} --}}

                        {{ (!is_null($showLinks) && $showLinks) ? $categories->links() : '' }}
                    </div>
                </div>
            </div>
        </div>
    </div>



    @if (Session::has('message'))
              {{-- Toast --}}
        <div class="toast" style="position: absolute; top: 10%; right: 10%;">
            <div class="toast-header">
                <strong class="mr-auto">Unit</strong>
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

    <script>

    </script>
     @if (Session::has('message'))
                <script>
                    jQuery(document).ready(function($){
                        var $toast = $('.toast').toast({
                            autohide :false
                        });

                        $toast.toast('show');
                    })
                </script>
    @endif


@endsection
