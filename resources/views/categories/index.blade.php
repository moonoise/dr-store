@php

    $i = 0;
@endphp
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5>หมวดหมู่</h5>
                        <div class="ml-auto">
                            <a href="{{ route('categories.create') }}" class="btn btn-sm btn-outline-info">เพิ่มหมวดหมู่</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-6"></div>
                        <div class="col-6">
                            <div class="float-right">
                                <form action="{{ route('categories.search') }}" method="get" class="form-inline">
                                    <div class="form-group mr-2 mb-2">
                                    <input type="search" name="search" id="search" class="form-control" value="{{ $search ?? "" }}">
                                            <button type="submit" class="btn btn-primary ml-1">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                 @include('layouts._messages')
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Categories</th>
                                <th scope="col">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $key => $category)
                                <tr>
                                    <td scope="row">{{ $categories->firstItem() + $key }}</td>
                                    <td>
                                    <a class="card-link" href="{{ route('categories.show', $category->id ) }}">
                                        {{ str_limit($category->title,100,"...") }} </a></td>
                                    <td>
                                        <div class="buttom-float">
                                            <a href="{{ route('categories.edit', $category->id ) }}" class="btn btn-sm btn-outline-info">แก้ไข</a>
                                            <form action="{{ route('categories.destroy' , $category->id ) }}" method="post" class="form-delete">
                                                @method('DELETE')
                                                @csrf
                                                <button type='submit' class="btn btn-sm btn-outline-danger" onclick="return confirm('คุณต้องการลบจริงๆ หรือใหม่') ">ลบ</button>
                                            </form>
                                        </div>


                                    </td>
                                </tr>
                            @empty
                            <div class="alert alert-warning"><strong>ยังไม่มีหมวดหมู่</strong> .</div>
                            @endforelse

                        </tbody>
                    </table>
                 <div class="mx-auto">
                    {{ $categories->links() }}
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
