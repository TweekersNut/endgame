<?php

namespace APP\Helpers;

use \DateTime;

class Logger {

    private $path = APP_ROOT . '/Logs/';
    private $filename;

    public function __construct($filename = 'logger') {
        date_default_timezone_set(TIME_ZONE);
        $this->path = $this->path;
        $this->filename = $filename;
    }

    
    public function write($type,$message) {
        $date = new DateTime();
        $log = $this->path . $date->format('Y-m-d') . "_". $this->filename .".log";
        if (is_dir($this->path)) {
            if (!file_exists($log)) {
                $fh = fopen($log, 'a+') or die("Fatal Error !");
                $logcontent = "Time : " . $date->format('H:i:s') . "\r\n" . "\r\n[". $type ."]\r\n" . $message . "\r\n";
                fwrite($fh, $logcontent);
                fclose($fh);
            } else {
                $this->edit($log, $date, $message);
            }
        } else {
            if (mkdir($this->path, 0777) === true) {
                $this->write($message);
            }
        }
    }
    
    public function writeInfo($message) {
        $date = new DateTime();
        $log = $this->path . $date->format('Y-m-d') . "_". $this->filename .".log";
        if (is_dir($this->path)) {
            if (!file_exists($log)) {
                $fh = fopen($log, 'a+') or die("Fatal Error !");
                $logcontent = "Time : " . $date->format('H:i:s') . "\r\n" . "\r\n[INFO]\r\n" . $message . "\r\n";
                fwrite($fh, $logcontent);
                fclose($fh);
            } else {
                $this->edit($log, $date, $message);
            }
        } else {
            if (mkdir($this->path, 0777) === true) {
                $this->write($message);
            }
        }
    }
    
    public function writeDebug($message) {
        $date = new DateTime();
        $log = $this->path . $date->format('Y-m-d') . "_". $this->filename .".log";
        if (is_dir($this->path)) {
            if (!file_exists($log)) {
                $fh = fopen($log, 'a+') or die("Fatal Error !");
                $logcontent = "Time : " . $date->format('H:i:s') . "\r\n" . "\r\n[Debug]\r\n" . $message . "\r\n";
                fwrite($fh, $logcontent);
                fclose($fh);
            } else {
                $this->edit($log, $date, $message);
            }
        } else {
            if (mkdir($this->path, 0777) === true) {
                $this->write($message);
            }
        }
    }
    
    public function writeWarning($message) {
        $date = new DateTime();
        $log = $this->path . $date->format('Y-m-d') . "_". $this->filename .".log";
        if (is_dir($this->path)) {
            if (!file_exists($log)) {
                $fh = fopen($log, 'a+') or die("Fatal Error !");
                $logcontent = "Time : " . $date->format('H:i:s') . "\r\n" . "\r\n[Warning]\r\n" . $message . "\r\n";
                fwrite($fh, $logcontent);
                fclose($fh);
            } else {
                $this->edit($log, $date, $message);
            }
        } else {
            if (mkdir($this->path, 0777) === true) {
                $this->write($message);
            }
        }
    }
    
    public function writeError($message) {
        $date = new DateTime();
        $log = $this->path . $date->format('Y-m-d') . "_". $this->filename .".log";
        if (is_dir($this->path)) {
            if (!file_exists($log)) {
                $fh = fopen($log, 'a+') or die("Fatal Error !");
                $logcontent = "Time : " . $date->format('H:i:s') . "\r\n" . "\r\n[ERROR]\r\n" . $message . "\r\n";
                fwrite($fh, $logcontent);
                fclose($fh);
            } else {
                $this->edit($log, $date, $message);
            }
        } else {
            if (mkdir($this->path, 0777) === true) {
                $this->write($message);
            }
        }
    }

    private function edit($log, $date, $message) {
        $logcontent = "Time : " . $date->format('H:i:s') . "\r\n" . $message . "\r\n\r\n";
        $logcontent = $logcontent . file_get_contents($log);
        file_put_contents($log, $logcontent);
    }

}
