## Instagram Image Downloader

A simple library that help to download image from Instagram due to an URL.

## Requirements

- PHP 7.1+
- PHP/cURL
- Composer


## Usage
- composer update
```
    use aydinanl/Instagram;
    
    $instance = new Instagram();
    $instance->setURL('https://www.instagram.com/p/BpM1Db3ljLO/');
    $instance->download();
    //Starts download automatically.
```
P.S: You can examine test/Example.php for more detailed usage.