@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>หมวดหมู่</h2>
                        <div class="ml-auto">
                        <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-circle-left"></i> กลับไป</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                <form action="{{ route('categories.store') }}" method="post">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="title">ชื่อหมวดหมู่ : </label>
                        <input type="text" name="title" id="title_id" value="{{ old('title') }}" class="form-control input-lg @error('title') is-invalid @enderror">
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>อธิบาย : </label>
                        <textarea name="overview" id="overview_id" cols="30" rows="10" class="form-control @error('overview') is-invalid @enderror">{{ old('overview') }}</textarea>
                            @error('overview')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-outline-primary">อัพเดท</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
