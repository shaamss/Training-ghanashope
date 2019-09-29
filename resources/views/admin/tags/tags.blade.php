@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> Tags </div>
                <div class="card-body">

                        <form method="post" action="{{ route('tags') }}" class="row">
                                @csrf

                                    <div class="form-group col-md-12">
                                        <label for="tag_name">Tag Name</label>
                                        <input type="text" class="form-control" id="tag_name" name="tag_name" placeholder="Tag Name" required >
                                    </div>
                                    {{-- <div class="form-group col-md-6">
                                            <label for="unit_code">Unit Code</label>
                                            <input type="text" class="form-control" id="unit_code" name="unit_code" placeholder="Tag Code" required >
                                    </div> --}}
                                    <div class="form-group col-md-12">
                                        <button type="submit" class="btn btn-primary">Save New Tag</button>
                                    </div>

                            </form>

                    <div class="row">
                        @foreach ($tags as $tag)
                        <div class="col-md-3">
                            <div class="alert alert-primary" role="alert">
                                {{ $tag->tag }}
                            </div>
                        </div>

                        @endforeach
                    </div>
                    {{ $tags->links() }}
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
                <strong class="mr-auto">Tag</strong>
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
