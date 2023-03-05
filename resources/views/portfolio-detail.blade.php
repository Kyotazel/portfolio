@extends('layouts.main')

@push('style')
    @livewireStyles
@endpush

@push('script')
    @livewireScripts
@endpush

@section('content')
    <section id="portfolio" class="text-center px-lg-5" style="min-height: 100vh">
        <div class="container">

            <div class="row p5-3 pb-5" data-aos="fade-up">
                <div class="col-lg-12">
                    <h1>{{$portfolio->title}}</h1>
                </div>
            </div>

            <div class="row gy-4 mt-2">

                <div class="col-md-8 text-start">
                    <img class="rounded-4 bg-light" style="height: 240px; width:auto" src='{{ asset("storage/portfolio/$portfolio->image") }}' alt="">
                </div>
                <div class="col-md-12 text-start">
                    {!! $portfolio->content !!}
                </div>

            </div>
        </div>
    </section>
@endsection