@extends('base.kerangka_panggil')
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
                                <li>
                                    <div class="collapsible-header">
                                        <i class="material-icons">access_time</i>
                                        Date Time
                                    </div>
                                    <div class="collapsible-body">
                                        <p id="dateTime" class="orange-text"></p>
                                        </i>
                                    </div>
                                </li>
                                <li>
                                    <div class="collapsible-header">
                                        <i class="material-icons">person_pin</i>
                                        Registration
                                    </div>
                                    <div class="collapsible-body">
                                        @if (Auth::user()->status == 'Active')
                                            <a href="#modal1"
                                                class="modal-trigger waves-effect waves-light btn-small orange darken-4"><i
                                                    class="material-icons right">group_add</i>Register</a>
                                        @else
                                            <p>Lorem ipsum dolor sit amet.</p>
                                        @endif
                                    </div>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
                <!-- Modals-->
                <div id="modal1" class="modal col s6 modal-fixed-footer" style="border-radius: 7px;">
                    <nav class="orange darken-4">
                        <span class="card-title center-align"><i>Form Registrasi</i></span>
                    </nav>
                    <br>
                    <br>
                    <form id="jbt-form" action="{{ route('addkandidat') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}" />
                        <div class="input-field col s6">
                            <input placeholder="Nama Lengkap" name="kandidat_name" id="kandidat_name" type="text"
                                class="validate" required="" minlength="5" maxlength="50">
                            <label id="kandidat_name" for="kandidat_name" class="red-text">Nama Lengkap *</label>
                        </div>
                        <div class="input-field col s6">
                            <input readonly name="kandidat_email" id="kandidat_email" type="email"
                                class="validate flow-text teal-text" value="{{ Auth::user()->email }}">
                            <label id="kandidat_email" for="kandidat_email" class="red-text">Email *</label>
                        </div>
                        <div class="input-field col s6">
                            <select id="jabatan_id" name="jabatan_id">
                                <option value="" disabled selected>Choose your option</option>
                                @foreach ($get_jbt as $isi)
                                    <option value="{{ $isi->id }}">{{ $isi->jabatan_code }}</option>
                                @endforeach
                            </select>
                            <label id="jabatan_id" for="jabatan_id" class="red-text">Posisi yang dilamar *</label>
                        </div>
                        <div class="input-field col s6">
                            <input placeholder="Tahun" name="year_of_join" id="year_of_join" type="number"
                                class="validate red-text" required="" maxlength="4">
                            <label id="year_of_join" for="year_of_join" class="red-text">Tahun Masuk *</label>
                        </div>
                        <div class="modal-footer input-field col s12">
                            <div id="div" class="row center">
                                <button id="submit" class="btn waves-effect waves-light red" type="submit">Simpan
                                </button>
                                <a href="javascript:void(0)" onclick="tutup()"
                                    class="btn waves-effect waves-light red">Close</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type='text/javascript'>
        function tutup() {
            $('#modal1').modal('close'),
                $('#role-form-edit').trigger("reset")
        }

        setInterval(() => $("#dateTime").text(new Date().toLocaleString()), 1000);
    </script>
@endsection
