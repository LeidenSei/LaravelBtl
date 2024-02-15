@extends('fe.index')
@section('main')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('index')}}"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$blog->name}}</li>
            </ol>
        </div><!-- End .container -->
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <article class="post single">
                    <div class="post-media">
                        <img src="{{ asset('storage/images') }}/{{ $blog->image }}" alt="Post">
                    </div><!-- End .post-media -->

                    <div class="post-body">
                        <div class="post-date">
                            <span class="month">{{$blog->created_at}}</span>
                        </div><!-- End .post-date -->

                        <h2 class="post-title">{{$blog->name}}</h2>

                        <div class="post-content">
                           {!!$blog->content!!}
                        </div><!-- End .post-content -->

                        <div class="post-share">
                            <h3 class="d-flex align-items-center">
                                <i class="fas fa-share"></i>
                                Share this post
                            </h3>

                            <div class="social-icons">
                                <a href="#" class="social-icon social-facebook" target="_blank"
                                    title="Facebook">
                                    <i class="icon-facebook"></i>
                                </a>
                                <a href="#" class="social-icon social-twitter" target="_blank" title="Twitter">
                                    <i class="icon-twitter"></i>
                                </a>
                                <a href="#" class="social-icon social-linkedin" target="_blank"
                                    title="Linkedin">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#" class="social-icon social-gplus" target="_blank" title="Google +">
                                    <i class="fab fa-google-plus-g"></i>
                                </a>
                                <a href="#" class="social-icon social-mail" target="_blank" title="Email">
                                    <i class="icon-mail-alt"></i>
                                </a>
                            </div><!-- End .social-icons -->
                        </div><!-- End .post-share -->
                        

                        

                    
                    </div><!-- End .post-body -->
                </article><!-- End .post -->

                <hr class="mt-2 mb-1">

                <div class="related-posts">
                    <h4>Recent<strong>Posts</strong></h4>

                    <div class="owl-carousel owl-theme related-posts-carousel" data-owl-options="{
                        'dots': false
                    }">
                    @foreach ($recentBlog as $item)
                    <article class="post">
                        <div class="post-media zoom-effect">
                            <a href="{{route('blog.detail',$item->slug)}}">
                                <img src="{{ asset('storage/images') }}/{{ $item->image }}" style="height: 280px; width:100%;" alt="Post">
                            </a>
                        </div><!-- End .post-media -->

                        <div class="post-body">

                            <h2 class="post-title">
                                <a href="{{route('blog.detail',$item->slug)}}">{{$item->name}}</a>
                             
                            </h2>
                            <span>{{$item->created_at}}</span>
                            <div class="post-content">
                            
                                <a href="{{route('blog.detail',$item->slug)}}" class="read-more">read more <i
                                        class="fas fa-angle-right"></i></a>
                            </div><!-- End .post-content -->
                        </div><!-- End .post-body -->
                    </article>
                    @endforeach


                    </div><!-- End .owl-carousel -->
                </div><!-- End .related-posts -->
            </div><!-- End .col-lg-9 -->

            <div class="sidebar-toggle custom-sidebar-toggle">
                <i class="fas fa-sliders-h"></i>
            </div>
            <div class="sidebar-overlay"></div>
        </div><!-- End .row -->
    </div><!-- End .container -->
</main><!-- End .main -->
@endsection