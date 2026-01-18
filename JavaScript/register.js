function generateFormandText() {
    let form = `
    <form action="#" method="post">
            <p></p>
                <table>
                    <tr>
                        <th id="username"><label for="name">Nome: </label></th>
                        <td headers="username"><input type="text" name="name" id="name" /></td>
                    </tr>
                    <tr>
                        <th id="usersurname"><label for="surname">Cognome: </label></th>
                        <td headers="usersurname"><input type="text" name="surname" id="surname" /></td>
                    </tr>
                    <tr>
                        <th id="useremail"><label for="email">E-mail: </label></th>
                        <td headers="useremail"><input type="email" name="email" id="email" /></td>
                    </tr>
                    <tr>
                        <th id="userphone"><label for="phone">Telefono: </label></th>
                        <td headers="userphone"><input type="number" name="phone" id="phone"/></td>
                    </tr>
                    <tr>
                        <th id="userpassword"><label for="password">Password: </label></th>
                        <td headers="userpassword"><input type="password" name="password" id="password" /></td>
                    </tr>
                </table>
                <input type="reset" name="reset" value="Annulla" />
                <input type="submit" name="submit" value="Conferma" />
            </form>
            <p>Hai già un account?</p>
            <a href="./login.php"><input type="button" name="loginbutton" id="loginbutton" value="Login" /></a>`;
    return form;
}

async function getRegisterData() {
    const url = 'api-register.php';
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.text();
        console.log(json);
        if(json["registersuccess"]){
            window.location.href = "./user-groups.php";
        } else {
            registerAttempt();
        }

    } catch (error) {
        console.log(error.message);
    }
}

const main = document.querySelector("main");
getRegisterData();

function registerAttempt() {
    let form = generateFormandText();
    main.innerHTML = form;
    // Gestisco tentativo di login
    document.querySelector("main form").addEventListener("submit", function (event) {
        event.preventDefault();
        const name = document.querySelector("#name").value;
        const surname = document.querySelector("#surname").value;
        const email = document.querySelector("#email").value;
        const phone = document.querySelector("#phone").value;
        const password = document.querySelector("#password").value;
        console.log("voila: ", name,surname,email,phone,password);
        register(name, surname, email, phone, password);
    });
}

async function register(name, surname, email, phone, password) {
    const url = 'api-register.php';
    const formData = new FormData();

    formData.append('name', name);
    formData.append('surname', surname);
    formData.append('email', email);
    formData.append('phone', phone);
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
        if(json["registersuccess"]) {
            window.location.href = "./user-groups.php";
        }
        else {
            console.log("rilevato errore");
            document.querySelector("form > p").innerText = json["registererror"];
        }


    } catch (error) {
        console.log(error.message);
    }
}