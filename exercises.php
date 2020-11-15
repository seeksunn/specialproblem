<!DOCTYPE html>
<html lang="en">
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}
.w3-bar,h1,button {font-family: "Raleway", sans-serif}
.fa-anchor,.fa-coffee {font-size:200px}
</style>



<body>

<?php 
include("check_session.php");
include("connection.php");
$id = new MongoDB\BSON\ObjectId($_GET['ex']);
$filter = ['_id' => $id]; 
$query = new MongoDB\Driver\Query($filter);   
$rows = $mng->executeQuery($databaseName.".exercises", $query);

foreach ($rows as $row) {
    $words = $row->words;    
    echo    "<header class='w3-container w3-red w3-center' style='padding:12px 16px'>
                <h1 class='w3-margin w3-jumbo' id='topic'>$row->topic</h1>
                <p class='w3-xlarge' id='objective'>Objective : $row->objective</p>  
            </header>";
    echo    "<div class='w3-row-padding w3-padding-64 w3-container' id='vbasic' style='display : block'>
                <div class='w3-content'>
                    <div class='w3-twothird'>
                        <h1>$row->contentTopic</h1>
                        <h5 class='w3-padding-32'>$row->content        
                    </div>
                </div>
            </div>";            
    if($row->onlyread=='false'){
        echo    "<div class='w3-container w3-padding-64 w3-content w3-center' id='playpart'>
                    <div id='word' style='font-size: 80px; color: red;'>
                        กด Start เพื่อเริ่มต้น
                    </div>
                    <p id='console'> </p><br>    
                    <p class='w3-center'>                                                           
                        <button class='w3-button w3-black w3-round w3-padding-large w3-large' id='readBtn' onclick='ttspeech()' style='display: none;'>Read</button>
                        <button class='w3-button w3-black w3-round w3-padding-large w3-large' id='continueBtn' onclick='pickword()'>Start</button>
                        <button class='w3-button w3-black w3-round w3-padding-large w3-large' id='speakBtn' onclick='speechToText()' style='display: none;'>Speak</button>                                                 
                    </p>
                </div>
                <form class='w3-center' action='exercise_completer.php' method='POST'>
                    <input type='text' style='display:none;' name='id' value='$id'>
                    <input type='submit' class='w3-button w3-black w3-round w3-padding-large w3-large' value='Exit' name='completed' id='exitBtn'>
                </form>"; 
    } else {
        echo    "<form class='w3-center' action='exercise_completer.php?' method='POST'>
                    <input type='text' style='display:none;' name='id' value='$id'>
                    <input type='submit' class='w3-button w3-black w3-round w3-padding-large w3-large' value='Complete' name='completed' id='exitBtn'>
                </form>";
    }
}         
?>
<!-- Footer -->
<footer class="w3-container w3-padding-64 w3-center w3-opacity">  
  <div class="w3-xlarge w3-padding-32">
    <i class="fa fa-facebook-official w3-hover-opacity"></i>
    <i class="fa fa-instagram w3-hover-opacity"></i>
    <i class="fa fa-snapchat w3-hover-opacity"></i>
    <i class="fa fa-pinterest-p w3-hover-opacity"></i>
    <i class="fa fa-twitter w3-hover-opacity"></i>
    <i class="fa fa-linkedin w3-hover-opacity"></i>
 </div>
 <p>Special Project of CS KMITL</p>
</footer>
<script>  
    var wordsArray = [<?php echo '"'.implode('","', $words).'"' ?>];
    function pickword(){    
        document.getElementById("console").innerHTML = ""; 
        document.getElementById("continueBtn").style.display = "none";    
        document.getElementById("readBtn").style.display = "inline"; 
        document.getElementById("speakBtn").style.display = "inline";
        //document.getElementById("continueBtn").style.display = "none";     
        index = Math.floor(Math.random() * wordsArray.length);
        document.getElementById("word").innerHTML = wordsArray[index];
        document.getElementById("continueBtn").innerHTML = "Next";
        //check if complete
        if (wordsArray[index]==undefined) {
            document.getElementById("word").innerHTML = "";
            document.getElementById("readBtn").style.display = "none"; 
            document.getElementById("speakBtn").style.display = "none"; 
            document.getElementById("exitBtn").value = "Complete";             
            document.getElementById("continueBtn").style.display = "none";
        }
        //remove word from array
        if (index > -1) {
            wordsArray.splice(index, 1);
        }  
    }
    function ttspeech(){
        var text = document.getElementById("word").innerHTML;        
        window.speechSynthesis.speak(new SpeechSynthesisUtterance(text));
    }
    function speechToText() {
        if ('SpeechRecognition' in window || 'webkitSpeechRecognition' in window) {                       
            document.getElementById("speakBtn").innerHTML = "Listening...";
            document.getElementById("continueBtn").style.display = "none"; 
            document.getElementById("speakBtn").disabled = true;
            var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition;
            var recognition = new SpeechRecognition();        
           
            recognition.lang = 'en-US';
            recognition.interimResults = false;
            recognition.maxAlternatives = 1;
            recognition.onspeechend = function() {
                document.getElementById("console").innerHTML = "กำลังดำเนินการ....";
                recognition.stop();                 
            }
            recognition.onresult = function(event) {                
                var result = event.results[0][0].transcript;
                document.getElementById("speakBtn").innerHTML = "Speak";
                if(result == document.getElementById("word").innerHTML) {
                    document.getElementById("console").innerHTML = "คุณออกเสียงถูกต้อง";
                    document.getElementById("speakBtn").disabled = false;
                    document.getElementById("speakBtn").style.display = "none";                                        
                    document.getElementById("continueBtn").style.display = "inline";                       
                } else {
                    document.getElementById("console").innerHTML = "คำที่ได้ยิน : "+result+"<br>คุณออกเสียงผิด กรุณาลองใหม่อีกครั้ง";
                    document.getElementById("speakBtn").disabled = false;
                }
            }
            recognition.start()            
        } else {
         alert("Your Browser is not support web speech api (see caniuse.com/speech-recognition for more info)")
        }
    }
</script>
</body>
</html>
