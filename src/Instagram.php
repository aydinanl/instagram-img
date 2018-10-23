<?php

namespace aydinanl;

require_once 'InstagramExceptions.php';

class Instagram implements InstagramInterface
{
    /**
     * @var string
     */
    public static $URL;

    /**
     * @param string $URL
     */
    public function setURL($URL = '')
    {
        self::$URL = $URL;
    }

    /**
     * @return string $URL
     */
    public static function getURL(): string
    {
        return self::$URL;
    }

    /**
     * @return mixed
     * @throws InstagramExceptionsNullURL
     * @throws InstagramExceptionsCurlError
     */
    public function download()
    {
        if (empty(self::$URL)) {
            throw new InstagramExceptionsNullURL('Please set an Instagram URL.');
        }

        return $this->prepareDownload();
    }

    /**
     * @throws InstagramExceptionsCurlError
     */
    public function prepareDownload(): void
    {
        $request = $this->request();
        $parse = $this->parse($request);

        // Open the file in a binary mode
        $fp = fopen($parse, 'rb');

        // Send the right headers
        header('Cache-Control: no-cache, no-store, max-age=0, must-revalidate');
        header('Pragma: no-cache');
        header('Content-Type: image/jpg');
        header('Content-Disposition: attachment; filename="instagram.jpg"');

        // Dump the picture and stop the script
        fpassthru($fp);
        exit;
    }

    /**
     * @return mixed - HTML
     * @throws InstagramExceptionsCurlError
     */
    public function request()
    {
        $url = self::$URL;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $request = curl_exec($ch);

        if ($request == false) {
            throw new InstagramExceptionsCurlError(curl_error($ch), curl_errno($ch));
        }

        curl_close($ch);
        return $request;
    }

    /**
     * @param $html
     * @return string - parsed instagram URL string
     */
    protected function parse($html): string
    {
        if (empty($html)) {
            return false;
        }

        preg_match_all('/<meta.*property="og:image".*content="(.*)".*\/>/', $html, $matches);
        return $matches[1][0];
    }

}