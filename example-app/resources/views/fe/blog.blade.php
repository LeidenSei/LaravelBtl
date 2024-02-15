@extends('fe.index')
@section('main')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('index')}}"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Blog</li>
            </ol>
        </div><!-- End .container -->
    </nav>

    <div class="container">

        <div class="row">
            <div class="col-lg-3">
                <form action="{{route('blog')}}" method="get">
                    <div class="input-group rounded">
                        <input type="search" class="form-control rounded" name="keyname" placeholder="Search blog" aria-label="Search" aria-describedby="search-addon" />
                        <button class="input-group-text border-0" id="search-addon">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                </form>
            </div>
            <div class="col-lg-12">
                <div class="blog-section row">
                    @foreach ($blog as $item)
                    <div class="col-md-6 col-lg-4">
                        <article class="post">
                            <div class="post-media">
                                <a href="{{route('blog.detail',$item->slug)}}">
                                    <img src="{{ asset('storage/images') }}/{{ $item->image }}" style="height: 280px; width:100%;" alt="Post" width="225"
                                        height="280">
                                </a>
                                <div class="post-date">
                                    <span class="month">{{$item->created_at}}</span>
                                </div>
                            </div><!-- End .post-media -->

                            <div class="post-body">
                                <h2 class="post-title">
                                    <a href="{{route('blog.detail',$item->slug)}}">{{$item->name}}</a>
                                </h2>
                                <div class="post-content">
                                    <p>{!!$item->description!!}</p>
                                </div><!-- End .post-content -->
                                
                            </div><!-- End .post-body -->
                        </article><!-- End .post -->
                    </div>
                    @endforeach

                </div>
                {{ $blog->links() }}
            </div><!-- End .col-lg-9 -->

            <div class="sidebar-toggle custom-sidebar-toggle">
                <i class="fas fa-sliders-h"></i>
            </div>
            <div class="sidebar-overlay"></div>
        </div><!-- End .row -->
    </div><!-- End .container -->
   
</main><!-- End .main -->

@endsection