function startDictation() {
     
       
    if (window.hasOwnProperty('webkitSpeechRecognition')) {
          alert('YOUR BROWSER SUPPORST VOICE RECOGANIZATION');

      var recognition = new webkitSpeechRecognition();

      recognition.continuous = false;
      recognition.interimResults = false;

      recognition.lang = "en-US";
      recognition.start();

      recognition.onresult = function(e) {
        document.getElementById('transcript').value
                                 = e.results[0][0].transcript;
          //alert(        document.getElementById('transcript').value);
        recognition.stop();
          
    setInterval(function(){    document.getElementById('labnol').submit()},300);
      };

      recognition.onerror = function(e) {
        recognition.stop();
      }

    }else{
        alert('Sorry this browser doesnot support the data you want');
    }
  }