@extends('layouts.app')

@section('content')
    <div class="card w-3/5 mx-auto">
        <h3 class="text-2xl font-normal text-center py-2 text-grey-dark">{{ __('Create New Project') }}</h3>
        <form action="{{url('projects')}}" method="POST" class="px-6">
            @csrf
            <div class="mb-6">
                <label class="control-label">Project Title</label>
                <input class="control .focus:outline-none .focus:shadow-outline" type="text" name="title" />
            </div>

            <div class="mb-6">
                <label class="control-label">Project Description</label>
                <textarea class="control" name="description" style="height: 150px;"></textarea>
            </div>

            <button class="button float-right" type="submit">Create Project</button>
        </form>
        <div class="m-3">
            <a class="no-underline font-normal" href="{{url('/projects')}}">Cancel</a>
        </div>
    </div>
@endsection
