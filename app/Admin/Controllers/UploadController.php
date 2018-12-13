<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PayConfig;
use App\Models\SchoolCover;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function uploadImage(Request $request)
    {
        // 初始化返回数据，默认是失败的
        $data = [
            'success'   => false,
            'msg'       => '上传失败!',
            'file_path' => ''
        ];
        // 判断是否有上传文件，并赋值给 $file
        if ($file = $request->upload_file) {
            // 保存图片到本地
            $path = $file->store('imgs', 'public');
            // 图片保存成功的话
            if ($path) {
                $data['file_path'] = Storage::disk('public')->url($path);
                $data['msg']       = "上传成功!";
                $data['success']   = true;
            }
        }
        return $data;
    }

}