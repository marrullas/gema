
    <div class="row">
        <div class="toppad  pull-right">
            <A href="{{ route('admin.users.edit', $user) }}" >Editar perfil</A>

            {{--<A href="edit.html" >Logout</A>--}}
            <br>
            <p class=" text-info">Ultimo ingreso: {{$user->last_login}} </p>
        </div>
        <div class="toppad" >


            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">{{$user->full_name}}</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100" class="img-circle"> </div>

                        <!--<div class="col-xs-10 col-sm-10 hidden-md hidden-lg"> <br>
                          <dl>
                            <dt>DEPARTMENT:</dt>
                            <dd>Administrator</dd>
                            <dt>HIRE DATE</dt>
                            <dd>11/12/2013</dd>
                            <dt>DATE OF BIRTH</dt>
                               <dd>11/12/2013</dd>
                            <dt>GENDER</dt>
                            <dd>Male</dd>
                          </dl>
                        </div>-->
                        <div class=" col-md-9 col-lg-9 ">
                            <table class="table table-user-information">
                                <tbody>
                                <tr>
                                    <td>Documento:</td>
                                    <td>{{$user->documento}}</td>
                                </tr>
                                <tr>
                                    <td>Telefono 1:</td>
                                    <td>{{$user->telefono1}}</td>
                                </tr>
                                <tr>
                                    <td>Telefono 2:</td>
                                    <td>{{$user->telefono2}}</td>
                                </tr>

                                <tr>
                                <tr>
                                    <td>Email:</td>
                                    <td><a href="mailto:{{$user->email}}">{{$user->email}}</a></td>
                                </tr>
                                <tr>
                                    <td>Email 2:</td>
                                    <td><a href="mailto:{{$user->email2}}">{{$user->email2}}</a></td>
                                </tr>
                                <tr>
                                    <td>Titulo:</td>
                                    <td>{{$user->titulo}}</td>
                                </tr>
                                <td>Profesión:</td>
                                <td>{{$user->profesión}}</td>

                                </tr>

                                </tbody>
                            </table>

                            <a href="#" class="btn btn-primary">Rendimiento de tareas</a>
                            <a href="#" class="btn btn-primary">Estatus SIG</a>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                        <span class="pull-right">
                            <a href="{{ route('admin.users.edit', $user) }}" data-original-title="Editar este perfil" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                            <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                        </span>
                </div>

            </div>
        </div>
    </div>
