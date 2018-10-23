<?php

namespace aydinanl;

interface InstagramInterface
{

    /**
     * @param string $URL
     * @return mixed
     */
    public function setURL($URL = '');

    /**
     * @return mixed
     */
    public function download();

    /**
     * @return mixed
     */
    public function request();
}