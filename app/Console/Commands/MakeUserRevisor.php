<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;


class MakeUserRevisor extends Command
{
  protected $signature = 'app:make-user-revisor {email}';

  protected $description = 'Rende un utente revisore';


    public function handle()
    {
      
        //Ricerca l'utente tramite l'email 
        $user = User::where('email', $this->argument('email'))->first();

        //Se non esiste, messaggio di errore
        if (!$user) {
            $this->error('Utente non trovato!');
            return;
        }

        //Se viene trovato il record viene aggiornato per renderlo revisore
        $user->is_revisor = true;
        $user->save();

        $this->info("L'utente {$user->email} è ora un revisore.");
    }
}


