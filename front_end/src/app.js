document.getElementById("studentForm").addEventListener("submit", 
    function(e) {
        e.preventDefault();

        let name = document.getElementById("name").value;
        let family = document.getElementById("family").value;
        let studentCode = document.getElementById("studentCode").value;

        fetch("http://localhost/trying_crud/api/crud.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                name: name,
                family: family,
                studentCode: studentCode
            })
        });
    }
);
