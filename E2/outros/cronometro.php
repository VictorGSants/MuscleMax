<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cronômetro</title>
<style>
  body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
  }
  
  .container {
    background-color: #ccc;
    border-radius: 10px;
    padding: 20px;
    max-width: 300px;
    margin: 50px auto;
    text-align: center;
  }
  
  .timer {
    font-size: 2em;
    margin-bottom: 20px;
  }
  
  .buttons button {
    background-color: darkorange;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    margin: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
  }
  
  .buttons button:hover {
    background-color: #999;
  }
</style>
</head>
<body>
<div class="container">
  <h1>Cronômetro</h1>
  <div class="timer">00:00</div>
  <div class="buttons">
    <button id="start" onclick="startTimer()">Iniciar</button>
    <button id="pause" onclick="pauseTimer()" style="display:none;">Pausar</button>
    <button id="reset" onclick="resetTimer()">Zerar</button>
  </div>
</div>
<script>
let timer;
let minutes = 0;
let seconds = 0;
let isTimerRunning = false;

function startTimer() {
  if (!isTimerRunning) {
    isTimerRunning = true;
    document.getElementById("start").style.display = "none";
    document.getElementById("pause").style.display = "inline-block";
    timer = setInterval(updateTimer, 1000);
  }
}

function pauseTimer() {
  clearInterval(timer);
  isTimerRunning = false;
  document.getElementById("start").style.display = "inline-block";
  document.getElementById("pause").style.display = "none";
}

function resetTimer() {
  clearInterval(timer);
  isTimerRunning = false;
  minutes = 0;
  seconds = 0;
  document.getElementById("start").style.display = "inline-block";
  document.getElementById("pause").style.display = "none";
  updateDisplay();
}

function updateTimer() {
  seconds++;
  if (seconds === 60) {
    minutes++;
    seconds = 0;
  }
  updateDisplay();
}

function updateDisplay() {
  const formattedMinutes = String(minutes).padStart(2, "0");
  const formattedSeconds = String(seconds).padStart(2, "0");
  document.querySelector(".timer").textContent = `${formattedMinutes}:${formattedSeconds}`;
}
</script>
</body>
</html>
