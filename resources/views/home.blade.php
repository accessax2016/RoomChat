@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3">
            <router-view name="listRoom"></router-view>
        </div>
        <div class="col-lg-9">
            <router-view name="noneRoom"></router-view>
            <router-view name="detailRoom"></router-view>
        </div>
    </div>
</div>
@endsection
