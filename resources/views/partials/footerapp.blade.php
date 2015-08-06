<!-- Scripts -->



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

{!! HTML::script('/css/assets/js/jquery.metisMenu.js') !!}
{!! HTML::script('/css/assets/js/morris/raphael-2.1.0.min.js') !!}
{{--{!! HTML::script('/css/assets/js/morris/morris.js') !!}--}}

{{--{!! HTML::script('/css/assets/js/custom.js') !!}--}}



</body>
</html>
