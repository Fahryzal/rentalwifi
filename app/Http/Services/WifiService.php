<?php

namespace App\Http\Services;

use App\Http\Entity\WifiEntity;
use ZteF\ZteF;
use App\Http\Repositories\WifiRepositories;

class WifiService
{
    const ACTION_DELETE = "delete";
    const ACTION_NEW = "new";
    const DEFAULT_SSID = 1;

    public function get(): array
    {
      $zte = new ZteF(config("app.zte_host"), config("app.zte_user"), config("app.zte_password"), true);

      $allowedUsers = $zte->network()->wlan()->associatedDevices();
      $wifiRepo = new WifiRepositories();

      return array_map(function($item) use($wifiRepo){

        $wifi = new WifiEntity();
        $wifi->name = $item["device_name"];
        $wifi->macAddr = $item["mac_address"];
        $wifi->ip = $item["ip_address"];
        $wifi->ssid = $item["wlan_ssid"];
        
        $wifiSetting = $wifiRepo->getByMacAddr($wifi->macAddr);
        
        if($wifiSetting) {
          $wifi->waktu = $wifiSetting->waktu;
          $wifi->created_at = $wifiSetting->created_at;
          $wifi->updated_at = $wifiSetting->updated_at;
        }

        return $wifi;

      },$allowedUsers);
    }

    public function getWithoutDeps()
    {
      $wifiRepo = new WifiRepositories();
      $models = $wifiRepo->all();
      return $models->map(function($item){

        $wifi = new WifiEntity();
        $wifi->name = "";
        $wifi->macAddr = $item->mac_address;
        $wifi->ip = "";
        $wifi->waktu = $item->waktu;
        $wifi->created_at = $item->created_at;
        $wifi->updated_at = $item->updated_at;
        return $wifi;
      });
    }

    public function unblock(array $formdata)
    {
      $wifi = new WifiEntity();
      $wifi->waktu = $formdata["waktu"];
      $wifi->macAddr = $formdata["mac_address"];
      $wifi->zteIndex = $formdata["zte_index"];
      
      $zte = new ZteF(config("app.zte_host"), config("app.zte_user"), config("app.zte_password"), true);

      $zte->security()->macFilter(null, null, self::DEFAULT_SSID, self::ACTION_DELETE, $wifi->zteIndex);

      $wifiRepo = new WifiRepositories();
      $isSuccess = $wifiRepo->addSetting($wifi);

      if(!$isSuccess) {
        throw new \Exception("failed save wifi settings");
      }

    }

    public function block(array $formdata)
    {      
      $zte = new ZteF(config("app.zte_host"), config("app.zte_user"), config("app.zte_password"), true);

      $zte->security()->macFilter($formdata["aksi"], $formdata["mac_address"], self::DEFAULT_SSID, self::ACTION_NEW);


      $wifiRepo = new WifiRepositories();
      $wifiRecord = $wifiRepo->getByMacAddr($formdata["mac_address"]);

      if($wifiRecord) {
        $isSuccess = $wifiRecord->delete();

        if(!$isSuccess) {
          throw new \Exception("failed delete wifi settings");
        }
      }

    }

    public function createOrUpdateSetting(array $formdata)
    {
      $wifi = new WifiEntity();
      $wifi->waktu = $formdata["waktu"];
      $wifi->macAddr = $formdata["mac_address"];

      $wifiRepo = new WifiRepositories();
      $wifiRecord = $wifiRepo->getByMacAddr($wifi->macAddr);

      if($wifiRecord) {
        $isSuccess = $wifiRepo->updateSetting($wifiRecord, $wifi);
      }else{
        $isSuccess = $wifiRepo->addSetting($wifi);
      }

      if(!$isSuccess) {
        throw new \Exception("failed save wifi settings");
      }

    }

}
