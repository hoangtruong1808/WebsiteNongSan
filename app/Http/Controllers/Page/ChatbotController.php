<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Incoming\Answer;
use Session;
use DB;


class ChatbotController extends Controller
{
    private $product;
    public function handle()
    {
        $botman = app('botman');

        $botman->hears('{message}', function($botman, $message) {
            $this->script($message, $botman);

        });

        $botman->listen();
    }

    /**
     * Place your BotMan logic here.
     */
    public function script($message, $botman){
        //chứa sản phẩm
        $this->product = DB::table('product')
                ->where('is_deleted', 0)
                ->get();
        foreach($this->product as $key=>$value){
            if (strtolower($value->name) == strtolower($message))
            {
                var_dump($value->id);
                die;
            }else{
                $botman->reply("write 'hi' for testing...");
            }

        }
    }
    public function askName($botman)
    {
        $botman->ask('Hello! What is your Name?', function(Answer $answer) {

            $name = $answer->getText();

            $this->say('Nice to meet you '.$name);
        });
    }

    public function containMessage($string1, $string2){
        if (strlen(strstr($string1, $string2)) > 0)
        {
            return true;
        }
        else {
            return false;
        }
    }
}
