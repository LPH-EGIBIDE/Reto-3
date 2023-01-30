@extends('layouts.app')

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
                            <p>Prueba</p>
                            <p>Prueba</p>
                            <p>Prueba</p>
                            <p>Prueba</p>
                            <p>Prueba</p>
                            <p>Prueba</p>
                            <p>Prueba</p>
                            <p>Prueba</p>
                            <p>Prueba</p>
                            <p>Prueba</p>
                            <p>Prueba</p>
                            <p>Prueba</p>
                            <p>Prueba</p>
                            <p>Prueba</p>
                            <p>Prueba</p>
                            <p>Prueba</p>
                            <p>Prueba</p>
                            <p>Prueba</p>
                            <p>Prueba</p>
                            <p>Prueba</p>
                            <p>Prueba</p>
                            <p>Prueba</p>
                            <p>Prueba</p>
                            <p>Prueba</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-lg-9">
                    <div class="chat-element">
                        <div class="chat-panel">
                            <div class="chat-messages overflow-auto">
                                <chat-bubble position="left" content="Mensaje recibido"></chat-bubble>
                                <chat-bubble position="right" content="Mensaje enviado"></chat-bubble>
                                <chat-bubble position="right" content="Mensaje enviado muy lasadsadddddddd ddddddddddddasd as dasdsd sd asdasd asdsa asd asda"></chat-bubble>
                                <chat-bubble position="left" content="Mensaje recibido 2"></chat-bubble>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="chat-box-tray">
                                        <div class="input-group">
                                            <textarea class="form-control lh-lg" aria-label="Mensaje" placeholder="Escribe tu mensaje aqui" ></textarea>
                                            <button class="btn btn-primary" type="button"><i class="fa-solid fa-paper-plane-top"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
