@extends('admin.page.kerangka_panggil')
@section('list_content')
    <div class="row">
        <div id="man" class="col s12">
            <div class="card material-table" style="border-radius: 5px;">
                <div class="table-header">
                    <span class="table-title">
                        List data accounts</span>
                    <div class="actions">
                        <a href="javascript:void(0)" onclick="frmRest()" class="modal-trigger btn-flat nopadding"><i
                                class="material-icons">sync</i></a>
                        {{-- <a href="javascript:void(0)" onclick="frmDel()" class="modal-trigger btn-flat nopadding"><i
                                class="material-icons">delete_forever</i></a> --}}
                        <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i
                                class="material-icons">search</i></a>
                    </div>
                </div>
                <table id="datatable" class="responsive-table" style="text-align:center;">
                    <thead>
                        <tr>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Standart</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @csrf
                        @foreach ($call as $isi)
                            @if ($isi->role_id != Session::get('role_id'))
                                <tr id="jid{{ $isi->id }}">
                                    <td>{{ $isi->nik }}</td>
                                    <td>{{ $isi->name }}</td>
                                    <td>
                                        @if ($isi->is_standart == 'No')
                                            <span class="btn-floating btn-small green nopadding"><i
                                                    class="medium material-icons white-text">thumb_up</i></span>
                                        @else
                                            <span class="btn-floating btn-small red nopadding"><i
                                                    class="medium material-icons white-text">priority_high</i></span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($isi->status == 'Active')
                                            <span class="badge green white-text"
                                                style="border-radius: 3px;">{{ $isi->status }}</span>
                                        @else
                                            <span class="badge red white-text"
                                                style="border-radius: 3px;">{{ $isi->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($isi->status == 'Inactive')
                                            <a href="javascript:void(0)" onclick="onAccount({{ $isi->id }})"
                                                class="btn-floating btn-small waves-effect waves-light green nopadding"><i
                                                    class="medium material-icons white-text">playlist_add_check</i></a>
                                        @else
                                            <a href="javascript:void(0)" onclick="offAccount({{ $isi->id }})"
                                                class="btn-floating btn-small waves-effect waves-light red nopadding"><i
                                                    class="medium material-icons white-text">highlight_off</i></a>
                                        @endif
                                        <a href="javascript:void(0)" onclick="detailEmp({{ $isi->id }})"
                                            class="modal-trigger btn-floating btn-small waves-effect waves-light blue nopadding"><i
                                                class="medium material-icons white-text">account_circle</i></a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- =============================== Modal 1 ================================= -->
            <div id="modal1" class="modal s12 m4 l8">
                <nav class="orange darken-4">
                    <span class="card-title center-align"><i id="header-modal-1"></i></span>
                </nav>
                <br>
                <br>
                <form id="reset-form">
                    <div class="input-field col s4"></div>
                    <div class="input-field col s4">
                        <div class="input-field col s6">
                            <input placeholder="Inputakan NIK" name="nik" id="nik" type="number" class="validate"
                                required="">
                            <label id="nik" for="nik" class="red-text">NIK *</label>
                        </div>
                        <div class="input-field col s6">
                            <input placeholder="Inputakan Password" name="password" id="password" type="password"
                                class="validate" required="" minlength="8" maxlength="10">
                            <label id="password" for="password" class="red-text">Password *</label>
                        </div>
                    </div>
                    <div class="input-field col s4"></div>
                    <div class="modal-footer input-field col s12">
                        <div id="div" class="row center">
                            <button id="submit" class="btn waves-effect waves-light red" type="submit">Execute
                            </button>
                            <a href="javascript:void(0)" onclick="tutup1()"
                                class="btn waves-effect waves-light red">Close</a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- =============================== End Modal 1 ================================= -->

            <!-- =============================== Start Modal 2 ================================= -->
            {{-- <div id="modal2" class="modal s12 m4 l8">
                <nav class="orange darken-4">
                    <span class="card-title center-align"><i id="header-modal-2"></i></span>
                </nav>
                <br>
                <br>
                <form id="del-emp-form">
                    <div class="input-field col s4"></div>
                    <div class="input-field col s4">
                        <input placeholder="Inputakan ID" name="emp_id_hapus" id="emp_id_hapus" type="number"
                            class="validate" required="">
                        <label id="emp_id_hapus" for="emp_id_hapus" class="red-text">Request hapus By Id *</label>
                    </div>
                    <div class="input-field col s4"></div>
                    <div class="modal-footer input-field col s12">
                        <div id="div" class="row center">
                            <button id="submit" class="btn waves-effect waves-light red" type="submit">Execute
                            </button>
                            <a href="javascript:void(0)" onclick="tutup2()"
                                class="btn waves-effect waves-light red">Close</a>
                        </div>
                    </div>
                </form>
            </div> --}}
            <!-- =============================== End Modal 2 ================================= -->
        </div>
    </div>

    <script type='text/javascript'>
        function frmRest() {
            $('#modal1').modal('open');
            $('#header-modal-1').html("Form Reset Password");
        }

        function tutup1() {
            $("#modal1").modal('close');
        }

        $('#reset-form').on('submit', function(event) {
            event.preventDefault();
            var nik = $('#nik').val();
            var password = $('#password').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('resetpassword') }}",
                dataType: 'json',
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    nik: nik,
                    password: password
                },
                success: function(response) {
                    $('#modal1').modal('close'),
                        alert(response['message']),
                        window.location.reload();
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    // console.log(xhr.status);
                    // console.log(xhr.responseText);
                    // console.log(thrownError);
                    alert(
                        xhr.status + "\\" +
                        xhr.responseText + "\\" +
                        thrownError
                    );
                }
            })
        })

        function frmDel() {
            $('#modal2').modal('open');
            $('#header-modal-2').html("Form Request Delete By User Inputs");
        }

        function tutup2() {
            $("#modal2").modal('close');
            $('#del-emp-form').trigger("reset");
        }

        $('#del-emp-form').on('submit', function(event) {
            event.preventDefault();
            var id = $('#emp_id_hapus').val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('reqdelby_id') }}",
                dataType: 'json',
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id
                },
                success: function(response) {
                    $('#modal2').modal('close'),
                        alert(response['message']),
                        window.location.reload();
                }
            })
        })

        function detailEmp(id) {
            $.get('emp/get/' + id, function(data) {
                $('#header-modal-1').html("Employee Detail");
                $("#modal1").modal('open');
                $("#karyawan_id").val(data.id);
                $("#nama_karyawan").val(data.nama_karyawan);
                $("#email").val(data.email);
                $("#date_of_join").val(data.date_of_join);
                $("#date_of_out").val(data.date_of_out);
                $("#nik").val(data.nik);
                $("#kandidat_id").val(data.kandidat_id);
                $("#user_id1").val(data.user_id);
                $("#jabatan_id").val(data.jabatan_id);
                $("#role_id").val(data.role_id);
                $("#year_of_join").val(data.year_of_join);
                $("#year_of_out").val(data.year_of_out);
                $("#status").val(data.status);
            })
        }


        $('#emp-form').on('submit', function(event) {
            event.preventDefault();

            var nik = $("#nik").val();
            var user_id = $("#user_id1").val();
            var jabatan_id = $("#jabatan_id").val();
            var role_id = $("#role_id").val();
            var karyawan_id = $("#karyawan_id").val();
            var nama_karyawan = $("#nama_karyawan").val();
            var email = $("#email").val();
            var status = $("#status").val();



            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('klaimempacc') }}",
                dataType: 'json',
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    nik: nik,
                    user_id: user_id,
                    jabatan_id: jabatan_id,
                    role_id: role_id,
                    karyawan_id: karyawan_id,
                    nama_karyawan: nama_karyawan,
                    email: email,
                    status: status
                },
                success: function(response) {
                    $('#modal1').modal('close'),
                        alert(response['message']),
                        window.location.reload();
                }
            })
        })

        //panggil button dgn melewatkan link
        function onAccount(id) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('admin/acc/active') }}" + '/' + id,
                dataType: 'json',
                type: "PUT",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    alert(response['message']);
                    window.location.reload();
                    window.location = "{{ route('accounts') }}";
                }
            });
        }



        function offAccount(id) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('admin/acc/inact') }}" + '/' + id,
                dataType: 'json',
                type: "PUT",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    alert(response['message']);
                    window.location.reload();
                    window.location = "{{ route('accounts') }}";
                }
            });
        }
    </script>
@endsection
