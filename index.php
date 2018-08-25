<?php
    require_once('nepali_calendar.php');

    $month_names = array('1' => 'बैशाख', '2' => 'जेठ', '3' => 'असार', '4' => 'साउन्  ', '5' => 'भदौ', '6' => 'अशोज', '7' => 'कार्तिक', '8' => 'मंसिर', '9' => 'पुष', '10' => 'माघ', '11' => 'फाल्गुन', '12' => 'चैत्');
?>

<!doctype html>

<?php 
    function convert_english_nums_to_nepali($number) {
        $numbers = array('0' => '०', '1' => '१', '2' => '२', '3' => '३', '4' => '४', '5' => '५', '6' => '६', '7' => '७', '8' => '८', '9' => '९');
        
        // Separate num_string into individual characters.
        $num_string = strval($number);
        $num_array = str_split($num_string);
        
        $num_array_in_nepali = array();
        foreach($num_array as $num_character) {
            array_push($num_array_in_nepali, $numbers[$num_character]);
        }

        return implode("", $num_array_in_nepali);
    }

?>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Radio Nepal</title>
    <meta name="description" content="Radio Nepal">
    <meta name="author" content="Aashish Tripathee">

    <link rel="stylesheet" href="css/style.css?v=1.0">

    <style>
        h1 { font-size: 5em; }
        h2 { font-size: 3em; }
        h2 a { text-decoration: none; color: #505050; }
        h2 a:hover { text-decoration: none; color: gray; }
    </style>
</head>
    <div class="wrapper">
        <h1>रेडियो नेपाल: विश्व परिवेश </h1>

            <hr>
            
            <?php
                $mp3_files = array();
                if ($handle = opendir('.')) {
                    while (false !== ($file = readdir($handle))) {
                        if ($file != "." && $file != ".." && strtolower(substr($file, strrpos($file, '.') + 1)) == 'mp3') {
                            array_push($mp3_files, $file);
                        }
                    }
                    closedir($handle);
                }

                rsort($mp3_files, SORT_STRING);

                
                $i = 1;
                foreach($mp3_files as $mp3_file) {
                    $nepali_number = convert_english_nums_to_nepali($i);

                    $filename = $mp3_file;
                    $title = "";
                    $timestamp = explode('.', explode('_', $filename)[1])[0];

                    $date = DateTime::createFromFormat('U', $timestamp, new DateTimeZone('Asia/Kathmandu'));
                    $cal = new Nepali_Calendar();
                    
                    $day = $date->format('d');
                    $month = $date->format('m');
                    $year = $date->format('Y');

                    $nepali_date = $cal->eng_to_nep($year, $month, $day);
                    $title = $month_names[$nepali_date['month']] . ' ' . convert_english_nums_to_nepali($nepali_date['date']) . ' गते ' . convert_english_nums_to_nepali($nepali_date['year']) . '- ' . $date->format('h') . ' ' . $date->format('i') . ' ' .$date->format('s');
                    
                    echo "<h2><a href='$mp3_file'>$title</a></h2>";
                    $i++;
                }
            ?>
    
    </div><!--/.wrapper -->
<body>
  
</body>
</html>