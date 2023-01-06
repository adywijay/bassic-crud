<div class="row">
    <div class="col s12 m4 l2"></div>
    <div class="col s12 m4 l8">
        @if ($message = Session::get('success'))
            <div class="alert card green white-text">
                <div class="card-content">
                    <p>
                        <i class="material-icons">check_circle</i><span>Success :</span> {{ $message }}.
                    </p>
                </div>
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="alert card red white-text">
                <div class="card-content">
                    <p><i class="material-icons">report</i><span>Warning :</span> {{ $message }}.</p>
                </div>
            </div>
        @endif

        @if ($message = Session::get('warning'))
            <div class="alert card amber white-text">
                <div class="card-content">
                    <p><i class="material-icons">report_problem</i><span>Warm :</span> {{ $message }}.
                    </p>
                </div>
            </div>
        @endif

        @if ($message = Session::get('info'))
            <div class="alert card blue white-text">
                <div class="card-content">
                    <p><i class="material-icons">info</i><span>Info :</span> {{ $message }}.</p>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert card red white-text">
                <div class="card-content">
                    <p><i class="material-icons">report</i><span>Warning :</span> Please check the form below for
                        errors.
                    </p>
                </div>
            </div>
    </div>
    <div class="col s12 m4 l2"></div>
</div>
@endif


<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 3000); // satuan detik milisecond 1 detik = 1000 ms
</script>
