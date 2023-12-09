<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class PythonScriptController extends Controller
{
    
    public function run(Request $request)
    {
        
        $scriptPath = base_path('public/python_script/code/checkerImageAI.py');
        $imagePath = public_path('storage/users_avatar/avatar.png');
        
        $process = new Process(['python', $scriptPath, $imagePath]);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        $output = $process->getOutput();
        if($output){
            User::where('id',auth()->id())
            ->update(['status','banned']);

            $ip_address = $request->ip();
            $htaccess_path = "/path/to/.htaccess"; // Thay thế bằng đường dẫn thực tế đến tệp .htaccess
            file_put_contents($htaccess_path, "deny from $ip_address\n", FILE_APPEND);
            return redirect()->route('/banned');
        }
        return $output;
    }
}
