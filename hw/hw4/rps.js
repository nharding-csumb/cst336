var imgPlayer;
var btnRock;
var btnPaper;
var btnScissors;
var btnGo;

function init(){
	imgPlayer = document.getElementById("imgPlayer");
	btnRock = document.getElementById("btnRock");
	btnPaper = document.getElementById("btnPaper");
	btnScissors = document.getElementById("btnScissors");
	deselectAll();
}

function deselectAll(){
	btnRock.style.backgroundColor = 'silver';
	btnPaper.style.backgroundColor = 'silver';
	btnScissors.style.backgroundColor = 'silver';
}

function select(choice){
	imgPlayer.src = 'images/' + choice + '.png';
	deselectAll();
	if(choice=='rock') btnRock.style.backgroundColor = '#888888';
	if(choice=='paper') btnPaper.style.backgroundColor = '#888888';
	if(choice=='sciccors') btnScissors.style.backgroundColor = '#888888';
}
	
// function selectRock(){
// 	imgPlayer.src = 'images/rock.png';
// 	btnRock.style.backgroundColor = '#888888';
// }

// function selectPaper(){
// 	imgPlayer.src = 'images/paper.png';
// 	btnPaper.style.backgroundColor = '#888888';
// }

// function selectScissors(){
// 	imgPlayer.src = 'images/scissors.png';
// 	btnScissors.style.backgroundColor = '#888888';
// }

