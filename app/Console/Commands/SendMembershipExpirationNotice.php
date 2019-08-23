<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Storekeeper;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\StorekeeperMembershipExpiration;

class SendMembershipExpirationNotice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send-membership-expiration-notice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send membership expiration notice to storekeepers';

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
     * @return mixed
     */
    public function handle()
    {
        $storekeepers = Storekeeper::where('membership_end_date', '<=', Carbon::now()->add(30, 'day')->format('Y-m-d'))->get();

        foreach ($storekeepers as $storekeeper) {

            echo 'Mail sent to ' . $storekeeper->email;

            Mail::to($storekeeper->email)->send(new StorekeeperMembershipExpiration());
        }
    }
}
