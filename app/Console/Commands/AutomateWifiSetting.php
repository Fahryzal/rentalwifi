<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Services\WifiService;
use App\Http\Entity\WifiEntity;
use ZteF\Exception\LoginException;


class AutomateWifiSetting extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:automate-wifi-setting';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $service = new WifiService();

        $time = date("Y-m-d H:i:s");

        $this->info("[$time] Run automate worker");
        while (true) {
            $activeWifis = $service->getWithoutDeps();

            foreach ($activeWifis as $wifi) {
                $time = date("Y-m-d H:i:s");
                /** @var WifiEntity $wifi */
                try{
                    if($wifi->isWaktuHabis()){
                        $service->block([
                            'aksi' => 'new',
                            'mac_address' => $wifi->macAddr
                        ]);
    
                        $this->info("[{$time}] Berhasil blokir mac address {$wifi->macAddr} !");
                    }
                
                } catch (LoginException $e) {
                    $this->error("[{$time}] Error: {$e->getMessage()}", "v");
    
    
                } catch (\Exception $e) {
                    $this->error("[{$time}] Error: {$e->getMessage()}", "v");
                }

                sleep(2);
            }
            sleep(2);
        }
        
    }
}
