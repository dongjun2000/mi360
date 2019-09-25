<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * 图片上传
     *
     * @param Request $request
     * @param $inputFileName
     * @return string
     */
    public function upload(Request $request, $inputFileName)
    {
        $path = null;

        // 请求中是否存在指定文件，并且验证上传是否成功
        if ($request->hasFile($inputFileName) && $request->file($inputFileName)->isValid()) {
            $path = $request->file($inputFileName)->store('/images/user/' . date('Ymd'), 'public');
        }

        return is_null($path) ? $path : asset('storage/' . $path);
    }
}
