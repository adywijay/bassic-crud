@extends('admin.page.kerangka_panggil')
@section('list_content')
    <div class="container z-depth-5">
        <nav class="orange darken-4">
            <span class="card-title center-align"><i>Detail Users</i></span>
        </nav>
        <section>
            <div class="row">
                <form id="detail_user-form" class="col s12">
                    @csrf
                    <div class="col s4">
                    </div>
                    <div class="input-field col s4">
                        <input disabled id="id" type="hidden" class="validate red-text center-align" required=""
                            value="{{ $call->id }}">
                        <label id="id" for="id"></label>
                    </div>
                    <div class="col s4">
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input disabled id="name" type="text" class="validate red-text" required=""
                                value="{{ $call->name }}">
                            <label id="name-label" for="name">Name</label>
                        </div>
                        <div class="input-field col s6">
                            <input disabled id="email" type="email" class="validate red-text" required=""
                                value="{{ $call->email }}">
                            <label id="Email-label" for="email">Email</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            @if ($call->email_verified_at == null)
                                <input disabled id="email_verified_at" type="text" class="validate red-text"
                                    value="0000-00-00 00:00:00" required="">
                                <label id="email_verified_at" for="email_verified_at">Email Verification</label>
                            @else
                                <input disabled id="email_verified_at" type="text" class="validate red-text"
                                    value="{{ $call->email_verified_at }}">
                                <label id="email_verified_at" for="email_verified_at">Email Verification</label>
                            @endif

                        </div>
                        <div class="input-field col s6">Status
                            <div class="switch">
                                <label>
                                    <i class="red-text"><b>Inactive</b></i>
                                    @if ($call->status == 'Inactive')
                                        <input id="sw-status" type="checkbox">
                                        <span class="lever"></span>
                                    @else
                                        <input id="sw-status" type="checkbox" checked>
                                        <span class="lever"></span>
                                    @endif
                                    <i class="blue-text text-accent-4"><b>Active</b></i>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input disabled id="created_at" type="text" class="validate red-text" required=""
                                value="{{ $call->created_at }}">
                            <label id="created_at" for="created_at">Last Create</label>
                        </div>
                        <div class="input-field col s6">
                            <input disabled id="updated_at" type="text" class="validate red-text" required=""
                                value="{{ $call->updated_at }}">
                            <label id="updated_at" for="updated_at">Last Update</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <div class="col s4"></div>
                            <div class="col s4">
                                <div class="row center">
                                    <input disabled id="role_id" type="text" class="row center validate red-text"
                                        required="" value="{{ $call->role_id }}">
                                    <label id="role_id" for="role_id">Role ID</label>
                                </div>
                            </div>
                            <div class="col s4"></div>
                        </div>
                    </div>
                    <div class="input-field col s12">
                        <div id="div" class="row center">
                            <a href="javascript:void(0)" onclick="back()"
                                class="btn-floating btn-medium waves-effect waves-light red nopadding"><i
                                    class="medium material-icons white-text">arrow_back</i></a>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
    <script type='text/javascript'>
        function back() {
            window.location = "{{ route('muser') }}";
        }

        $(document).ready(function() {
            var id = $('#id').val();

            $("input").change(function() {
                if ($(this).is(":checked")) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ url('admin/muser/seton') }}" + '/' + id, //Define Post URL
                        dataType: 'json',
                        type: "PUT",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            alert(response['message']);
                            window.location.reload();
                            window.location = "{{ route('muser') }}";
                        }
                    });
                } else {

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ url('admin/muser/setoff') }}" + '/' + id, //Define Post URL
                        dataType: 'json',
                        type: "PUT",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            alert(response['message']);
                            window.location.reload();
                            window.location = "{{ route('muser') }}";
                        }
                    });

                }
            });
        });
    </script>
@endsection
