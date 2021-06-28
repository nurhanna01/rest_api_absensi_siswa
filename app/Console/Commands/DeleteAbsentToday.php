<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Absen;
use Carbon\Carbon;

class DeleteAbsentToday extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:absent';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Menghapus semua absen siswa hari ini';

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
        $now = Carbon::now();
        $tanggal=$now->format('Y-m-d');
        Absen::where('tanggal','=',$tanggal)->delete();
        return $this->info('Anda berhasil menghapus data absen hari ini');
         
    }
}
