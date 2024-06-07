@extends('layouts.inner_page')
@section('content')


<div class="body_content">
    <!-- Blog Section Area -->
    <section class="our-blog pt50">
        <div class="container">
            <div class="row wow fadeInUp" data-wow-delay="100ms">
                <div class="col-lg-12">
                    <h2 class="blog-title">{{ucfirst($article->title)}}</h2>
                    <div class="blog-single-meta">
                        <div class="post-author d-sm-flex align-items-center">
                            <?php
                            $dateString = $article->created_at;
                            $dateTime = new DateTime($dateString);
                            $formattedDate = $dateTime->format('M d, Y');
                            ?>
                            <a class="ml15 pr15 bdrr1" href="">{{ucwords($article->cat->name)}}</a><a class="ml15" href="">{{$formattedDate}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mx-auto maxw1600 mt60 wow fadeInUp" data-wow-delay="300ms">
            <div class="row">
                <div class="col-lg-12">
                    <div class="large-thumb"><img class="w-100" src="{{asset('assets/articlesImages/'. $article->featured_image) }}" alt=""></div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="roww wow fadeInUp" data-wow-delay="500ms">
                <div class="col-xl-8 offset-xl-2">
                    <div class="ui-content mt40 mb60">
                        <p class="mb25 ff-heading">{{ucfirst($article->content)}}</p>
                    </div>
                    <div class="blockquote-style1 mb60">
                        <blockquote class="blockquote">
                            <p class="fst-italic fz15 fw500 ff-heading">{{ucfirst($article->short_description)}}</p>
                        </blockquote>
                    </div>
                    <div class="ui-content mt40 mb30">
                        <h4 class="mb10">1. {{ucfirst($article->heading)}}</h4>
                        <div class="custom_bsp_grid">
                            <ul class="list-style-type-bullet p-0 ml20">
                                <li>{{ucfirst($article->excerpt)}}</li>
                            </ul>
                        </div>
                    </div>
                    @php $images = explode(',', $article->additional_images); @endphp

                    @if(!empty($images))
                    <div class="col-lg-12 mt40">
                        @foreach($images as $img)
                        <img src="{{asset('assets/articlesImages/'. $img) }}" alt="" class="bdrs12 post-img-2 w-100">
                        @break
                        @endforeach
                    </div>
                    @endif

                    <div class="mbp_pagination_tab bdrb1">
                        <div class="row justify-content-between pt45 pt30-sm pb45 pb30-sm">
                            <div class="col-md-6">
                                <div class="pag_prev">
                                    @if($previousArticle)
                                    <a href="{{route('article', ['id' => base64_encode($previousArticle->id), 'name' => base64_encode($previousArticle->title)])}}" target="_blank">
                                        <h6><span class="fas fa-chevron-left pe-2"></span> Previous Article</h6>
                                        <p class="fz13 text mb-0">{{ucfirst($previousArticle->title)}}</p>
                                    </a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="pag_next">
                                    @if($nextArticle)
                                    <a href="{{route('article', ['id' => base64_encode($nextArticle->id), 'name' => base64_encode($nextArticle->title)])}}" class="text-end" target="_blank">
                                        <h6>Next Article<span class="fas fa-chevron-right ps-2"></span></h6>
                                        <p class="fz13 text mb-0">{{ucfirst($nextArticle->title)}}</p>
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bsp_reveiw_wrt">
                        <h6 class="fz17">Leave A Review</h6>
                        <form class="comments_form mt30">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-4">
                                        <label class="fw600 ff-heading mb-2">Email</label>
                                        <input type="email" class="form-control" placeholder="creativelayers088">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label class="fw600 ff-heading mb-2">Title</label>
                                        <input type="text" class="form-control" placeholder="Enter Title">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="widget-wrapper sideborder-dropdown mb-4">
                                        <label class="fw600 ff-heading mb-2">Rating</label>
                                        <div class="form-style2 input-group">
                                            <select class="selectpicker" data-live-search="true" data-width="100%">
                                                <option>Rating</option>
                                                <option data-tokens="Five Star">Five Star</option>
                                                <option data-tokens="Four Star">Four Star</option>
                                                <option data-tokens="Three Star">Three Star</option>
                                                <option data-tokens="Two Star">Two Star</option>
                                                <option data-tokens="One Star">One Star</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-4">
                                        <label class="fw600 ff-heading mb-2">Review</label>
                                        <textarea class="pt15" rows="6" placeholder="Write a Review"></textarea>
                                    </div>
                                    <a href="page-property-single-v1.html" class="ud-btn btn-white2">Submit Review<i class="fal fa-arrow-right-long"></i></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @endsection