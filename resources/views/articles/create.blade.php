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
                <form action="{{ route('articles.store') }}" method="post" enctype="multipart/form-data" >
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
                        <button type="submit" class="btn btn-outline-primary">เพิ่ม</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="for-clone hide invisible">
    <div class="control-group input-group" style="margin-top:10px">
        <input type="file" name="filename[]" class="form-control">
        <div class="input-group-btn">
        <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
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

</script>
