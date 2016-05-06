<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
  protected $table = 'subscribers';
  protected $primaryKey = 'sub_id';
  protected $fillable = ['sub_name', 'sub_email', 'sub_sendgrid_id'];

  public function sendSendgrid($subscriber, $update = true)
  {
    $url = 'https://api.sendgrid.com/v3';
    $request =  $url.'/contactdb/recipients';
    // Generate curl request
    $userid = 'playligo';
    $userkey= 'p@sswd4r00t';

    $data = json_encode([['email'=>$subscriber->sub_email, 'last_name'=>$subscriber->sub_name]]);

    $session = curl_init($request);
    // Tell curl to use HTTP get
    curl_setopt ($session, CURLOPT_POST, TRUE);
    curl_setopt ($session, CURLOPT_POSTFIELDS, $data);
    // Tell curl that this is the body of the GET
    curl_setopt($session, CURLOPT_HTTPAUTH, CURLAUTH_BASIC ) ;
    curl_setopt($session, CURLOPT_USERPWD, $userid.':'.$userkey);
    // Tell curl not to return headers, but do return the response
    curl_setopt($session, CURLOPT_HEADER, False);
    curl_setopt($session, CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
    // Tell PHP not to use SSLv3 (instead opting for TLS)
    curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

    // obtain response
    $response = curl_exec($session);

    curl_close($session);

    $sendgrid = json_decode($response);

    if ($sendgrid->error_count == 0 && $update) {
      $subscriber->update(['sub_sendgrid_id' => $sendgrid->persisted_recipients[0]]);
    }

    return $sendgrid;


  }
}
