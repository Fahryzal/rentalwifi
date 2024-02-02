<?php

namespace App\Http\Controllers;

use ZteF\Exception\LoginException;
use ZteF\ZteF;
use App\Http\Requests\BlockPostRequest;
use App\Http\Requests\WifiSettingPostRequest;
use App\Http\Services\WifiService;



class WifiController extends Controller
{


    public function AllowedUsers()
    {
        try {
            $wifiService = new WifiService();

            $allowedUsers = $wifiService->get();

            return view("wifi.index", ['allowedUsers' => $allowedUsers]);
        
        } catch (LoginException $e) {
            echo $e->getMessage() . \PHP_EOL;
        } catch (\Exception $e) {
            echo $e->getMessage() . \PHP_EOL;
        }
    }

    public function BlockUsers()
    {
        try {
            $zte = new ZteF(config("app.zte_host"), config("app.zte_user"), config("app.zte_password"), true);
        
            // Get status
            $blockedUsersUsers = $zte->network()->wlan()->accessControlList();
            return view("wifi.blocked_users", ['blockedUsersUsers' => $blockedUsersUsers]);

        
        } catch (LoginException $e) {
            echo $e->getMessage() . \PHP_EOL;
        } catch (\Exception $e) {
            echo $e->getMessage() . \PHP_EOL;
        }
    }

    public function block(BlockPostRequest $request)
    {
        try {
            $wifiService = new WifiService();
            $formdata = $request->validated();
            $wifiService->block($formdata);

            return redirect('/wifi-setting/acl')->with('success', "Berhasil memblokir mac address : {$request->mac_address}");
        
        } catch (LoginException $e) {
            return redirect('/wifi-setting/acl')->with('error', "Error: {$e->getMessage()}");
        } catch (\Exception $e) {
            return redirect('/wifi-setting/acl')->with('error', "Error: {$e->getMessage()}");
        }
    }

    public function unblock(WifiSettingPostRequest $request)
    {
        try {  
            $wifiService = new WifiService();
            $formdata = $request->validated();

            $wifiService->unblock($formdata);

            return redirect('/wifi-setting/acl')->with('success', "Berhasil membuka blokir mac address : {$request->mac_address}");
        
        } catch (LoginException $e) {
            return redirect('/wifi-setting/acl')->with('error', "Error: {$e->getMessage()}");

        } catch (\Exception $e) {
            return redirect('/wifi-setting/acl')->with('error', "Error: {$e->getMessage()}");

        }
    }

    public function createOrUpdateSetting(WifiSettingPostRequest $request)
    {
        try {
            $wifiService = new WifiService();
            $formdata = $request->validated();
            $wifiService->createOrUpdateSetting($formdata);

            return redirect('/');        
        } catch (LoginException $e) {
            return redirect('/')->with('error', "Error: {$e->getMessage()}");
        } catch (\Exception $e) {
            return redirect('/')->with('error', "Error: {$e->getMessage()}");
        }
    }
}
