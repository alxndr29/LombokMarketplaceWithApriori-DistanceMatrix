@extends('layouts.template-admin')
@section('content')
<div class="page-title">
    <div class="title_left">
        <h3><small> Dashboard Iki</small></h3>
    </div>
</div>
<div class="clearfix"></div>

@endsection

@section('anotherjs')
<script type="text/javascript">
    $(document).ready(function() {
       console.log('hello world!');
    });
</script>
@endsection