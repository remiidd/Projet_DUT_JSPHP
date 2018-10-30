document.addEventListener("keydown", infosClavier);
const bordure = 'black';
const background = "white";
const couleur_snack = 'lightgreen';
const contour_snack = 'darkgreen';

let snake = [
  {x: 290, y: 190},
  {x: 280, y: 190},
  {x: 270, y: 190},
  {x: 260, y: 190},
  {x: 250, y: 190}
]

var fenetre = document.getElementById("fenetrejeu");
var fen2d = fenetre.getContext("2d");
var scoreaff = document.getElementById("score");


fen2d.fillStyle = background;
fen2d.strokestyle = bordure;


fen2d.fillRect(0, 0, fenetre.width, fenetre.height);
fen2d.strokeRect(0, 0, fenetre.width, fenetre.height);

var score = 0;
var dx = 10;
var dy = 0;

var foodX = alea(0, fenetre.width - 10), foodY = alea(0, fenetre.height - 10);

main();

function infosClavier(e) {
  if (e.keyCode == 40) {
    dy=10;
    dx=0;
  }
  else if (e.keyCode == 38) {
    dy=-10;
    dx=0;
  }
  else if (e.keyCode == 37) {
    dy=0;
    dx=-10;
  }
  else if (e.keyCode == 39) {
    dy=0;
    dx=10;
  }
}

function alea(min, max) {
  return Math.round((Math.random() * (max-min) + min) / 10) * 10;
}

function des_nouri() {
 fen2d.fillStyle = 'red';
 fen2d.strokestyle = 'darkred';
 fen2d.fillRect(foodX, foodY, 10, 10);
 fen2d.strokeRect(foodX, foodY, 10, 10);
}

function score(){

}

function cre_nouri() {
  foodX = alea(0, fenetre.width - 10);
  foodY = alea(0, fenetre.height - 10);

  snake.forEach(function mange(part) {
    if (foodIsOnSnake = part.x == foodX && part.y == foodY){
      cre_nouri();
    }
  });
}

function main() {
  setTimeout(function onTick() {
    supprimersnack();
    des_nouri();
    avancer();
    des_snack();

    if (fin_partie()){
      alert("Perdu !");
    }
    else{
      main();
    }
  }, 80)
}

function des_snack() {
  snake.forEach(des_partie)
}

function des_partie(snakePart) {
  fen2d.fillStyle = couleur_snack;
  fen2d.strokestyle = contour_snack;

  fen2d.fillRect(snakePart.x, snakePart.y, 10, 10);
  fen2d.strokeRect(snakePart.x, snakePart.y, 10, 10);
}

function avancer() {
  snake.unshift({x: snake[0].x + dx, y: snake[0].y + dy});

  if (snake[0].x === foodX && snake[0].y === foodY) {
    console.log("Score" + score);
    score += 1;
    scoreaff.textContent= "Votre score : " + score;
    cre_nouri();
  } else {
    snake.pop();
  }
}

function supprimersnack() {
  fen2d.fillStyle = "white";
  fen2d.strokeStyle = "black";

  fen2d.fillRect(0, 0, fenetre.width, fenetre.height);
  fen2d.strokeRect(0, 0, fenetre.width, fenetre.height);
}

function fin_partie() {
  for (let i = 4; i < snake.length; i++) {
    if (didCollide = snake[i].x === snake[0].x && snake[i].y === snake[0].y){
      return true
    }
  }

  if (snake[0].x < 0 || snake[0].x > fenetre.width - 10 || snake[0].y < 0 || snake[0].y > fenetre.height - 10){
    return true;
  }
}
