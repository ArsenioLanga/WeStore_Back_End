// app.js

 function adicionar_carrinho(id_carrinho){
     
    axios.default.withCredentials = true;
    axios.get('?p=adicionar_carrinho&id_produto=' + id_carrinho)
        .then(function(response){
            console.log(response);
        });
 }