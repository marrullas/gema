<!-- Scripts -->

{{--<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>--}}
{{--<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>--}}

@yield('scripts')
{!! HTML::script('/css/assets/js/custom.js') !!}
{!!Html::style('/bower_resources/wysihtml5/dist/bootstrap3-wysihtml5.css')!!}
{!! HTML::script('/bower_resources/wysihtml5/dist/bootstrap3-wysihtml5.all.min.js') !!}


<script type="text/javascript">

    $(document).ready( function() {
        //$(".textarea").Editor();
        $('.textarea').wysihtml5({
            toolbar : {
                html:false
            }
        });
        @if(Auth::check())
        //opciones menu auditoria
        $.get('/devolverncsajax', function(data){
            var $ulsub = $("#ulpendientes");
            $("#ncspendientescount").html(data.ncspendientes.length);
            $.each(data.ncspendientes, function (i, item) {
                //console.log(item);
                $ulsub.append( // append directly here
                        '<hr><li data-grid-id="' + item.id +
                        '"><a href="{{ url('auditoria/auditaractividad') }}/'+item.auditoria_id+'">' +item.descripcion
                );
            })
            @if((Auth::user()->type == 'admin' || Auth::user()->type == 'auditor'))
            var $ulsub = $("#uldevueltas");
            $("#ncsdevueltascount").html(data.ncsdevueltas.length);
            $.each(data.ncsdevueltas, function (i, item) {
                //console.log(item);
                $ulsub.append( // append directly here
                        '<hr><li data-grid-id="' + item.id +
                        '"><a href="{{ url('admin/auditoria') }}/'+item.auditoria_id+'/edit">' + item.descripcion
                );
            })
            @endif
            //console.log(data);
        });
        @endif
    });

    function GetTime(date) {
        var currentTime = (new Date(date))
        var hours = currentTime.getHours()
        //Note: before converting into 12 hour format
        var suffix = "";
        if (hours > 11) {
            suffix += "PM";
        } else {
            suffix += "AM";
        }
        var minutes = currentTime.getMinutes()
        if (minutes < 10) {
            minutes = "0" + minutes
        }
        if (hours > 12) {
            hours -= 12;
        } else if (hours === 0) {
            hours = 12;
        }
        var time = hours + ":" + minutes + " " + suffix;
        return time;
    }
</script>
<script src="{{ asset('css/assets/js/parsley/parsley.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('css/assets/js/parsley/es.js') }}" type="text/javascript"></script>
{!! HTML::script('/css/assets/js/jquery.metisMenu.js') !!}
{{--{!! HTML::script('/css/assets/js/morris/raphael-2.1.0.min.js') !!}
{!! HTML::script('/css/assets/js/morris/morris.js') !!}--}}
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.6/Chart.min.js"></script>
{{--{!! HTML::script('/css/assets/js/custom.js') !!}--}}



</body>
</html>
