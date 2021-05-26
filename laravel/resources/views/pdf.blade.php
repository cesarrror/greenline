<html>
    <style>
        @page {

        }
        body{
            font-family: 'arial';
            text-transform: uppercase;
            font-size:12px;
        }

        table{
            border-spacing: 5px;
            border-collapse: separate;
        }

        table th{
            border: dashed #000;
            border-width: 0px 0px 2px 0px;
        }
    </style>
    <body>
        <div>
            {{$nomEmp}}
        </div>
        <div style="margin-top: 6px">
            {{$descTda}}
        </div>
        <div style="margin-top: 20px">
            {{$calleTda}} {{$numTda}}
        </div>
        <div>
            {{$colTda}}
        </div>
        <div>
            {{$cdTda}} {{$edoTda}} {{$cpTda}}
        </div>
        <div>
            RFC: {{$rfc}}
        </div>
        <div style="margin-top: 20px">
            TICKET NUMERO: {{$numPedido}}
        </div>
        <div>
            caja: {{$Caja}}
        </div>
        <div>
            atendio: {{$user}}
        </div>
        <div style="margin-top: 20px">
            <table style="width: 100%">
                <thead>
                    <tr>
                        <th>CANT</th>
                        <th>DESCRIPCION</th>
                        <th>IMPORTE</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($articulos as $articulo)
                        <tr>                            
                            <td style="text-align: right;">{{$articulo['cantidad']}}</td>
                            <td>{{$articulo['descripcion']}}</td>
                            <td style="text-align: center;">{{$articulo['importe']}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div>
            <div style="float: left;">
                articulos: {{$cant_articulos}}
            </div>
            <div style="float: left; margin-left: 20px;">
                total ${{$total}}
            </div>
        </div>
        <div>
            <div style="clear:both; margin-top: 30px;">
                iva incluido: {{$iva}}
            </div>
        </div>
        <div>
            <div style="margin-top: 20px;">
                recibido: {{$recibido}}
            </div>
        </div>
        <div>
            <div>
                cambio: {{$cambio}}
            </div>
        </div>
        <div>
            <div style="margin-top: 60px;">
                {{$leyenda}}
            </div>
        </div>
    </body>
</html>