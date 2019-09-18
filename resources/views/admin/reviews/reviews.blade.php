<?php
 //use Illuminate\Support\Carbon;
 use Carbon\Carbon;
?>
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
                                    <p>{{ $review->review }}</p>
                                    <p>Stars:
                                        @php
                                            $total = 5; //total stars range from database
                                            $currentStars = $review->stars; //exist stars from  each item in database
                                            $remainingStars = $total - $currentStars ;
                                        @endphp
                                        @for ($i = 0; $i < $review->stars; $i++)
                                        <i class="fas fa-star"></i>
                                        @endfor
                                        @for ($i = 0; $i < $remainingStars; $i++)
                                            <i class="far fa-star"></i>
                                        @endfor
                                    </p>
                                    {{-- <p>Date: {{ Carbon::createFromTimeStamp(strtotime($review->created_at))->diffForHumans() }}</p> --}}
                                    <p>Date: {{ $review->humanFormattedTime() }}</p>

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
