<?php

namespace App\Http\Controllers;

use Elastic\Elasticsearch\Exception\ClientResponseException;
use Elastic\Elasticsearch\Exception\MissingParameterException;
use Elastic\Elasticsearch\Exception\ServerResponseException;
use Illuminate\Http\Request;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;

class Nessus extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Client $client)
    {
        //
    //    dd($client);
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://localhost:8834/scans/8');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);



        $headers = array();
        $headers[] = 'X-Apikeys: accessKey=967b9303c3efeaa61b536e5e6259045a88a06477163cf1afa56c188461da6324; secretKey=85a4c1fefdb4fa6ea0dae88b0cedf494780eed82105083b3f01c9d6dd35ff507';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);


        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        $sera = json_decode($result, true);


        $qtd = count($sera['vulnerabilities']);

        for ($i=0 ; $i < $qtd ; $i++ ) {
            $params = [
                'index' => 'nessus2',
                'id'    => $sera['vulnerabilities'][$i]['vuln_index'],
                'body'  => $sera['vulnerabilities'][$i]
            ];
            try {
                $response = $client->index($params);
            } catch (ClientResponseException $e) {  echo "que porra 111";
            } catch (MissingParameterException $e) { echo "que porra 222";
            } catch (ServerResponseException $e) { echo "que porra 333";
            }
            echo '<pre>';
            var_export($response->asArray());
            echo '<pre>';

        }
    }
}
