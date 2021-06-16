<?php

namespace App\Console\Commands;

use App\Services\LikeCardService;
use Illuminate\Console\Command;
use Mail;

class BalanceMailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'balance:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Mail To Admin When Balance Reach TO Fixed Balance That We Know';

    /**
     * likeCard
     *
     * @var \App\Services\LikeCardService
     */
    private $likeCard;

    /**
     * Create a new command instance.
     *
     * @param \App\Services\LikeCardService $likeCard
     * @return void
     */
    public function __construct(LikeCardService $likeCard)
    {
        parent::__construct();
        $this->likeCard = $likeCard;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      $response = json_decode($this->likeCard->checkBalance());
      $this->balance = $response->balance??0 ;
      if($this->balance <= get_setting('balance_limit')) {
        $this->sendMailToAdmin($this->balance);
      }
    }

    /**
     * Method sendMailToAdmin
     *
     * @param float $balance
     *
     * @return void
     */
    public function sendMailToAdmin($balance)
    {
      Mail::send('front.mails.our_balance', ['balance' => $balance], function ($m) {
        $m->from("m.mahmoud@ivas.com",'Like Card');
        $m->to(admin_mail, 'like Card')->subject('Balance Limit');
      });
    }
}
