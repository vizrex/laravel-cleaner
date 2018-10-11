<?php

/*
 *  Copyright © All Rights Reserved by Vizrex (Private) Limited 
 *  Usage or redistribution of this code is strictly prohibited
 *  without written consent of Vizrex (Private) Limited.
 *  Queries are welcomed at copyright@vizrex.com
 */

namespace Vizrex\LaravelCleaner\Console\Commands;

use Vizrex\Laraviz\Console\Commands\BaseCommand;
use Illuminate\Support\Facades\Artisan;

class Cleanup extends BaseCommand
{
/**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cleanup {--all} {--auth} {--cache} {--config} {--debugbar} {--route} {--view} {--session} {--log}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleans cache, sessions, debugbar, views and other things';
    
    protected $availableCommandNames = [];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Load Available Commands
        $this->loadAvailableCommandNames();
        
        // Get commands to execute
        $commandsToExecute = $this->getCommandsToExecute();
        
        //dd($commandsToExecute);
        
        // Execute Commands
        foreach($commandsToExecute as $cmd)
        {
            $this->callIfExists($cmd);
        }
    }
    
    private function loadAvailableCommandNames()
    {
        $commands = Artisan::all();
        $this->availableCommandNames = [];
        
        foreach($commands as $command)
        {
            $this->availableCommandNames[] = $command->getName();
        }
    }
    
    private function getCommandsToExecute($skipUserOptions = false)
    {
        $commandsToExecute = [];
        $potentialClearCommands = ["cache", "config", "debugbar", "route", "view", "session", "log"];
        $clearAuthCommand = "auth:clear-resets";
        
        if($skipUserOptions || $this->option("auth"))
            $commandsToExecute[] = $clearAuthCommand;
        
        foreach($potentialClearCommands as $cmd)
        {
            if($skipUserOptions || $this->option("all") || $this->option($cmd))
                $commandsToExecute[] = "$cmd:clear";
        }
        
        // If no switch is given, execute all commands
        if(empty($commandsToExecute))
        {
            $commandsToExecute = $this->getCommandsToExecute(true);
        }
        
        return $commandsToExecute;
        
    }
    
    private function callIfExists($commandName, $parameters = [])
    {
        if(in_array($commandName, $this->availableCommandNames))
        {
            try
            {
                Artisan::call($commandName, $parameters);
                $this->info(Artisan::output());
            }
            catch(\RuntimeException $ex)
            {
                $this->error($ex->getMessage());
            }
        }
        else
        {
            $this->debug($this->str("not_found", ['command' => $commandName]));
        }
    }

    protected function setNamespace()
    {
        $this->namespace = \Vizrex\LaravelCleaner\LaravelCleanerProvider::getNamespace();
    }


}
