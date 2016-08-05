function loadTable(){

$.ajax({
headers: { 'X-Auth-Token': 'a0a6c9a4443e46f680b1fe4c3f5f0bb6' },
  url: 'http://api.football-data.org/v1/soccerseasons/426/leagueTable',
  dataType: 'JSON',
  type: 'GET',

}).done(function(response) {
  var standings = response.standing;
    var out ="";
    var i;
    for (i=0; i<3; i++){
        out += '<tr><td  id="champions">' + standings[i].position + '</td><td><img src="' + standings[i].crestURI + '"height="30px"></td><td class="team">' + standings[i].teamName + '</td><td>' + standings[i].wins+'</td><td>' + standings[i].draws+'</td><td>' + standings[i].losses + '</td><td>' + standings[i].points + '</td></tr>';    
    }    
    
    out += '<tr><td  id="championsqual">' + standings[3].position + '</td><td><img src="' + standings[3].crestURI + '"height="30px"></td><td class="team">' + standings[3].teamName + '</td><td>' + standings[3].wins+'</td><td>' + standings[3].draws+'</td><td>' + standings[3].losses + '</td><td>' + standings[3].points + '</td></tr>';
    
    out += '<tr><td  id="europa">' + standings[4].position + '</td><td><img src="' + standings[4].crestURI + '"height="30px"></td><td class="team">' + standings[4].teamName + '</td><td>' + standings[4].wins+'</td><td>' + standings[4].draws+'</td><td>' + standings[4].losses + '</td><td>' + standings[4].points + '</td></tr>';
    
    for (i=5; i<standings.length-3; i++){
        out += '<tr><td>' + standings[i].position + '</td><td><img src="' + standings[i].crestURI + '"height="30px"></td><td class="team">' + standings[i].teamName + '</td><td>' + standings[i].wins+'</td><td>' + standings[i].draws+'</td><td>' + standings[i].losses + '</td><td>' + standings[i].points + '</td></tr>';    
    }   
    
    for (i; i<standings.length; i++){
        out += '<tr><td id="relegation">' + standings[i].position + '</td><td><img src="' + standings[i].crestURI + '"height="30px"></td><td class="team">' + standings[i].teamName + '</td><td>' + standings[i].wins+'</td><td>' + standings[i].draws+'</td><td>' + standings[i].losses + '</td><td>' + standings[i].points + '</td></tr>';   
    }   
    
    
    document.getElementById("standings").innerHTML += out;    
    })
}
