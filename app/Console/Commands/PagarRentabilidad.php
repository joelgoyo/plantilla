<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Http\Controllers\InversionController;

class PagarRentabilidad extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pagar:rentabilidad';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Porcentaje de rentabilidad';

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
            Log::info('PagarRentabilidad- '.Carbon::now());
            $inversion = new InversionController();
            $inversion->pagarRentabilidad();
        } catch (\Throwable $th) {
            Log::error('Error al Pagar la rentabilidad -> '.$th);
        }
    }
}
