
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-comment"></span> {{--Chat--}}
{{--                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-chevron-down"></span>
                        </button>
                        <ul class="dropdown-menu slidedown">
                            <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-refresh">
                            </span>Refresh</a></li>
                            <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-ok-sign">
                            </span>Available</a></li>
                            <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-remove">
                            </span>Busy</a></li>
                            <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-time"></span>
                                    Away</a></li>
                            <li class="divider"></li>
                            <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-off"></span>
                                    Sign Out</a></li>
                        </ul>
                    </div>--}}
                </div>
                <div class="panel-body-chat">
                    <ul class="chat">
                        @foreach($nc->seguimientos as $i => $seguimiento)
                        <li class="{{!($i%2==0)?'left clearfix':'right clearfix'}}"><span class="{{!($i%2==0)?'chat-img pull-left':'chat-img pull-right'}}">
                            {{--<img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />--}}
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font">Nota: {{$i}}</strong> <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time"></span>{!! $seguimiento->created_at !!}</small>
                                </div>
                                <p>
                                    {!! $seguimiento->detalle !!}
                                </p>
                            </div>
                        </li>
                        @endforeach
{{--                        <li class="right clearfix"><span class="chat-img pull-right">
                            <img src="http://placehold.it/50/FA6F57/fff&text=ME" alt="User Avatar" class="img-circle" />
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>13 mins ago</small>
                                    <strong class="pull-right primary-font">Bhaumik Patel</strong>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                    dolor, quis ullamcorper ligula sodales.
                                </p>
                            </div>
                        </li>
                        <li class="left clearfix"><span class="chat-img pull-left">
                            <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font">Jack Sparrow</strong> <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time"></span>14 mins ago</small>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                    dolor, quis ullamcorper ligula sodales.
                                </p>
                            </div>
                        </li>
                        <li class="right clearfix"><span class="chat-img pull-right">
                            <img src="http://placehold.it/50/FA6F57/fff&text=ME" alt="User Avatar" class="img-circle" />
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>15 mins ago</small>
                                    <strong class="pull-right primary-font">Bhaumik Patel</strong>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                    dolor, quis ullamcorper ligula sodales.
                                </p>
                            </div>
                        </li>--}}
                    </ul>
                </div>
{{--                <div class="panel-footer">
                    {!! Form::open(['url'=> ['admin/auditoria/crearnota',$nc], 'method' => 'POST','files' => true ] ) !!}
                    <div class="input-group">
                        <input id="btn-input" type="text" class="form-control input-large" placeholder="Escribir nota aqui" />
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-warning btn-sm" id="btn-chat">
                                Enviar</button>
                        </span>

                    </div>
                    {!! Form::close() !!}
                </div>--}}
            </div>
        </div>
    </div>

