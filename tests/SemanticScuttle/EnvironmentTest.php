<?php

class SemanticScuttle_EnvironmentTest extends PHPUnit_Framework_TestCase
{
    public function testServerPathInfoModPhp()
    {
        $_SERVER = array(
            'HTTP_USER_AGENT' => 'Opera/9.80 (X11; Linux x86_64; U; de) Presto/2.9.168 Version/11.50',
            'HTTP_HOST' => 'bm-cgi.bogo',
            'HTTP_ACCEPT' => 'text/html, application/xml;q=0.9, application/xhtml+xml, image/png, image/webp, image/jpeg, image/gif, image/x-xbitmap, */*;q=0.1',
            'HTTP_ACCEPT_LANGUAGE' => 'de-DE,de;q=0.9,en;q=0.8',
            'HTTP_ACCEPT_ENCODING' => 'gzip, deflate',
            'HTTP_COOKIE' => 'PHPSESSID=ga446jhs0e09hkt60u9bsmp0n0',
            'HTTP_CACHE_CONTROL' => 'no-cache',
            'HTTP_CONNECTION' => 'Keep-Alive',
            'PATH' => '/usr/local/bin:/usr/bin:/bin',
  'SERVER_SIGNATURE' => '<address>Apache/2.2.17 (Ubuntu) Server at bm-cgi.bogo Port 80</address>',
            'SERVER_SOFTWARE' => 'Apache/2.2.17 (Ubuntu)',
            'SERVER_NAME' => 'bm-cgi.bogo',
            'SERVER_ADDR' => '127.0.0.1',
            'SERVER_PORT' => '80',
            'REMOTE_ADDR' => '127.0.0.1',
            'DOCUMENT_ROOT' => '/etc/apache2/htdocs',
            'SERVER_ADMIN' => '[no address given]',
            'SCRIPT_FILENAME' => '/home/cweiske/Dev/html/hosts/bm-cgi.bogo/profile.php',
            'REMOTE_PORT' => '45349',
            'GATEWAY_INTERFACE' => 'CGI/1.1',
            'SERVER_PROTOCOL' => 'HTTP/1.1',
            'REQUEST_METHOD' => 'GET',
            'QUERY_STRING' => '',
            'REQUEST_URI' => '/profile.php/dummy',
            'SCRIPT_NAME' => '/profile.php',
            'PATH_INFO' => '/dummy',
            'PATH_TRANSLATED' => '/home/cweiske/Dev/html/hosts/bm-cgi.bogo/dummy',
            'PHP_SELF' => '/profile.php/dummy',
            'REQUEST_TIME' => 1311422546,
        );
        $this->assertEquals(
            '/dummy', SemanticScuttle_Environment::getServerPathInfo()
        );
    }


    public function testServerPathInfoFastCgi()
    {
        $_SERVER = array(
            'PHP_FCGI_MAX_REQUESTS' => '5000',
            'PHPRC' => '/etc/php5/cgi/5.3.6/',
            'PHP_FCGI_CHILDREN' => '3',
            'PWD' => '/var/www/cgi-bin',
            'FCGI_ROLE' => 'RESPONDER',
            'REDIRECT_HANDLER' => 'php-cgi',
            'REDIRECT_STATUS' => '200',
            'HTTP_USER_AGENT' => 'Opera/9.80 (X11; Linux x86_64; U; de) Presto/2.9.168 Version/11.50',
            'HTTP_HOST' => 'bm-cgi.bogo',
            'HTTP_ACCEPT' => 'text/html, application/xml;q=0.9, application/xhtml+xml, image/png, image/webp, image/jpeg, image/gif, image/x-xbitmap, */*;q=0.1',
            'HTTP_ACCEPT_LANGUAGE' => 'de-DE,de;q=0.9,en;q=0.8',
            'HTTP_ACCEPT_ENCODING' => 'gzip, deflate',
            'HTTP_COOKIE' => 'PHPSESSID=ga446jhs0e09hkt60u9bsmp0n0',
            'HTTP_CONNECTION' => 'Keep-Alive',
            'PATH' => '/usr/local/bin:/usr/bin:/bin',
  'SERVER_SIGNATURE' => '<address>Apache/2.2.17 (Ubuntu) Server at bm-cgi.bogo Port 80</address>',
            'SERVER_SOFTWARE' => 'Apache/2.2.17 (Ubuntu)',
            'SERVER_NAME' => 'bm-cgi.bogo',
            'SERVER_ADDR' => '127.0.0.1',
            'SERVER_PORT' => '80',
            'REMOTE_ADDR' => '127.0.0.1',
            'DOCUMENT_ROOT' => '/etc/apache2/htdocs',
            'SERVER_ADMIN' => '[no address given]',
            'SCRIPT_FILENAME' => '/home/cweiske/Dev/html/hosts/bm-cgi.bogo/profile.php',
            'REMOTE_PORT' => '45342',
            'REDIRECT_URL' => '/profile.php/dummy',
            'GATEWAY_INTERFACE' => 'CGI/1.1',
            'SERVER_PROTOCOL' => 'HTTP/1.1',
            'REQUEST_METHOD' => 'GET',
            'QUERY_STRING' => '',
            'REQUEST_URI' => '/profile.php/dummy',
            'SCRIPT_NAME' => '/profile.php',
            'PATH_INFO' => '/dummy',
            'PATH_TRANSLATED' => '/etc/apache2/htdocs/dummy',
            'ORIG_PATH_INFO' => '/profile.php/dummy',
            'ORIG_SCRIPT_NAME' => '/cgi-bin-php/php-cgi-5.3.6',
            'ORIG_SCRIPT_FILENAME' => '/var/www/cgi-bin/php-cgi-5.3.6',
            'ORIG_PATH_TRANSLATED' => '/home/cweiske/Dev/html/hosts/bm-cgi.bogo/profile.php/dummy',
            'PHP_SELF' => '/profile.php/dummy',
            'REQUEST_TIME' => 1311422521,
        );
        $this->assertEquals(
            '/dummy', SemanticScuttle_Environment::getServerPathInfo()
        );
    }


    public function testGetRootWithConfigPreset()
    {
        $GLOBALS['root'] = 'https://happy.penguin.example.org/walks/away/';
        $this->assertEquals(
            'https://happy.penguin.example.org/walks/away/',
            SemanticScuttle_Environment::getRoot()
        );
    }

    public function testGetRootInRootDir()
    {
        $_SERVER = array(
            'HTTP_HOST'       => 'bm.bogo',
            'DOCUMENT_ROOT'   => '/etc/apache2/htdocs',
            'SCRIPT_FILENAME' => '/home/cweiske/Dev/html/hosts/bm.bogo/index.php',
            'QUERY_STRING'    => '',
            'REQUEST_URI'     => '/',
            'SCRIPT_NAME'     => '/index.php',
            'PHP_SELF'        => '/index.php',
        );
        $this->assertEquals(
            '//bm.bogo/',
            SemanticScuttle_Environment::getRoot()
        );
    }

    public function testGetRootInSubdir()
    {
        $_SERVER = array(
            'HTTP_HOST'       => 'bm-subdir.bogo',
            'DOCUMENT_ROOT'   => '/etc/apache2/htdocs',
            'SCRIPT_FILENAME' => '/home/cweiske/Dev/html/hosts/bm-subdir.bogo/tools/scuttle/index.php',
            'QUERY_STRING'    => '',
            'REQUEST_URI'     => '/tools/scuttle/',
            'SCRIPT_NAME'     => '/tools/scuttle/index.php',
            'PHP_SELF'        => '/tools/scuttle/index.php',
        );
        $this->assertEquals(
            '//bm-subdir.bogo/tools/scuttle/',
            SemanticScuttle_Environment::getRoot()
        );
    }

    public function testGetRootFromPharIndex()
    {
        $_SERVER = array(
            'HTTP_HOST'       => 'dist.bm.bogo',
            'DOCUMENT_ROOT'   => '/etc/apache2/htdocs',
            'SCRIPT_FILENAME' => '/home/cweiske/Dev/html/hosts/dist.bm.bogo/SemanticScuttle-0.98.X.phar',
            'QUERY_STRING'    => '',
            'REQUEST_URI'     => '/SemanticScuttle-0.98.X.phar/www/index.php',
            'SCRIPT_NAME'     => '/SemanticScuttle-0.98.X.phar',
            'PATH_INFO'       => '/www/index.php',
            'PATH_TRANSLATED' => 'phar:///home/cweiske/Dev/semanticscuttle/cwdev/dist/SemanticScuttle-0.98.X.phar/www/index.php',
            'PHP_SELF'        => '/SemanticScuttle-0.98.X.phar/www/index.php',
            'PHAR_PATH_TRANSLATED' => '/home/cweiske/Dev/html/hosts/dist.bm.bogo/www/index.php',
        );
        $this->assertEquals(
            '//dist.bm.bogo/SemanticScuttle-0.98.X.phar/www/',
            SemanticScuttle_Environment::getRoot()
        );
    }

    public function testGetRootFromPharWithSubpath()
    {
        $_SERVER = array(
            'HTTP_HOST'       => 'dist.bm.bogo',
            'DOCUMENT_ROOT'   => '/etc/apache2/htdocs',
            'SCRIPT_FILENAME' => '/home/cweiske/Dev/html/hosts/dist.bm.bogo/SemanticScuttle-0.98.X.phar',
            'QUERY_STRING'    => 'no value',
            'REQUEST_URI'     => '/SemanticScuttle-0.98.X.phar/www/index.php/foo/bar/',
            'SCRIPT_NAME'     => '/SemanticScuttle-0.98.X.phar',
            'PATH_INFO'       => '/foo/bar/',
            'PATH_TRANSLATED' => 'phar:///home/cweiske/Dev/semanticscuttle/cwdev/dist/SemanticScuttle-0.98.X.phar/www/index.php',
            'PHP_SELF'        => '/SemanticScuttle-0.98.X.phar/www/index.php/foo/bar/',
            'REQUEST_TIME'    => '1313425297',
            'PHAR_PATH_INFO'  => '/www/index.php/foo/bar/',
            'PHAR_PATH_TRANSLATED' => '/home/cweiske/Dev/html/hosts/dist.bm.bogo/www/index.php/foo/bar/',
        );
        $this->assertEquals(
            '//dist.bm.bogo/SemanticScuttle-0.98.X.phar/www/',
            SemanticScuttle_Environment::getRoot()
        );
    }
}

?>