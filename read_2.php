<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">

  <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>

    <style>

        table{
        width: 100%;
        border-collapse:separate;
        border-spacing: 0;
        }

        table th:first-child{
        border-radius: 5px 0 0 0;
        }

        table th:last-child{
        border-radius: 0 5px 0 0;
        border-right: 1px solid #3c6690;
        }

        table th{
        text-align: center;
        color:white;
        background: linear-gradient(#829ebc,#225588);
        border-left: 1px solid #3c6690;
        border-top: 1px solid #3c6690;
        border-bottom: 1px solid #3c6690;
        box-shadow: 0px 1px 1px rgba(255,255,255,0.3) inset;
        width: 25%;
        padding: 10px 0;
        }

        table td{
        text-align: center;
        border-left: 1px solid #a8b7c5;
        border-bottom: 1px solid #a8b7c5;
        border-top:none;
        box-shadow: 0px -3px 5px 1px #eee inset;
        width: 25%;
        padding: 10px 0;
        }

        table td:last-child{
        border-right: 1px solid #a8b7c5;
        }

        table tr:last-child td:first-child {
        border-radius: 0 0 0 5px;
        }

        table tr:last-child td:last-child {
        border-radius: 0 0 5px 0;
        }

    </style>
</head>


<body>

    <header class="">
    </header>

    <main>
    <canvas id="myChart"></canvas>
    <div class="home-chart">
        <div class="ct-chart"></div>
    </div>

        <?php

                $csvArray = array();
                $firstFlg = true;
                $keys = array();
                $count = 0;
                $file = fopen('./data/data.txt', 'r');
              
                while ($line = fgetcsv($file)) {
                  if($firstFlg){
                    for($i = 0; $i < count($line); $i++){
                      array_push($keys,$line[$i]);
                    }
                    $firstFlg = false;
                  }else{
                    for($i = 0; $i < count($line); $i++){
                      $csvArray[$count][$keys[$i]] = $line[$i];
                    }
                    $count++;
                  }
                }
               
                fclose($file);

                echo "<table>\n<tr>\n<th>年月</th><th>電気代</th>\n</tr>\n";

                foreach($csvArray as $value){
                   
                        echo "<tr>\n";
                        echo "<td>".$value['年月']."</td>\n";
                        echo "<td>".$value['電気代']."</td>\n";
                        echo "</tr>\n";   
                }
                echo "</table>";
                
                $csvArray = json_encode($csvArray);

                
      
        ?>

              <script>
            
              let bar = JSON.parse('<?php echo $csvArray; ?>');
              console.log(bar);

              console.log(bar[0].年月);
              console.log(bar[0].電気代);
              console.log(bar.length);

              var labelsVal = [];
              var seriesVal = [];
              
              for ( var i = 0; i < bar.length;  i++){
                labelsVal.push(bar[i].年月);
                seriesVal.push(bar[i].電気代);
              };

              console.log(seriesVal[5]);
              seriesVal[5] = Number(seriesVal[5]);
              console.log(seriesVal[5]);

              for ( var i = 0; i < seriesVal.length;  i++){
                seriesVal[i] = Number(seriesVal[i]);
              };

              console.log(labelsVal);
              console.log(seriesVal);
          
              var data = {
              labels: labelsVal,
              series: [seriesVal]
              };

              var options = {
              height: 200
              };

              new Chartist.Line('.ct-chart', data, options);

              </script>


    </main>

    <footer class="">
    </footer>

<!-- JavaScriptの記述 -->






</body>
</html>





