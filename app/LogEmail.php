<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Mail;

class LogEmail extends Model
{
    protected $primaryKey = 'loem_id';
    protected $fillable = ['loem_type', 'loem_email', 'loem_title', 'loem_content', 'loem_dt_sent', 'loem_status', 'loem_priority', 'loem_recipient_name'];

    public function sendNewSusbcriber($subscriber)
    {
      $view = view('email.welcome_subscriber', compact('subscriber'))->render();

      $loem = $this->create(['loem_type' => config('email.type_new_subscriber'),
                  'loem_email' => $subscriber->sub_email,
                  'loem_title' => config('playligo.email_subscribe_subject'),
                  'loem_content' => $view,
                  'loem_status' => 'pending',
                  'loem_type' => 'new_subscriber',
                  'loem_priority' => 1,
                  'loem_recipient_name' => $subscriber->sub_name,
                  ]);
      // dd(asset('file/the-ultimate-travel-checklist.pdf'));
      $this->mailNow($loem, asset('file/the-ultimate-travel-checklist.pdf'));
    }

    public function mailNow($log_email, $pathToFile = '')
    {
      $content = $log_email->loem_content;

      Mail::send('email.template', compact('content'), function ($m) use($log_email){
        // $m->from(config('playligo.email'), config('playligo.app_name'));
        $m->to($log_email->loem_email, $log_email->loem_recipient_name)->subject($log_email->loem_title);

        if (!empty($pathToFile)) {
            $m->attach($pathToFile, ['mime' => 'application/pdf']);
        }
      });

      if( count(Mail::failures()) == 0 ) {
        $log_email->update(['loem_status' => 'sent', 'loem_dt_sent' => date('YmdHis')]);
      } else {
        $log_email->update(['loem_status' => 'failed']);
      }
    }
}
