<?php

namespace App\Http\Controllers;

use App\Jobs\SendQueueEmail;
use App\Models\FtpGovFile;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function sendTestEmail(){
        $data['data'] = Video::where('id',1857)->first();
        $data['mail'] = 'App\Mail\VideoUploaded';
        $data['users'] = [Auth::user()];
        $job = (new SendQueueEmail($data))->delay(now()->addSeconds(2));
        dispatch($job);
    }

    public function getFtpContents(){
        //FTP server credentials
        $ftp_server = "ftp.pr.mod.gov.rs";
        $ftp_username="b92";
        $ftp_userpass="1389#Bd3v3T#9831";


        // Establishing ftp connection
        $ftp_connection = ftp_connect($ftp_server)
        or die("Could not connect to $ftp_server");

        if($ftp_connection) {
            echo "successfully connected to the ftp server!";

            // Logging in to established connection
            // with ftp username password
            $login = ftp_login($ftp_connection, $ftp_username, $ftp_userpass);

            if($login){
                echo "<br>logged in successfully!";

                // Get file & directory list of current directory
                $file_list = ftp_nlist($ftp_connection, ".");
                $new_uploads = collect();
                //output the array stored in $file_list using foreach loop
                foreach($file_list as $folder) {
                    $sub_file_list = ftp_nlist($ftp_connection, $folder);
                    foreach($sub_file_list as $key=>$file_path) {
                        $file_exists = FtpGovFile::
                            where('folder',preg_replace('/[^A-Za-z0-9-]/', ' ',$folder))
                            ->where('file_path',preg_replace('/[^A-Za-z0-9-]/', ' ',$file_path))
                            ->first();
//                        echo $folder.') '.$file_path;
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
                    $data['data'] = $new_uploads;
                    $data['mail'] = 'App\Mail\GovFtpUpdate';
                    $data['users'] = [Auth::user()];
                    $job = (new SendQueueEmail($data))->delay(now()->addSeconds(2));
                    dispatch($job);
                }


                dd($new_uploads);





            }
            else {
                echo "<br>login failed!";
            }

            // echo ftp_get_option($ftp_connection, 1);
            // Closing  connection
            if(ftp_close($ftp_connection)) {
                echo "<br>Connection closed Successfully!";
            }
        }
    }
}
