@extends('admin.page.kerangka_panggil')
@section('list_content')
    <div class="row">
        <div id="man" class="col s12">
            <div class="card material-table" style="border-radius: 5px;">
                <div class="table-header">
                    <span class="table-title">List data jabatan</span>
                    <div class="actions">
                        <a href="javascript:void(0)" onclick="addJbt()" class="modal-trigger btn-flat nopadding"><i
                                class="material-icons">supervisor_account</i></a>
                        <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i
                                class="material-icons">search</i></a>
                    </div>
                </div>
                <table id="datatable" class="responsive-table" style="text-align:center;">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Jabatan Code</th>
                            <th>Jabatan Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($call as $isi)
                            <tr id="jid{{ $isi->id }}">
                                <td>{{ $isi->id }}</td>
                                <td>{{ $isi->jabatan_code }}</td>
                                <td>{{ $isi->jabatan_name }}</td>
                                <td>
                                    <a href="javascript:void(0)" onclick="editJbt({{ $isi->id }})"
                                        class="modal-trigger btn-floating btn-small waves-effect waves-light blue nopadding"><i
                                            class="medium material-icons white-text">edit</i></a>

                                    <a href="javascript:void(0)" onclick="delJbt({{ $isi->id }})"
                                        class="btn-floating btn-small waves-effect waves-light red nopadding"><i
                                            class="medium material-icons white-text">delete</i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal 1 (for add data)-->
    <div id="modal1" class="modal">
        <div class="modal-content" style="border-radius: 5px;">
            <div class="row center">
                <span class="card-title center-align"><b><i id="header-modal-1"></i></b></span>
            </div>
            <br>
            <form id="jbt-form">
                @csrf
                <div class="input-field col s6">
                    <input placeholder="IT - Dev, Ops, Sec Etc" id="jabatan_code" type="text" class="validate"
                        required="" minlength="5" maxlength="15">
                    <label id="jabatan_code" for="jabatan_code" class="red-text">Jabatan Code *</label>
                </div>
                <div class="input-field col s6">
                    <input placeholder="Jabatan Name" id="jabatan_name" type="text" class="validate" required=""
                        minlength="10" maxlength="100">
                    <label id="jabatan_name" for="jabatan_name" class="red-text">Nama Jabatan *</label>
                </div>
                <div class="modal-footer">
                    <div class="row center">
                        <button id="submit-form" class="btn waves-effect waves-light orange accent-4" type="submit">Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End Modal 1-->

    <!-- Modal 2 (for add edit data)-->
    <div id="modal2" class="modal">
        <div class="modal-content" style="border-radius: 5px;">
            <div class="row center">
                <span class="card-title center-align"><b><i id="header-modal-2"></i></b></span>
            </div>
            <br />
            <form id="jbt-form-edit">
                @csrf
                <input type="hidden" name="id" id="id" />
                <div class="input-field col s6">
                    <input placeholder="IT - Dev, Ops, Sec Etc" id="jabatan_code2" type="text" class="validate"
                        required="">
                    <label id="jabatan_code2" for="jabatan_code2" class="red-text">Jabatan Code *</label>
                </div>
                <div class="input-field col s6">
                    <input placeholder=" " id="jabatan_name2" type="text" class="validate" required="">
                    <label id="jabatan_name2" for="jabatan_name2" class="red-text">Jabatan Name *</label>
                </div>
                <div class="modal-footer">
                    <div class="row center">
                        <button id="submit" class="btn waves-effect waves-light orange accent-4" type="submit">Simpan
                        </button>
                        <a href="javascript:void(0)" onclick="tutup()"
                            class="btn waves-effect waves-light orange accent-4">Close</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script type='text/javascript'>
        /**
         * Funngsi untuk keperluan penambahan data
         */

        function tutup() {
            $('#modal2').modal('close');
        }

        //panggil button dgn melewatkan link
        function addJbt() {
            $('#header-modal-1').html("form tambah data jabatan");
            $('#modal1').modal('open');
        }

        $('#jbt-form').on('submit', function(event) {
            event.preventDefault();
            jabatan_code = $('#jabatan_code').val();
            jabatan_name = $('#jabatan_name').val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('addjabatan') }}", //Define Post URL
                dataType: 'json',
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    jabatan_code: jabatan_code,
                    jabatan_name: jabatan_name
                },
                success: function(response) {
                    $('#modal1').modal('close'),
                        alert(response['message']),
                        window.location.reload();
                }
            })
        })


        /**
         * Funngsi untuk keperluan edit data
         */

        //panggil button dgn melewatkan link
        function editJbt(id) {
            $.get('jabatan/get/' + id, function(data) {
                $('#header-modal-2').html("form edit data jabatan");
                $("#modal2").modal('open');
                $("#id").val(data.id);
                $("#jabatan_code2").val(data.jabatan_code);
                $("#jabatan_name2").val(data.jabatan_name);
            })
        }

        //runner button action submit form edit data
        $('#jbt-form-edit').on('submit', function(event) {
            event.preventDefault();
            id = $('#id').val();
            jabatan_code = $('#jabatan_code2').val();
            jabatan_name = $('#jabatan_name2').val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('editjabatan') }}", //Define Post URL
                dataType: 'json',
                type: "PUT",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id,
                    jabatan_code: jabatan_code,
                    jabatan_name: jabatan_name
                },
                success: function(response) {
                    $('#jbt-form-edit').trigger("reset"),
                        $('#modal2').modal('close'),
                        alert(response['message']),
                        window.location.reload()
                }
            })
        })


        /**
         * Funngsi untuk keperluan hapus data
         */

        //panggil button dgn melewatkan link
        function delJbt(id) {
            let text = "Are sure to delete this record" + " " + "id" + " " + id + "..?";
            if (confirm(text) == true) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('admin/jabatan/dell') }}" + '/' + id, //Define Post URL
                    dataType: 'json',
                    type: "DELETE",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        alert(response['message']);
                        window.location.reload();
                    }
                });
            }

        }
    </script>
@endsection
