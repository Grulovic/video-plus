<?php

namespace App\Console\Commands;

use App\Jobs\SendQueueEmail;
use App\Mail\GovFtpUpdate;
use App\Models\FtpGovFile;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckGovFtpUpdates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkGovFtpUpdates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Gov Ftp Updates';

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
     * @return int
     */
    public function handle()
    {
        //FTP server credentials
        $ftp_server = "ftp.pr.mod.gov.rs";
        $ftp_username="b92";
        $ftp_userpass="1389#Bd3v3T#9831";


        // Establishing ftp connection
        $ftp_connection = ftp_connect($ftp_server)
        or die("Could not connect to $ftp_server");

        if($ftp_connection) {
            $this->info( "successfully connected to the ftp server!");

            // Logging in to established connection
            // with ftp username password
            $login = ftp_login($ftp_connection, $ftp_username, $ftp_userpass);

            if($login){
                $this->info( "logged in successfully, starting check!");

                // Get file & directory list of current directory
                $file_list = ftp_nlist($ftp_connection, "/");
                $this->info( "directory: ".json_encode($file_list));

                $new_uploads = collect();
                //output the array stored in $file_list using foreach loop
                foreach($file_list as $folder) {
                    $sub_file_list = ftp_nlist($ftp_connection, $folder);
                    foreach($sub_file_list as $key=>$file_path) {
                        $file_exists = FtpGovFile::
                        where('folder',preg_replace('/[^A-Za-z0-9-]/', ' ',$folder))
                            ->where('file_path',preg_replace('/[^A-Za-z0-9-]/', ' ',$file_path))
                            ->first();
//                        $this->info( $folder.') '.$file_path);
                        if(!$file_exists){
                            $new_file = new FtpGovFile();
                            $new_file->folder = preg_replace('/[^A-Za-z0-9-]/', ' ', $folder);
                            $new_file->file_path = preg_replace('/[^A-Za-z0-9-]/', ' ', $file_path);
                            $new_file->save();

                            $new_uploads->add($new_file);
                        }
                    }
                }
                if(sizeof($new_uploads) > 0){
                    $this->info("There are updates! Sending Emails!");

                    $data['data'] = $new_uploads;
                    $data['mail'] = 'App\Mail\GovFtpUpdate';
                    $data['users'] = [Auth::user()];
//                    $job = (new SendQueueEmail($data))->delay(now()->addSeconds(2));
//                    dispatch($job);
                    $send_to_mails = [
//                        'stefan.grulovic@gmail.com',
                        'elcorovic@gmail.com',
                        'randda13@gmail.com',
                        'desk.videoplus@gmail.com',
                        'fedja.grulovic@gmail.com'
                    ];
                    foreach ($send_to_mails as $mail){
                        Mail::to($mail)->send(new GovFtpUpdate($data['data']));
                    }
                }else{
                    $this->info("There are no updates!");
                }

//                dd($new_uploads);
            }
            else {
                $this->info("login failed!");
            }

            // $this->info( ftp_get_option($ftp_connection, 1));
            // Closing  connection
            if(ftp_close($ftp_connection)) {
                $this->info( "Connection closed Successfully!");
            }
        }
    }
}
