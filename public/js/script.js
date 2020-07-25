$(document).ready(function(){
    $("#categoria").change(function(e){
    	let categoria = $(e.target).val();

         $.ajax({
         	type: 'POST',
         	url: '/dadosAjax',
         	data: 'categoria='+categoria,
         	dataType: 'json',
            success: function(dados){
            	console.log(dados);
            	$("#totalVendas").html(dados);
            },
            error: function(error){
            	console.log('error');
            }
         });   

    });
    $("#botao").click(function(){
	$("#exibir").removeClass("paragrafo");
    });

});

var ano_atual = new Date;
ano_atual = ano_atual.getFullYear();
$('#atual').html(ano_atual);

function modificarTodos(id){
	location.href = '/todosServicos?acao=modificarStatus&id='+id;
}
function modificarStatusPendentes(id){
	location.href = '/?acao=modificarStatus&id='+id;
}

function removerTodos(id) {
	location.href = '/todosServicos?acao=remover&id='+id;
}
function excluirPendentes(id){
	location.href = '/?acao=remover&id='+id;

}

function editarTodos(id,valor,tex_categoria,tex_cliente,tex_endereco,tex_servico,tex_descricao){
	let form = document.createElement('form')
	form.action = '/atualizarTodos'
	form.method = 'post'
	form.class = 'row'


	let inputId = document.createElement('input')
	inputId.type = 'hidden'
	inputId.name = 'id'
	inputId.className = 'form-control col-7'
	inputId.value = id

	let inputValor = document.createElement('input')
	inputValor.type = 'number'
	inputValor.name = 'valor'
	inputValor.className = 'form-control col-7'
	inputValor.value = valor

	let inputCategoria = document.createElement('input')
	inputCategoria.type = 'text'
	inputCategoria.name = 'categoria'
	inputCategoria.className = 'form-control col-7'
	inputCategoria.value = tex_categoria

	let inputCliente = document.createElement('input')
	inputCliente.type = 'text'
	inputCliente.name = 'cliente'
	inputCliente.className = 'form-control col-7'
	inputCliente.value = tex_cliente

	let inputEndereco = document.createElement('input')
	inputEndereco.type = 'text'
	inputEndereco.name = 'endereco'
	inputEndereco.className = 'form-control col-7'
	inputEndereco.value = tex_endereco

	let inputServico = document.createElement('input')
	inputServico.type = 'text'
	inputServico.name = 'servico'
	inputServico.className = 'form-control col-7'
	inputServico.value = tex_servico

	let inputDescricao = document.createElement('input')
	inputDescricao.type = 'text'
	inputDescricao.name = 'descricao'
	inputDescricao.className = 'form-control col-7'
	inputDescricao.value = tex_descricao

	let button = document.createElement('button')
	button.type = 'submit'
	button.className = 'col-7 btn btn-info'
	button.innerHTML = 'Atualizar'
    form.appendChild(inputId)
    form.appendChild(inputCategoria)
    form.appendChild(inputCliente)
    form.appendChild(inputEndereco)
    form.appendChild(inputServico)
    form.appendChild(inputDescricao)
    form.appendChild(inputValor)
    form.appendChild(button)

    let servico = document.getElementById('servico_'+id)
    servico.innerHTML = ''
    servico.insertBefore(form, servico[0]);
}

function modificarPendentes(id,valor,tex_categoria,tex_cliente,tex_endereco,tex_servico,tex_descricao){
	let form = document.createElement('form');
	form.action = '/atualizarPendentes'
	form.method = 'post'
	form.className = 'row'

	let inputId = document.createElement('input')
	inputId.type = 'hidden'
	inputId.name = 'id'
	inputId.className = 'col-7 form-control'
	inputId.value = id

	let inputCategoria = document.createElement('input')
	inputCategoria.type = 'text'
	inputCategoria.name = 'categoria'
	inputCategoria.className = 'form-control col-7'
	inputCategoria.value = tex_categoria

	let inputCliente = document.createElement('input')
	inputCliente.type = 'text'
	inputCliente.name = 'cliente'
	inputCliente.className = 'form-control col-7'
	inputCliente.value = tex_cliente

	let inputEndereco = document.createElement('input')
	inputEndereco.type = 'text'
	inputEndereco.name = 'endereco'
	inputEndereco.className = 'form-control col-7'
	inputEndereco.value = tex_endereco

	let inputServico = document.createElement('input')
	inputServico.type = 'text'
	inputServico.name = 'servico'
	inputServico.className = 'form-control col-7'
	inputServico.value = tex_servico

	let inputDescricao = document.createElement('input')
	inputDescricao.type = 'text'
	inputDescricao.name = 'descricao'
	inputDescricao.className = 'form-control col-7'
	inputDescricao.value = tex_descricao

	let inputValor = document.createElement('input')
	inputValor.type = 'number'
	inputValor.name = 'valor'
	inputValor.className = 'form-control col-7'
	inputValor.value = valor

	let button = document.createElement('button')
	button.type = 'submit'
	button.className = 'col-7 btn btn-info'
	button.innerHTML = 'Atualizar'
    form.appendChild(inputId)
    form.appendChild(inputCategoria)
    form.appendChild(inputCliente)
    form.appendChild(inputEndereco)
    form.appendChild(inputServico)
    form.appendChild(inputDescricao)
    form.appendChild(inputValor)
    form.appendChild(button)

    let servico = document.getElementById('servico_'+id)
    servico.innerHTML = ''
    servico.insertBefore(form, servico[0]);

}



