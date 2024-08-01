@extends('layout.main')

@section('sidebar')
<ul class="metismenu" id="menu">
    <li class="nav-label">Dashboard</li>
    <li>
        <a href="{{ route('superadmin.dashboard') }}">
            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
        </a>
    </li>
    <li>
        <a href="{{ route('superadmin.daftarakun') }}">
            <i class="icon-notebook menu-icon"></i><span class="nav-text">Daftar Akun</span>
        </a>
    </li>
</ul>
@endsection

@section('content')
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Table</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No Telp</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>
                                            <span>
                                                <a>
                                                    <i class="fa fa-pencil color-muted m-r-5"></i>
                                                </a>
                                                <a>
                                                    <i class="fa fa-close color-danger"></i>
                                                </a>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No Telp</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="general-button" style="margin-left: 1070px">
                    <a href="{{ route('superadmin.create') }}">
                        <button type="button" class="btn mb-1 btn-primary">Tambah Akun</button>
                    </a>
                    <br><br>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection