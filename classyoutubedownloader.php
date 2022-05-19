<?php
class YoutubeDownloader
{

    protected $url_youtube;

    public function __construct($url_youtube)
    {
        $this->url_youtube  = $url_youtube;
        header('Content-Type: application/json');
    }

    /** Execute shell youtube-dl */
    private function exec($command)
    {
        return shell_exec('youtube-dl "'.$this->url_youtube.'" '.$command);
    }


    /** Get Dump JSON */
    private function getJSONOutput()
    {
        return json_decode($this->exec('-j'));
    }


    /** Convert Duration from seconds */
    private function convertDuration($total_time)
    {
        $seconds    = $total_time % 60;
        $minutes    = (floor($total_time / 60)) % 60;
        $hours      = floor($total_time / 3600);
        $sec        = sprintf('%02d', $seconds);
        return ($hours == 0 ? $minutes . ':'.$sec : $hours . ':' . $minutes . ':'.$sec);
    }


    /** Validate Yotube URL */
    private function validateURL($url)
    {
        return preg_match('~^(?:https?://)?(?:www[.])?(?:youtube[.]com/watch[?]v=|youtu[.]be/)([^&]{11})~x', $url);
    }


    /** Time Execute */
    private function timeExecute() 
    {
        $time = microtime();
        $time = explode(' ', $time);
        $time = $time[1] + $time[0];
        return $time;
     
    }


    /** Make message error */
    private function errMsg($message)
    {
        return json_encode(
            array(
                'error'     => true,
                'message'   => $message
            )
        );
    }


    /** Itag Youtube Info */
    private function getItagInfo()
    {
        return array(
            /** audio */
            139 => array('audio' => true, 'video' => false),
            140 => array('audio' => true, 'video' => false),
            141 => array('audio' => true, 'video' => false),
            171 => array('audio' => true, 'video' => false),
            249 => array('audio' => true, 'video' => false),
            250 => array('audio' => true, 'video' => false),
            251 => array('audio' => true, 'video' => false),

            /** audio/video */
            5   => array('audio' => true, 'video' => true),
            6   => array('audio' => true, 'video' => true),
            17  => array('audio' => true, 'video' => true),
            18  => array('audio' => true, 'video' => true),
            22  => array('audio' => true, 'video' => true),
            34  => array('audio' => true, 'video' => true),
            35  => array('audio' => true, 'video' => true),
            36  => array('audio' => true, 'video' => true),
            37  => array('audio' => true, 'video' => true),
            38  => array('audio' => true, 'video' => true),
            43  => array('audio' => true, 'video' => true),
            44  => array('audio' => true, 'video' => true),
            45  => array('audio' => true, 'video' => true),
            46  => array('audio' => true, 'video' => true),
            82  => array('audio' => true, 'video' => true),
            83  => array('audio' => true, 'video' => true),
            84  => array('audio' => true, 'video' => true),
            85  => array('audio' => true, 'video' => true),
            92  => array('audio' => true, 'video' => true),
            93  => array('audio' => true, 'video' => true),
            94  => array('audio' => true, 'video' => true),
            95  => array('audio' => true, 'video' => true),
            96  => array('audio' => true, 'video' => true),
            101 => array('audio' => true, 'video' => true),
            102 => array('audio' => true, 'video' => true),
            132 => array('audio' => true, 'video' => true),
            151 => array('audio' => true, 'video' => true),
            
            /** video */
            133 => array('audio' => false, 'video' => true),
            134 => array('audio' => false, 'video' => true),
            135 => array('audio' => false, 'video' => true),
            136 => array('audio' => false, 'video' => true),
            137 => array('audio' => false, 'video' => true),
            138 => array('audio' => false, 'video' => true),
            160 => array('audio' => false, 'video' => true),
            167 => array('audio' => false, 'video' => true),
            168 => array('audio' => false, 'video' => true),
            169 => array('audio' => false, 'video' => true),
            218 => array('audio' => false, 'video' => true),
            219 => array('audio' => false, 'video' => true),
            242 => array('audio' => false, 'video' => true),
            243 => array('audio' => false, 'video' => true),
            244 => array('audio' => false, 'video' => true),
            245 => array('audio' => false, 'video' => true),
            246 => array('audio' => false, 'video' => true),
            247 => array('audio' => false, 'video' => true),
            248 => array('audio' => false, 'video' => true),
            264 => array('audio' => false, 'video' => true),
            266 => array('audio' => false, 'video' => true),
            271 => array('audio' => false, 'video' => true),
            272 => array('audio' => false, 'video' => true),
            278 => array('audio' => false, 'video' => true),
            298 => array('audio' => false, 'video' => true),
            299 => array('audio' => false, 'video' => true),
            302 => array('audio' => false, 'video' => true),
            303 => array('audio' => false, 'video' => true),
            308 => array('audio' => false, 'video' => true),
            313 => array('audio' => false, 'video' => true),
            315 => array('audio' => false, 'video' => true),
            330 => array('audio' => false, 'video' => true),
            331 => array('audio' => false, 'video' => true),
            332 => array('audio' => false, 'video' => true),
            333 => array('audio' => false, 'video' => true),
            334 => array('audio' => false, 'video' => true),
            335 => array('audio' => false, 'video' => true),
            336 => array('audio' => false, 'video' => true),
            337 => array('audio' => false, 'video' => true),
            394 => array('audio' => false, 'video' => true),
            395 => array('audio' => false, 'video' => true),
            396 => array('audio' => false, 'video' => true),
            397 => array('audio' => false, 'video' => true),
            398 => array('audio' => false, 'video' => true),
            399 => array('audio' => false, 'video' => true),
            400 => array('audio' => false, 'video' => true),
            401 => array('audio' => false, 'video' => true),
            402 => array('audio' => false, 'video' => true)
        );
    }


    public function check_youtubedl() 
    {
        $return = shell_exec(sprintf("which %s", escapeshellarg('youtube-dl')));
        return !empty($return);
    }


    /** Execute youtube-dl */
    public function execute()
    {
        if ($this->check_youtubedl())
        {
            if (!$this->validateURL($this->url_youtube))
                $output = $this->errMsg('Silahkan gunakan alamat URL Video Youtube dengan benar.');
            else
            {
                $start_time = $this->timeExecute();
                $json       = $this->getJSONOutput();
                $videos     = $json->formats;

                if (count($videos) > 0 && is_array($videos))
                {
                    /** List array from formats */ 
                    $arr = array();
                    foreach($videos as $dat)
                    {
                        $tagInfo = $this->getItagInfo();
                        $tagInfo = $tagInfo[$dat->format_id];

                        $arr[] = array(
                            'itag_id'   => $dat->format_id,
                            'url'       => $dat->url,
                            'filesize'  => $dat->filesize,
                            'ext'       => '.'.$dat->ext,
                            'audio'     => $tagInfo
                        );
                    }

                    $end_time   = $this->timeExecute();
                    $time_taken = round($end_time - $start_time, 2);

                    $output = json_encode(
                        array(
                            'output_response'   => array(
                                'title'         => $json->title,
                                'duration'      => $this->convertDuration($json->duration),
                                'view'          => number_format($json->view_count),
                                'like'          => number_format($json->like_count),
                                'dislike'       => number_format($json->dislike_count),
                                'thumbnail'     => $json->thumbnail,
                                'format'        => $json->format_note,
                                'videos'        => $arr
                            ),
                            'server_response'   => array(
                                'time_execute'  => $time_taken.'s',
                                'referer'       => $_SERVER['HTTP_REFERER']
                            ),
                            'error'             => false
                        )
                    );
                }
                else $output = $this->errMsg('Tidak dapat menemukan data video, silahkan coba kembali.');
            }
        }
        else $output = $this->errMsg('Tidak dapat menemukan youtube-dl. Silahkan install terlebih dahulu.');

        return $output;
    }
}
