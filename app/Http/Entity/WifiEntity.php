<?php

namespace App\Http\Entity;
use Carbon\Carbon;


class WifiEntity
{
  const BUFFER_MINUTES = 1; //waktu dilebihkan 1 menit

  public string $name;
  public string $macAddr;
  public string $ip;
  public string $ssid;
  public ?int $waktu = null;
  public ?int $zteIndex = null;
  public ?string $created_at = null;
  public ?string $updated_at = null;


  public function sisaWaktu(): int
  {

    if(!$this->waktu){
      return 0;
    }

    $waktu = self::BUFFER_MINUTES + $this->waktu;

    $waktuMulai = strtotime("+{$waktu} minutes", strtotime($this->updated_at)); 
    $sisa = $waktuMulai - time();

    if($sisa > 0){
      return $sisa/60;
    }
    return 0;
  }

  public function isWaktuHabis()
  {
    return ($this->sisaWaktu() <= 0);
  }

  public function getWaktuSelesai()
  {
    if(is_null($this->waktu)){
      return null;
    }

    return  Carbon::parse($this->updated_at)->addMinutes($this->waktu + WifiEntity::BUFFER_MINUTES);
  }
}
