@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>แก้ไข เนื้อหา</h2>
                        <div class="ml-auto">
                        <a href="{{ route('categories.show', $category->id ) }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-circle-left"></i> กลับไป</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('articles.update',$article->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="categories_id" value="{{ $article->id }}">
                        <div class="form-group col-md-6">
                            <label for="categories">หมวดหมู่ : </label>
                            <select class="form-control form-control-sm" name="categories_id">
                                @forelse ($selectCategories as $select)
                                    <option value="{{ $select->id }}" {{ $article->categories_id == $select->id ?  'selected' : '' }}>{{ $select->title }}</option>
                                @empty

                                @endforelse

                              </select>
                            @error('categories')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label for="title">หัวข้อเนื้อหา : </label>
                            <input type="text" name="title" id="title_id" value="{{ old('title',$article->title) }}" class="form-control input-lg @error('title') is-invalid @enderror">
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label>รายละเอียดอื่นๆ (ถ้ามี) : </label>
                        <textarea name="body" id="body_id" cols="30" rows="10" class="form-control @error('body') is-invalid @enderror">{{ old('body',$article->body) }}</textarea>
                            @error('body')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-outline-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
