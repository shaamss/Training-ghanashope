@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> Reviews </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($reviews as $review)

                            <div class="col-md-3">

                                <div class="alert alert-primary" role="alert">
                                    <h3>{{ $review->customer->formattedName() }}</h3>
                                    <p>{{ $review->product->title }}</p>
                                    <p>Stars: {{ $review->stars }}</p>
                                </div>

                            </div>

                        @endforeach
                    </div>
                    {{ $reviews->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
