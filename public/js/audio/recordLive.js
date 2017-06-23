var audio_context,
    recorder,
    volume,
    volumeLevel = 0,
    currentEditedSoundIndex;

function startUserMedia(stream) {
  var input = audio_context.createMediaStreamSource(stream);
  console.log('Media stream created.');

  volume = audio_context.createGain();
  volume.gain.value = volumeLevel;
  input.connect(volume);
  volume.connect(audio_context.destination);
  console.log('Input connected to audio context destination.');
  
  recorder = new Recorder(input);
  console.log('Recorder initialised.');
}

function changeVolume(value) {
  if (!volume) return;
  volumeLevel = value;
  volume.gain.value = value;
}

function startRecording(button) {

  navigator.getUserMedia({audio: true}, function(stream) {
      var input = audio_context.createMediaStreamSource(stream);
      console.log('Media stream created.');

      volume = audio_context.createGain();
      volume.gain.value = volumeLevel;
      input.connect(volume);
      volume.connect(audio_context.destination);
      console.log('Input connected to audio context destination.');
      
      recorder = new Recorder(input);
      console.log('Recorder initialised.');

      // The old startRecording
      recorder && recorder.record();
      
      audio_record = document.getElementById('audio_record');
      audio_record.setAttribute('disabled','true');
      
      audio_stop = document.getElementById('audio_stop');
      audio_stop.removeAttribute('disabled');
      
      audio_light = document.getElementById('recording_light');
      audio_light.style.display = 'inline-block';
      
      console.log('Recording...');
      
  }, function(e) {
    console.warn('No live audio input: ' + e);
  });
	
}

function stopRecording(button) {
  recorder && recorder.stop();
  button.disabled = true;
  console.log('Stopped recording.');
  
  // create WAV download link using audio data blob
  createDownloadLink();
  
  audio_stop = document.getElementById('audio_stop');
  audio_stop.setAttribute('disabled','true');
  
  audio_record = document.getElementById('audio_record');
  audio_record.removeAttribute('disabled');
  
  audio_light = document.getElementById('recording_light');
  audio_light.style.display = 'none';
  
  try{
  	recorder.clear();
  }catch(e){
	  alert('Your recording was not saved.\nMake sure you give your browser\nproper access to your Microphone.');
  }

  audio_context.close();
}

function createDownloadLink() {
  currentEditedSoundIndex = -1;
  recorder && recorder.exportWAV(handleWAV.bind(this));
}

function handleWAV(blob) {
  var tableRef = document.getElementById('recordingslist');
  if (currentEditedSoundIndex !== -1) {
    $('#recordingslist tr:nth-child(' + (currentEditedSoundIndex + 1) + ')').remove();
  }
		
  var applyName = document.createElement('a');
  var applyDescription = document.createElement('a');
  
  
var reader = new FileReader();
reader.addEventListener("loadend", function() {
	var blob_data = reader.result;
	applyName.download = btoa(blob_data);
	applyDescription.download = btoa(blob_data);
});
reader.readAsBinaryString(blob);

  var url = URL.createObjectURL(blob);
  var newRow   = tableRef.insertRow(currentEditedSoundIndex);
  var newRow2  = tableRef.insertRow(currentEditedSoundIndex);
  newRow.className = 'soundBite';

  var newCell = newRow.insertCell(-1);
  
  var audioElement = document.createElement('audio');
  audioElement.controls = true;
  audioElement.style.maxWidth = "260px";
  audioElement.src = url;
  
  newCell.appendChild(audioElement);
  newCell = newRow.insertCell(-1);
  
  /*var saveText = document.createElement('div');
  saveText.style = 'font-weight:bold';
  saveText.innerHTML = 'Apply to:';
  
  newCell.appendChild(saveText);
  newCell = newRow.insertCell(-1);*/
  
  applyDescription.href = '#';
  applyDescription.innerHTML = 'Save as Description';
  applyDescription.className = 'btn btn-primary saveAudio';
  applyDescription.rel = 'audio_description';
  
  newCell.appendChild(applyDescription);
  newCell = newRow2.insertCell(-1);
  
  applyName.href = '#';
  applyName.innerHTML = 'Save as Title';
  applyName.className = 'btn btn-primary saveAudio';
  applyName.rel = 'audio_title';
  
  newCell.appendChild(applyName);
  newCell = newRow.insertCell(-1);
}

window.onload = function init() {
  try {
    // webkit shim
    window.AudioContext = window.AudioContext || window.webkitAudioContext || window.mozAudioContext;
    navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia;
    window.URL = window.URL || window.webkitURL || window.mozURL;
    
    audio_context = new AudioContext();
    console.log('Audio context set up.');
    console.log('navigator.getUserMedia ' + (navigator.getUserMedia ? 'available.' : 'not present!'));
  } catch (e) {
    console.warn('No web audio support in this browser!');
  }
  
};
