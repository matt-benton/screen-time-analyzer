<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Segment;

class ConvertToMultiMonitors extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monitor:multi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Loop through each segments record, creating a record in monitor_segment with the monitor id and segment id';

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
        foreach (Segment::all() as $segment) {
            $segment->monitors()->attach($segment->monitor_id);
            $this->info('Record created for segment ' . $segment->id . ' and monitor ' . $segment->monitor_id . '.');
        }
    }
}
