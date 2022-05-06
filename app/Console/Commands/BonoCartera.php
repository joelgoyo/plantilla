<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class BonoCartera extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bono:cartera';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bono del 1% a pagar mensualmente';

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
            Log::info('Pago de bono Cartera- '.Carbon::now());
            $wallet = new WalletController();
            $wallet->bonoCartera();
        } catch (\Throwable $th) {
            Log::error('Error al Pagar el bono Cartera -> '.$th);
        }
    }
}
