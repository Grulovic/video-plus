<?php

namespace App\Http\Controllers;

use App\Jobs\SendQueueEmail;
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
                //output the array stored in $file_list using foreach loop
                foreach($file_list as $key=>$dat) {
                    echo '<hr>';
                    echo $key."=>".$dat."<br>";
                    $sub_file_list = ftp_nlist($ftp_connection, $dat);
                    foreach($sub_file_list as $key=>$dat) {
                        echo $key."=>".$dat."<br>";
                    }
                    echo '<hr>';

                }





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
