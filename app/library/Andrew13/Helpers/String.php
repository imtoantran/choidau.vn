<?php namespace Andrew13\Helpers;

use Carbon\Carbon;
use tidy;

class String {

    /**
     * Capatilize first letter of each word of a string.
     *
     * @param string  $value
     * @return string
     */
    public static function title($value)
    {
        return mb_convert_case($value, MB_CASE_TITLE);
    }

    /**
     * @param $value
     * @internal param $html
     * @return string
     */
    public static function tidy($value)
    {
        // Check to see if Tidy is available.
        if(class_exists('tidy')) {
            $tidy = new tidy();
            return  $tidy->repairString($value, array(
                'show-body-only' => true,
            ));
        } else { // No Tidy, Time for regex and possibly a broken DOM :(
            preg_match_all('#<(?!meta|img|br|hr|input\b)\b([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $value, $result);
            $openedtags = $result[1];
            preg_match_all('#</([a-z]+)>#iU', $value, $result);
            $closedtags = $result[1];
            $len_opened = count($openedtags);
            if (count($closedtags) == $len_opened) {
                return $value;
            }
            $openedtags = array_reverse($openedtags);
            for ($i=0; $i < $len_opened; $i++) {
                if (!in_array($openedtags[$i], $closedtags)) {
                    $value .= '</'.$openedtags[$i].'>';
                } else {
                    unset($closedtags[array_search($openedtags[$i], $closedtags)]);
                }
            }
            return $value;
        }
    }

    public static function date(Carbon $date)
    {
        if($date->diffInDays(Carbon::now()) < 7) {
            return $date->diffForHumans();
        } else {
            return $date->toFormattedDateString();
        }
    }

    public  static function get_url_img_public($url){
        $ii =strpos($url,'public')+6;
        $nn=strlen($url);
        $url_2=substr($url,$ii,$nn-$ii);
        return $url_2;
    }

    public static function date_format_vn($date)
    {
        //$date=date_create($date);
       // $date= date_format($post->created_at,'H:i d-m-Y');
        return $date;
    }

    public static function showTimeAgo($date)
    {
        if(empty($date))
        {
            return "No date provided";
        }

        $periods = array("giây", "phút", "giờ", "ngày", "tuần", "tháng", "năm", "decade");
        $lengths = array("60","60","24","7","4.35","12","10");

        $now = time();
        $unix_date = strtotime($date);

        // check validity of date
        if(empty($unix_date))
        {
            return "Bad date";
        }

        // is it future date or past date
        if($now > $unix_date)
        {
            $difference     = $now - $unix_date;
            $tense         = "cách đây";
        }
        else
        {
            $difference     = $unix_date - $now;
            $tense         = "vừa xong";
        }

        for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++)
        {
            $difference /= $lengths[$j];
        }

        $difference = round($difference);

        if($difference != 1)
        {
            $periods[$j].= "";
        }

        return " {$tense} $difference  $periods[$j] ";
    }

}