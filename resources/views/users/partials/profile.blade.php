
    <div class="row">
        <div class="toppad  pull-right">

            {{--<A href="edit.html" >Logout</A>--}}
            <br>
            <p class=" text-info">Último ingreso: {{$user->last_login}} </p>
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
{{--                                <tr>
                                    <td>Titulo:</td>
                                    <td>{{$user->titulo}}</td>
                                </tr>
                                <td>Profesión:</td>
                                <td>{{$user->profesión}}</td>

                                </tr>--}}

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                </div>

            </div>
        </div>
    </div>
