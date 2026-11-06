const URL_API = "http://127.0.0.1:8000/api/competitions";
const form = document.getElementById("competitonForm");

const list = document.getElementById("competitions");


async function getCompetitions() {
    const response = await fetch(URL_API);
    const result = await response.json();

    list.innerHTML = "";

    for (let i = 0; i < result.length; i++) {
        console.log(result[i]);

        list.innerHTML += `
            <div class="competition">
                <h3>${result[i].title}</h3>
                <p>${result[i].category}</p>
                <p>${result[i].description}</p>
                <p>Capacity: ${result[i].capacity}</p>
            </div>
        `;
    }
}

form.addEventListener("submit", async function(event){
    event.preventDefault();
    
    const data = {
        title: document.getElementById("title").value,
        category: document.getElementById("category").value,
        capacity: Number(document.getElementById("capacity").value),
        description: document.getElementById("description").value
    };
    
    const response = await fetch(URL_API,{
        method: "POST",
        
        headers:{
            "Content-Type": "application/json",
            "Accept": "application/json"
        },
        body: JSON.stringify(data)
    });
    
    console.log(await response.json());
    
});

getCompetitions();
