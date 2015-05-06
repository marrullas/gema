<!-- Scripts -->

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

@yield('scripts')
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
    });


</script>

{!! HTML::script('/css/assets/js/jquery.metisMenu.js') !!}
{!! HTML::script('/css/assets/js/morris/raphael-2.1.0.min.js') !!}
{{--{!! HTML::script('/css/assets/js/morris/morris.js') !!}--}}

{{--{!! HTML::script('/css/assets/js/custom.js') !!}--}}



</body>
</html>
