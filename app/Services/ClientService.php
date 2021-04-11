<?php


namespace App\Services;

use Illuminate\UploadedFile;
use App\Client;

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
     * @return Client
     */
    public function handle($request, $client = null)
    {
        if(!$client) {
            $client = new Client;
        }

        $request['password']  = \Hash::make($request['password']);
        
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

}
