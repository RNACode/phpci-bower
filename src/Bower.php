<?php

namespace RNACode\PHPCI;


use PHPCI\Builder;
use PHPCI\Model\Build;
use PHPCI\Plugin;

class Bower implements Plugin
{

    protected $directory;
    protected $phpci;
    protected $build;
    protected $bower;
    protected $command;
    protected $flags;

    /**
     * Standard Constructor
     *
     * $options['directory'] Output Directory. Default: %BUILDPATH%
     * $options['filename']  Phar Filename. Default: build.phar
     * $options['regexp']    Regular Expression Filename Capture. Default: /\.php$/
     * $options['stub']      Stub Content. No Default Value
     *
     * @param Builder $phpci
     * @param Build $build
     * @param array $options
     */
    public function __construct(Builder $phpci, Build $build, array $options = array())
    {
        $path = $phpci->buildPath;
        $this->build = $build;
        $this->phpci = $phpci;
        $this->directory = $path;
        $this->bower = $this->phpci->findBinary('bower');
        $this->command = array_key_exists('command', $options) ? $options['command'] : null;
        $this->flags = array_key_exists('flags', $options) ? $options['flags'] : [];
    }

    /**
     * Executes gulp and runs a specified command (e.g. install / update)
     */
    public function execute()
    {
        // build the gulp command
        $cmd = 'cd';
        if (IS_WIN) {
            $cmd .= ' /d';
        }
        $cmd .= ' %s && %s %s %s';
        // and execute it
        return $this->phpci->executeCommand($cmd, $this->directory, $this->bower, $this->command, implode(' ', $this->flags));
    }

}