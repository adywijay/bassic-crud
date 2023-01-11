@extends('admin.page.kerangka_panggil')
@section('list_content')
    <div class="row">
        <div id="man" class="col s12">
            <div class="card material-table" style="border-radius: 5px;">
                <div class="table-header">
                    <span class="table-title">
                        List data employers</span>
                    <div class="actions">
                        <a href="{{ route('export_emp_pdf') }}"class="modal-trigger btn-flat nopadding"><i class="material-icons">print</i></a>
                        <a href="{{ route('export_emp') }}" target="_blank" class="modal-trigger btn-flat nopadding"><i class="material-icons">swap_vertical_circle</i></a>
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
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @csrf
                        @foreach ($call as $isi)
                            <tr id="jid{{ $isi->id }}">
                                <td class="left-align">{{ $isi->id }}</td>
                                <td class="left-align">{{ $isi->nik }}</td>
                                <td class="left-align">{{ $isi->nama_karyawan }}</td>
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
                                        <a href="javascript:void(0)" onclick="Activated({{ $isi->id }})"
                                            class="btn-floating btn-small waves-effect waves-light green nopadding"><i
                                                class="medium material-icons white-text">playlist_add_check</i></a>
                                    @else
                                        <a href="javascript:void(0)" onclick="Inactived({{ $isi->id }})"
                                            class="btn-floating btn-small waves-effect waves-light red nopadding"><i
                                                class="medium material-icons white-text">highlight_off</i></a>
                                    @endif
                                    <a href="javascript:void(0)" onclick="detailEmp({{ $isi->id }})"
                                        class="modal-trigger btn-floating btn-small waves-effect waves-light blue nopadding"><i
                                            class="medium material-icons white-text">account_circle</i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- =============================== Modal 1 ================================= -->
            <div id="modal1" class="modal s6">
                <nav class="s6 orange darken-4">
                    <span class="card-title center-align"><i id="header-modal-1"></i></span>
                </nav>
                <br>
                <br>
                <form id="emp-form" class="col s12">
                    @csrf
                    <input type="hidden" name="karyawan_id" id="karyawan_id">
                    <div class="row">
                        <div class="input-field col s6">
                            <input readonly placeholder="Nama Lengkap" name="nama_karyawan" id="nama_karyawan"
                                type="text" class="validate" required="">
                            <label id="nama_karyawan" for="nama_karyawan" class="red-text">Nama Lengkap *</label>
                        </div>
                        <div class="input-field col s6">
                            <input readonly placeholder="Email Aktif" name="email" id="email" type="email"
                                class="validate flow-text teal-text" required="">
                            <label id="email" for="email" class="red-text">Email *</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input readonly placeholder="date_of_join" name="date_of_join" id="date_of_join" type="text"
                                class="validate" required="">
                            <br><br>
                            <label id="date_of_join" for="date_of_join" class="red-text">Tgl. Masuk *</label>
                        </div>
                        <div class="input-field col s6">
                            <input readonly placeholder="date_of_out" name="date_of_out" id="date_of_out" type="hidden"
                                class="validate" required="">
                            <label id="date_of_out" for="date_of_out" class="red-text">Tgl. Keluar *</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input readonly placeholder="Nomor Induk" name="nik" id="nik" type="number"
                                class="validate" required="">
                            <label id="nik" for="nik" class="red-text">NIK *</label>
                        </div>
                        <div class="input-field col s6">
                            <input readonly placeholder="ID Candidate" name="kandidat_id" id="kandidat_id"
                                type="number" class="validate" required="">
                            <label id="kandidat_id" for="kandidat_id" class="red-text">ID Candidate *</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input readonly placeholder="User ID" name="user_id1" id="user_id1" type="number"
                                class="validate" required="">
                            <label id="user_id1" for="user_id1" class="red-text">User ID *</label>
                        </div>
                        <div class="input-field col s6">
                            <input readonly placeholder="ID Jabatan" name="jabatan_id" id="jabatan_id" type="number"
                                class="validate" required="">
                            <label id="jabatan_id" for="jabatan_id" class="red-text">ID Jabatan *</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input readonly placeholder="ID Role" name="role_id" id="role_id" type="number"
                                class="validate" required="">
                            <label id="role_id" for="role_id" class="red-text">ID Role *</label>
                        </div>
                        <div class="input-field col s6">
                            <input readonly placeholder="Tahun Masuk" name="year_of_join" id="year_of_join"
                                type="number" class="validate" required="">
                            <label id="year_of_join" for="year_of_join" class="red-text">Tahun Masuk *</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input readonly placeholder="Tahun Keluar" name="year_of_out" id="year_of_out"
                                type="hidden" class="validate" required="">
                            <label id="year_of_out" for="year_of_out" class="red-text">Tahun Keluar *</label>
                        </div>
                        <div class="input-field col s6">
                            <input readonly placeholder="Status" name="status" id="status" type="text"
                                class="validate" required="">
                            <label id="status" for="status" class="red-text">Status *</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="modal-footer input-field col s12">
                            <div id="div" class="row center">
                                <button id="submit" class="btn waves-effect waves-light green" type="submit">Create
                                    Accounts <i class="material-icons right">account_box</i>
                                </button>
                                <a href="javascript:void(0)" onclick="tutup()"
                                    class="btn waves-effect waves-light red">Close</a>
                            </div>
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
            </div>
            <!-- =============================== End Modal 2 ================================= -->
        </div>
    </div>

    <script type='text/javascript'>
        function tutup() {
            $("#modal1").modal('close');
        }

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
        function Activated(id) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('admin/emp/active/') }}" + '/' + id,
                dataType: 'json',
                type: "PUT",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    alert(response['message']);
                    window.location.reload();
                    window.location = "{{ route('employment') }}";
                }
            });
        }



        function Inactived(id) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('admin/emp/inact') }}" + '/' + id,
                dataType: 'json',
                type: "PUT",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    alert(response['message']);
                    window.location.reload();
                    window.location = "{{ route('employment') }}";
                }
            });
        }
    </script>
@endsection
