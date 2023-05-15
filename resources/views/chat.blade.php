@extends('layouts.app')

@section('content')
    <div class="container">
        
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Chats</div>

                    <div class="panel-body">
                        <chat-messages :messages="messages" :typing="typing"></chat-messages>
                    </div>
                    <div class="panel-footer">
                        <chat-form 
                        v-on:messagesent="addMessage" 
                        :user="{{ Auth::user() }}" 
                        :typing="typing">
                        </chat-form>
                    </div>
                    
                    {{-- <span v-if="typing" class="help-block" style="font-style: italic;">typing...</span> --}}
                    <span v-show="typing" class="help-block" style="font-style: italic;">
                        @{{ user.name }} is typing...
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection


{{-- @extends('layouts.app') --}}

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Chats</div>
                    {{ $user = Auth::user(); }}
                    <div class="panel-body">
                        @if ($user->id == 1)
                            <div class="message"  style="width: 50%; background-color: grey; ">
                                <chat-messages messages:="messages" :typing="typing"></chat-messages>

                            </div>
                        @else
                            <div class="message" style="width: 50%; background-color: red; float: right">
                                <chat-messages :messages="messages" :typing="typing"></chat-messages>

                            </div>
                        @endif

                    </div>
                    

                    <div class="panel-footer">
                        <chat-form v-on:messagesent="addMessage" :user="{{ Auth::user() }}" :typing="typing">
                        </chat-form>
                    </div>

                    <span v-show="typing" class="help-block" style="font-style: italic;">
                        @{{ user.name }} is typing...
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection


