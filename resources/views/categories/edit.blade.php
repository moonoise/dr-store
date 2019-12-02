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
                    <form action="{{ route('categories.update', $categories->id ) }}" method="post">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="title">ชื่อหมวดหมู่ : </label>
                            <input type="text" name="title" id="title_id" value="{{ old('title',$categories->title) }}" class="form-control input-lg">
                            @if ( $errors->has('title') )
                                <div class="invalid-feedback">
                                <strong>{{ $errors->first('title') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>อธิบาย : </label>
                            <textarea name="overview" id="overview_id" cols="30" rows="10" class="form-control">{{ $categories->overview }}</textarea>
                            @if ( $errors->has('overview') )
                                <div class="invalid-feedback">
                                <strong>{{ $errors->first('overview') }}</strong>
                                </div>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-outline-primary">อัพเดท</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
