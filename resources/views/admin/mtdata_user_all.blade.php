@extends('admin.page.kerangka_panggil')
@section('list_content')
    <div class="row">
        <div id="man" class="col s12">
            <div class="card material-table" style="border-radius: 5px;">
                <div class="table-header">
                    <span class="table-title">
                        List data users</span>
                    <div class="actions">
                        <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i
                                class="material-icons">search</i></a>
                    </div>
                </div>
                <table id="datatable" class="responsive-table" style="text-align:center;">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @csrf
                        @foreach ($call as $isi)
                            <tr>
                                <td>{{ $isi->id }}</td>
                                <td>{{ $isi->email }}</td>
                                <td>
                                    <div class="switch">
                                        <label>
                                            <i class="red-text"><b>Inactive</b></i>
                                            @if ($isi->status == 'Active')
                                                <input disabled type="checkbox" checked>
                                            @else
                                                <input disabled type="checkbox">
                                            @endif
                                            <span class="lever"></span>
                                            <i class="blue-text"><b>Active</b></i>
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ url('admin/muser/detail/' . $isi->id) }}"
                                        class="modal-trigger btn-floating btn-small waves-effect waves-light blue nopadding"><i
                                            class="medium material-icons white-text">find_in_page</i></a>

                                    <a href="javascript:void(0)" onclick="delUsers({{ $isi->id }})"
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

    <script type='text/javascript'>
        /**
         * Funngsi untuk keperluan hapus data
         */

        //panggil button dgn melewatkan link
        function delUsers(id) {
            let text = "Are sure to delete this record" + " " + "id" + " " + id + "..?";
            if (confirm(text) == true) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('admin/muser/dell') }}" + '/' + id, //Define Post URL
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
