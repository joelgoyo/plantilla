<?php

namespace App\Console\Commands;

use App\Models\Inversion;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;


class startPayRentabilidad extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'start:payrentabilidad';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'cambia el estado de la inversion para pagar rentabilidad';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            Log::info('Inciar Comando start:payrentabilidad ' . Carbon::now()->format('Y-m-d'));
      
            Inversion::where('pay_rentabilidad', '=', 1)->update(['pay_rentabilidad' => 2]);
     
        } catch (\Throwable $th) {
            Log::info('Fin Comando start:payrentabilidad ' . Carbon::now()->format('Y-m-d'));
        }
    }
}
