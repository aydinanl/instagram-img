<?php

namespace aydinanl;

class Example
{

    public function test(): void
    {
        try {
            //Create new instance.
            $instance = new Instagram();

            //Set instance's Instagram URL.
            $instance->setURL('https://www.instagram.com/p/BpM1Db3ljLO/');

            //Download it.
            $instance->download();
        } catch (InstagramExceptionsNullURL $e) {
            echo 'Error: ' . $e->getMessage();

        } catch (InstagramExceptionsCurlError $e) {
            echo 'Curl Error.';
        }
    }
}

require_once __DIR__ . '/../vendor/autoload.php';

// Simple Usage
$exp = new Example();
$exp->test();