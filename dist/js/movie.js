document.addEventListener('DOMContentLoaded', function () {
    document.getElementById("newMovieButton").addEventListener("click", function () {
        document.getElementById("newMovieForm").style = "";
        return false;
    });
    document.getElementById("addMovieButton").addEventListener("click", function () {
        let movie = {};
        movie.id = document.getElementById("newMovieId").value;
        movie.title = document.getElementById("newMovieTitle").value;
        movie.description = document.getElementById("newMovieDesc").value;
        movie.genre = document.getElementById("newMovieGenre").value;
        sendRequest(movie);
    });
})

async function sendRequest(movie) {
    let response = await fetch('newmovie.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify(movie)
    });
    let result = await response.json();
    if(response.ok){
        appendMovieToTable(result);
    }
    else{
        let msg = result.message ? result.message : response.statusText;
        alert(msg);
    }
    


}

async function appendMovieToTable(movie) {
    let tablehead = document.getElementById("movieTableHead");
    let tr = document.createElement("tr");

    let tdId = document.createElement("td");
    tr.appendChild(tdId);
    tdId.innerHTML = movie.id;

    let tdTitle = document.createElement("td");
    tr.appendChild(tdTitle);
    tdTitle.innerHTML = movie.title;

    let tdGenre = document.createElement("td");
    tr.appendChild(tdGenre);
    tdGenre.innerHTML = movie.genre;

    let tdDesc = document.createElement("td");
    tr.appendChild(tdDesc);
    tdDesc.innerHTML = movie.description;

    tablehead.after(tr);
}