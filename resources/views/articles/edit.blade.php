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
                    <form action="{{ route('articles.update',$article->id) }}" method="post" enctype="multipart/form-data">
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
                        {{-- {{ dd($article->file_decode) }} --}}
                        @if ( $uploads )
                            @forelse ($uploads as $key => $file)

                            @csrf
                            <div class="col-12">
                                <div class="form-check mt-2 checkbox-link" >
                                    <input class="form-check-input check-file" type="checkbox" value="{{ $file->id }}" name='file_id[]' id="file_id_{{ $file->id }}">
                                    <label class="form-check-label" for="file_id_{{ $file->id }}">
                                    {{ $file->source_name }}
                                    </label>

                                </div>

                            </div>
                            @empty

                            @endforelse
                        @else

                        @endif
                        <br>
                        <br>
                        <div class="input-group control-group increment" >
                            <input type="file" name="filename[]" class="form-control">
                            <div class="input-group-btn">
                                <button class="btn btn-success" type="button"><i class="fa fa-plus"></i>Add</button>
                            </div>
                        </div>
                        <div class="clone hide">
                            <div class="control-group input-group" style="margin-top:10px">
                                <input type="file" name="filename[]" class="form-control">
                                <div class="input-group-btn">
                                <button class="btn btn-danger" type="button"><i class="fa fa-times" aria-hidden="true"></i> Remove</button>
                                </div>
                            </div>
                        </div>
                        <br>

                        @error('filename')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('filename.*')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <button type="submit" class="btn btn-outline-primary"><i class="fa fa-save" aria-hidden="true"></i> Update</button>
                    </form>
                    @include('layouts._messages')
                </div>
            </div>
        </div>
    </div>

</div>

<div class="for-clone hide invisible">
    <div class="control-group input-group" style="margin-top:10px">
        <input type="file" name="filename[]" class="form-control">
        <div class="input-group-btn">
        <button class="btn btn-danger" type="button"><i class="fa fa-times" aria-hidden="true"></i> Remove</button>
        </div>
    </div>
</div>
@endsection

<script src="{{ asset('js/jquery.min.js') }}"></script>

<script type="text/javascript">

$(document).ready(function() {

$(".btn-success").click(function(){
    var html = $(".for-clone").html();
    $(".increment").after(html).removeClass("invisible for-clone").addClass("clone");
});

$("body").on("click",".btn-danger",function(){
    $(this).parents(".control-group").remove();
});



});



$(document).on("change",".check-file",function () {
    // console.log($(this).prop('checked'))
    if ($(this).prop('checked') == true) {
        $(this).closest(".checkbox-link").addClass('checkbox-danger').append('<span class="badge badge-warning">ลบ</span>');

    }else if($(this).prop('checked') == false){

        $(this).closest(".checkbox-link").removeClass('checkbox-danger').find('.badge').remove();
    }

});

</script>



