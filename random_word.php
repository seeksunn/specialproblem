
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
<?php include("check_session.php")?>
    <header class='w3-container w3-red w3-center' style='padding:12px 16px'>
        <h1 class='w3-margin w3-jumbo' id='topic'>Random Words</h1>
        <p class='w3-xlarge' id='objective'>Objective : อ่านออกเสียงตามคำที่กำหนดให้</p>  
    </header>
    <div class='w3-row-padding w3-padding-64 w3-container' id='vbasic' style='display : block'>
        <div class='w3-content'>
            <div class='w3-twothird'>
                      
            </div>
        </div>
    </div>   

     <div class='w3-container w3-padding-64 w3-content w3-center' id='playpart'>
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
            <form class='w3-center' action='exerciseslist.php#menu' method='GET'>
                <input type='submit' class='w3-button w3-black w3-round w3-padding-large w3-large' value='Exit' name='completed' id='exitBtn'>
            </form>
      

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
    function pickword(){   
        var words;     
        document.getElementById("console").innerHTML = ""; 
        document.getElementById("readBtn").style.display = "inline"; 
        document.getElementById("speakBtn").style.display = "inline";        
        var xhttp;
        xhttp = new XMLHttpRequest();     
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("word").innerHTML = this.responseText;
            }
        };        
        xhttp.open("GET", "pick_rand_word.php", true);
        xhttp.send();     
        document.getElementById("word").innerHTML = words;
        document.getElementById("continueBtn").innerHTML = "Next";
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
            var SpeechGrammarList = SpeechGrammarList || webkitSpeechGrammarList            
            var targets = [document.getElementById("word").innerHTML,document.getElementById("word").innerHTML];
            var grammar = '#JSGF V1.0; grammar targets; public <target> = ' + targets.join(' | ') + ' ;';
            var speechRecognitionList = new SpeechGrammarList();
            speechRecognitionList.addFromString(grammar, 1);
            recognition.grammars = speechRecognitionList;


            recognition.lang = 'en-US';
            recognition.interimResults = false;
            recognition.maxAlternatives = 1;
            recognition.onspeechend = function() {
                recognition.stop();                 
            }
            recognition.onresult = function(event) {
                var result = event.results[0][0].transcript;
                document.getElementById("speakBtn").innerHTML = "Speak";
                document.getElementById("continueBtn").style.display = "inline";  
                if(result == document.getElementById("word").innerHTML) {
                    document.getElementById("console").innerHTML = "คุณออกเสียงถูกต้อง";
                    document.getElementById("speakBtn").disabled = false;
                    document.getElementById("speakBtn").style.display = "none";                                      
                                          
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
