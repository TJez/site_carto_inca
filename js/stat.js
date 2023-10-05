// graphique
var graph = document.getElementById('graph').getContext('2d');

graph.height = 100;
// graph.height(100);

// définition des data
var listData = document.getElementsByClassName("data");
var data = [];
var legend = [];
var compt = 0;

// boucle pour parcourir les données
for (let count = 0; count < listData.length; count++) {
    data.push(listData[count].innerHTML);
    legend.push(listData[count].id);
    compt += 1;
}
console.log("data : " + data + " legend : " + legend);

// construction couleurs aléatoires
const generateColor = () => {
  
    let randomColor = (Math.floor(Math.random()*0xFFFFFF)).toString(16);
    document.body.style.backgroundColor = "#" + randomColor;
    let text = document.querySelector('#code');
    text.innerText = "#" + randomColor;
  
}

// liste couleur aléatoire pour data
listColor = [];
for (let count = 0; count < compt; count++)
{
    listColor.push("#" + (Math.floor(Math.random()*0xFFFFFF)).toString(16));
}

// paramétrage du graphe
var graph = new Chart(graph, {
    type: 'bar',
    data: {
        labels: legend,
        datasets: [{
            data: data,
            backgroundColor: listColor,
            borderColor: listColor,
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
