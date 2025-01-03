<?php
namespace App\Actions\SettingAction;

use App\Models\Setting;
use Exception;
use Illuminate\Http\Request;

class SettingEditAction{
    protected $request;
    protected $data = [];
    protected $sessionData;
    protected $setting;
    public function __construct(Request $request, $sessionValue = null, Setting $setting)
    {
        $this->request = $request;
        $this->sessionData = $sessionValue;
        $this->setting = $setting;
    }

    public function arrangeUpdateData()
    {
        $this->data = $this->request->all();
        $this->data["site_name"] = $this->jsonUpdateFormat($this->request->site_name, $this->setting->site_name);
        $this->data["quatation"] = $this->jsonUpdateFormat($this->request->quatation, $this->setting->quatation);
        $this->data["address"] = $this->jsonUpdateFormat($this->request->address, $this->setting->address);
        $this->data["phone"] = $this->jsonUpdateFormat($this->request->phone, $this->setting->phone);
        $this->data["contact"] = $this->jsonUpdateFormat($this->request->contact, $this->setting->contact);
        $this->data["contact_second"] = $this->jsonUpdateFormat($this->request->contact_second, $this->setting->contact_second);
        $this->data["meta_title"] = $this->jsonUpdateFormat($this->request->meta_title, $this->setting->meta_title);
        $this->data["meta_keywords"] = $this->jsonUpdateFormat($this->request->meta_keywords, $this->setting->meta_keywords);
        $this->data["meta_description"] = $this->jsonUpdateFormat($this->request->meta_description, $this->setting->meta_description);
        $this->data["copyright"] = $this->jsonUpdateFormat($this->request->copyright, $this->setting->copyright);
        $this->setting->fill($this->data);
        $settingData = $this->setting->save();
        if (!$settingData) {
            throw new Exception();
        }
        return "success";
    }
    public function jsonUpdateFormat($eng, $oldData)
    {
        $decodeData = json_decode($oldData);
        $decodeData->{$this->sessionData} = $eng;
        return json_encode($decodeData);
    }

}