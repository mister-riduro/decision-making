<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Hasil Perhitungan</title>
        <link rel="stylesheet" href="style.css">
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
            crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link
            rel="preconnect"
            href="https://fonts.gstatic.com"
            crossorigin="crossorigin">
        <link
            href="https://fonts.googleapis.com/css2?family=Inter&display=swap"
            rel="stylesheet">
    </head>
    <body>
        <?php
            $harga_jual = $_POST["hargajual"];
            $harga_beli = $_POST["hargabeli"];

            $jumlahprob1 = $_POST["jumlahprob1"];
            $probality1 = $_POST["probability1"];

            $jumlahprob2 = $_POST["jumlahprob2"];
            $probality2 = $_POST["probability2"];

            $jumlahprob3 = $_POST["jumlahprob3"];
            $probality3 = $_POST["probability3"];

            $jumlahprob4 = $_POST["jumlahprob4"];
            $probality4 = $_POST["probability4"];

            $jumlahprob = array($jumlahprob1, $jumlahprob2, $jumlahprob3, $jumlahprob4);
            $probs = array($probality1, $probality2, $probality3, $probality4);

            $count = count_pay_off($harga_jual, $harga_beli, $jumlahprob, $probs);

            echo '<div class="card" style="width: 18rem;">';
                echo '<div class="card-body">';
                    echo '<h5 class="card-title">Kesimpulan</h5>';
                    echo '<p class="card-text">Jadi jumlah barang yang harus dijual adalah sebanyak </p>' . $jumlahprob[$count] . " Koran";
                    echo '<div class="btn-back" style="margin-top:24px;">';
                        echo '<a href="index.html" class="btn btn-primary">Kembali ke Input</a>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';

            function count_pay_off($jual, $beli, array $jumlahprob, array $probs) {
                $decision = array();
                $hasil = 0;    
                //$pay_off = 0;
                //echo "Jumlahprob index 0 = ".$jumlahprob[0];

                //MENGHITUNG PAY OFF
                for($i=0; $i<4; $i++) {
                    for($j=0; $j<4; $j++) {
                        if ($jumlahprob[$j] < $jumlahprob[$i]) {
                            $decision[$i][$j] = ($jumlahprob[$j] * $jual) - ($jumlahprob[$i] * $beli);
                        } else {
                            $decision[$i][$j] = ($jumlahprob[$i] * $jual) - ($jumlahprob[$i] * $beli);
                        }
                        
                        //$pay_off = $jumlahprob[$i] * $jual - $jumlahprob[$i] * $beli;
                        //array_push($decision, array($pay_off));
                        //echo $decision[$i][$j]." ";
                    }
                }
                
                $hasil = count_expected_return($decision, $probs);
                return $hasil;
            }

            function count_expected_return(array $decision, array $probs) {
                $expected_return = array();
                $result = 0;
                
                //MENGHITUNG EXPECTED RETURN
                for($i=0; $i<4; $i++) {
                    $temp = 0;
                    for($j=0; $j<4; $j++) {
                        $temp = $temp + $decision[$i][$j] * $probs[$j];
                    }
                    $expected_return[$i] = $temp;
                }

                $scan = max($expected_return);

                //SCAN FOR EXPECTED RETURN
                for($i=0; $i<4; $i++) {
                    if($expected_return[$i] == $scan) {
                        $result = $i;
                        return $result;
                    }
                }
            }
        ?>
    </body>
</html>