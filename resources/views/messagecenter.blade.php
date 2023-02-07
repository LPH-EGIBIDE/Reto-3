@extends('layouts.app')

@section('scripts')
    @vite('resources/js/messageCenter.ts')
@endsection

@section('navbar')
    @include('navbar')
@endsection

@section('content')
<template id="chat-bubble-template">
    <div class="col-lg-6">
        <div class="chat-bubble chat-bubble--right">
      <span class="text-wrap text-break">
      </span>
        </div>
    </div>
</template>
<div class="container bg-light">
    <div class="card">
        <div class="card-header">
            Centro de mensajes
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5 col-lg-3 ">
                    <div class="card overflow-auto conversation-list">
                        <div class="card-header">
                            Lista de conversaciones
                        </div>
                        <div class="card-body overflow-auto">
                            <ul id="chattersList" class="p-0">
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-lg-9">
                    <div class="chat-element">
                        <div class="chat-panel">
                            <div class="chat-messages overflow-auto" id="messagesList">
                            </div>
                            <div class="row">
                                <form action="{{ route('mensaje.store') }}" method="post" id="messageForm">
                                    <div class="col-12">
                                        <div class="chat-box-tray">
                                                @csrf
                                                <div class="input-group">
                                                    <input type="hidden" name="receiver_id" value="" id="receiver_id">
                                                    <textarea name="mensaje"  class="form-control lh-lg" aria-label="Mensaje" placeholder="Escribe tu mensaje aqui" ></textarea>
                                                    <button class="btn btn-primary" type="submit"><i class="fa-solid fa-paper-plane-top"></i></button>
                                                </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
