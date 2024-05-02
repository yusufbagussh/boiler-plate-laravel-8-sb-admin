@extends('layouts.main')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Calculator App</h1>
        </div>

        <form method="POST" action="{{ url('/calculation/logic') }}"
            class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            @csrf
            <div class="form-group row">
                <div class="col-sm-5">
                    <input type="number" class="form-control form-control-user" name="operand1"
                        placeholder="Enter first number">
                </div>
                <div class="col-sm-2">
                    <select name="operator" class="form-control form-control-user">
                        <option value="">...</option>
                        <option value="tambah">+</option>
                        <option value="kurang">-</option>
                        <option value="kali">*</option>
                        <option value="bagi">/</option>
                    </select>
                </div>
                <div class="col-sm-5">
                    <input type="number" class="form-control form-control-user" name="operand2"
                        placeholder="Enter second number">
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-user btn-block mt-2 justify-content-center">
                Calculate
            </button>
        </form>
        @if (session()->has('success'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn btn-success btn-circle btn-sm" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        @endif
    </div>
@endsection
