<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet"> 
    <link href="<?php echo base_url("assets/css/clients.css")?>" rel="stylesheet"> 
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous" ></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <header>
        <nav class="navbar bg-body-tertiary">
            <div class="container">
                <div class="navbar-brand" href="#">
                    <h2>
                        Clientes
                    </h2>
                </div>
            </div>
        </nav>
    </header><br/>

    <main>
        <div class="loading" id="loading">
            <div class="text-center">
            <div class="spinner-grow text-primary" role="status">
                <span class="sr-only"></span>
            </div>
            </div>
        </div>
        <div class="container-md">
            <button type="button" class="btn btn-success" id="btnAdd" data-bs-toggle="modal" data-bs-target="#clientModal">
                Adicionar cliente
            </button>

            <div class="modal fade" id="clientModal" tabindex="-1" aria-labelledby="clientModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="clientModalLabel">Novo Cliente</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post" id="clientForm">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Nome</label>
                                    <input type="text" class="form-control" id="name" placeholder="Exemplo da Silva" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="nome@exemplo.com" required>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Telefone</label>
                                    <input type="text" class="form-control" id="phone" placeholder="(00) 00000-0000" required>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Endereço</label>
                                    <input type="text" class="form-control" id="address" required>
                                </div>

                                <div class="mb-3">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                    <button type="submit" class="btn btn-primary"  data-bs-dismiss="modal">Salvar</button>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>


            <div class="modal fade" id="updateClientModal" tabindex="-1" aria-labelledby="clientModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="clientModalLabel">Alterar Cliente</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                           
                        </div>
                    </div>
                </div>
            </div>
        </div><br/>

        <div class="container-md">
            <div class="row">
                <table class="table" id="tableClients">
                    <thead>
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Endereço</th>
                        <th scope="col">Operações</th>
                        </tr>
                    </thead>
                    <tbody id="bodyTable">
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script>
        $(document).ready(()=>{
            const tableClients = $("#tableClients").DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-BR.json',
                },
                columnDefs: [{
                    "defaultContent": "-",
                    "targets": "_all"
                }]
            });
           
            document.getElementById("clientForm").addEventListener("submit", function(event){
                event.preventDefault();
                Add();
            });
            
            async function Add()
            {
                let name = $("#name").val();
                let email = $("#email").val();
                let phone = $("#phone").val();
                let address = $("#address").val();
                $(".loading").attr("style", "display: flex");
                await new Promise((resolve, reject) => {
                    $.ajax({
                        data: {
                            name,
                            email,
                            phone,
                            address
                        },
                        url: "/clients/add",
                        type: "POST",
                        dataType: "json",
                        success: (resp) => {
                            resolve(resp)
                        },
                        error: (err) => {
                            reject(err)
                        }
                    });
                });
                updateTable();
                $(".loading").attr("style", "display: none");
                Swal.fire({
                    title: "Clientes",
                    text: "Registro adicionado com sucesso!",
                    icon: "success"
                });
            }

            async function getAllUsers()
            {
                return await new Promise((resolve, reject) => {
                                $.ajax({
                                    data: {},
                                    url: "/clients/getall",
                                    type: "GET",
                                    dataType: "json",
                                    success: (resp) => {
                                        resolve(resp);
                                    },
                                    error: (err) => {
                                        reject(err);
                                    }
                                });
                        });
            } 

            async function updateTable()
            {
                $(".loading").attr("style", "display: flex");
                let table = $("#bodyTable");
                table.empty();
                let resp = await getAllUsers();
                let html;
                for(var i = 0; i < resp.data_clients.length; i++)
                {
                    tableClients.row.add([
                        resp.data_clients[i].id,
                        resp.data_clients[i].name,
                        resp.data_clients[i].email,
                        resp.data_clients[i].phone,
                        resp.data_clients[i].address,
                        `<a data-id="${resp.data_clients[i].id}" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#updateClientModal" id="btnEdit">Editar</a>
                            <a data-id="${resp.data_clients[i].id}" class="btn btn-danger" id="btnDelete">Excluir</a>`
                    ]).draw();
                }
                $(".loading").attr("style", "display: none");
            }
            updateTable();
            
        });
    </script>
</body>
</html>