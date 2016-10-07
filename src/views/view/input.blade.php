<?php
    $value = '';
    if(isset($_name)){
        $f = $field['name'];
        $value = "{{  $$_name->$f }}";
    }
?>

@if($field['type'] == 1)
<!-- 普通文本框 -->
<div class="form-group">
    <label>{{ $field['label'] }}</label>
    <input type="text" class="form-control" name="{{ $field['name'] }}" value="{!! $value !!}">
</div>
@endif
@if($field['type'] == 2)
{{-- TextArea --}}
    <div class="form-group">
        <label>{{ $field['label'] }}</label>
        <textarea name="{{ $field['name'] }}" rows="30" class="form-control">{{ $value }}</textarea>
    </div>
@endif
@if($field['type'] == 3)
{{-- 富文本 --}}
    <div class="form-group">
        <label>{{ $field['label'] }}</label>
        <textarea name="{{ $field['name'] }}" rows="30" class="summernote">{{ $value }}</textarea>
    </div>
@endif
@if($field['type'] == 4)
{{-- 图片上传 --}}
    <div class="form-group">
        <label>{{ $field['label'] }}</label>
        <div>
            <img class="thumbnail">
            <div class="input-group">
                <input type="text" placeholder="文件地址" class="form-control img-upload">
                <span class="input-group-btn">
                    <label class="btn btn-primary" data-toggle="modal" data-target="#_upload">上传</label>
                </span>
            </div>
        </div>
    </div>
@endif
@if($field['type'] == 5)
    {{-- 下拉框 --}}
    <div class="form-group">
        <label>{{ $field['label'] }}</label>
        <select name="{{ $field['name'] }}" class="form-control">

        </select>
    </div>
@endif
@if($field['type'] == 6)
    {{-- select2 下拉框 --}}
    <div class="form-group">
        <label>{{ $field['label'] }}</label>
        <select name="{{ $field['name'] }}" class="select2">

        </select>
    </div>
@endif

