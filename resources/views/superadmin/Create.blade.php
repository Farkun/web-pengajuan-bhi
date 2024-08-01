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
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-validation">
                        <form class="form-valide" action="{{ route('users.store') }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="name">Nama<span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter your name  ..">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="email">Email <span
                                        class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="email" name="email"
                                        placeholder="Your valid email.." required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="phone">No Telp<span
                                        class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="number" class="form-control" id="phone" name="phone" placeholder="+62"
                                        required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="role">Role <span
                                        class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <select class="form-control" id="role" name="role" required>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->role }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-8 ml-auto">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #/ container -->
</div>
@endsection