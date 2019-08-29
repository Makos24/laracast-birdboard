@extends('layouts.app')

@section('content')

    <div class="flex items-center mb-3 py-4">
        <div class="flex items-end w-full">
            <p class="text-grey font-normal text-sm mr-auto">
                <a class="no-underline text-grey text-sm font-normal" href="/projects">My Projects</a> / {{$project->title}}
            </p>
            <a href="{{url('/projects/create')}}" class="button">New Project</a>
        </div>

    </div>

    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3 mb-6">
                <div class="mb-8">

                    <h2 class="text-grey font-normal text-lg mb-3">Tasks</h2>

                    @foreach($project->tasks as $task)
                        <div class="card mb-3">

                                <form method="POST" action="{{$task->path()}}">
                                    @method('PATCH')
                                    @csrf
                                    <div class="flex">
                                        <input value="{{$task->body}}" type="text" name="body"
                                               class="w-full {{$task->completed ? 'text-grey' : ''}}" />
                                        <input type="checkbox" name="completed" onchange="this.form.submit()"
                                                {{$task->completed ? 'checked' : ''}}/>
                                    </div>
                                </form>

                        </div>
                    @endforeach

                    <form method="POST" action="{{$project->path().'/tasks'}}">
                        @csrf
                        <input name="body" class="card w-full" placeholder="Add New Task Here">
                    </form>

                </div>

                <div>

                    <h2 class="text-grey font-normal text-sm mr-auto mb-3">General Notes</h2>
                    <form action="{{$project->path()}}" method="POST">
                        @method('PATCH')
                        @csrf
                        <textarea name="notes" class="card w-full" style="height: 200px" placeholder="Enter notes here">{{$project->notes}}</textarea>
                        <button class="button" type="submit">Save Notes</button>
                    </form>


                </div>

            </div>
            <div class="lg:w-1/4 px-3">
                @include('projects.card')
            </div>
        </div>
    </main>


    <div>
        <a href="{{url('/projects')}}">Go Back</a>
    </div>
@endsection
