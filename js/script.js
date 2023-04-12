// o código a baixo é referente ao cadastro, onde ao selecionar o seu tipo de usuário, o form muda de acordo com o tipo selecionado
// obtém o elemento select e os formulários
// ele captura tudo por ID no HTML e faz as alterações dentro do arquivo do CSS
const tipoUsuarioSelect = document.getElementById("tipo-usuario");
const empresaForm = document.getElementById("empresa-form");
const candidatoForm = document.getElementById("candidato-form");


// quando acesso a página ele já muda para a opção pré selecionada
// se estiver pré selecionado empresa, ele exibe empresa.
if(tipoUsuarioSelect.value === "empresa"){
  empresaForm.style.display = "block";
  candidatoForm.style.display = "none";
}else if(tipoUsuarioSelect.value === "candidato"){
  empresaForm.style.display = "none";
  candidatoForm.style.display = "block";
}


// aqui ele de fato faz a alteração quando eu mudo entre empresa e candidato
tipoUsuarioSelect.addEventListener("change", function() {
  if (tipoUsuarioSelect.value === "empresa") {
    empresaForm.style.display = "block";
    candidatoForm.style.display = "none";

  } else if (tipoUsuarioSelect.value === "candidato") {
    empresaForm.style.display = "none";
    candidatoForm.style.display = "block";

  }
});


// o código abaixo é para utilizar uma API do IBGE, para CIDADES e ESTADOS
const estadoSelect = document.getElementById('estado');
  const cidadeSelect = document.getElementById('cidade');

  estadoSelect.addEventListener('change', () => {
    const estado = estadoSelect.value;
    cidadeSelect.innerHTML = '<option value="">Carregando...</option>';

    fetch(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${estado}/municipios`)
      .then(response => response.json())
      .then(cidades => {
        cidadeSelect.innerHTML = '<option value="">Selecione uma cidade</option>';
        cidades.forEach(cidade => {
          const option = document.createElement('option');
          option.value = cidade.nome;
          option.textContent = cidade.nome;
          cidadeSelect.appendChild(option);
        });
      });
  });
  
// o código abaixo é para adicionar uma máscara de CNPJ
function fMasc(objeto, mascara) {
    obj = objeto;
    masc = mascara;
    setTimeout("fMascEx()", 1);
  }
  
  function fMascEx() {
    obj.value = masc(obj.value);
  }
  
  function mCNPJ(cnpj) {
    cnpj = cnpj.replace(/\D/g, "");
    cnpj = cnpj.replace(/^(\d{2})(\d)/, "$1.$2");
    cnpj = cnpj.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3");
    cnpj = cnpj.replace(/\.(\d{3})(\d)/, ".$1/$2");
    cnpj = cnpj.replace(/(\d{4})(\d)/, "$1-$2");
    return cnpj;
  }
  
  
const estadoSelect2 = document.getElementById('estado2');
const cidadeSelect2 = document.getElementById('cidade2');

estadoSelect2.addEventListener('change', () => {
  const estado2 = estadoSelect2.value;
  cidadeSelect2.innerHTML = '<option value="">Carregando...</option>';

  fetch(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${estado2}/municipios`)
    .then(response => response.json())
    .then(cidades => {
      cidadeSelect2.innerHTML = '<option value="">Selecione uma cidade</option>';
      cidades.forEach(cidade2 => {
        const option = document.createElement('option');
        option.value = cidade2.nome;
        option.textContent = cidade2.nome;
        cidadeSelect2.appendChild(option);
      });
    });
});
