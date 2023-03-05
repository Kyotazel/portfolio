@extends('layouts.main')

@push('style')
    @livewireStyles
@endpush

@push('script')
    @livewireScripts
@endpush

@section('content')
    <section id="blog" class="text-center px-lg-5">
        <div class="container">

            <div class="row pb-4" data-aos="fade-up">
                <div class="col-lg-12">
                    <h1>Blogs</h1>
                    <h6 class="text-brand">My Recent Post</h6>
                </div>
            </div>

            <div class="row gy-4">

                @foreach ($blogs as $blog)
                <div class="col-md-4 text-start" data-aos="fade-up">
                    <div class="card-custom rounded-4 bg-base shadow-effect">
                        <div class="card-custom-image rounded-4">
                            <img class="rounded-4 bg-light" src='{{ asset("storage/blog/$blog->image") }}' alt="">
                        </div>
                        <div class="card-custom-content p-4">
                            <p class="text-brand mb-2">{{date_format($blog->created_at, 'd-m-Y')}}</p>
                            <h5 class="mb-4">{{$blog->title}}</h5>
                            <p>{{$blog->short_content}}</p>
                            <a href="/blog/{{$blog->slug}}" class="link-custom">Read More</a>
                        </div>
                    </div>
                </div>
                @endforeach


            </div>
        </div>
    </section>
@endsection
