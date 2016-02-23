<?php

namespace RNACode\PHPCI;


use PHPCI\Builder;
use PHPCI\Model\Build;
use PHPCI\Plugin;

class Bower implements Plugin
{

    /**
     * @var string
     */
    protected $directory;
    protected $phpci;
    protected $build;
    protected $bower;

    /**
     * Standard Constructor
     *
     * $options['directory'] Output Directory. Default: %BUILDPATH%
     * $options['filename']  Phar Filename. Default: build.phar
     * $options['regexp']    Regular Expression Filename Capture. Default: /\.php$/
     * $options['stub']      Stub Content. No Default Value
     *
     * @param Builder $phpci
     * @param Build   $build
     * @param array   $options
     */
    public function __construct(Builder $phpci, Build $build, array $options = array())
    {
        $path = $phpci->buildPath;
        $this->build = $build;
        $this->phpci = $phpci;
        $this->directory = $path;
        $this->bower = $this->phpci->findBinary('bower');
        var_dump($options);
    }

    /**
     * Executes gulp and runs a specified command (e.g. install / update)
     */
    public function execute()
    {
        // if npm does not work, we cannot use gulp, so we return false
        $cmd = 'echo %s';
        if (IS_WIN) {
            $cmd = 'echo /d %s';
        }
        // and execute it
        return $this->phpci->executeCommand($cmd, $this->directory);
    }

}