// Configurazione iniziale
let myCanvas = document.getElementById("myCanvas").getContext('2d');

// Array contenenti i dati per popolare il grafico
let mesi = [
    "Gennaio",
    "Febbraio",
    "Marzo",
    "Aprile",
    "Maggio",
    "Giugno",
    "Luglio",
    "Agosto",
    "Settembre",
    "Ottobre",
    "Novembre",
    "Dicembre"
];

let quantita = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

// Global options
Chart.defaults.font.family = 'Lato';
Chart.defaults.font.size = 18;
Chart.defaults.font.color = '#000';

let chart = new Chart(myCanvas, {
    // Serve a selezionare il tipo di grafico
    // Altri tipi sono: bar, line, radar, ciambella, polarArea, bolla, scatter,
    type: 'bar',
    data: {
        // array importati con i dati
        labels: mesi,
        datasets: [{
            label: "Numero Ordini",
            data: quantita,
            // colore delle colonne
            backgroundColor: [
                'rgb(0, 255, 125)',
                'rgb(0, 255, 255)',
                'rgb(0, 125, 255)',
                'rgb(0, 0, 255)',
                'rgb(125, 0, 255)',
                'rgb(255, 0, 255)',
                'rgb(255, 0, 125)',
                'rgb(255, 0, 0)',
                'rgb(255, 125, 0)',
                'rgb(255, 255, 0)',
                'rgb(125, 255, 0)',
                'rgb(0, 255, 0)'
            ],
            hoverBorderWidth: 1,
            hoverBorderColor: '#000'
        }]
    },
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Ordini ricevuti mese/anno',
                fontSize: 25
            },
            legend: {
                display: false,
                position: 'bottom'
            },
            layout: {
                padding: {
                    top: 50,
                    bottom: 0
                }
            }
        }
    }
});