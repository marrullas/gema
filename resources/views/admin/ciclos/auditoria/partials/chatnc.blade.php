
{{--    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
--}}{{--                <div class="panel-heading">
                    <span class="glyphicon glyphicon-comment"></span> --}}{{----}}{{--Chat--}}{{----}}{{--

                </div>--}}{{--
                <div class="panel-body-chat">--}}
                    <ul class="chat">
                        @foreach($nc->seguimientos as $i => $seguimiento)
                        <li class="{{!($i%2==0)?'left clearfix':'right clearfix'}}"><span class="{{!($i%2==0)?'chat-img pull-left':'chat-img pull-right'}}">
                            {{--<img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />--}}
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font">Nota: </strong> <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time"></span>{!! $seguimiento->created_at !!}</small>
                                </div>
                                <p>
                                    {!! $seguimiento->detalle !!}
                                </p>
                            </div>
                        </li>
                        @endforeach
                        <li>
                            {!! Form::open(['url'=> ['auditoria/agregarseguimiento',$nc], 'method' => 'POST'] ) !!}
                            <div class="input-group">
                                {!! Form::text('texto', null, ['class' => 'form-control', 'placeholder'=>'Ingresar texto']) !!}
                                {{--<input id="btn-input" type="text" class="form-control input-large" placeholder="Escribir nota aqui" />--}}
                                <span class="input-group-btn">
                            <button type="submit" class="btn btn-success btn-sm" id="btn-chat">
                                Enviar</button>
                        </span>

                            </div>
                            {!! Form::close() !!}
                        </li>
                    </ul>
               {{-- </div>--}}
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

