function creaForm() {
    let form = `
    <form action="#" method="POST">
                <p></p>
                <table>
                    <tr>
                        <th id="useremail"><label for="email">E-mail: </label></th>
                        <td headers="useremail"><input type="email" name="email" id="email" /></td>
                    </tr>
                    <tr>
                        <th id="userpassword"><label for="password">Password: </label></th>
                        <td headers="userpassword"><input type="password" name="password" id="password" /></td>
                    </tr>
                </table>
                <input type="reset" name="reset" value="Annulla" />
                <input type="submit" name="submit" value="Conferma" />
            </form>
            <p>Non hai un account?</p>
            <a href="./register.html"><input type="button" name="Registrati" id="register" value="Registrati" /></a>`;
    return form;
}

async function getLoginData() {
    const url = 'api-login.php';
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.text();
        console.log(json);
        if(json["logineseguito"]){
            window.location.href = "./groups.html";
        } else {
            loginAttempt();
        }

    } catch (error) {
        console.log(error.message);
    }
}

const main = document.querySelector("main");
getLoginData();

function loginAttempt() {
    let form = creaForm();
    main.innerHTML = form;
    // Gestisco tentativo di login
    document.querySelector("main form").addEventListener("submit", function (event) {
        event.preventDefault();
        const email = document.querySelector("#email").value;
        const password = document.querySelector("#password").value;
        console.log("voila: ", email,password);
        login(email, password);
    });
}

async function login(email, password) {
    const url = 'api-login.php';
    const formData = new FormData();
    formData.append('email', email);
    formData.append('password', password);
    try {

        const response = await fetch(url, {
            method: "POST",                   
            body: formData
        });

        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        console.log(json);
        if(json["logineseguito"]){
            window.location.href = "./groups.html";
        }
        else{
            document.querySelector("form > p").innerText = json["errorelogin"];
        }


    } catch (error) {
        console.log(error.message);
    }
}
