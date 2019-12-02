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
                <h5 class="card-title">{{ $category->title }}</h5>
                    <p class="card-text">
                        {{ $category->overview }}
                    </p>
                    <hr>
                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col-4"></div>
                        <div class="col-4">
                            <div class="form-group">
                            <form action="{{ route('articles.create') }}" method="get">
                                <input type="hidden" name="categories_id" value="{{ $category->id }}">
                                <button type="submit" class="btn btn-outline-info float-right mr-2 mb-2">เพิ่มรายการ</button>
                            </form>
                            </div>
                        </div>

                        <div class="col-12">
                            @include('layouts._messages')
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">รายการ</th>
                                        <th scope="col">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($articles as $key => $article)
                                        <tr>
                                            <td>{{ $articles->firstItem() + $key }}</td>
                                            <td> <a href="{{ route('articles.show',$article->id ) }}">{{  $article->title }}</a></td>
                                            <td>
                                                <a href="{{ route('articles.edit', $article->id ) }}" class="btn btn-sm btn-outline-info">แก้ไข</a>
                                                <form action="{{ route('articles.destroy',$article->id ) }}" method="post" class="form-delete">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="categories_id" value="{{ $category->id }}">
                                                    <button type='submit' class="btn btn-sm btn-outline-danger" onclick="return confirm('คุณต้องการลบจริงๆ หรือใหม่') ">ลบ</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-warning"><strong>ไม่พบรายการ</strong> .</div>
                                    @endforelse


                                </tbody>
                            </table>
                            <div class="mx-auto">
                                {{ $articles->links() }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
