<?php

namespace App\Http\Controllers;

use Elastic\Elasticsearch\Client;
use Illuminate\Http\Request;

class Nmap extends Controller
{

    public function retira($file){
        preg_match('/\[(.*?)\]/', $file, $cortado);

        // Escolha um para remover os []:
        if(isset($cortado[0])){
            $texto = str_replace('[', '', str_replace(']', '', $cortado[0]));
            return $texto;
        }
        return ' ';
    }

    public function lerarquivo($arquivo){
        if ( file_exists( $arquivo ) ) {
            // Cria o recurso (abrir o arquivo)
            $handle = fopen( $arquivo, 'r' );
            while (($buffer = fgets($handle, 4096)) !== false) {
                $retorno = $this->retira($buffer);
                if ($retorno != ' ' && ctype_digit($retorno)){
                    $vul[] = $retorno;
                }
            }

            fclose($handle);
            return $vul;
        }
    }

    public function vulnerabilidades($vul, $csv, $ip){


        foreach ($vul as $key => $value) {
            // code...
            if(isset($csv[$value])){
                //    print_r($csv[$value]);
                $linha2 = NULL;
                foreach ($csv[$value] as  $linha) {
                    // code...
                    $linha2 =  $linha2 . $linha . '\n';
                }
                //    print_r($csv[$value]);

                $vulnerabilidade[] = [
                    'ip' => $ip,
                    'data' =>  date("Y-m-d"),
                    'vul' => $value,
                    'descricao' => $linha2
                ];
            }
            //echo $key;
        }
        return $vulnerabilidade;

    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Client $client)
    {
        //
        $nmap = 'nmap -sV  -oA vulnerabilidades --script=vulscan   --script-args vulscandb=cve.csv --script-args=vulscanoutput=details 127.0.0.1';
        $nmap = 'nmap -sV  -oA whois --script whois-domain.nse uol.com.br';
        $nmap = 'nmap -sV  -oA metodos_http --script http-methods scanne.nmap.org';
        $nmap = 'nmap -sV  -oA enum_http -p80 --script http-enum.nse scanme.nmap.org';
        $nmap = 'nmap -sV  -oA dns --script dns-brute.nse nmap.org';
        $nmap = 'nmap -sV -oA ';
        /*
        $file = '';
        $script = ['vnmap' => '--script=vulscan   --script-args vulscandb=cve.csv --script-args=vulscanoutput=details',
                   'whois' => '-script whois-domain.nse' ,
                    'metodos_http' => '--script http-methods',
                    'enum_http' => '--script http-enum.nse',
                    'dns' => '--script dns-brute.nse'
            ];
        $file = ['vnmap' => 'vulnerabilidades',
            'whois' => 'whois' ,
            'metodos_http' => 'metodos_http',
            'enum_http' => 'enum_http',
            'dns' => 'dns'
        ];
        */
        $parametro = [
          'vnmap' =>['--script=vulscan   --script-args vulscandb=cve.csv --script-args=vulscanoutput=details', 'vulnerabilidades'],
          'whois' =>['-script whois-domain.nse', 'whois'],
          'metodos_http'  => ['--script http-methods','metodos_http'],
          'enum_http'  => ['--script http-enum.nse', 'enum_http'],
            'dns' => ['--script dns-brute.nse', 'dns'],
            'firewall' => ['--script http-waf-detect, https-waf-fingerprint', 'firewall'],
            'dhcp' => ['--script broadcast-dhcp-discover', 'dhcp']
            ];

        $campos = $request->all();
        $ip = $campos['ip'];
        $opcao = $campos['flexRadioDefault'];
        if ($opcao == 'vnmap' ) {

            $csv = array_map('str_getcsv', file('cve.csv'));
            $vul = $this->lerarquivo($parametro[$opcao][1].'.nmap');
            $vulnerabilidade = $this->vulnerabilidades($vul, $csv, $ip);


            $qtd = count($vulnerabilidade);

            for ($i=0 ; $i < $qtd ; $i++ ) {
                // code...
                $params = [
                    'index' => 'vulnerabilidades',
                    'id'    => $vulnerabilidade[$i]['vul'],
                    'body'  => $vulnerabilidade[$i]
                ];


                $response = $client->index($params);

            }



        }
        $nmap = $nmap . ' ' . $parametro[$opcao][1] . ' ' . $parametro[$opcao][0] . ' ' . $ip;
        $output = shell_exec($nmap);
    //    $relatorio = 'xsltproc ' . $file[$opcao] . '.xml' . ' -o ' . $file[$opcao] . '.html';
        $relatorio = 'xsltproc ' . $parametro[$opcao][1] . '.xml' . ' -o ' . $parametro[$opcao][1] . '.html';

        $html = shell_exec($relatorio);
        $copy = 'cp ' . $parametro[$opcao][1] . '.html' . ' site.html';
        $cp = shell_exec($copy);
        $redirect = '/' . 'relatorio.php?rel=' . $parametro[$opcao][1] ;

       // $redirect = '/relatorio.php';

        //    $redirect = '/' . 'relatorio.php&site=' . $file[$opcao];

        return redirect($redirect);





    }
}
