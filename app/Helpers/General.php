<?php
/*
 * helper function that auto load(composer.json autoload => files) and then use composer dump-autoload
 *  when project run on server
 *
 */

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

function isOnline($id)
{
    return Cache::has('user-is-online-' . $id);
}
function offline($id)
{
    return Cache::forget('user-is-online-' . $id);
}
function saveImage($folder, $img){
    $filename = time().$img->hashName();
    $img -> storeAs('/',$filename,$folder);//By default, this method will use your default disk. If you would like to specify another disk, pass the disk name as the second argument to the store method:
    $path = $folder . '/' . $filename;
    return $path;
}
function deleteImage($image){
    $photo = Str::after($image, 'assets/');
    $photo = base_path('/public/assets/images/' . $photo);
    unlink($photo);
}
function get_default_lang(){
    return config('app.locale');
}
function get_time_notify($datetime1){
    $datetime1 = strtotime($datetime1);
    $datetime2 = strtotime(Carbon::now());
    $secs = $datetime2 - $datetime1;
    switch ($secs){
        case(floor($secs/(7*86400))>0):
        {
            if(ceil($secs/(7*86400)) > 2)
                return 'منذ' . ceil($secs/(7*86400)) . 'أسابيع';
            elseif(ceil($secs/(7*86400)) == 2)
                return 'منذ أسبوعين';
            else
                return 'منذ أسبوع';
        }
        case(floor($secs/(86400))>0):
        {
            if(ceil($secs/(86400)) > 2)
                return 'منذ' . ceil($secs/(86400)) . 'أيام';
            elseif(ceil($secs/(86400)) == 2)
                return 'منذ يومين';
            else
                return 'منذ يوم';
        }
        case(floor($secs/(3600))>0):
        {
            if(ceil($secs/(3600)) > 2)
                return 'منذ' . ceil($secs/(3600)) . 'ساعات';
            elseif(ceil($secs/(3600)) == 2)
                return 'منذ ساعتين';
            else
                return 'منذ ساعه';
        }
        case(floor($secs/(60))>0):
        {
            if(ceil($secs/(60)) > 2)
                return 'منذ' . ceil($secs/(60)) . 'دقائق';
            elseif(ceil($secs/(60)) == 2)
                return 'منذ دقيقتين';
            else
                return 'منذ دقيقه';
        }
        case($secs>0):
        {
            if(ceil($secs) > 2)
                return 'منذ' . ceil($secs) . 'ثواني';
            elseif(ceil($secs) == 2)
                return 'منذ ثانيتين';
            else
                return 'منذ ثانيه';
        }
        default:
            return 'الأن';
    }
}
