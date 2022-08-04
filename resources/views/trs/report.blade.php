<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style media="screen">
            @page {
                margin: 0cm 0cm;
            }

            body {
                margin-top: 1cm;
                margin-left: 1cm;
                margin-right: 1cm;
                margin-bottom: 1cm;
            }

            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 1cm;
                background-color: rgb(179, 179, 179);
                color: white;
                text-align: center;
                line-height: 0.5cm;
                font-family: Helvetica, Arial, sans-serif;
            }

            /** Define the footer rules **/
            footer {
                position: fixed; 
                bottom: 0cm; 
                left: 0cm; 
                right: 0cm;
                height: 1cm;
                background-color: rgb(179, 179, 179);
                color: white;
                text-align: center;
                line-height: 0.5cm;
            }

            footer .page-number:after { content: counter(page); }

            .bordered td {
                border-color: #959594;
                border-style: solid;
                border-width: 1px;
            }

            table {
                border-collapse: collapse;
            }

             .page-break {
                  page-break-after: always;
                }
    </style>
</head>
    <body>
        <header>
            Permissões do Sistema
        </header>

        <footer>
          <span>{{ date('d/m/Y H:i:s') }} - </span><span class="page-number">Página </span>         
        </footer>

        <main>
            @foreach($trs as $tr)
            <table  class="bordered" width="100%">
              <tbody>
                <tr>
                  <td>{{$tr->numero}}</td>
                  <td>{{$tr->ano}}</td>
                </tr>
              </tbody>
            </table>
            <div class="page-break"></div>
            @endforeach

        </main>
    </body>
</html>