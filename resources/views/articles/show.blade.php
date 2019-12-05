@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>หัวข้อ</h2>
                        <div class="ml-auto">
                        <a href="{{ route('categories.show',$article->categories_id) }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-circle-left"></i> กลับไป</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                <h5 class="card-title">{{ $article->title }}</h5>
                    <p class="card-text">
                        {{ $article->body }}
                    </p>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection




