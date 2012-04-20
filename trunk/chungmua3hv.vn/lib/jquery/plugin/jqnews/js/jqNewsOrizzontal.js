/*
* JqNewsOrizzontal - JQuery NewsTicker
* Author: Gravagnola Saverio and Iuliano Renato
* Version: 1.0
*/

var newsVisual = 5; // Numero di news da visualizzare - news to be displayed
var intervallo = 5000; // >1500
var numNews = 4;
var numNewsOrizzontal;
var gestInter;
$(document).ready(function() {

    // Totale news orizzontali
    numNewsOrizzontal = $("#jqnews").children().length;

    // Controllo di overflow
    if (newsVisual > numNewsOrizzontal) {
        newsVisual = numNewsOrizzontal;
    }
	
	if(numNews > numNewsOrizzontal){
		numNews = numNewsOrizzontal;	
	}

    // Hide delle news superflue all'inizializzazione
    for (var i = newsVisual; i < numNewsOrizzontal; i++) {
        $($("#jqnews").children()[i]).css("opacity", "0");		
    }

    gestInter = setInterval(jqNewsRotate, intervallo);

    // Gestione del mouseover-mouseout
    //$("#jqnews").mouseover(function() { clearInterval(gestInter) });
    //$("#jqnews").mouseout(function() { gestInter = setInterval(jqNewsRotate, intervallo); });
});

function jqNewsRotate() {
    // Inserire lo stesso valore utilizzato per definire l'altezza ed i margini dei div nel file css/style.css
    var larghezzaDiv = -150;
    var margineDiv = 5;
    
    // Hide della prima news
	var a = document.getElementById('jqnews').childNodes;

    $($("#jqnews").children()[0]).animate({ opacity: 0 }, 1000, "linear", function() {
        // Movimento verso l'alto
        $($("#jqnews").children()[0]).animate({ marginLeft: larghezzaDiv }, 1000, "linear", function() {
            // Ripristino posizione elemento nascosto
            $($("#jqnews").children()[0]).css("margin", margineDiv);
            // Spostamento in coda dell'elemento nascosto
            $("#jqnews").append($($("#jqnews").children()[0]));
            // Visualizzazione dell'ultima news
            $($("#jqnews").children()[(numNews-1)]).animate({ opacity: 1 }, 1500);
        });
    });
}

function preItem(){
	// Inserire lo stesso valore utilizzato per definire l'altezza ed i margini dei div nel file css/style.css
    var larghezzaDiv = -150;
    var margineDiv = 5;
    clearInterval(gestInter);
    // Hide della prima news	
    $($("#jqnews").children()[0]).animate({ opacity: 0 }, 1000, "linear", function() {
        // Movomento verso l'alto
        //$($("#jqnews").children()[4]).css("opacity", 0);
        $($("#jqnews").children()[0]).animate({ marginLeft: larghezzaDiv }, 1000, "linear", function() {
            // Ripristino posizione elemento nascosto
            $($("#jqnews").children()[0]).css("margin", margineDiv);
            // Spostamento in coda dell'elemento nascosto
            $("#jqnews").append($($("#jqnews").children()[0]));
            // Visualizzazione dell'ultima news
            $($("#jqnews").children()[(numNews-1)]).animate({ opacity: 1 }, 1500);
        });
    });
	
	gestInter = setInterval(jqNewsRotate, intervallo);
}

function nextItem(){
	var larghezzaDiv = 150;
    var margineDiv = 5;
    clearInterval(gestInter);
    // Hide della prima news
    $($("#jqnews").children()[(numNews-1)]).animate({ opacity: 0 }, 1000, "linear", function() {    	
    	$($("#jqnews").children()[(newsVisual - 1)]).insertBefore($($("#jqnews").children()[0]));
    	//$($("#jqnews").children()[0]).css("width", 0);
    	$($("#jqnews").children()[0]).css("opacity", 0);
		$($("#jqnews").children()[0]).animate({ opacity: 1 }, 1500);
    });
	gestInter = setInterval(nextItem, intervallo);
}