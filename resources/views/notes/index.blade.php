@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title pull-left">Notes</h3>
                    <a class="btn btn-default pull-right" href="{{url('notes/create')}}" role="button">New</a>
                    <div class="clearfix"></div>
                </div>

                <div class="panel-body">
                    <ul>
                        @foreach($notes as $note)
                            <li><a href="/notes/{{$note->id}}">{{$note->title}}</a></li>
                        @endforeach
                    </ul>
                    {{$notes->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
