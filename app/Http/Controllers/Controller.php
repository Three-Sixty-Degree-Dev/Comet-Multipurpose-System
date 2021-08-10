<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //generate slug
    protected function getSlug($slug){
        return str_replace(' ', '-', $slug);
    }

    //genereate video url youtube and vimeo link
    protected function getVideo($request_url){
        //fix youtube and vimeo url
        $url = $request_url;
        if(strpos($url,'youtube')){
            $slice_url = explode('&', $url);
            return $video_url = str_replace('watch?v=', 'embed/', $slice_url[0]);
        }elseif (strpos($url, 'vimeo')){
            return $video_url = str_replace('vimeo.com', 'player.vimeo.com/video', $url);
        }
    }

    //generate update video url youtube and vimeo link
    protected function getUpdateVideo($request_v_url, $feature_data){
        //fix youtube and vimeo url
        $url = $request_v_url;
        $text_pur_y = substr($url, 0, 30);
        $text_pur_v = substr($url, 0, 17);

        if($text_pur_y == 'https://www.youtube.com/watch?' || $text_pur_v == 'https://vimeo.com') {
            if (strpos($url, 'youtube')) {
                $slice_url = explode('&', $url);
                return $video_url = str_replace('watch?v=', 'embed/', $slice_url[0]);
            } elseif (strpos($url, 'vimeo')) {
                return $video_url = str_replace('vimeo.com', 'player.vimeo.com/video', $url);
            }
        }else{
            return $video_url = $feature_data->post_video;
        }
    }


    // Image upload
    public function imageUpload($request, $file, $path){
        if($request->hasFile($file)){
            $img = $request->file($file);
            $unique_name = md5(time().rand()).'.'.$img->getClientOriginalExtension();
            $img->move(public_path($path), $unique_name);
        }

        return $unique_name;
    }
}
