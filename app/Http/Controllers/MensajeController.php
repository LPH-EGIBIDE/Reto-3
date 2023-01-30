<?php

namespace App\Http\Controllers;

use App\Models\AlumnoHistorico;
use App\Models\Curso;
use App\Models\Mensaje;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class MensajeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('messagecenter');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'mensaje' => 'required|max:255',
            'receiver_id' => 'required|numeric',
        ]);
        $receiver = Persona::findOrFail($request->receiver_id);

        if (Gate::allows('can_message', [$receiver])) {
            $mensaje = new Mensaje();
            $mensaje->mensaje = $request->mensaje;
            $mensaje->sender_id = auth()->user()->persona->id;
            $mensaje->receiver_id = $request->receiver_id;
            $mensaje->save();
            return ['success' => true, 'mensaje' => $mensaje->mensaje];
        } else {
            return ['error' => 'No se pudo enviar el mensaje'];
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mensaje  $mensaje
     * @return \Illuminate\Http\Response
     */
    public function show(Mensaje $mensaje)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mensaje  $mensaje
     * @return \Illuminate\Http\Response
     */
    public function chat($id, $page = 1)
    {

        $limit = 30; //messages per page
        $offset = ($page - 1) * $limit;
        $receiver = Persona::findOrFail($id);
        $chat = Mensaje::where('sender_id', auth()->user()->persona->id)->where('receiver_id', $receiver->id)->orWhere('sender_id', $receiver->id)->where('receiver_id', auth()->user()->persona->id)->orderBy('created_at', 'desc')->offset($offset)->limit($limit)->get();
        //Separate messages by sender
        // Show only sender id , message and date
        $chat = $chat->map(function ($item, $key) {
            return [
                'mensaje' => $item->mensaje,
                'created_at' => $item->created_at->format('d/m/Y H:i:s'),
                'is_sender' => $item->sender_id == auth()->user()->persona->id,
            ];
        });


        return response(['success' => true, 'chat' => $chat, 'messages' => $chat->count()], 200, [], JSON_NUMERIC_CHECK);
    }

    public function chatters(){
        //get all users that have sent a message to the current user and the ones that could be messaged
        $lastCurso = Curso::all()->sortBy('id')->last();

        $sentMessagePersonas = auth()->user()->persona->mensajeEnviado->pluck('receiver_id')->unique();
        $receivedMessagePersonas = auth()->user()->persona->mensajeRecibido->pluck('sender_id')->unique();
        switch (auth()->user()->persona->tipo){
            case 'facilitador_centro':
                $availableChatters = auth()->user()->persona->informacion->alumnoHistorico->where('curso_id', $lastCurso->id)->pluck('facilitador_empresa')->unique();
                break;
            case 'facilitador_empresa':
                $availableChatters = auth()->user()->persona->informacion->alumnoHistorico->where('curso_id', $lastCurso->id)->pluck('facilitador_centro')->unique();
                break;
            default:
                $availableChatters = [];

        }
        $chatters = $sentMessagePersonas->merge($receivedMessagePersonas)->merge($availableChatters)->unique();
        $chatters = Persona::whereIn('id', $chatters)->get();
        return response(['success' => true, 'chatters' => $chatters], 200, [], JSON_NUMERIC_CHECK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mensaje  $mensaje
     * @return \Illuminate\Http\Response
     */
    public function edit(Mensaje $mensaje)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mensaje  $mensaje
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mensaje $mensaje)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mensaje  $mensaje
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mensaje $mensaje)
    {
        //
    }
}
