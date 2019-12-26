@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5>แก้รหัสผ่าน</h5>

                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            @include('layouts._messages')
                            <form action="{{ route('user.update2', $user->id ) }}" method="post">
                                @csrf
                                @method('PUT')
                                @foreach ($errors->all() as $error)
                                    <p class="text-danger">{{ $error }}</p>
                                @endforeach
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <div class="form-group row">
                                    <label for="" class="col-md-4">name: </label>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" name="name" id="name" value="{{ $user->name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password1" class="col-md-4">Password</label>
                                    <div class="col-md-6">
                                        <input class="form-control" name="password1" type="password" id="password1">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-md-4">Password</label>
                                    <div class="col-md-6">
                                        <input  class="form-control" name="password2" type="password">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-outline-info">Password Change</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
