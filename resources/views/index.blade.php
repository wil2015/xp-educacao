<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Projeto Aplicado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<div class="container">

    <h2 class="text-center display-2"><strong>Projeto Aplicado XPeducação</strong></h2>
    <h2 class="text-center display-2">Selecao de Estrategia</h2>
    <br>
    <form class="container-fluid" id="form"  method="post" action="/nmap">
        @csrf
        <div class="row text-left">
            <div class="col text-left">
                <label  class="text-left" for="IP">IP:</label>
                <input type="text" class="form-control" id="IP" placeholder="IP OU DOMINIO" name="ip" required>
            </div>
            <div class="col text-left">
                <label for="pwd">Portas:</label>
                <input type="text" class="form-control" id="pwd" placeholder="portas separadas por virgular" name="portas">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-6">

            </div>
            <div class="col-6">
                <h4  class="text-center" >NMAP SCRIPT ENGINE</h4>

            </div>
        </div>
        <div class="row">
            <div class="col-6   border bg-light">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="portscan" checked>
                    <label class="form-check-label" for="flexRadioDefault1">
                        Port Scan
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="enum_http">
                    <label class="form-check-label" for="flexRadioDefault1">
                        Enumeração de Sistemas e Servicos
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="firewall">
                    <label class="form-check-label" for="flexRadioDefault2">
                        Firewall/IDS Invasion
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="vnmap">
                    <label class="form-check-label" for="flexRadioDefault2">
                        Vulnerabilidade NMAP
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" onchange="handleClick(this);" id="NESSUS" value="vnessus">
                    <label class="form-check-label" for="flexRadioDefault2">
                        Vulnerabilidade NESSUS
                    </label>
                </div>
            </div>

            <div class="col-3   border bg-light">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="whois">
                    <label class="form-check-label" for="flexRadioDefault1">
                        WHOIS
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="metodos_http">
                    <label class="form-check-label" for="flexRadioDefault1">
                        HTTP
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="dns" >
                    <label class="form-check-label" for="flexRadioDefault2">
                        DNS
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="diretorio">
                    <label class="form-check-label" for="flexRadioDefault2">
                        Diretorio
                    </label>
                </div>
            </div>
            <div class="col-3  border bg-light">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="dhcp">
                    <label class="form-check-label" for="flexRadioDefault1">
                        DHCP
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="APACHE">
                    <label class="form-check-label" for="flexRadioDefault1">
                        APACHE
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="MYSQL" >
                    <label class="form-check-label" for="flexRadioDefault2">
                        MYSQL
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="COMPARTILHAMENTO" >
                    <label class="form-check-label" for="flexRadioDefault2">
                        COMPARTILHAMENTO
                    </label>
                </div>
            </div>
        </div>
        <br>
        <br>
        <button type="submit" class="btn btn-primary mb-3">Executar</button
    </form>
    <br>
    <a href="http://localhost:9200" class="btn btn-info role="button">Gerencia</a>

</div>
<script>

    function handleClick(flexRadioDefault) {

        document.getElementById('form').action = '/nessus';
    }

</script>
</body>
</html>
