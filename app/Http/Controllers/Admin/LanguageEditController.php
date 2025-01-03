<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class LanguageEditController extends Controller
{
    public function Index(){
        $lang = getLangValueAdmins();
        $path='resources/lang/'.$lang.'/admin.php';
        $langContentPath = base_path($path);
        $langContent = include($langContentPath);
        return view('admin.language.index', compact('langContent','lang'));
    }
    public function updateLanguage(Request $request) {
        // dd($request->all());
        $lang = getLangValueAdmins();
        $path='resources/lang/'.$lang.'/admin.php';
        $langContentPath = base_path($path);
        $langContent = include($langContentPath);
        $newContent = $request->input('langContent');
        // Merge the new content with the existing content
        $updatedContent = array_merge($langContent, $newContent);
        // Save the updated content back to the language file
        $contentString = "<?php\n\nreturn " . var_export($updatedContent, true) . ";\n";
        File::put($langContentPath, $contentString);
        return redirect()->back()->with('success', 'Language content updated successfully');
    }
}
