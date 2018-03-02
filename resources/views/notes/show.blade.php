@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title pull-left">{{$note->title}}</h3>

                    <a class="btn btn-default pull-right" href="{{url('notes/'.$note->id)}}" role="button" 
                                            onclick="event.preventDefault();
                                                     document.getElementById('delete-note').submit();">Delete</a>
                    <a class="btn btn-default pull-right" href="{{url('notes/'.$note->id.'/edit')}}" role="button" style="margin-right: 5px;">Edit</a>

                    <div class="clearfix"></div>
                </div>

                <div class="panel-body">
                    @if($note->type == 'list')
                        <ul>
                            @foreach($note->content as $content)
                                <li>{{$content}}</li>
                            @endforeach    
                        </ul>
                    @elseif($note->type == 'text')
                        <p>{{($note->content)[0]}}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<form id="delete-note" action="{{ url('notes/'.$note->id) }}" method="POST" style="display: none;">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
</form>

@endsection
