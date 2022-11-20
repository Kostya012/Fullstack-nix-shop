<?php

namespace framework\Components;

trait BaseMethods
{
    /**
     * Clear string of string or array
     * @param mixed $str
     * @return mixed
     */
    public function clearStr(mixed $str): mixed
    {
        if (is_array($str)) {
            foreach ($str as $key => $item) {
                $str[$key] = trim(strip_tags($item));
            }
            return $str;
        } else {
            return trim(strip_tags($str));
        }
    }

    /**
     * Transform number-string to number (return number, 0-false or float)
     * @param mixed $num
     * @return mixed
     */
    public function clearNum(mixed $num):mixed
    {
        return $num * 1;
    }

    /**
     * Check is POST or not
     * @return bool
     */
    public function isPost():bool
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    /**
     * Check is XMLHttpRequest from AJAX library Javascript or not
     * @return bool
     */
    public function isAjax():bool
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    public function redirect($http = false, $code = false)
    {
        if ($code) {
            $codes = ['301' => 'HTTP/1.1 301 Move Permanently'];

            if ($codes[$code]) {
                header($codes[$code]);
            }
            if ($http) {
                $redirect = $http;
            } else {
                $redirect = $_SERVER['HTTP_REFERER'] ?? 'home';
            }
            header("Location: $redirect");
            exit;
        }
    }

    public function writeLog($message, $file = 'log.txt', $event = 'Fault')
    {
        $dateTime = new \DateTime();
        $str = $event . ': ' . $dateTime->format('d-m-Y G:i:s') . ' - ' . $message . "\n"; // for Windows \r\n
        file_put_contents(filename: "log/$file", data: $str, flags: FILE_APPEND);
    }
}
