<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use App\Http\Conversations\OnboardingConversation;
use App\Http\Conversations\AddressConversation;
use App\Http\Conversations\SearchProductConversation;
use App\ChatbotScript;
use Illuminate\Support\Facades\Response;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;

class BotManController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        $botman = app('botman');

        $botman->listen();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tinker()
    {
        return view('tinker');
    }

    /**
     * Loaded through routes/botman.php
     * @param  BotMan $bot
     */
    public function startConversation(BotMan $bot)
    {
        $bot->startConversation(new OnboardingConversation());
    }

    /** */
    public function askAddress(BotMan $bot){
        $bot->startConversation(new AddressConversation());
    }

    /** */
    public function askProduct($bot, $text){
        $bot->startConversation(new SearchProductConversation($text));
    }

    /** */

    public function index(){
        $c_a = DB::table('chatbot_script')
                     ->select(DB::raw('count(*) as num_active'))
                     ->where('status', '=', '1')
                     ->get();
        $c_i = DB::table('chatbot_script')
                    ->select(DB::raw('count(*) as num_inactive'))
                    ->where('status', '=', '0')
                    ->get();

        $data = [
            'ac' => $c_a,
            'ic' => $c_i,
            'scripts' => ChatbotScript::all()
        ];
        //return view('list_conversation')->with('scripts', ChatbotScript::all());
        return view('create_conversation')->with($data);
    }

    /** */
    public function show($id){
        $data = ChatbotScript::where('id', '=', $id)->first();
        return Response::json($data);
    }

    /** */
    public function saveScript(Request $request){
        $cbs = new ChatbotScript();
        $request['btn-status'] == 'save' ? $cbs : $cbs = ChatbotScript::find($request['id-script']);
        $cbs->name = $request['name'];
        $cbs->key_word = $request['key-word'];
        $cbs->script = $request['script'];
        
        $cbs->status = $request['enabled-script'];
    
        $cbs->save();

        return redirect()->route('chatbot.list');
    }
}
