@extends('master')
@section('title','Add Category')
@section('content')
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
{{--    @foreach($allCategories as $allCategory)--}}
{{--        @if($allCategory['id_parent']==0)--}}
{{--        <p><a id="category" href="javascript:;" category_id="{{$allCategory->id}}">{{$allCategory->name}}</a></p>--}}
{{--        @endif--}}
{{--    @endforeach--}}

{{--    <p><a id="category" href="javascript:;" category_id="{{$allCategory->id}}">{{$treeCategory}}</a></p>--}}
    <a href="javascript:;" id="category">ADD</a>
<script type="text/javascript">
    $(document).ready(function () {
        $('#category').click(function () {
            console.log('aaaaaa');
        });
        function CategoryTre($arr, $parent = 0, $indent = 0){
            if (count($arr)!=0){

            }
        }
    });
</script>
@endsection
