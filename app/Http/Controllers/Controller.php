<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Owenoj\LaravelGetId3\GetId3;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function test()
    {
    	// Get cloudflare data
    	$curl = curl_init();

		curl_setopt_array($curl, array(
		 CURLOPT_URL => "https://api.cloudflare.com/client/v4/accounts/acf72dd236d407950885efd822228792/stream/keys",
		 CURLOPT_RETURNTRANSFER => true,
		 CURLOPT_ENCODING => "",
		 CURLOPT_MAXREDIRS => 10,
		 CURLOPT_TIMEOUT => 30,
		 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		 CURLOPT_CUSTOMREQUEST => "GET",
		 CURLOPT_HTTPHEADER => array(
		   "cache-control: no-cache",
		   "postman-token: e6cd8da1-85c9-52d5-ec9e-a3593c5fd9f2",
		   "x-auth-email: courson.lms@gmail.com",
		   "x-auth-key: 12d9f600c030cdfc4f5a740dafd4ed515a147"
		 ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		 echo "cURL Error #:" . $err;
		} else {
		 	echo '<pre>';
		 	$res = json_decode($response);

		 	
		 	// print_r($res);
			foreach ($res->result as $value) {

				$cuuurl = "https://api.cloudflare.com/client/v4/accounts/acf72dd236d407950885efd822228792/stream/keys/".$value->id;
				
				$curl = curl_init();

				curl_setopt_array($curl, array(
				 CURLOPT_URL => $cuuurl,
				 CURLOPT_RETURNTRANSFER => true,
				 CURLOPT_ENCODING => "",
				 CURLOPT_MAXREDIRS => 10,
				 CURLOPT_TIMEOUT => 30,
				 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				 CURLOPT_CUSTOMREQUEST => "DELETE",
				 CURLOPT_HTTPHEADER => array(
				   "cache-control: no-cache",
				   "postman-token: fae47a73-13d9-53ea-5ab1-eb603fbcf673",
				   "x-auth-email: courson.lms@gmail.com",
				   "x-auth-key: 12d9f600c030cdfc4f5a740dafd4ed515a147"
				 ),
				));
				$response = curl_exec($curl);
				curl_close($curl);
			}
			// echo $res;
		}



		// $response = curl_exec($curl);
		// $err = curl_error($curl);

		// curl_close($curl);

		// if ($err) {
		//  echo "cURL Error #:" . $err;
		// } else {
		//  echo $response;
		// }

    	// $video_link = 'https://iframe.videodelivery.net/eyJhbGciOiJSUzI1NiIsImtpZCI6IjNkM2QxZTBmNTY5NjIyZGYxMzVjZjA1MzhjMGIxMzJlIn0.eyJzdWIiOiIwMjE0NTVlNzc5NmU4ZDlmZTZlNzVjZGFmZGI3YTU3YSIsImtpZCI6IjNkM2QxZTBmNTY5NjIyZGYxMzVjZjA1MzhjMGIxMzJlIiwiZXhwIjoxNjUxMTMzNDI1LCJhY2Nlc3NSdWxlcyI6W3sidHlwZSI6ImlwLnNyYyIsImlwIjpbIjEyNC4yNTMuMzIuNTIiXSwiYWN0aW9uIjoiYWxsb3cifSx7InR5cGUiOiJhbnkiLCJhY3Rpb24iOiJibG9jayJ9XX0.WXxjGec5wXDthbEIEwEQwtZTJjUYW7quQe1Q4vV0hUJMPZ5mxcOyA9im0Uq9vjv5QYwa3syRaASyVPakN1buLx43ShEJE1LtANeM5wf3JyOpHABek6biNuiguKxtZgXnd5hKSz8eLrZA_HdgnQZ12vvTL5CtkYJM8Ch7WZi171I-8-bxwQ1eQ05mCGFocHZNiFtH-mnEKJPqPBZ-WDwQFAEctzX5aOMGeMGM6wsi73d3S7Km1uwp3ibIt3V6D8DpBvYUA8jDEG3VkigD9aBLHh-ROB_qtN150wCeB4K6CObnAEbyfs59JhbMVrGqBYrk-u76t-DhU7zTu8PA-cxpoQ';
    	// // $track = new GetId3($video_link);

    	// $track = GetId3::fromDiskAndPath('cloudflare', $video_link); // even works with S3
    	// dd($track->extractInfo());

    }
}
