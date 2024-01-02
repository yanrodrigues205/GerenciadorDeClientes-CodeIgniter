<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>AMZMP - Login</title>
</head>
<body style="display:flex; height: 100%;">
    <div class="container-sm text-align">
        <div class="row">
            <div class="col">
                <div class="row">
                    <h1> Bem vindo ao Teste do Yan Rodrigues!</h1>
                </div>
            </div>
            <div class="col">
                <form>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="nome@exemplo.com">
                    </div>

                    <div class="mb-3">
                        <label for="inputPassword5" class="form-label">Senha</label>
                        <input type="password" id="password" class="form-control" aria-describedby="passwordHelpBlock">
                        <div id="passwordHelpBlock" class="form-text">
                        Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                        </div>
                    </div>

                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button class="btn btn-success" type="button" id="btnSend">Entrar</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script>
        $(document).ready(()=>{

            document.getElementById("btnSend").addEventListener("click",()=>{
                let data = sendData();

                if(!data)
                {
                    alert("senha ou email incorreto!");
                }
                data.then((obj) => {
                    Swal.fire({
                        title: "Usuário authenticado com sucesso!",
                        text: obj.token,
                        icon: "success"
                    });
                    localStorage.setItem("token", obj.token);
                    window.location.href = "/clients";
                }); 

            });

            


            async function sendData()
            {
                const inputEmail = $("#email").val();
                const inputPassword = $("#password").val(); 
                let dados = {
                    "email": `${inputEmail}`,
                    "password": `${inputPassword}`
                };
                $("#email").val("");
                $("#password").val("");
                return await new Promise((resolve, reject)=>{
                    $.ajax({
                        method: "POST",
                        url: "/auth",
                        dataType:"JSON",
                        data: dados,
                        success: (resp) =>{
                            resolve(resp);
                        },
                        error: (err) =>{
                            reject(err);
                        }
                    });
                });
            }
        });
    </script>
</body>
</html>