<article class="row">
    <div class="col-md-2 col-sm-2 col-md-offset-1 col-sm-offset-0 hidden-xs">
        <figure class="thumbnail">
            <img class="img-responsive" src="http://www.keita-gaming.com/assets/profile/default-avatar-c5d8ec086224cb6fc4e395f4ba3018c2.jpg" />
            <figcaption class="text-center">{{$mensaje->user->full_name}}</figcaption>
        </figure>
    </div>
    <div class="col-md-9 col-sm-9">
        <div class="panel panel-default arrow left">
            <div class="panel-heading right">Respuesta</div>
            <div class="panel-body">
                <header class="text-left">
                    <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> {{$mensaje->created_at}}</time>
                </header>
                <div class="comment-post">
                    <p>
                        {{$mensaje->contenido}}
                    </p>
                </div>
                {{--<p class="text-right"><a href="#" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> reply</a></p>--}}
            </div>
        </div>
    </div>
</article>