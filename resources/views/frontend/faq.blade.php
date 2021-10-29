
@extends('frontend.master')

@section('header')
<section class="section-pagetop bg_gray ">
    <div class="container">
        <h2 class="title-page">FAQ</h2>
    </div> <!-- container //  -->
    </section>
@endsection


@section('content')

<!-- ? Page section  -->
<div class="container pb-5">
    <div>
        @foreach ($blog as $item)
        <div class="accordion mt-5">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button
                        class="accordion-button custom-fs-25 bg-white text-dark border border-dark collapsed border-1 @if($loop->first)active @endif"
                        type="button" data-bs-toggle="collapse" data-bs-target="#question-{{$item->id}}" aria-expanded="true"
                        aria-controls="collapseOne">
                        {{$item->title}}
                    </button>
                </h2>
                <div id="question-{{$item->id}}" class="accordion-collapse collapse bg-light @if($loop->first)show @endif" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body custom-subtitle-2">
                        {{$item->desrc}}

                    </div>
                </div>
            </div>
        </div>
        @endforeach


    </div>
</div>
<!-- ============== -
@endsection

