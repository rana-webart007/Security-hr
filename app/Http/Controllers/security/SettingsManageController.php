<?php

namespace App\Http\Controllers\security;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;

class SettingsManageController extends Controller
{
    //

    public function settings_update($key)
    {
           $values = Settings::where('key', $key)->first();
           return view('admin.settings.update', compact('values'));
    }

    public function settings_update_action(Request $request, $id)
    {
           Settings::whereId($id)->update([
                 'value' => $request->data,
           ]);

          return redirect()->back();
    }
}
