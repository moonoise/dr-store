@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5>รายชื่อสมาชิก</h5>

                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-6"></div>
                        <div class="col-6">
                            <div class="float-right">
                                <form action="{{ route('user.search') }}" method="get" class="form-inline">
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
                                <th scope="col">name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Type</th>
                                <th scope="col">#</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($users as $key => $user)
                                <tr>
                                    <td scope="row">{{ $users->firstItem() + $key }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>
                                        @guest

                                        @else
                                            @if (Auth::user()->role === 'admin')
                                                <a href="{{ route('user.edit2', $user->id ) }}" class="btn btn-sm btn-outline-info">แก้ไข</a>
                                                @if (Auth::user()->id != $user->id )
                                                    <form action="{{ route('user.destroy',$user->id ) }}" method="post" class="form-delete">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                        <input type="hidden" name="name" value="{{ $user->name }}">
                                                        <button type='submit' class="btn btn-sm btn-outline-danger" onclick="return confirm('คุณต้องการลบจริงๆ หรือใหม่') ">ลบ</button>
                                                    </form>
                                                @endif

                                            @endif
                                        @endguest
                                    </td>
                                </tr>
                            @empty

                            @endforelse

                        </tbody>
                    </table>
                 <div class="mx-auto">
                    {{ $users->links() }}
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
