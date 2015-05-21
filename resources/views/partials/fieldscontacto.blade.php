@if(!Auth::check())
                   <div class="form-group">
                             {!! Form::label('email', 'E-Mail', ['class' => 'control-label col-md-4' ]) !!}
                             {!! Form::email('email', null, ['class' => 'form-control col-md-4' ]) !!}
                         </div>
@else

        {!! Form::hidden('email',Auth::user()->email) !!}

@endif

  
                 <div class="form-group">
                         {!! Form::label('subject', 'Asunto', ['class' => 'control-label col-md-4' ]) !!}
                         {!! Form::text('subject', null, ['class' => 'form-control col-md-4' ]) !!}
                     </div>
                 <div class="form-group">
                         {!! Form::label('body', 'Mensaje',['class' => 'control-label col-md-4' ]) !!}
                         {!! Form::textarea('body', null, ['class' => 'form-control col-md-4' ]) !!}
                     </div>
                 <div class="form-group">
                         {!! Form::submit('Enviar', ['class' => 'btn btn-success col-md-4' ] ) !!}
                     </div>

