@extends('admin.page.kerangka_panggil')
@section('list_content')
    <div class="row">
        <div id="man" class="col s12">
            <div class="card material-table" style="border-radius: 5px;">
                <div class="table-header">
                    <span class="table-title">
                        List data candidate</span>
                    <div class="actions">
                        {{-- href="javascript:void(0)" onclick="manualAddKdt()" --}}
                        <a href="javascript:void(0)" onclick="manualAddKdt()" class="modal-trigger btn-flat nopadding"><i
                                class="material-icons">group_add</i></a>
                        <a href="javascript:void(0)" onclick="frmDel()" class="modal-trigger btn-flat nopadding"><i
                                class="material-icons">delete_forever</i></a>
                        <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i
                                class="material-icons">search</i></a>
                    </div>
                </div>
                <table id="datatable" class="responsive-table" style="text-align:center;">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @csrf
                        @foreach ($call as $isi)
                            <tr id="jid{{ $isi->id }}">
                                <td>{{ $isi->id }}</td>
                                <td>{{ $isi->kandidat_name }}</td>
                                <td>
                                    @if ($isi->status == 'Verification')
                                        <span class="badge teal white-text"
                                            style="border-radius: 3px;">{{ $isi->status }}</span>
                                    @elseif ($isi->status == 'Accept')
                                        <span class="badge green white-text"
                                            style="border-radius: 3px;">{{ $isi->status }}</span>
                                    @else
                                        <span class="badge red white-text"
                                            style="border-radius: 3px;">{{ $isi->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($isi->status == 'Verification')
                                        <a href="javascript:void(0)" onclick="setAcc({{ $isi->id }})"
                                            class="btn-floating btn-small waves-effect waves-light green nopadding"><i
                                                class="medium material-icons white-text">playlist_add_check</i></a>

                                        <a href="javascript:void(0)" onclick="setRecj({{ $isi->id }})"
                                            class="btn-floating btn-small waves-effect waves-light red nopadding"><i
                                                class="medium material-icons white-text">highlight_off</i></a>
                                    @elseif ($isi->status == 'Accept')
                                        <a href="javascript:void(0)" onclick="setRecj({{ $isi->id }})"
                                            class="btn-floating btn-small waves-effect waves-light red nopadding"><i
                                                class="medium material-icons white-text">highlight_off</i></a>
                                        <a href="javascript:void(0)" onclick="detailKdt({{ $isi->id }})"
                                            class="modal-trigger btn-floating btn-small waves-effect waves-light blue nopadding"><i
                                                class="medium material-icons white-text">account_circle</i></a>
                                    @elseif ($isi->status == 'Reject')
                                        <a href="javascript:void(0)" onclick="setAcc({{ $isi->id }})"
                                            class="btn-floating btn-small waves-effect waves-light green nopadding"><i
                                                class="medium material-icons white-text">playlist_add_check</i></a>
                                        <a href="javascript:void(0)" onclick="detailKdt({{ $isi->id }})"
                                            class="modal-trigger btn-floating btn-small waves-effect waves-light blue nopadding"><i
                                                class="medium material-icons white-text">account_circle</i></a>
                                    @else
                                        <a href="javascript:void(0)" onclick="detailKdt({{ $isi->id }})"
                                            class="modal-trigger btn-floating btn-small waves-effect waves-light blue nopadding"><i
                                                class="medium material-icons white-text">account_circle</i></a>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- =============================== Modal 1 ================================= -->
            <div id="modal1" class="modal col s6 modal-fixed-footer">
                <nav class="orange darken-4">
                    <span class="card-title center-align"><i id="header-modal-1"></i></span>
                </nav>
                <br>
                <br>
                <form id="kdt-form">
                    @csrf
                    <input type="hidden" name="id1" id="id1">
                    <div class="input-field col s6">
                        <input readonly placeholder="Nama Lengkap" name="kandidat_name" id="kandidat_name" type="text"
                            class="validate" required="">
                        <label id="kandidat_name" for="kandidat_name" class="red-text">Nama Lengkap *</label>
                    </div>
                    <div class="input-field col s6">
                        <input readonly placeholder="Email Aktif" name="kandidat_email" id="kandidat_email" type="email"
                            class="validate flow-text teal-text" required="">
                        <label id="kandidat_email" for="kandidat_email" class="red-text">Email *</label>
                    </div>
                    <div class="input-field col s3">
                        <input readonly placeholder="User ID" name="user_id" id="user_id" type="number"
                            class="validate flow-text teal-text" required="">
                        <label id="user_id" for="user_id" class="red-text">ID *</label>
                    </div>
                    <div class="input-field col s3">
                        <input readonly placeholder="User ID" name="jabatan_id" id="jabatan_id" type="number"
                            class="validate flow-text teal-text" required="">
                        <label id="jabatan_id" for="jabatan_id" class="red-text">Jabatan ID *</label>
                    </div>
                    <div class="input-field col s3">
                        <input readonly placeholder="User ID" name="role_id" id="role_id" type="number"
                            class="validate flow-text teal-text" required="">
                        <label id="role_id" for="role_id" class="red-text">Role ID *</label>
                    </div>
                    <div class="input-field col s3">
                        <input readonly placeholder="Tahun" name="year_of_join" id="year_of_join" type="number"
                            class="validate red-text" required="">
                        <label id="year_of_join" for="year_of_join" class="red-text">Tahun Masuk *</label>
                    </div>
                    <div class="input-field col s6">
                        <input readonly placeholder="date_of_join" name="date_of_join" id="date_of_join" type="text"
                            class="validate red-text" required="">
                        <br><br>
                        <label id="date_of_join" for="date_of_join" class="red-text">Tgl. Masuk *</label>
                    </div>
                    <div class="input-field col s6">
                        <input readonly placeholder="Status" name="status" id="status" type="text"
                            class="validate red-text" required="">
                        <label id="status" for="status" class="red-text">Status *</label>
                    </div>
                    <div class="modal-footer input-field col s12">
                        <div id="div" class="row center">
                            <button id="submit" class="btn waves-effect waves-light green" type="submit">Claim
                                Employee
                            </button>
                            <a href="javascript:void(0)" onclick="tutup()"
                                class="btn waves-effect waves-light red">Close</a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- =============================== End Modal 1 ================================= -->

            <!-- =============================== Start Modal 2 ================================= -->
            <div id="modal2" class="modal s12 m4 l8">
                <nav class="orange darken-4">
                    <span class="card-title center-align"><i id="header-modal-2"></i></span>
                </nav>
                <br>
                <br>
                <form id="del-kdt-form">
                    <div class="input-field col s4"></div>
                    <div class="input-field col s4">
                        <input placeholder="Inputakan ID" name="id_hapus" id="id_hapus" type="number"
                            class="validate" required="">
                        <label id="id_hapus" for="id_hapus" class="red-text">Request hapus ID *</label>
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
            </div>
            <!-- =============================== End Modal 2 ================================= -->
            <!-- =============================== Start Modal 3 ================================= -->
            <div id="modal3" class="modal col s6 modal-fixed-footer">
                <nav class="orange darken-4">
                    <span class="card-title center-align"><i id="header-modal-3"></i></span>
                </nav>
                <br>
                <br>
                <form id="add-kdt-form">
                    @csrf
                    <div class="input-field col s6">
                        <input placeholder="Nama Lengkap" name="kandidat_name3" id="kandidat_name3" type="text"
                            class="validate" required="" maxlength="50">
                        <label id="kandidat_name3" for="kandidat_name3" class="red-text">Nama Lengkap *</label>
                    </div>
                    <div class="input-field col s6">
                        <input placeholder="Email Aktif" name="kandidat_email3" id="kandidat_email3" type="email"
                            class="validate flow-text teal-text" required="">
                        <label id="kandidat_email3" for="kandidat_email3" class="red-text">Email *</label>
                    </div>
                    <div class="input-field col s3">
                        <input placeholder="User ID" name="user_id3" id="user_id3" type="number"
                            class="validate flow-text teal-text" required="">
                        <label id="user_id" for="user_id" class="red-text">ID *</label>
                    </div>
                    <div class="input-field col s3">
                        <input placeholder="Jabatan ID" name="jabatan_id3" id="jabatan_id3" type="number"
                            class="validate flow-text teal-text" required="">
                        <label id="jabatan_id3" for="jabatan_id3" class="red-text">Jabatan ID *</label>
                    </div>
                    <div class="input-field col s3">
                        <input placeholder="Role ID" name="role_id3" id="role_id3" type="number"
                            class="validate flow-text teal-text" required="">
                        <label id="role_id3" for="role_id3" class="red-text">Role ID *</label>
                    </div>
                    <div class="input-field col s3">
                        <input placeholder="Tahun" name="year_of_join3" id="year_of_join3" type="number"
                            class="validate red-text" required="">
                        <label id="year_of_join3" for="year_of_join3" class="red-text">Tahun Masuk *</label>
                    </div>
                    <div class="input-field col s6">
                        <input placeholder="date_of_join3" name="date_of_join3" id="date_of_join3" type="datetime-local"
                            class="validate red-text" required="">
                        <div>
                            <label id="date_of_join3" for="date_of_join3" class="red-text">Tgl. Masuk *</label>
                        </div>
                    </div>
                    <div class="modal-footer input-field col s12">
                        <div id="div" class="row center">
                            <button id="submit" class="btn waves-effect waves-light teal" type="submit">Simpan
                            </button>
                            <a href="javascript:void(0)" onclick="tutup3()"
                                class="btn waves-effect waves-light red">Close</a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- =============================== End Modal 3 ================================= -->
        </div>
    </div>

    <script type='text/javascript'>
        function tutup() {
            $("#modal1").modal('close');
        }

        function manualAddKdt() {
            $('#modal3').modal('open');
            $('#header-modal-3').html("Form Registrasi Manual");
        }

        function tutup3() {
            $("#modal3").modal('close');
            $('#add-kdt-form').trigger("reset");
        }



        $('#add-kdt-form').on('submit', function(event) {
            event.preventDefault();

            var kandidat_name = $('#kandidat_name3').val();
            var kandidat_email = $('#kandidat_email3').val();
            var user_id = $('#user_id3').val();
            var jabatan_id = $('#jabatan_id3').val();
            var role_id = $('#role_id3').val();
            var year_of_join = $('#year_of_join3').val();
            var date_of_join = $('#date_of_join3').val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('admin/candid/add') }}",
                dataType: 'json',
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    kandidat_name: kandidat_name,
                    kandidat_email: kandidat_email,
                    user_id: user_id,
                    jabatan_id: jabatan_id,
                    role_id: role_id,
                    year_of_join: year_of_join,
                    date_of_join: date_of_join
                },
                success: function(response) {
                    $('#modal3').modal('close'),
                        alert(response['message']),
                        window.location.reload();
                }
            })
        })

        function frmDel() {
            $('#modal2').modal('open');
            $('#header-modal-2').html("Form Request Delete By User Inputs");
        }

        function tutup2() {
            $("#modal2").modal('close');
            $('#del-kdt-form').trigger("reset");
        }

        $('#del-kdt-form').on('submit', function(event) {
            event.preventDefault();
            id_hapus = $('#id_hapus').val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('reqdellidkdt') }}",
                dataType: 'json',
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id_hapus: id_hapus
                },
                success: function(response) {
                    $('#modal2').modal('close'),
                        alert(response['message']),
                        window.location.reload();
                }
            })
        })

        function detailKdt(id) {
            $.get('candid/get/' + id, function(data) {
                $('#header-modal-1').html("Detail Registrasi");
                $("#modal1").modal('open');
                $("#id1").val(data.id);
                $("#kandidat_name").val(data.kandidat_name);
                $("#kandidat_email").val(data.kandidat_email);
                $("#user_id").val(data.user_id);
                $("#jabatan_id").val(data.jabatan_id);
                $("#role_id").val(data.role_id);
                $("#year_of_join").val(data.year_of_join);
                $("#date_of_join").val(data.date_of_join);
                $("#status").val(data.status);
            })
        }


        $('#kdt-form').on('submit', function(event) {
            event.preventDefault();

            var id = $('#id1').val();
            var kandidat_name = $("#kandidat_name").val();
            var kandidat_email = $("#kandidat_email").val();
            var user_id = $("#user_id").val();
            var jabatan_id = $("#jabatan_id").val();
            var role_id = $("#role_id").val();
            var year_of_join = $("#year_of_join").val();
            var date_of_join = $("#date_of_join").val();
            var status = $("#status").val();

            /*
            var a = [
                id1,
                kandidat_name,
                kandidat_email,
                user_id,
                jabatan_id,
                role_id,
                year_of_join,
                date_of_join
            ];

            console.log(a);

            */

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('klaimemp') }}",
                dataType: 'json',
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id,
                    kandidat_name: kandidat_name,
                    kandidat_email: kandidat_email,
                    user_id: user_id,
                    jabatan_id: jabatan_id,
                    role_id: role_id,
                    year_of_join: year_of_join,
                    date_of_join: date_of_join,
                    status: status
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

        //panggil button dgn melewatkan link
        function setAcc(id) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('admin/candid/acc') }}" + '/' + id,
                dataType: 'json',
                type: "PUT",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    alert(response['message']);
                    window.location.reload();
                    window.location = "{{ route('candid') }}";
                }
            });
        }



        function setRecj(id) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('admin/candid/rejct') }}" + '/' + id,
                dataType: 'json',
                type: "PUT",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    alert(response['message']);
                    window.location.reload();
                    window.location = "{{ route('candid') }}";
                }
            });
        }
    </script>
@endsection
