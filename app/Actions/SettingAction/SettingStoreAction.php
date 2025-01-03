<?php

namespace App\Actions\SettingAction;

use App\Models\Setting;
use Exception;
use Illuminate\Http\Request;

class SettingStoreAction
{
    protected $request;
    protected $data = [];
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function arrangeStoreData()
    {
        $this->data = $this->request->all();
        $this->data["site_name"] = $this->jsonStoreFormat($this->request->site_name);
        $this->data["quatation"] = $this->jsonStoreFormat($this->request->quatation);
        $this->data["address"] = $this->jsonStoreFormat($this->request->address);
        $this->data["phone"] = $this->jsonStoreFormat($this->request->phone);
        $this->data["contact"] = $this->jsonStoreFormat($this->request->contact);
        $this->data["contact_second"] = $this->jsonStoreFormat($this->request->contact_second);
        $this->data["meta_title"] = $this->jsonStoreFormat($this->request->meta_title);
        $this->data["meta_keywords"] = $this->jsonStoreFormat($this->request->meta_keywords);
        $this->data["meta_description"] = $this->jsonStoreFormat($this->request->meta_description);
        $this->data["copyright"] = $this->jsonStoreFormat($this->request->copyright);
        // dd($this->data);
        $visitor = Setting::create($this->data);
        if (!$visitor) {
            throw new Exception();
        }
        return "success";
    }
    public function jsonStoreFormat($eng)
    {
        return json_encode([
            'en' => $eng ?? null,
            'np' => $eng ?? null
        ]);
    }
}
