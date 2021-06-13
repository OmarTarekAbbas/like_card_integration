<?php


namespace App\Services;

use App\Client;
use App\Constants\OrderStatus;
use App\Constants\PaymentType;
use Illuminate\Http\UploadedFile;

class ClientService
{
    /**
     * @var IMAGE_PATH
     */
	  const IMAGE_PATH = 'clients';

    /**
     * @var UploaderService
     */
    private $uploaderService;

    /**
     * __construct
     * @param UploaderService $uploaderService
     * @return void
     */
    public function __construct(UploaderService $uploaderService)
    {
        $this->uploaderService = $uploaderService;
    }

    /**
     * handle function that make update for client
     * @param array $request
     * @param \App\Client|null $client
     * @return Client
     */
    public function handle($request, $client = null)
    {
        if(!$client) {
            $client = new Client;
        }

        // if(isset($request['password'])) {
          $request['password']  = \Hash::make('123456');
        // }

        if(isset($request['image'])) {
            $request = array_merge($request, [
                'image' => $this->handleFile($request['image'])
            ]);
        }

        $client->fill($request);

        $client->save();

    	return $client;
    }

    /**
     * handle image file that return file path
     * @param File $file
     * @return string
     */
    public function handleFile(UploadedFile $file)
    {
        return $this->uploaderService->upload($file, self::IMAGE_PATH);
    }

    public function registerAndLogin($email)
    {
      $client = Client::where("email", $email)->first();
      if(!$client) {
        $post['email'] = $email;
        $client = $this->handle($post);
      }
      auth()->guard('client')->login($client);
    }

    /**
     * Method send Mail To User With Serial Code
     *
     * @param App\Order $order
     *
     * @return void
     */
    public function sendMailToUserWithSerialCode($order)
    {
      $client = Client::find($order->client_id);
      \Mail::send('front.mails.serial_code',
      ['order' => $order,
      'client' => $client,
      'paymentType' => new PaymentType,
      'orderStatus' => new OrderStatus],
      function ($m) {
        $m->from(env("ORDER_EMAIL"), env("ORDER_SUBJECT"));
        $m->to(auth()->guard("client")->user()->email, env("ORDER_SUBJECT"))->subject('Serial Code');
      });
    }
}
