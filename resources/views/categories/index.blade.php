@php
    $i =1;
@endphp
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">หมวดหมู่</div>

                <div class="card-body">
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
                            @forelse ($categories as $category)
                                <tr>
                                    <td scope="row">{{$i++}}</td>
                                    <td>{{ $category->title }}</td>
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
