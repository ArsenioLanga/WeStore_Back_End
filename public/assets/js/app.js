// app.js

 function adicionar_carrinho(id_carrinho){
     
    axios.default.withCredentials = true;
    axios.get('?p=adicionar_carrinho&id_produto=' + id_carrinho)
        .then(function(response){
            document.getElementById('carrinho').innerText = response.data;
            console.log(response.data);
        });
 }

//  function limpar_carrinho(){
//     axios.default.withCredentials = true;
//     axios.get('?p=limpar_carrinho')
//         .then(function(response){
//             document.getElementById('carrinho').innerText = 0;
//         });
//  }