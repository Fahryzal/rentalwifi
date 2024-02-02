<?php

namespace App\Http\Repositories;

use App\Models\Wifi;
use App\Http\Entity\WifiEntity;

class WifiRepositories
{
    public function all()
    {
      $models = Wifi::all();
      return $models;
    }

    public function getByMacAddr(string $macAddr): ?Wifi
    {
      $model = Wifi::where("mac_address", $macAddr)->first();
      return $model;
    }

    public function addSetting(WifiEntity $entity)
    {
      $model = new Wifi();
      $model->mac_address = $entity->macAddr;
      $model->waktu = $entity->waktu;
      return $model->save();
    }

    public function updateSetting(Wifi $model, WifiEntity $entity)
    {
      $model->mac_address = $entity->macAddr;
      $model->waktu = $entity->waktu;
      return $model->save();
    }
}
