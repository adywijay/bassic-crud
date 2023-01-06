@extends('admin.page.kerangka_panggil')
@section('list_content')
    <div class="container">
        <div class="row">
            <div class="col s12">
                @include('admin.page.flash_message')
                <div class="card z-depth-5" style="border-radius: 6px;">
                    <nav class="orange darken-4">
                        <span class="card-title center-align"><i>Welcome</i></span>
                    </nav>
                    <div class="card-content">
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quidem ad cum animi voluptate
                            architecto voluptas aperiam tempora saepe, enim fugiat, earum quam, cumque reprehenderit? Porro
                            blanditiis ex commodi quidem?

                        </p>
                    </div>
                    <div class="card-action">
                        <div id="div" class="row center">
                            <ul class="collapsible z-depth">
                                <li class="active">
                                    <div class="collapsible-header">
                                        <i class="material-icons">access_time</i>
                                        Date Time
                                    </div>
                                    <div class="collapsible-body">
                                        <p id="dateTime" class="orange-text"></p>
                                        </i>
                                    </div>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type='text/javascript'>
        setInterval(() => $("#dateTime").text(new Date().toLocaleString()), 1000);
    </script>
@endsection
