<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet"> 
    <link href="<?php echo base_url("assets/css/clients.css")?>" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous" ></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js" integrity="sha512-efAcjYoYT0sXxQRtxGY37CKYmqsFVOIwMApaEbrxJr4RwqVVGw8o+Lfh/+59TU07+suZn1BWq4fDl5fdgyCNkw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/canvasjs/1.7.0/canvasjs.min.js" integrity="sha512-FJ2OYvUIXUqCcPf1stu+oTBlhn54W0UisZB/TNrZaVMHHhYvLBV9jMbvJYtvDe5x/WVaoXZ6KB+Uqe5hT2vlyA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <header>
            <div class="container text-center" style="height: 120px; display: grid; align-items: center;">
                <div class="row">
                    <div class="col">
                        <h2>Clientes</h2>
                    </div>
                    <div class="col-6">
                    </div>
                    <div class="col">
                        <div><i class="fa-solid fa-user" style="font-size: 18px; color: gray;"></i>&nbsp;<span id="profile"></span></div>
                    </div>
                </div>
            </div>
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
            <div class="accordion" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <div style="align-items: center;display: flex;flex-direction: column;">
                                <strong>Telefone dos clientes associados as regiões do Brasil</strong>
                                <div id="chart">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><br/>

        <div class="container-md">
            <button type="button" title="Adicionar cliente" class="btn btn-success" id="btnAdd" data-bs-toggle="modal" data-bs-target="#clientModal">
                <i class="fa-solid fa-plus"></i>
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

                                <div class="mb-1">
                                    <label for="exampleFormControlInput1" class="form-label">Endereço</label>
                                    <div class="column">
                                        <button type="button" class="btn" title="Pesquisar" id="getaddress"> <i class="fa-solid fa-magnifying-glass"></i> Procurar CEP</button>
                                        <textarea type="text" class="form-control address" id="address" required></textarea>
                                        <sub>Digite o CEP e clique no botão para procurar o endereço automático (sem traços, espaços ou letras).</sub>
                                    </div>
                                </div>

                                <div class="d-grid gap-2 col-6 mx-auto">
                                    <button type="submit" class="btn btn-primary" title="Salvar cliente" data-bs-dismiss="modal"><i class="fa-solid fa-floppy-disk"></i></button>
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
                            <form method="post" id="clientEditForm">
                                <input type="hidden" class="form-control" id="idEdit">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Nome</label>
                                    <input type="text" class="form-control" id="nameEdit" placeholder="Exemplo da Silva" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="emailEdit" placeholder="nome@exemplo.com" required>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Telefone</label>
                                    <input type="text" class="form-control" id="phoneEdit" placeholder="(00) 00000-0000" required>
                                </div>

                                <div class="mb-1">
                                    <label for="exampleFormControlInput1" class="form-label">Endereço</label>
                                    <div class="column">
                                        <button type="button" class="btn" title="Pesquisar" id="getaddress" name="edit"> <i class="fa-solid fa-magnifying-glass"></i> Procurar CEP</button>
                                        <textarea type="text" class="form-control address" id="addressEdit" required></textarea>
                                        <sub>Digite o CEP e clique no botão para procurar o endereço automático (sem traços, espaços ou letras).</sub>
                                    </div>
                                </div>

                                <div class="d-grid gap-2 col-6 mx-auto">
                                    <button type="submit" class="btn btn-primary" title="Salvar cliente" data-bs-dismiss="modal"><i class="fa-solid fa-floppy-disk"></i></button>
                                </div>

                                
                            </form>
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
        $(document).ready(async ()=>{
            const tableClients = $("#tableClients").DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-BR.json',
                },
                columnDefs: [{
                    "defaultContent": "-",
                    "targets": "_all"
                }]
            });
            
            const inputPhone = $("#phone");
            const inputAddress = document.getElementById("address");
            
            const maskPhone = {
                mask: ['(99) 9999-9999', '(99) 99999-9999']
            };

            const maskAddress = {
                mask: ['99999-999'],
                keepStatic: true
            }

            Inputmask(maskPhone).mask(inputPhone);
            Inputmask(maskAddress).mask(inputAddress);
            
            

            tableClients.on( 'search.dt', async () => {
                await events();
            } );
            
            tableClients.on( 'page.dt', async () => {
                await events();
            } );
            
            
        
            
            document.querySelectorAll("#getaddress").forEach((element)=>{
                element.addEventListener("click", async()=>{
                    let address;
                    if($(element).attr("name") == "edit")
                    {
                        address = document.getElementById("addressEdit");
                    }
                    else
                    {
                        address = document.getElementById("address");
                    }
                    
                    let addressCEP = address.value.replace(/-/g, "");

                    
                    const CEPnumber = /^[0-9]+$/;
                    const CEPformat = /^[0-9]{8}$/;
                    if(!CEPnumber.test(addressCEP) || !CEPformat.test(addressCEP))
                    {
                        Swal.fire({
                            title: "CEP",
                            text: "Este não é um CEP, verifique se possuí apenas oito números, sem espaços ou letras.",
                            icon: "error"
                        });
                        
                        address.value = "";
                        return;
                    }

                    const searchAdress = await fetch(`https://viacep.com.br/ws/${addressCEP}/json/`);


                    const response = await searchAdress.json();
                    if(typeof response.logradouro !== "undefined")
                    {
                        if(inputAddress.inputmask)
                            inputAddress.inputmask.remove();

                        address.value = `${response.logradouro} - ${response.bairro} , ${response.localidade} - ${response.uf}.`;
                    }
                    else
                    {
                        Swal.fire({
                            title: "CEP",
                            text: "Endereço de CEP não encontrado.",
                            icon: "error"
                        });
                        address.value = "";
                        return;
                    }
                        
                    
                });
            })

            let readToken = await new Promise((resolve, reject)=>{
                                $.ajax({
                                    url: "/auth/readToken",
                                    method: "GET",
                                    headers:{
                                        "Authorization": localStorage.getItem("token")
                                    },
                                    success: (resp) => {
                                        if(typeof resp.data != "undefined")
                                        {
                                            $("#profile").empty().append(`Olá ${resp.data.data.name_user},`);
                                        }
                                        resolve(resp)
                                    },
                                    error: (err) => {
                                        reject(err)
                                    }
                                });
                            });
            await updateTable();
            
            
            document.getElementById("clientForm").addEventListener("submit", function(event){
                event.preventDefault();
                Add();
            });
            
            document.getElementById("clientEditForm").addEventListener("submit", function(event){
                event.preventDefault();
                Edit();
            });
              
            function events()
            {
                
                document.querySelectorAll("#btnDelete").forEach((element)=>{
                    element.addEventListener("click", async ()=>{
                        let id = $(element).attr("data-id");
                        console.log("btnDelete ID -> "+id);
                        $(".loading").attr("style", "display: flex");
                        let resp = await new Promise((resolve, reject) => {
                            $.ajax({
                                url: `/clients/delete`,
                                method: "post",
                                dataType: "json",
                                data: {
                                    id
                                },
                                headers:
                                {
                                    "Authorization": localStorage.getItem("token")
                                },
                                success: (resp) => {
                                    console.log(resp);
                                    resolve(resp)
                                },
                                error: (err) => {
                                    reject(err)
                                }
                            });
                        
                        });
                        $("#idEdit").val("");
                        $("#emailEdit").val("");
                        $("#nameEdit").val("");
                        $("#addressEdit").val("");
                        $("#phoneEdit").val("");
                        await updateTable();
                        $(".loading").attr("style", "display: none");
                    });
                });


                    document.querySelectorAll("#btnEdit").forEach((element)=>{
                    element.addEventListener("click", async ()=>{
                        let id = $(element).attr("data-id");
                        $(".loading").attr("style", "display: flex");
                        let resp = await new Promise((resolve, reject) => {
                            $.ajax({
                                url: `/clients/getbyid/${id}`,
                                method: "GET",
                                headers:
                                {
                                    "Authorization": localStorage.getItem("token")
                                },
                                success: (resp) => {
                                    resolve(resp)
                                },
                                error: (err) => {
                                    reject(err)
                                }
                            });
                        });
                        $("#idEdit").val(id);
                        $("#emailEdit").val(resp.client.email);
                        $("#nameEdit").val(resp.client.name);
                        $("#addressEdit").val(resp.client.address);
                        $("#phoneEdit").val(resp.client.phone);
                        $(".loading").attr("style", "display: none");
                    });
                })
            }

           

           

            async function Edit()
            {
                let id = $("#idEdit").val();
                let name = $("#nameEdit").val();
                let address = $("#addressEdit").val();
                let email = $("#emailEdit").val();
                let phone = $("#phoneEdit").val();
                $(".loading").attr("style", "display: flex");
                try
                {
                    let resp1 = await new Promise((resolve, reject) => {
                        $.ajax({
                            url: "/clients/edit",
                            method: "post",
                            dataType: "json",
                            data: {
                                id:id,
                                name:name,
                                email:email,
                                phone:phone,
                                address: address
                            },
                            headers:
                            {
                                "Authorization": localStorage.getItem("token")
                            },
                            success: (resp) => {
                                resolve(resp)
                            },
                            error: (err) => {
                                reject(err)
                            }
                        })
                    });
                }
                catch(err)
                {
                    console.log(err);
                }
                $(".loading").attr("style", "display: none");
                $("#idEdit").val("");
                $("#emailEdit").val("");
                $("#nameEdit").val("");
                $("#addressEdit").val("");
                $("#phoneEdit").val("");
                Swal.fire({
                            title: "Cliente",
                            text: `Editado com sucesso cliente de ID ${id}, ${name}`,
                            icon: "success"
                });
                await updateTable();
                
            }
            
            
            
            async function Add()
            {
                let name = $("#name").val();
                let email = $("#email").val();
                let phone = $("#phone").val();
                let address = $("#address").val();

                if(!name || !email || !phone || !address)
                {
                    Swal.fire({
                        title: "Clientes",
                        text: "Preencha todos os campos para concluir o envio!",
                        icon: "error"
                    });
                    return;
                }

               
                
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
                        headers:{
                            "Authorization": localStorage.getItem("token")
                        },
                        success: (resp) => {
                            resolve(resp)
                        },
                        error: (err) => {
                            reject(err)
                        }
                    });
                });
                await updateTable();
                $(".loading").attr("style", "display: none");
                Swal.fire({
                    title: "Clientes",
                    text: "Registro adicionado com sucesso!",
                    icon: "success"
                });
                Inputmask(maskAddress).mask(inputAddress);
                $("#name").val("");
                $("#email").val("");
                $("#phone").val("");
                $("#address").val("");
            }

            async function getAllUsers()
            {
                
                return await new Promise((resolve, reject) => {    
                                        
                                        $.ajax({
                                            data: {},
                                            url: "/clients/getall",
                                            type: "GET",
                                            dataType: "json",
                                            headers:{
                                                "Authorization": localStorage.getItem("token")
                                            },
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
                
                await tableClients.clear().draw();

                let resp = await getAllUsers();
                for(var i = 0; i < resp.data_clients.length; i++)
                {
                    tableClients.row.add([
                        resp.data_clients[i].id,
                        resp.data_clients[i].name,
                        resp.data_clients[i].email,
                        resp.data_clients[i].phone,
                        resp.data_clients[i].address,
                        `<a data-id="${resp.data_clients[i].id}" title="Alterar cliente ID ${resp.data_clients[i].id}" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateClientModal" id="btnEdit"><i class="fa-regular fa-rectangle-list" style="color: white"></i></a>
                            <a data-id="${resp.data_clients[i].id}" title="Excluir cliente ID ${resp.data_clients[i].id}" class="btn btn-danger" id="btnDelete"><i class="fa-solid fa-trash" style="color: white"></i></a>`
                    ]).draw();
                }


                await AllPhones();
                await events();
                $(".loading").attr("style", "display: none");
            }


            async function AllPhones()
            {
                
                let states = await new Promise((resolve, reject) => {    
                                        
                                        $.ajax({
                                            data: {},
                                            url: "/clients/phoneStatesPercent",
                                            type: "GET",
                                            dataType: "json",
                                            headers:{
                                                "Authorization": localStorage.getItem("token")
                                            },
                                            success: (response) => {
                                                resolve(response);
                                            },
                                            error: (err) => {
                                                reject(err);
                                            }
                                });
                            });

                console.log(states);
                
                $("#chart").empty();

                var chart = new CanvasJS.Chart("chart", {
                    exportEnabled: true,
                    animationEnabled: true,
                    width: 450,
                    height: 300,
                    legend:{
                        cursor: "pointer"
                    },
                    data: [{
                        type: "pie",
                        showInLegend: true,
                        toolTipContent: "{name}: <strong>{y}%</strong>",
                        indexLabel: "{name} - {y}%",
                        dataPoints: [
                            { y: states.sudeste, name: "Sudeste", exploded: true },
                            { y: states.sul, name: "Sul" },
                            { y: states.centro_oeste, name: "Centro Oeste" },
                            { y: states.norte, name: "Norte" },
                            { y: states.nordeste, name: "Nordeste" }
                        ]
                    }]
                });
                chart.render();
                $(".canvasjs-chart-canvas")[0].style.position = "unset";
                $(".canvasjs-chart-canvas")[0].style.display = "flex";
                $(".canvasjs-chart-credit").remove()

            } 
        });
    </script>
</body>
</html>