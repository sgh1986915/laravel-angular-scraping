<?php

/*
 *  @author     Aafrin <info@aafrin.com>
 *  @site       www.aafrin.com
 *  @version    1.0
 */
 
 ///usr/bin/mysqldump -u root -p trendsninja > /var/www/html/app/storage/trendsninja-2014-10-13-17-17-25.sql

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class DatabaseBackup extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'db:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup mySQL database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire() {
        $this->info('Database Backup Started');

        $host = Config::get('database.connections.mysql.host');
        $database = Config::get('database.connections.mysql.database');
        $username = Config::get('database.connections.mysql.username');
        $password = Config::get('database.connections.mysql.password');
        $backupPath = app_path() . "/storage/backup/";
        $backupFileName = $database . "-" . date("Y-m-d-H-i-s") . '.sql';

        //for linux replace the path with /usr/local/bin/mysqldump (The path might varies).
        //$path = "c:\\xampp\mysql\bin\mysqldump";
		$path="/usr/bin/mysqldump";

        //without password
        //$command = $path . " -u " . $username . " " . $database . " > " . $backupPath . $backupFileName;
        //with password
        $command = $path . " -u " . $username . " -p " . $password . " " . $database . " > " . $backupPath . $backupFileName;
        
		$this->info($command); exit();
		
		system($command);
        $this->info('Backup File Created At: ' . $backupPath . $backupFileName);
        $this->info('Database Backup Completed');
    }

}