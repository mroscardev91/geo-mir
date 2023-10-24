<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;



class MailController extends Controller
{
   public function test(Request $request)
   {
       try {
           $mail = new TestMail([
               'name' => 'Anonymous',
               'body' => 'Testing mail',
               'url'  => '/'
           ]);
           Mail::to('2daw.equip11@fp.insjoaquimmir.cat')->send($mail);
           echo '<h1>Mail send successfully</h1>';
       } catch (\Exception $e) {
           echo '<pre>Error - ' . $e .'</pre>';
       }
   }
}

