@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>เนื้อหา</h2>
                        <div class="ml-auto">
                        <a href="{{ route('categories.show', $categories_id ) }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-circle-left"></i> กลับไป</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                <form action="{{ route('articles.store') }}" method="post">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="categories_id" value="{{ $categories_id }}">
                        <div class="form-group">
                            <label for="title">หัวข้อเนื้อหา : </label>
                            <input type="text" name="title" id="title_id" value="{{ old('title') }}" class="form-control input-lg @error('title') is-invalid @enderror">
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>รายละเอียดอื่นๆ (ถ้ามี) : </label>
                        <textarea name="body" id="body_id" cols="30" rows="10" class="form-control @error('body') is-invalid @enderror">{{ old('body') }}</textarea>
                            @error('body')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-outline-primary">เพิ่ม</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
