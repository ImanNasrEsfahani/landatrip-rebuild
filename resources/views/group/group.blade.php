@extends('layout.layout')

@section("title", "Group Page")

@section('content')
{{--    <div class="container-fluid m-0 p-0 pb-5 bg-gray">--}}
{{--        <div class="container row mx-auto px-0 justify-content-center">--}}
{{--            <div class="pt-4 col-23 col-md-6 h-100 d-flex flex-column">--}}
{{--                @includeIf('group.components.group-info')--}}
{{--                @includeIf('group.components.group-tutor')--}}
{{--                @includeIf('group.components.group-students')--}}
{{--            </div>--}}
{{--            <div class="pt-4 col-23 col-md-18 vh-100 overflow-y-scroll  d-flex flex-column">--}}
{{--                <div class="bg-white shadow rounded-3 w-100 px-4 pt-3 pb-3">--}}
{{--                    @includeIf('group.components.group-header')--}}
{{--                    @includeIf('group.components.group-chat')--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@includeif("group.components.group-students")--}}
<div id="group-react" groupDate="{{Carbon\Carbon::create($group->start_date)->isoFormat('MMM Do gg')}}" groupImage="{{$group->thumbnailImage}}"
     group="{{$group}}" auth="{{ auth()->user() }}" student="{{$group->users()->with("profileImage",)->get()}}"></div>
@endsection
