@extends('layouts.main')

@push('style')
    @livewireStyles
@endpush

@push('script')
    @livewireScripts
@endpush

@section('content')
    <section id="home" class="full-height px-lg-5">

        <div class="container">
            <div class="row">
                <div class="col-lg-10">
                    <h1 class="display-4 fw-bold" data-aos="fade-up">I'M A <span class="text-brand">Web
                            developer</span></h1>
                    <p class="lead mt-2 mb-4" data-aos="fade-up" data-aos-delay="300">I am Okta Ari Aditya, And I
                        web developer with expertise in Fullstack development using various programming languages
                        including HTML, CSS, JavaScript, PHP, and MySQL. I am highly skilled in problem-solving. I
                        am equally comfortable working independently or as part of a team.</p>
                    <div data-aos="fade-up" data-aos-delay="600">
                        <a href="#work" class="btn btn-brand me-3">Explore My Work</a>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- //HOME -->

    <!-- ABOUT -->
    <section id="about" class="full-height px-lg-5">
        <div class="container">

            <div class="row pb-4" data-aos="fade-up">
                <div class="col-lg-8">
                    <h6 class="text-brand">ABOUT</h6>
                </div>
            </div>

            <h1>My Skill, Education & Experiance</h1>
            <div class="row gy-5">
                <div class="col-lg-12">
                    <h3 class="mb-4" data-aos="fade-up" data-aos-delay="300">Skills</h3>

                    <div class="row gy-4">
                        <div class="col-6" data-aos="fade-up" data-aos-delay="600">
                            <ul>
                                @foreach ($skills as $key => $skill)
                                    @if ($key < count($skills) / 2)
                                        <li>
                                            <h5>{{ $skill->name }}</h5>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-6" data-aos="fade-up" data-aos-delay="600">
                            <ul>
                                @foreach ($skills as $key => $skill)
                                    @if ($key > count($skills) / 2)
                                        <li>
                                            <h5>{{ $skill->name }}</h5>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">

                    <h3 class="mb-4" data-aos="fade-up" data-aos-delay="300">Education</h3>
                    <div class="row gy-4">

                        @foreach ($educations as $education)
                        <div class="col-12" data-aos="fade-up" data-aos-delay="600">
                            <div class="bg-base p-4 rounded-4 shadow-effect">
                                <h4>{{$education->name . " (" . $education->first_time . " - " . $education->last_time . ")"}}</h4>
                                <p class="text-brand mb-2">{{$education->major}}</p>
                                {!!$education->description!!}
                            </div>
                        </div>
                        @endforeach

                    </div>

                </div>

                <div class="col-lg-6">

                    <h3 class="mb-4" data-aos="fade-up" data-aos-delay="300">Experiance</h3>
                    <div class="row gy-4">

                        @foreach ($experiences as $experience)
                        <div class="col-12" data-aos="fade-up" data-aos-delay="600">
                            <div class="bg-base p-4 rounded-4 shadow-effect">
                                <h4>{{$experience->proffesion}}</h4>
                                <p class="text-brand mb-2">{{$experience->name . " (" . $experience->first_time . " - " . $experience->last_time . ")"}}</p>
                                {!! $experience->description !!}
                            </div>
                        </div>
                        @endforeach

                    </div>

                </div>

            </div>

        </div>
    </section>
    <!-- //ABOUT -->

    <!-- SERVICES -->
    <section id="services" class="full-height px-lg-5">
        <div class="container">

            <div class="row pb-4" data-aos="fade-up">
                <div class="col-lg-8">
                    <h6 class="text-brand">SERVICES</h6>
                    <h1>Services That I Provide</h1>
                </div>
            </div>

            <div class="row gy-4">

                @foreach ($services as $service)
                <div class="col-md-4" data-aos="fade-up">
                    <div class="service p-4 bg-base rounded-4 shadow-effect">
                        <div class="iconbox rounded-4">
                            <i class="{{$service->icon}}"></i>
                        </div>
                        <h5 class="mt-4 mb-2">{{$service->title}}</h5>
                        <p>{{$service->short_content}}</p>
                        <a href="/service/{{$service->slug}}" class="link-custom">Read More</a>
                    </div>
                </div>
                @endforeach

            </div>

        </div>
    </section>
    <!-- SERVICES -->

    <!-- WORK -->
    <section id="work" class="full-height px-lg-5">
        <div class="container">

            <div class="row pb-4" data-aos="fade-up">
                <div class="col-lg-8">
                    <h6 class="text-brand">WORK</h6>
                    <h1>My Recent Projects</h1>
                </div>
            </div>

            <div class="row gy-4">

                @foreach ($portfolios as $portfolio)
                <div class="col-md-4" data-aos="fade-up">
                    <div class="card-custom rounded-4 bg-base shadow-effect">
                        <div class="card-custom-image rounded-4">
                            <img class="rounded-4 bg-light" src='{{ asset("storage/portfolio/$portfolio->image") }}' alt="">
                        </div>
                        <div class="card-custom-content p-4">
                            <h4>{{$portfolio->title}}</h4>
                            <p>{{$portfolio->short_content}}</p>
                            <a href="/portfolio/{{$portfolio->slug}}" class="link-custom">Read More</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="col-md-12 text-center mt-5">
                <a href="/portfolios" class="btn btn-brand">View All Portfolio</a>
            </div>

        </div>
    </section>
    <!-- //WORK -->

    <!-- BLOG -->
    <section id="blog" class="full-height px-lg-5">
        <div class="container">

            <div class="row pb-4" data-aos="fade-up">
                <div class="col-lg-8">
                    <h6 class="text-brand">BLOG</h6>
                    <h1>My BLog Posts</h1>
                </div>
            </div>

            <div class="row gy-4">

                @foreach ($blogs as $blog)
                <div class="col-md-4" data-aos="fade-up">
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

                <div class="col-md-12 text-center mt-5">
                    <a href="/blogs" class="btn btn-brand">View All Blog</a>
                </div>

            </div>

        </div>
    </section>
    <!-- //BLOG -->

    <!-- CONTACT -->
    <section id="contact" class="full-height px-lg-5">
        <div class="container">

            <div class="row justify-content-center text-center">
                <div class="col-lg-8 pb-4" data-aos="fade-up">
                    <h6 class="text-brand">CONTACT</h6>
                    <h1>Interested in working together? Let's talk
                    </h1>
                </div>


                <div class="col-lg-8" data-aos="fade-up">
                    <form id="contact_me" class="row g-lg-3 gy-3">
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter your name">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Enter your email">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-12">
                            <input type="text" class="form-control" id="subject" name="subject"
                                placeholder="Enter subject">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-12">
                            <textarea rows="4" class="form-control" id="message" name="message" placeholder="Enter your message"></textarea>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-12 d-grid">
                            <button type="submit" class="btn btn-brand btn_submit">Contact me</button>
                        </div>
                    </form>
                </div>
            </div>


        </div>

    </section>
    <!-- //CONTACT -->
@endsection

@push('scripts')
    <script>
        $(".btn_submit").on('click', function(e) {
            e.preventDefault();
            var formData = new FormData($('#contact_me')[0]);
            $.ajax({
                url: "{{ route('contact-me') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data) {
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil",
                        text: data.text,
                    })
                    $('.invalid-feedback').empty();
                    $('.form-control').removeClass('is-invalid');
                    $('#contact_me')[0].reset();

                },
                error: function(res) {
                    let errors = res.responseJSON?.errors

                    $('.invalid-feedback').empty();
                    $('.form-control').removeClass('is-invalid');

                    if (errors) {
                        for (const [key, value] of Object.entries(errors)) {
                            $(`[name=${key}]`).addClass("is-invalid");
                            $(`[name=${key}]`).next().html(value);
                        }
                    }
                }
            })
        })
    </script>
@endpush
