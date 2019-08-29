@extends('layouts.app')

@section('content')
    <div class="flex">
        <div class="flex items-end w-full py-6">
            <h1 class="text-grey font-normal text-sm mr-auto">My Projects</h1>
            <a href="{{url('/projects/create')}}" class="button">New Project</a>
        </div>

    </div>
    <div class="lg:flex lg:flex-wrap -mx-3">
        @forelse($projects as $project)
            <div class="lg:w-1/3 px-3 pb-6">
                @include('projects.card')
            </div>


        @empty
            <div>No Projects yet</div>
        @endforelse
    </div>
@endsection
