<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Http\Controllers\InversionController;

class RentabilidadSumCapital extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'capital:sumRentabilidad';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'las wallets de tipo rentabilidad las pasa a estatus pagado y suma el monto al capital de la inversion';

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
            Log::info('rentabilidadSumCapital- '.Carbon::now());
            $inversion = new InversionController();
            $inversion->rentabilidadSumCapital();
        } catch (\Throwable $th) {
            Log::error('Error al rentabilidadSumCapital -> '.$th);
        }
    }
}
