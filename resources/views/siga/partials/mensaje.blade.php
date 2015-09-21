<article class="row">
    <div class="col-md-2 col-sm-2 hidden-xs">
        <figure class="thumbnail">
            <img class="img-responsive" src="http://www.keita-gaming.com/assets/profile/default-avatar-c5d8ec086224cb6fc4e395f4ba3018c2.jpg" />
            <figcaption class="text-center">{{$mensaje->user->full_name}}</figcaption>
        </figure>
    </div>
    <div class="col-md-10 col-sm-10">
        <div class="panel panel-default arrow left">
            <div class="panel-body">
                <header class="text-left">
                    <div class="panel-title right"><strong>{{$mensaje->titulo}}</strong></div>
                    <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> {{$mensaje->created_at}}</time>

                </header>
                <div class="comment-post">
                    <p>
                        {{$mensaje->contenido}}
                    </p>
                </div>
  {{--              <p class="text-right">
                    <a class="btn btn-default btn-sm" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fa fa-reply"></i> Responder
                    </a>
                </p>--}}
            </div>
        </div>
    </div>
</article>